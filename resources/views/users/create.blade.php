@extends('adminlte::page')

@section('content')
	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>Criar novo usuário</h2>
	        </div>
	        <div class="pull-right">
	            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
	        </div>
	    </div>
	</div>
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong> ouve algum problema.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nome:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Senha:</strong>
                {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Confirme a senha:</strong>
                {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Perfil:</strong>
                {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <label for="title">Pais</label>
                <select id="country" name="category_id" class="form-control" style="width:350px" >
                <option value="" selected disabled>Selecione um pais</option>
                    @foreach($countries as $key => $country)
                    <option value="{{$key}}"> {{$country}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">Estado</label>
                <select name="state" id="state" class="form-control" style="width:350px">
                </select>
            </div>

            <div class="form-group">
                <label for="title">Cidade</label>
                <select name="cities[]" id="city" class="form-control" style="width:350px" multiple>
                </select>
            </div>
        </div>



        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>CPF:</strong>
                {!! Form::text('cpf', null, array('placeholder' => 'cpf','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>RG:</strong>
                {!! Form::text('rg', null, array('placeholder' => 'rg','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>Data:</strong>
                {!! Form::text('data', null, array('placeholder' => 'data','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>Sexo:</strong>
                {!! Form::text('sexo', null, array('placeholder' => 'sexo','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>Nacionalidade:</strong>
                {!! Form::text('nacionalidade', null, array('placeholder' => 'nacionalidade','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>Naturalidade:</strong>
                {!! Form::text('naturalidade', null, array('placeholder' => 'naturalidade','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>Endereco:</strong>
                {!! Form::text('endereco', null, array('placeholder' => 'endereco','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>Fone:</strong>
                {!! Form::text('fone', null, array('placeholder' => 'fone','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>Matricula:</strong>
                {!! Form::text('matricula', null, array('placeholder' => 'matricula','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>Estado civil:</strong>
                {!! Form::text('estadocivil', null, array('placeholder' => 'estadocivil','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>Conjuge:</strong>
                {!! Form::text('conjuge', null, array('placeholder' => 'conjuge','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>Carteira digital:</strong>
                {!! Form::text('carteiradigital', null, array('placeholder' => 'carteiradigital','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>Banco:</strong>
                {!! Form::text('banco', null, array('placeholder' => 'banco','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>Agencia:</strong>
                {!! Form::text('agencia', null, array('placeholder' => 'agencia','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>Tipo conta:</strong>
                {!! Form::text('tipoconta', null, array('placeholder' => 'tipoconta','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <strong>Titular conta:</strong>
                {!! Form::text('titularconta', null, array('placeholder' => 'titularconta','class' => 'form-control')) !!}
            </div>
        </div>



        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary">Enviar</button>
        </div>
	</div>
	{!! Form::close() !!}
@endsection



@section('adminlte_js')
<script type="text/javascript">
    $('#country').change(function(){
    var countryID = $(this).val();
    if(countryID){
        $.ajax({
           type:"GET",
           url:"{{url('get-state-list')}}?country_id="+countryID,
           success:function(res){
            if(res){
                $("#state").empty();
                $("#state").append('<option>Selecione um estado</option>');
                $.each(res,function(key,value){
                    $("#state").append('<option value="'+key+'">'+value+'</option>');
                });

            }else{
               $("#state").empty();
            }
           }
        });
    }else{
        $("#state").empty();
        $("#city").empty();
    }
   });
    $('#state').on('change',function(){
    var stateID = $(this).val();
    if(stateID){
        $.ajax({
           type:"GET",
           url:"{{url('get-city-list')}}?state_id="+stateID+"&all="+ {{ auth()->user()->roles()->whereIn('name', ['admin', 'diretoria'])->count() }},
           success:function(res){
            if(res){
                $("#city").empty();
                $.each(res,function(key,value){
                    $("#city").append('<option value="'+key+'">'+value+'</option>');
                });

            }else{
               $("#city").empty();
            }
           }
        });
    }else{
        $("#city").empty();
    }

   });
</script>

@endsection
