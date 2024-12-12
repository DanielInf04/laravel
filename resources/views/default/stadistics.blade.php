@extends('layout')

@section('title', 'Listado de cuentas')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h2 class="mt-4">Estadisticas</h2>

    <!-- Cuenta con Saldo Máximo -->
    <table class="table table-striped table-bordered table-hover mt-3 mb-3 shadow-sm rounded-3 w-50 text-center">
        <h3>Cuenta con saldo máximo</h3>
        <thead class="table-primary">
            <tr>
                <th>Código</th>
                <th>Saldo</th>
                <th>Cliente</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <tr>
                <td>{{ $cuentaSMax->codigo }}</td>
                <td>{{ $cuentaSMax->saldo }}</td>
                <td>{{ $cuentaSMax->cliente->nombreApellidos() }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Cuenta con Saldo Mínimo -->
    <table class="table table-striped table-bordered table-hover mt-3 mb-3 shadow-sm rounded-3 w-50 text-center">
        <h3>Cuenta con saldo mínimo</h3>
        <thead class="table-primary">
            <tr>
                <th>Código</th>
                <th>Saldo</th>
                <th>Cliente</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <tr>
                <td>{{ $cuentaSMin->codigo }}</td>
                <td>{{ $cuentaSMin->saldo }}</td>
                <td>{{ $cuentaSMin->cliente->nombreApellidos() }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Total cuentas -->
    <table class="table table-striped table-bordered table-hover mt-3 mb-3 shadow-sm rounded-3 w-50 text-center">
        <h3>Total cuentas</h3>
        <thead class="table-primary">
            <tr>
                <th>Saldo promedio</th>
                <th>Cantidad cuentas</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <tr>
                <td>{{ round($promedio, 2) }}</td>
                <td>{{ $cuentas }}</td>
            </tr>
        </tbody>
    </table>
    
@endsection