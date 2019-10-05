<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Syscategory extends Model
{
    protected $fillable = ['sys_category_name', 'sys_category_type'];

    public function categories()
    {
        return $this->hasMany('App\Category', 'sys_category_id');
    }
}
