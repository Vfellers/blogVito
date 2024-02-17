@extends('layouts.adminLayout.template')
@section('title', "Listar Artigos")
    
@section("content")
    <div class="row">
        <div class="col">
            <h1>Artigos</h1>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end">

                @can("deleta-artigo", 1)                                                        {{-- Autorização pra aparecer o botao criar só para o usuario nivel 1 --}}
                <a href="{{route("artigos.create")}}" class="btn btn-success">Adicionar</a>
                @endcan
                
            </div>
        </div>
    </div>


    {{-- Mensagem que deletou com sucesso. //Vem do ArticlesAdmController  // ->with("success", "Registro Deletado."); --}}
    @if (session()->has("success"))
        <div class="row">
            <div class="col col-sm-12 com-md-4">
                <div class="alert alert-success">
                    {{session("success")}}
                </div>
            </div>
        </div>
    @endif



    <div class="row">
        <div class="col">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Data</th>
                        <th>Imagem</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($articles as $a)
                        <tr>
                            <td> {{$a->title}} </td>
                            <td> {{$a->author}} </td>
                            <td> {{date("d/m/Y", strtotime($a->date))}} </td>
                            <td> <img src="/upload/{{$a->image}}" height="50px" > </td>
                            <td> 


                                {{-- Qual dos usuarios tem permissao pra deletar --}}
                                @can("deleta-artigo", 1)
                                
                                {{-- Editar --}}
                                <a href="{{route("artigos.edit", $a->id)}}" class="btn btn-primary" >Editar</a> 
                                {{-- Deletar --}}
                                <a href="#" class="btn btn-danger" onclick="deleteRegistro('delete-form')">Deletar</a>                 {{-- Trouxe a função deleteRegistro quepuxa o onclick // Botou o delete-form que tirou de baixo--}}
                                <form id="delete-form" class="d-none" action="{{route("artigos.destroy", $a->id)}}" method="POST">     {{-- Destroy é metodo do articlesAdmController --}}
                                    @csrf
                                    @method("DELETE")
                                </form>

                                @endcan

                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            {{$articles->links()}}
        </div>
    </div>


    {{-- DO delete, confirmação de deleção // trouxe o onclick que estava laem cima aqui e vai chamar a funcao lá--}}

    <script>

        function deleteRegistro(elem){
            if(confirm("Deseja deletar este registro?")){
                event.preventDefault(); document.getElementById(elem).submit()
            }
        }

        // event.preventDefault(); document.getElementById('delete-form').submit() original antes de mexer
    </script>

@endsection

