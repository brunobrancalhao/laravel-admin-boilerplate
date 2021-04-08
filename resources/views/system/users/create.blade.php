@extends('layouts.app')

@section('content')


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><strong>Cadastrar</strong> <small>Usuário</small></div>
            <div class="card-body">
                {!! Form::open(['route' => 'users.store']) !!}

                    @include('system.users.fields')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
