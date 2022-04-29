@extends('layout')

@push('styles')
    <link href="{{ asset('css/style-temporada.css') }}" rel="stylesheet">
@endpush

@section('titulo')
    Temporadas
@endsection

@extends('header')

@section('conteudo')

    <main class="container-principal">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/series">Home</a></li>
                <li class="breadcrumb-item ativo" aria-current="page">Temporadas</li>
            </ol>
        </nav>

        <div class="titulo">
            <h1>{{$serie->nome}} - Temporadas</h1>
        </div>

    <ul class="lista">
        @foreach ($temporadas as $temporada)
            <li class="item-lista">
                <a href="/temporadas/{{$temporada->id}}/episodios">{{$temporada->nome}}</a>
                <span class="badge badge-secondary">{{$temporada->episodiosAssistidos()->count()}}/{{$temporada->episodios->count()}}</span>
            </li>
        @endforeach
    </ul>

    </main>

@endsection
