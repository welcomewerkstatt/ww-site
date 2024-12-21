<?php
/**
 * DB SQLite Implementation
 */

use Kirby\Uuid\Uuid;

class InternalInventoryPage extends Kirby\Cms\Page
{
    public function children(): Pages
    {
        
        $items = []; 
        $dbItems = Db::select('items');

        foreach ($dbItems as $item) {
            // if ($item->images() == null) {
            //     file_put_contents("debug.txt", print_r($item, true), FILE_APPEND | LOCK_EX);
            // }
            $items[] = [
                'slug'     => $item->invnum(),
                'num'      => 0,
                'template' => 'inventory-item',
                'model'    => 'inventory-item',
                'content'  => [
                    'title'        => $item->manufacturer()." ".$item->name()." ".$item->model(),
                    'name'         => $item->name(),
                    'invnum'       => $item->invnum(),
                    'model'        => $item->model(),
                    'amount'       => $item->amount(),
                    'manufacturer' => $item->manufacturer(),
                    'registered'   => $item->registered(),
                    'location'     => $item->location(),
                    'owner'        => $item->owner(),
                    'category'     => $item->category(),
                    'source'       => $item->source(),
                    'price'        => $item->price(),
                    'discharge'    => $item->discharge(),
                    'notes'        => $item->notes(),
                    'internalPage' => empty($item->internalpage()) ? null : json_decode($item->internalpage()),
                    'uuid'         => "inv" . $item->invnum(),
                    'images'       => empty($item->images()) ? null : json_decode($item->images()),
                ]
            ];
        }

        return $this->children = Pages::factory($items, $this);
    }
}
