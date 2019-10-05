<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = ['category_name', 'category_type', 'isHidden', 'sys_category_id', 'parent_id'];

    public function syscategory()
    {
        return $this->belongsTo('App\Syscategory', 'sys-category_id');
    }
}
