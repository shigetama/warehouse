<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function recplans() {
      return $this->hasMany('App\Recplan');
    }
}
