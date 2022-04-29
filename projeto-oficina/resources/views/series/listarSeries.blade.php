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

        <a id="adicionar" href="/series/adicionar" class="btn btn-success" role="button">Adicionar</a>

        <ul class="lista">
            @foreach ($series as $serie)
                <li class="item-lista">
                    <a id="serie-{{$serie->id}}" href="/series/{{$serie->id}}/temporadas">{{$serie->nome}}</a>
                </li>
            @endforeach
        </ul>

    </main>

    @include('bootstrapJs')

@endsection
