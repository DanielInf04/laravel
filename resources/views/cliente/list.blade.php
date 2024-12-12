@extends('layout')

@section('title', 'Listado de clientes')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Listado de clientes</h1>
    <a href="{{ route('cliente_new') }}" class="btn btn-success">
        <i class="bi bi-person-plus"></i> &nbsp;Nuevo cliente
    </a>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <strong>Éxito!</strong> {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-striped table-bordered table-hover mt-3 mb-3 shadow-sm rounded-3">
        <thead class="table-success">
            <!-- table-light -->
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Fecha Nacimiento</th>
                <th>Imagen</th>
                <th>Cantidad cuentas</th>
                @auth
                    <th class="text-center" style="width: 200px;">Acciones</th>
                @endauth
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->dni }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->apellidos }}</td>
                    <td>{{ $cliente->fechaN->format('d-m-Y') }}</td>
                    <td>
                        @if($cliente->imagen)
                            <div style="display: flex; justify-content: center;">
                                <img src="{{ asset('uploads/imagenes/'.$cliente->imagen) }}" alt="" height="150">
                            </div>
                        @else
                            No tiene imagen
                        @endif
                    </td>
                    <td>
                        {{ $cliente->cuentas->count() }}
                    </td>
                    @auth
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('cliente_edit', ['id' => $cliente->id]) }}" class="btn btn-primary" title="Editar">
                                    <i class="bi bi-pencil-fill"></i> Editar
                                </a>
                                <a href="{{ route('cliente_delete', ['id' => $cliente->id]) }}" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?')" title="Eliminar">
                                    <i class="bi bi-trash-fill"></i> Eliminar
                                </a>
                            </div>
                        </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
@endsection