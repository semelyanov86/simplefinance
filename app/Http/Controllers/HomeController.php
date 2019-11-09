<?php

namespace App\Http\Controllers;

use App\AccountType;
use App\CardType;
use App\Currency;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $now = Carbon::now();
        $accountTypes = AccountType::getAllSortableTypes();
        $currencies = Currency::where('is_active', '1')->get();
        $cardTypes = CardType::all();
        $monthes = json_encode(range(1, 12));
        $years = json_encode(range((int) $now->year, ((int) $now->year) + 20));
        return view('home', compact('accountTypes', 'currencies', 'cardTypes', 'monthes', 'years'));
    }
}
