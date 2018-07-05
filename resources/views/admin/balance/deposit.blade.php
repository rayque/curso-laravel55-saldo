@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1>Fazer Recarrega</h1>
<ol class="breadcrumb">
  <li><a href="#">Dashboard</a></li>
  <li><a href="#">Saldo</a></li>
  <li><a href="#">Depositar</a></li>
</ol>
@stop

@section('content')
<div class="box">
  <div class="box-header">
    <h3>Fazer Recarga</h3>
  </div>
  <div class="box-body">

    @include('admin.includes.alerts')

    <form class="" action="{{ route('deposit.store') }}" method="POST">
      {{ csrf_field() }}
      <div class="form-group">
        <input type="text" name="value" class="form-control" placeholdeR="Valor Recarga">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success">
          <i class="fa fa-plus fa-fw"></i>
          Recarregar
        </button>
      </div>


    </form>

  </div>
</div>


@stop
