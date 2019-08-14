@extends('adminlte::page')

@section('title', 'Saldo')

@section('content_header')
    <h1>Saldo</h1>

    <div class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
    </div>
@stop

@section('content')
    <div class="box">

        <div class="box-header">
 
            <a href="{{ route('balance.deposit') }}" class="btn btn-success">
                <i class="fa fa-cart-plus" aria-hidden="true">
                    Recarregar
                </i>
            </a>
   

            @if ($amout > 0 && false)
                <a href="{{ route('balance.withdraw') }}" class="btn btn-danger">
                    <i class="fa fa-cart-arrow-down" aria-hidden="true">
                        Sacar
                    </i>
                </a>

                <a href="{{ route('balance.transfer') }}" class="btn btn-info">
                    <i class="fa fa-exchange" aria-hidden="true">
                        Transferir
                    </i>
                </a>
            @endif

        </div>

        <div class="box-body">
            @include('admin.includes.alerts')
            <h1>Meu saldo</h1>
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>R${{ number_format($amout, 2, ',', '.') }}</h3>
                </div>
                <div class="icon">
                    <i class="ion ion-cash"></i>
                </div>
                <a href="#" class="small-box-footer">Histórico<i class="fa fa-arrow-circle-right"></i></a>
            </div>

            <hr>

            @php
                $percent = 1;
                $mostratabelaganhos = false;
                if(auth()->user()->hasRole('investidor')){
                    $percent = 17;
                    $mostratabelaganhos = true;
                }
                if(auth()->user()->hasRole('consultor')){
                    $percent = 4;
                    $mostratabelaganhos = true;
                }
                if(auth()->user()->hasRole('franqueado')){
                    $percent = 3;
                    $mostratabelaganhos = true;
                }
                 if(auth()->user()->hasRole('franqueador')){
                    $percent = 1;
                    $mostratabelaganhos = true;
                }
                $total = ($amout * $percent) / 100;
            @endphp

            @if($mostratabelaganhos)
                <h1>Previsão dos ganhos</h1>
            <table class="table table-bordered">
                <tr>
                    <th>Dia</th>
                    <th>Valor</th>
                </tr>
                @for($i=0; $i < 30; $i++)
                @php
                    $total = (($total * 0.5) / 100) + $total
                @endphp
                <tr>
                    <td>{{ $mutable->add(1, 'day') }}</td>
                    <td>{{ number_format($total, 2, ',', '.') }}</td>
                </tr>
                @endfor
            </table>

            <h1>A receber</h1>

            <div class="small-box bg-green">
                <div class="inner">
                    <h3>R${{ number_format($total, 2, ',', '.') }}</h3>
                </div>
                <div class="icon">
                    <i class="ion ion-cash"></i>
                </div>
            </div>
        @endif
        </div>
    </div>
@stop
