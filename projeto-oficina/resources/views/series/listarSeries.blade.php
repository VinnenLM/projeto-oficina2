@extends('layout')

@push('styles')
    <link href="{{ asset('css/style-listar-series.css') }}" rel="stylesheet">
@endpush

@section('titulo')
    Controle de Séries
@endsection

@section('conteudo')

    @include('header')

    <main class="container-principal">

        <div class="titulo">
            <h1>Listagem de Séries</h1>
        </div>

        @if(!empty($mensagem))
            <div id="mensagem" class="alert alert-success">{{$mensagem}}</div>
        @endif

        <div class="d-flex justify-content-between">
            <a id="adicionar" href="/series/adicionar" class="btn btn-success" role="button">Adicionar</a>
            <form action="/buscar" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Buscar Série" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </form>
        </div>

        <ul class="lista">
            @foreach ($series as $serie)
                <li class="item-lista">
                    <a id="serie-{{$serie->id}}" href="/series/{{$serie->id}}/temporadas">{{$serie->nome}}</a>
                    <div class="botoes">
                        <form action="/series/{{$serie->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Tem certeza?')" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>

    </main>

    @include('bootstrapJs')

@endsection
