<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraDebitCard extends Model
{
    protected $fillable = [
        'expire_date_month',
        'atm_commission',
        'account_id',
        'card_type_id',
        'expire_date_year',
        'other_atm_commission',
        'rate_balance',
        'year_cost'
    ];

    /**
     * Get the account record associated with the extra type.
     */
    public function account()
    {
        return $this->hasOne('App\Account');
    }

    /**
     * Get the card type record associated with the extra type.
     */
    public function cardType()
    {
        return $this->hasOne('App\CardType');
    }
}
