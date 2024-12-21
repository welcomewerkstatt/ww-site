<?php
/**
 * DB SQLite Implementation
 */

use Kirby\Uuid\Uuid;

class InternalInventoryPage extends Kirby\Cms\Page
{
    public function children(): Pages
    {
        // $insert = Db::insert('items', ["manufacturer" => array("hersteller1", "hersteller2"), "model" => "def"]);
        // $update = Db::update('items', ["manufacturer" => array("hersteller3", "hersteller4")], ['invnum' => 730]);
        
        // $lastQuery = Db::connection()->lastQuery();
        // $lastError = Db::connection()->lastError();
        // $lastResult = Db::connection()->lastResult();
        // $trace = Db::connection()->trace();
        // file_put_contents("debug.txt", print_r($lastQuery, true), FILE_APPEND | LOCK_EX);
        // file_put_contents("debug.txt", print_r($lastError, true), FILE_APPEND | LOCK_EX);
        // file_put_contents("debug.txt", print_r($lastResult, true), FILE_APPEND | LOCK_EX);
        // file_put_contents("debug.txt", print_r($trace, true), FILE_APPEND | LOCK_EX);
        // $newItem = Db::first('items', '*', '"invnum"=747');
        // file_put_contents("debug.txt", print_r(json_decode($newItem->manufacturer), true), FILE_APPEND | LOCK_EX);
        $items = []; 
        $dbItems = Db::select('items');
        // file_put_contents("debug.txt", print_r($dbItems, true), FILE_APPEND | LOCK_EX);

        // var_dump($dbItems);

        foreach ($dbItems as $item) {
            if ($item->images() == null) {
                file_put_contents("debug.txt", print_r($item, true), FILE_APPEND | LOCK_EX);
            }
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

        // var_dump($items[0]);

        return $this->children = Pages::factory($items, $this);
    }
}
