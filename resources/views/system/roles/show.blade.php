@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">Grupo de Usuários</div>
            <div class="card-body">
                <div class="form-group">
                    <strong>Nome:</strong>
                    {{ $role->name }}
                </div>
                <div class="form-group">
                    <strong>Permissões:</strong>
                    @if(!empty($rolePermissions))
                        @foreach($rolePermissions as $v)
                            <label class="label label-success">{{ $v->name }},</label>
                        @endforeach
                    @endif
                </div>
                <div class="form-group">
                    <a class="btn btn-danger" href="{{ route('roles.index') }}"> Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
