@extends('layouts.app')

@section('content')

<div class="col-sm-12">
   <div class="card">
      <div class="card-header"><strong>Atualizar</strong> <small>Usuário</small></div>
      <div class="card-body">
        {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch']) !!}

            @include('system.users.fields')

        {!! Form::close() !!}
      </div>
   </div>
</div>

@endsection
