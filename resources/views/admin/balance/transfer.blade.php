@extends('adminlte::page')

@section('title', 'Transferência')

@section('content_header')
<h1>Fazer Transferência</h1>
<ol class="breadcrumb">
  <li><a href="#">Dashboard</a></li>
  <li><a href="#">Saldo</a></li>
  <li><a href="#">Transferência</a></li>
</ol>
@stop

@section('content')
<div class="box">
  <div class="box-header">
    <h3>Fazer Transferência (Informe o Recebedor)</h3>
  </div>
  <div class="box-body">

    @include('admin.includes.alerts')

    <form class="" action="{{ route('confirm.transfer') }}" method="POST">
      {{ csrf_field() }}
      <div class="form-group">
        <input type="text" name="sender" class="form-control" placeholder="Informação de quem vai receber o a transferência" autofocus>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success">
          Próxima etapa
        </button>
      </div>


    </form>

  </div>
</div>


@stop
