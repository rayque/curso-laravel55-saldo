@extends('adminlte::page')

@section('title', 'Confirma Transferência')

@section('content_header')
<h1>Confirma Transferência Saldo</h1>
<ol class="breadcrumb">
  <li><a href="#">Dashboard</a></li>
  <li><a href="#">Saldo</a></li>
  <li><a href="#">Transferência</a></li>
  <li><a href="#">Confirmação</a></li>
</ol>
@stop

@section('content')
<div class="box">
  <div class="box-header">
    <h3>Confirmar Transferência</h3>
  </div>
  <div class="box-body">

    @include('admin.includes.alerts')

    <p> <strong>Recebedor: </strong> {{ $sender->name }} </p>
    <p> <strong>Seu saldo: </strong> {{ $balance->amount }} </p>

    <form class="" action="{{ route('transfer.store') }}" method="POST">
      {{ csrf_field() }}

      <input type="hidden" name="sender_id" value="{{ $sender->id }} ">

      <div class="form-group">
        <input type="text" name="value" class="form-control" placeholder="Valor:" autofocus>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success">
          <i class="fa fa-exchange fa-fw"></i>
          Transferir
        </button>
      </div>


    </form>

  </div>
</div>


@stop
