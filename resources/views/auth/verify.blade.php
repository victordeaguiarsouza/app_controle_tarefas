@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verifique seu endereço de Email</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Um novo link de verificação foi enviado para seu email.
                        </div>
                    @endif

                    Antes de proceguir, por favor verifique seu email.
                    Caso não tenha recebido o email,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">clique aqui que enviaremos outro</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
