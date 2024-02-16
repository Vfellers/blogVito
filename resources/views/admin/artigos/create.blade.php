@extends('layouts.adminLayout.template')
@section('title', "Cadastrar Artigo")
    
@section("content")
    <div class="row">
        <div class="col-12">
            <h1>Cadastrar novo artigo</h1>
        </div>
    </div>

    <form action="{{route("artigos.store")}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col col-sm-12 col-md-4 mb-3">
                <label for="title">Título</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            
            <div class="col col-sm-12 col-md-8 mb-3">
                <label for="preview">Preview</label>
                <input type="text" name="preview" id="preview" class="form-control">
            </div>
           
            <div class="col col-sm-12 col-md-4 mb-3">
                <label for="author">Autor</label>
                <input type="text" name="author" id="author" class="form-control">
            </div>

            <div class="col col-sm-12 col-md-4 mb-3">
                <label for="image">Imagem</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <div class="col col-sm-12 col-md-4 mb-3">
                <label for="from_categories">Categoria</label>
                <select name="from_categories" id="from_categories" class="form-select">
                    <option value="">Selecione uma categoria</option>
                    @foreach ($categorias as $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>


            <div class="col col-sm-12 col-md-12 mb-3">
                <label for="text">Texto</label>
                <div class="mb-3">
                    <label for="text"></label>
                    <textarea class="form-control" name="text" id="text" rows="15"></textarea>
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-success" >Salvar</button>
            </div>

        </div>
    
    </form>
@endsection