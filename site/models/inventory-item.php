<?php

class InventoryItemPage extends Kirby\Cms\Page
{

  public function writeContent(array $data, string|null $languageCode = null): bool
  {
    // file_put_contents("debug.txt", print_r($data, true), FILE_APPEND | LOCK_EX);

    $item = Db::first('items', '*', ['invnum' => $this->invnum()]);

    // Transform multiline YAML strings (e.g. `- file123.jpg\n- file456.jpg` into arrays)
    if ($data["images"]) {
      $splitImages = explode("\n", $data["images"]);
      $imageElements = array_filter(array_map(fn ($image) => substr($image,2), $splitImages));
      $data["images"] = $imageElements;
    }


    if ($item) {
      $update = Db::update('items', $data, ['invnum' => $this->invnum()]);
      return $update;
    }

    $latestInvNum = Db::max('items', 'invnum');

    $data['invnum'] = $latestInvNum + 1;

    $insert = Db::insert('items', $data);

    return $insert;
  }

  public function delete(bool $force = false): bool
  {
    return Db::delete('comments', ['slug' => $this->slug()]);
  }
}
