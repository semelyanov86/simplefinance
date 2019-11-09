<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'acc_state',
        'account_type_id',
        'bank_bik',
        'currency_code',
        'description',
        'market_amount',
        'name',
        'start_balance',
        'user_id'
    ];

    /**
     * Get the account record associated with the extra type.
     */
    public function accountType()
    {
        return $this->belongsTo('App\AccountType');
    }

    public function extraTable()
    {
        $modelName = $this->accountType->extra_model;
        if ($modelName) {
            return $this->hasOne($modelName);
        } else {
            return null;
        }
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
