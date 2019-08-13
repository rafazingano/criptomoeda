@extends('adminlte::page')

@section('content')
	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>Usuários</h2>
	        </div>
	        <div class="pull-right">
                @role('admin')
	            <a class="btn btn-success" href="{{ route('users.create') }}"> Criar novo usuário</a>
                @endrole
                @role('diretoria')
                <a class="btn btn-success" href="{{ route('users.create') }}"> Criar novo usuário</a>
                @endrole
                @role('financeiro')
                <a class="btn btn-success" href="{{ route('users.create') }}"> Criar novo usuário</a>
                @endrole
	        </div>
	    </div>
	</div>
	@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
	@endif
	<table class="table table-bordered">
		<tr>
			<th>No</th>
			<th>Nome</th>
			<th>Email</th>
			<th>Perfil</th>
			<th width="280px"></th>
		</tr>
	@foreach ($data as $key => $user)
	<tr>
		<td>{{ ++$i }}</td>
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
			<a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Ver</a>
			<a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Editar</a>
			{!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Deletar', ['class' => 'btn btn-danger']) !!}
        	{!! Form::close() !!}
		</td>
	</tr>
	@endforeach
	</table>
	{!! $data->render() !!}
@endsection
