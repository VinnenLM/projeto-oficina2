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

    </main>

@endsection
