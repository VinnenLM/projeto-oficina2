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
                @csrf
                <div class="input-group mb-3">
                    <input id="buscar" name="buscar" type="text" class="form-control" placeholder="Buscar Série">
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

                    <div class="input-group w-50" hidden id="input-{{ $serie->id }}">
                        <input id="input-serie-{{ $serie->id }}" type="text" class="form-control"
                               value="{{ $serie->nome }}">
                        <div class="input-group-append">
                            @csrf
                            <button class="btn btn-primary" id="editar-serie" onclick="editarSerie({{ $serie->id }})">
                                <i class="bi bi-check2"></i>
                            </button>
                        </div>
                    </div>

                    <div class="botoes">
                        <button class="btn btn-success mr-1" onclick="mostrarInput({{$serie->id}})"><i
                                class="bi bi-pencil-square"></i></button>
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

    <script>
        function mostrarInput(serieId) {
            let inputSerie = $(`#input-${serieId}`);
            let nomeSerie = $(`#serie-${serieId}`);
            if (inputSerie.attr('hidden')) {
                inputSerie.removeAttr('hidden');
                nomeSerie.attr('hidden', true);
            } else {
                inputSerie.attr('hidden', true);
                nomeSerie.removeAttr('hidden');
            }
        }

        function editarSerie(serieId) {
            let formData = new FormData();
            const nome = $(`#input-serie-${serieId}`).val();
            const token = $('input[name=_token]').val();
            formData.append('nome', nome);
            formData.append('_token', token);
            const url = `/series/${serieId}/editarSerie`;
            fetch(url, {
                method: 'POST',
                body: formData
            }).then(() => {
                mostrarInput(serieId);
                $(`#serie-${serieId}`).text(nome);
                location.reload();
            });
        }
    </script>

@endsection
