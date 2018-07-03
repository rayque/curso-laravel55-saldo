<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Balance;

class BalanceController extends Controller
{
    public function index()
    {
      $balance = auth()->user()->balance;
      $amount = $balance ? $balance->amount : 0;

      return view('admin.balance.index', compact('amount'));
    }

    public function deposit()
    {
      return view('admin.balance.deposit');
    }

    public function depositStore(Request $request, Balance $balance)
    {
      // firstOrCrete([]) ==  retorna o valor da table, caso contrário  cria um registro com o valor predefinido
      $balance = Auth()->user()->balance()->firstOrCreate([]);
      // $balance->deposit($request->value);
      dd($balance->deposit($request->value));

    }

}
