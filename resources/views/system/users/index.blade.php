@extends('layouts.app')

@section('content')
    @include('flash::message')
    <div class="container-fluid">
        <div class="c-subheader justify-content-between">
            <h3 class="pull-left">Usuários</h3>
            <h3 class="pull-right">
            <a class="btn btn-primary pull-right" href="{{ route('users.create') }}"><i class="cil-plus"></i> Novo Usuário</a>
            </h3>
        </div>
        <br/>
        <table class="table table-responsive-sm table-hover table-outline mb-0">
            <thead class="thead-light">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Nome</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Criação</th>
                    <th class="text-center">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="text-center">{!! $user->id !!}</td>
                        <td class="text-center">{!! $user->name !!}</td>
                        <td class="text-center">{!! $user->email !!}</td>
                        <td class="text-center">{!! $user->created_at->format('d-m-Y H:i:s') !!}</td>
                        <td class="text-center">
                            {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                                <a href="{{ route('users.edit', [$user->id]) }}" class='btn btn-primary btn-xs'><i class="cil-pencil"></i></a>
                                {!! Form::button('<i class="cil-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Tem certeza?')"]) !!}
                            {!! Form::close() !!}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
