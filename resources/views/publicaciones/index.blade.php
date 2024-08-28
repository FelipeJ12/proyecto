@extends('plantilla')
@section('titulo', 'Publicaciones')
@section('contenido')

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('exito'))
        <div class="alert alert-success" role="alert">
            {{ session('exito') }}
        </div>
    @endif
    @if(session('fracaso'))
        <div class="alert alert-danger" role="alert">
            {{ session('fracaso') }}
        </div>
    @endif


    <!-- Button trigger MODAL CREAR -->
    <h1 style="margin-left: 5rem;">Publicaciones<a class="btn btn-success" href="{{ route('publicaciones.create') }}" style="margin-left: 44rem;">+ Nueva Publicacion</a></h1>


    <!-- MOSTRAR PUBLICACIONES  -->
@foreach($publicaciones as $publicacion)

    <div class="card"  style="width: 70rem; margin-left: 5rem; margin-bottom: 1rem;">
        <table class="table">
            <thead>
            </thead>
            <tbody>
            <tr>
                <td scope="col">
                    <div class="card-body " >
                        <h4 class="card-title">{{ $publicacion->titulo }}</h4>
                        <h6 class="card-subtitle mb-2 text-body-secondary">User</h6>
                        <p class="card-text">{{ $publicacion->contenido }}</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td scope="col">
                    <a href="{{ route('publicaciones.show', ['id'=> $publicacion->id]) }}" class="btn btn-warning btn-sm">Comentarios</a>
                    <a href="{{ route('publicaciones.edit', ['id'=> $publicacion->id]) }}" class="btn btn-warning btn-sm">Editar</a>

                    <!-- Button trigger MODAL ELIMINAR -->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#MODALELIMINAR{{$publicacion->id}}">
                        Eliminar
                    </button>
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td>
                    <div class="row" >
                        @forelse($publicacion->categorias as $categoria)
                            <div class="col-sm-1">
                                <span class="badge text-bg-secondary" >  {{ $categoria->nombre }}  </span>
                            </div>
                        @empty
                            <div class="col">
                                <span class="badge text-bg-secondary" >Sin Categoria</span>
                            </div>
                        @endforelse
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>

            <!-- Modal ELIMINAR-->
            <div class="modal fade" id="MODALELIMINAR{{$publicacion->id}}" tabindex="-1" aria-labelledby="MODALELIMINARLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="MODALELIMINARLabel">Eliminar Publicacion</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Estas seguro que quieres eliminar la publicacion?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <form method="post" action="{{ route('publicaciones.destroy' , ['id'=>$publicacion->id]) }}">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Eliminar" class="btn btn-danger">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endforeach

@endsection
