@extends('layout')

@section('title', 'Editar Cliente')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1 class="mb-4">Editar Cliente</h1>

    <!-- Volver link -->
    <a href="{{ route('cliente_list') }}" class="btn btn-secondary mb-3">&laquo; Volver</a>

    <!-- Mensajes de error -->
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario -->
    <div>
        <form method="POST" action="{{ route('cliente_edit', $cliente->id) }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" name="dni" value="{{ old('dni', $cliente->dni) }}" class="form-control" id="dni" />
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" class="form-control" id="nombre" />
            </div>

            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" name="apellidos" value="{{ old('apellidos', $cliente->apellidos) }}" class="form-control" id="apellidos" />
            </div>

            <div class="mb-3">
                <label for="fechaN" class="form-label">Fecha Nacimiento</label>
                <input type="date" name="fechaN" value="{{ old('fechaN', $cliente->fechaN->format('Y-m-d')) }}" class="form-control" id="fechaN" />
            </div>

            <div class="mb-3">
                @isset($cliente->imagen)
                    <div>
                        <strong>Imagen actual: </strong>{{ $cliente->imagen }}<br>
                        <label for="borrarImagen" class="form-label">Borrar Imagen</label>
                        <input type="checkbox" name="borrarImagen" id="borrarImagen">
                    </div>
                @endisset
                <label for="imagen" class="form-label">Subir una nueva imagen</label>
                <input type="file" name="imagen" class="form-control" id="imagen" />
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
        </form>
    </div>
@endsection