<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;

class Shipplan extends Model
{
  // 商品名称取得
    public function items() {
      return Item::where('id', $this->item_id)->first()->name;
    }
}
