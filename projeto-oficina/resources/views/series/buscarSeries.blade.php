@extends('layout')

@push('styles')
    <link href="{{ asset('css/style-buscar-series.css') }}" rel="stylesheet">
@endpush

@section('titulo')
    Controle de Séries
@endsection

@section('conteudo')

    @include('header')

    <main class="container-principal">

        <div class="titulo">
            <h1>Busca por Séries</h1>
        </div>

        @if(!empty($mensagem))
            <div id="mensagem" class="alert alert-warning">{{$mensagem}}</div>
        @endif

        @if(isset($series))
            <ul class="lista">
                <p>Resultado da busca:</p>
                @foreach ($series as $serie)
                    <li class="item-lista">
                        <a id="serie-{{$serie->id}}" href="/series/{{$serie->id}}/temporadas">{{$serie->nome}}</a>
                    </li>
                @endforeach
            </ul>
        @endif

    </main>

    @include('bootstrapJs')

@endsection
