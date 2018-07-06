<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use \App\User;

class Balance extends Model
{
  public $timestamps = false;

  public function deposit(float $value) : Array
  {
    DB::beginTransaction();

    $totalBefore = $this->amount ?? 0 ;
    $this->amount += number_format($value, 2, '.', '');
    $deposit = $this->save();

    $historic = auth()->user()->historics()->create([
      'type'          => 'I',
      'amount'        => $value,
      'total_before'  => $totalBefore,
      'total_after'   => $this->amount,
      'date'          => date('Ymd')
    ]);

    if ($deposit and $historic){
      DB::commit();
      return [
        'success' => true,
        'message' => 'Sucesso ao recarregar'
      ];
    }else{
      DB::rollback();
      return [
        'success' => false,
        'message' => 'Falha ao recarregar'
      ];
    }
  }

  public function withdraw(float $value) : Array
  {
    if($this->amount < $value){
      return [
        'success' => false,
        'message' => 'Saldo insuficiente!'
      ];
    }

    DB::beginTransaction();

    $totalBefore = $this->amount ?? 0 ;
    $this->amount -= number_format($value, 2, '.', '');
    $withrawn = $this->save();

    $historic = auth()->user()->historics()->create([
      'type'          => 'O',
      'amount'        => $value,
      'total_before'  => $totalBefore,
      'total_after'   => $this->amount,
      'date'          => date('Ymd')
    ]);

    if ($withrawn and $historic){
      DB::commit();
      return [
        'success' => true,
        'message' => 'Sucesso ao retirar'
      ];
    }else{
      DB::rollback();
      return [
        'success' => false,
        'message' => 'Falha ao retirar'
      ];
    }

  }

  public function transfer(float $value, User $sender): Array
  {
    if($this->amount < $value){
      return [
        'success' => false,
        'message' => 'Saldo insuficiente!'
      ];
    }

    DB::beginTransaction();

    /************************************************************
    * Atualiza o próprio saldo
    *************************************************************/

    $totalBefore = $this->amount ?? 0 ;
    $this->amount -= number_format($value, 2, '.', '');
    $transfer = $this->save();

    $historic = auth()->user()->historics()->create([
      'type'                => 'T',
      'amount'              => $value,
      'total_before'        => $totalBefore,
      'total_after'         => $this->amount,
      'date'                => date('Ymd'),
      'user_id_transaction' => $sender->id,
    ]);

    /************************************************************
    * Atualiza o saldo do recebedor
    *************************************************************/
    $senderBalance = $sender->balance()->firstOrCreate([]);
    $totalBeforeSender = $senderBalance->amount ?? 0 ;
    $senderBalance->amount += number_format($value, 2, '.', '');
    $transferSender = $senderBalance->save();

    $historicSender = $sender->historics()->create([
      'type'                => 'I',
      'amount'              => $value,
      'total_before'        => $totalBeforeSender,
      'total_after'         => $senderBalance->amount,
      'date'                => date('Ymd'),
      'user_id_transaction' => auth()->user()->id,
    ]);

    if ($transfer and $historic and $transferSender and $historicSender){

      DB::commit();

      return [
        'success' => true,
        'message' => 'Sucesso ao transferir'
      ];
    }

    DB::rollback();

    return [
      'success' => false,
      'message' => 'Falha ao transferir'
    ];
  }

}
