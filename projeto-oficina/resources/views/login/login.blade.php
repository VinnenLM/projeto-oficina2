@extends('layout')

@push('styles')
    <link href="{{ asset('css/style-login.css') }}" rel="stylesheet">
@endpush

@section('titulo')
    Login
@endsection

@section('conteudo')

    <h1>LOGIN</h1>

    <main class="container-principal">

        @if ($errors->any())
            <div class="alert alert-danger align-items-center">
                <ul class="mt-0 mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post">
            @csrf
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" required class="form-control">
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" name="password" id="password" required min="1" class="form-control">
            </div>

            <div class="botoes">
                <button type="submit" class="btn btn-success mt-3">
                    Entrar
                </button>

                <a href="/registrar">
                    Registrar
                </a>
            </div>

        </form>

    </main>

@endsection
