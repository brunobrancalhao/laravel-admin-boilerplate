@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" style="margin-top: 2%">
                <div class="card" style="width: 40rem;">
                    <div class="card-body">
                        <h4 class="card-title">Verifique seu email</h4>
                        @if (session('resent'))
                            <p class="alert alert-success" role="alert">Um novo link de verificação foi enviado para
Seu endereço de email</p>
                        @endif
                        <p class="card-text">Antes de continuar, verifique se há um link de verificação em seu e-mail. Se você não recebeu o e-mail,</p>
                        <a href="{{ route('verification.resend') }}">clique aqui para solicitar outro</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection