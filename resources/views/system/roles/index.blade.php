@extends('layouts.app')


@section('content')

@include('flash::message')
    <div class="container-fluid">
    <div class="c-subheader justify-content-between">
        <h3 class="pull-left">Grupos de Usuários</h3>
        <h3 class="pull-right">
            @can('role-create')
                <a class="btn btn-primary pull-right" href="{{ route('roles.create') }}"><i class="cil-plus"></i> Novo Grupo</a>
            @endcan
        </h3>
    </div>
    <br/>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-responsive-sm table-hover table-outline mb-0">
        <thead class="thead-light">
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Nome</th>
                <th class="text-center" width="280px">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $key => $role)
                <tr>
                    <td class="text-center">{{ ++$i }}</td>
                    <td class="text-center">{{ $role->name }}</td>
                    <td class="text-center">
                        <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}"><i class="cil-low-vision"> </i></a>
                        @can('role-edit')
                            <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}"><i class="cil-pencil"></i></a>
                        @endcan
                        @can('role-delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                {!! Form::button('<i class="cil-trash"></i>', ['type' => 'submit','class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


{!! $roles->render() !!}

@endsection