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
            @role('investidor')
            <a href="{{ route('balance.deposit') }}" class="btn btn-success">
                <i class="fa fa-cart-plus" aria-hidden="true">
                    Recarregar
                </i>
            </a>
            @endrole

            @if ($amout > 0)
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

        </div> <!-- box-header -->

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

            </div> <!-- small-box bg-green -->




<hr>
<h1>Listagem dos meus usuários</h1>





            <table class="table table-bordered">
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Perfil</th>
                    <th>Valor</th>
                    <th>% a receber</th>
                </tr>
                @php
                    $total = 0;
                @endphp
            @foreach ($data as $key => $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if(!empty($user->roles))
                        @foreach($user->roles as $v)
                            <label class="label label-success">{{ $v->display_name }}</label>
                        @endforeach
                    @endif
                </td>
                <td>
                    R${{ number_format($user->balance? $user->balance->amount : 0, 2, ',', '.') }}
                </td>
                <td>
                    @php
                    if($user->balance){
                       $total = ($user->balance->amount * 0.02) + $total;
                    }
                        @endphp
                    R${{ number_format(($user->balance? $user->balance->amount * 0.02 : 0), 2, ',', '.') }}
                </td>
            </tr>
            @endforeach
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





        </div> <!-- box-body -->

    </div> <!-- box -->
@stop
