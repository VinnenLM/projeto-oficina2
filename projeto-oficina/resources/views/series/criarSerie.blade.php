@extends('layout')

@push('styles')
    <link href="{{ asset('css/style-criar-serie.css') }}" rel="stylesheet">
@endpush

@section('titulo')
    Criar de Série
@endsection

@extends('header')

@section('conteudo')

    <main class="container-principal">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/series">Home</a></li>
                <li class="breadcrumb-item ativo" aria-current="page">Adicionar Série</li>
            </ol>
        </nav>

        <div class="titulo">
            <h1>Adicionar Série</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger align-items-center">
                <ul class="mt-0 mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="/series/adicionar">
            @csrf
            <div class="row">
                <div class="col col-8">
                    <label for="nome">Nome</label>
                    <input class="form-control" type="text" name="nome" id="nome">
                </div>
                <div class="col col-2">
                    <label for="qtd_temporadas">N° Temporadas</label>
                    <input class="form-control" type="number" min="1" name="qtd_temporadas" id="qtd_temporadas">
                </div>
                <div class="col col-2">
                    <label for="qtd_episodios">N° Episódios</label>
                    <input class="form-control" type="number" min="1" name="qtd_episodios" id="qtd_episodios">
                </div>
            </div>
            <button class="btn btn-success">Salvar</button>
        </form>

    </main>
@endsection
