@extends('layout')

@section('title', 'Pagina ejemplo')

@section('stylesheets')
    @parent
@endsection

@section('content')
     
<h1>Grupos de 2DAW</h1>
  
    <table>
        <thead>
            <tr>
                <th>Código</th><th>Denominación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grupos as $grupo)
                <tr>
                   <td>{{ $grupo->codigo }}</td><td>{{ $grupo->denominacion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection