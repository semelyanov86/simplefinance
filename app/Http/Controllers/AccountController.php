<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests\AccountStoreRequest;
use App\User;
use Faker\Provider\Payment;
use Illuminate\Http\Request;
use App\ExtraDebitCard;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountStoreRequest $request)
    {
        $account = new Account();
        $childModel = false;
        foreach ($request->all() as $key => $value) {
            if (!is_array($value)) {
                $account->$key = strval($value);
            } else {
                $childModel = $this->getChildEntityFromRequest($value, $key);
            }
        }
        $account->user_id = Auth::user()->id;
        $account->save();
        if ($childModel) {
            $childModel->account_id = $account->id;
            $childModel->save();
        }
        $account->message = 'Новый счёт успешно добавлен';
        return $account;
    }

    private function getChildEntityFromRequest($childArray, $key)
    {
        $classname = 'App\\' . $key;
        $childModel = new $classname();
        foreach ($childArray as $key => $value) {
            if (is_array($value)) {
                $value = $value['id'];
            }
            $childModel->$key = $value;
        }
        return $childModel;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
