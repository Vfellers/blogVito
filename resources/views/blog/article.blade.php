@extends('layouts.blogLayout.template')
@section('title', $article->title)         {{-- traz o titulo do artigo na aba --}} 

@section('content')

    <div class="row mt-4">
        <div class="col-12">
            <h1><span class="badge bg-primary">{{date("d/m/Y", strtotime($article->date))}}</span>{{$article->title}}</h1>
        </div>
    </div>


    @php
        $totalChar = strlen($article->text);     //Contar quantidade de caracteres no texto
    @endphp


    <div class="row mt-5">
        <div class="col col-sm-12 col-md-4">
            <img src="https://alkasoft.com.br/wp-content/uploads/2017/09/imagem125_2-700x321.jpg" class="img-fluid">
        </div>

        <div class="col col-sm-12 col-md-8">
            {{substr($article->text, 0, $totalChar/4)}}                {{-- Nao acho que seja o correto, mas dividiu o texto em 4 pra colocar só a primeira parte do lado da imagem --}}   
        </div>
        
        <div class="col col-sm-12 col-md-12">
            {{substr($article->text, $totalChar/4, $totalChar)}}        {{-- pega a partir de onde cortei até o fim colocando embaixo da imagem // O correto seria trocar pra mt4e tirar o de cima --}}
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <h2>Outros Artigos</h2>
        </div>
    </div>

    <div class="row">
        @foreach ($others as $a)

        <div class="col col-sm-12 col-md-3">
            <div class="card">
                <img src="https://alkasoft.com.br/wp-content/uploads/2017/09/imagem125_2-700x321.jpg" class="card-img-top"
                    alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$a->title}}</h5>
                    <p class="card-text">{{substr($a->preview, 0, 100)}}</p>                  {{-- Comeca do zero e vai até 100 caracteres de limite --}}
                </div>

                <div class="card-action">    
                    <small>{{date("d/m/Y", strtotime($a->date))}}</small>
                    <a href="/artigo/{{$a->id}}/{{Illuminate\support\Str::slug($a->title)}}" class="btn btn-primary">LER AGORA</a>  {{-- Illuminate\support\Str::slug($article->title) // Vai fazer o titulo ficar na url da noticia e ajuda google a indexar--}}
                </div>
            </div>
        </div>

        @endforeach
    </div>


@endsection

