@extends('layout')

@section('title', 'Listado de cuentas')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Listado de cuentas</h1>
    <a href="{{ route('cuenta_new') }}" class="btn btn-primary">
        <i class="bi bi-credit-card"></i> &nbsp;Nueva cuenta
    </a>

    @if(isset($messageCode) || isset($messageSaldo))
        <div class="alert alert-info mt-3">
            @if(isset($messageCode))
                {!! $messageCode !!}<br>
            @endif
            @if(isset($messageSaldo))
                {!! $messageSaldo !!}
            @endif
            <form action="{{ route('cuenta_list') }}">
                <button type="submit" class="btn btn-primary btn-sm mt-3">Limpiar filtro</button>
            </form>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <strong>Éxito!</strong> {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-striped table-bordered table-hover mt-3 mb-3 shadow-sm rounded-3">
        <thead class="table-primary">
            <tr>
                <th>Código</th>
                <th>Saldo</th>
                <th>Cliente</th>
                @auth
                    <th class="text-center" style="width: 200px;">Acciones</th>
                @endauth
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($cuentas as $cuenta)
                <tr>
                    <td>{{ $cuenta->codigo }}</td>
                    <td>{{ $cuenta->saldo }}</td>
                    <td>
                        @isset($cuenta->cliente)
                            {{ $cuenta->cliente->nombreApellidos() }}
                        @else
                            No tiene cliente
                        @endisset
                    </td>
                    @auth
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('cuenta_edit', ['id' => $cuenta->id]) }}" class="btn btn-primary btn-sm" title="Editar">
                                    <i class="bi bi-pencil-fill"></i> Editar
                                </a>
                                <a href="{{ route('cuenta_delete', ['id' => $cuenta->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta cuenta?')" title="Eliminar">
                                    <i class="bi bi-trash-fill"></i> Eliminar
                                </a>
                            </div>
                        </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
    <form action="{{ route('cuenta_filtro') }}" >
        <label for="filtrado">Busca por <b>código: </b></label>
        <input type="text" name="cadena" required>
        <label for="filtrado"><b>Saldo</b> mínimo:</label>
        <input type="number" name="saldo" required>
        <input type="submit" name="filtro" value="Filtro AND" class="btn btn-primary btn-sm">
        <input type="submit" name="filtro" value="Filtro OR" class="btn btn-primary btn-sm">
    </form>
@endsection