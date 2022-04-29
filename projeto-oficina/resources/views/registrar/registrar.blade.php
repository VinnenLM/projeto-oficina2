@extends('layout')

@push('styles')
    <link href="{{ asset('css/style-registrar.css') }}" rel="stylesheet">
@endpush

@section('titulo')
    Registrar-se
@endsection

@section('conteudo')

    <h1>REGISTRAR</h1>

    <main class="container-principal">

        <form method="post">
            @csrf
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" required class="form-control">
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" required class="form-control">
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" name="password" id="password" required min="1" class="form-control">
            </div>

            <button type="submit" class="btn btn-success mt-3">
                Salvar
            </button>

            <span>Já Cadastrado?<a href="/entrar">Entrar</a></span>
        </form>
    </main>
@endsection
