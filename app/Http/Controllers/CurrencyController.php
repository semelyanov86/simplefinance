<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyUpdateRequest;
use App\Currency;

class CurrencyController extends Controller
{
    public function update(CurrencyUpdateRequest $request)
    {
        Currency::where('is_active', '1')->update(['is_active' => '0']);
        Currency::where('is_default', '1')->update(['is_default' => '0']);
        $activeCurrencies = $request->get('active');
        $defaultCurrency = $request->get('defaultCurrency');
        foreach ($activeCurrencies as $currency) {
            Currency::whereId($currency['id'])->update($currency);
        }
        Currency::whereId($defaultCurrency['id'])->update($defaultCurrency);
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Currencies list has been updated',
            ]);
        }
        return redirect()->back()->with('success', 'Currencies has been updated');
    }
}
