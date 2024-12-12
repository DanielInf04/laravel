@extends('layout')

@section('title', 'Listado de cuentas')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Listado de cuentas</h1>
    <a href="{{ route('cuenta_new') }}">+ Nueva cuenta</a>

    @if (session('status'))
        <div>
            <strong>Success!</strong> {{ session('status') }}  
        </div>
    @endif

    <table style="margin-top: 20px;margin-bottom: 10px;">
        <thead>
            <tr>
                <th>Código</th><th>Saldo</th><th>Cliente</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cuentas as $cuenta)
                <tr>
                    <td>{{ $cuenta->codigo }}</td><td>{{ $cuenta->saldo }}</td><td>{{ $cuenta->cliente_id }}</td>
                    <td>
                        <a href="{{ route('cuenta_delete', ['id' => $cuenta->id]) }}">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
@endsection