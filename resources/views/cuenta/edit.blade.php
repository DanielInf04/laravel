@extends('layout')

@section('title', 'Editar Cuenta')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1 class="mb-4">Editar Cuenta</h1>

    <!-- Volver link -->
    <a href="{{ route('cuenta_list') }}" class="btn btn-secondary mb-3">&laquo; Volver</a>

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
        <form method="POST" action="{{ route('cuenta_edit', $cuenta->id) }}">
            @csrf

            <div class="mb-3">
                <label for="codigo" class="form-label">Código</label>
                <input type="text" name="codigo" value="{{ old('codigo', $cuenta->codigo) }}" class="form-control" id="codigo" />
            </div>

            <div class="mb-3">
                <label for="saldo" class="form-label">Saldo</label>
                <input type="number" name="saldo" value="{{ old('saldo', $cuenta->saldo) }}" class="form-control" id="saldo" />
            </div>

            <div class="mb-3">
                <label for="cliente_id" class="form-label">Cliente</label>
                <select name="cliente_id" class="form-select" id="cliente_id">
                    <option value="">«-- selecciona un cliente --»</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}" @selected($cuenta->cliente_id == $cliente->id)>{{ $cliente->nombreApellidos() }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Cuenta</button>
        </form>
    </div>
@endsection