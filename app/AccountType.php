<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    protected $fillable = ['name', 'parent', 'id'];

    public static function getAllSortableTypes()
    {
        return self::all()
            ->sortBy('parent')
            ->groupBy('parent')
            ->map(function ($type, $key) {
                $newType = new AccountType();
                $newType->name = $key;
                $newType->id = '-1';
                $newType->parent = $key;
                $type->prepend($newType);
                return $type;
            })
            ->collapse();
    }
}
