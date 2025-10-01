<?php

return [
	'description' => 'Import inventory items from a single Kirby YML page to a multi page setup.',
	'args' => [],
	'command' => static function ($cli): void {
		$kirby = $cli->kirby();
		$kirby->impersonate('kirby');
		$site = $kirby->site();
		$oldInventory = $site->index()->findBy('intendedTemplate', 'inventory');
		$newInventory = $site->index()->findBy('intendedTemplate', 'items');

		if (!$oldInventory) {
			$cli->error('Old Inventory page not found.');
			return;
		}
		if (!$newInventory) {
			$cli->error('New Inventory page not found.');
			return;
		}

		$items = $oldInventory->items()->toStructure();

		if ($items->count() === 0) {
			$cli->error('No items found in the inventory page.');
			return;
		}

		// Build a UUID to filename mapping from the inventar images directory
		$uuidToFile = [];
		$imagesDir = $kirby->root('content') . '/inventar/images';
		
		if (is_dir($imagesDir)) {
			$files = glob($imagesDir . '/*.txt');
			foreach ($files as $txtFile) {
				$uuid = trim(file_get_contents($txtFile));
				if (str_starts_with($uuid, 'Uuid: ')) {
					$uuid = trim(str_replace('Uuid: ', '', $uuid));
					$imageFile = str_replace('.txt', '', $txtFile);
					if (file_exists($imageFile)) {
						$uuidToFile[$uuid] = $imageFile;
					}
				}
			}
		}
		
		$cli->dump('Found ' . count($uuidToFile) . ' image mappings.');

		foreach ($items as $item) {
			$cli->dump('Processing item: ' . $item->invnum());
			
			// Check if page already exists
			$existingPage = $newInventory->find($item->invnum());
			if ($existingPage) {
				$cli->dump('Skipping existing item: ' . $item->invnum());
				continue;
			}
			
		// Helper function to normalize text fields
		$normalizeText = function($value) {
			$stringValue = trim((string) $value);
			return ($stringValue === '-' || $stringValue === '–') ? '' : $stringValue;
		};

		// Create the page first
		$newPage = $newInventory->createChild([
			'slug' => $item->invnum(),
			'template' => 'item',
			'draft' => false,
			'content' => [
				'title' => $item->invnum(),
				'invnum' => $item->invnum(),
				'registered' => $item->registered(),
				'manufacturer' => $normalizeText($item->manufacturer()),
				'model' => $normalizeText($item->model()),
				'amount' => $item->amount(),
				'name' => $normalizeText($item->name()),
				'location' => $item->location(),
				'locationDetail' => $normalizeText($item->locationdetail()),
				'owner' => $normalizeText($item->owner()),
				'category' => $normalizeText($item->category()),
				'source' => $normalizeText($item->source()),
				'price' => $item->price(),
				'discharge' => $normalizeText($item->discharge()),
				'notes' => $normalizeText($item->notes()),
				'internalPage' => $item->internalpage()->value(),
			]
		]);
		// Copy images if they exist
			if ($item->images()->isNotEmpty()) {
				$imageReferences = $item->images()->value(); // This should be an array of file:// references
				
				foreach ($imageReferences as $imageRef) {
					// Remove the 'file://' prefix to get the UUID
					$uuid = str_replace('file://', '', $imageRef);
					
					// Find the source file by UUID using our mapping
					if (isset($uuidToFile[$uuid])) {
						$sourceFilePath = $uuidToFile[$uuid];
						$sourceFileName = basename($sourceFilePath);
						
						$cli->dump('Copying image: ' . $sourceFileName);
						
						// Copy the file to the new page directory
						try {
							$newPage->createFile([
								'source' => $sourceFilePath,
								'filename' => $sourceFileName
							]);
						} catch (Exception $e) {
							$cli->error('Failed to copy image ' . $sourceFileName . ': ' . $e->getMessage());
						}
					} else {
						$cli->error('Source image not found for UUID: ' . $uuid);
					}
				}
			}
		}

		$cli->dump('Found ' . $items->count() . ' items in the inventory page.');
		$cli->success('Nice command!');
	}
];
