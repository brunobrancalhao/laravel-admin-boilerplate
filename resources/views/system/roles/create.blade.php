@extends('layouts.app')


@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Ops!</strong> Existe problemas com os campos!<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

<div class="container-fluid">
    <div class="card">
        <div class="card-header">Criar Grupo</div>
        <div class="card-body">
            {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                <div class="form-group">
                    <strong>Nome:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <strong>Permissões:</strong>
                    <br/>
                    @foreach($permission as $value)
                        <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                        {{ $value->name }}</label>
                    <br/>
                    @endforeach
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                    <a class="btn btn-danger" href="{{ route('roles.index') }}"> Voltar</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection