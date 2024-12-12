<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Http\Controllers\DateTime;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

class ClienteController extends Controller
{
    function list() 
    {
      $clientes = Cliente::all();

      return view('cliente.list', ['clientes' => $clientes]);
    }

    function new(Request $request) 
    {
      if ($request->isMethod('post')) {    
        $now = new \DateTime();
        $dateNow = $now->format('d-m-Y');

        // Validamos los campos antes de crear un nuevo cliente
        $validated = $request->validate([
          'dni' => 'required|size:9|unique:clientes',
          'nombre' => 'required',
          'apellidos' => 'required',
          'fechaN' => 'required|date|before_or_equal:'.$dateNow,
        ], [
          'fechaN.required' => 'El campo fecha de nacimiento es obligatorio',
          'fechaN.before_or_equal' => 'El campo fecha de nacimiento debe ser una fecha anterior o igual a '.$dateNow,
        ]);

        // recogemos los campos del formulario en un objeto cliente
        $cliente = new Cliente;
        $cliente->dni = $request->dni;
        $cliente->nombre = $request->nombre;
        $cliente->apellidos = $request->apellidos;
        $cliente->fechaN = $request->fechaN;
        
        if($request->file('imagen')) {
          $file = $request->file('imagen');
          $extension = $file->getClientOriginalExtension();
          // guardamos en una variable $filename el nombre que pondremos al fichero
          $filename = $cliente->nombre .'_'. $cliente->apellidos .'_'. uniqid() .'.'. $extension;

          $file->move(public_path('uploads/imagenes'), $filename);

          // asignamos el nombre de la imagen al cliente
          $cliente->imagen = $filename;
        }

        $cliente->save();

        return redirect()->route('cliente_list')->with('status', 'Nuevo cliente '.$cliente->nombreApellidos().' creado!');
        
        }

    // si no venimos de hacer submit al formulario, tenemos que mostrar el formulario

    $clientes = Cliente::all();

    return view('cliente.new');
  }

  function delete($id) 
    { 
        $cliente = Cliente::find($id);
        $cliente->delete();

        return redirect()->route('cliente_list')->with('status', 'Cliente '.$cliente->nombreApellidos().' eliminado!');
    }

  function edit(Request $request, $id)
    {
      $cliente = Cliente::find($id);

      $now = new \DateTime();
      $dateNow = $now->format('Y-m-d');

      if($request->isMethod('post')) {
        // Validamos los campos antes de crear un nuevo cliente
        $validated = $request->validate([
          'dni' => ['required','size:9',
                    Rule::unique('clientes')->ignore($cliente->id),
        ],
          'nombre' => 'required',
          'apellidos' => 'required',
          'fechaN' => 'required|date|before_or_equal:'.$dateNow,
        ]);

        // recogemos los campos del formulario en un objeto cliente
        $cliente->dni = $request->input('dni');
        $cliente->nombre = $request->input('nombre');
        $cliente->apellidos = $request->input('apellidos');
        $cliente->fechaN = $request->input('fechaN');

        if($request->file('imagen')) {
          if($cliente->imagen) {
            File::delete(public_path('uploads/imagenes/'.$cliente->imagen));
          }
          $file = $request->file('imagen');
          $extension = $file->getClientOriginalExtension();
          // guardamos en una variable $filename el nombre que pondremos al fichero
          $filename = $cliente->nombre .'_'. $cliente->apellidos .'_'. uniqid() .'.'. $extension;

          $file->move(public_path('uploads/imagenes'), $filename);

          // asignamos el nombre de la imagen al cliente
          $cliente->imagen = $filename;
        }

        if($request->borrarImagen) {
          if($cliente->imagen) {
            File::delete(public_path('uploads/imagenes/'.$cliente->imagen));
          }
          $cliente->imagen = null;
        }

        $cliente->save();

        return redirect()->route('cliente_list')
          ->with('status', 'Cliente '.$cliente->nombreApellidos().' actualizado correctamente!');

      }

      // Obtenemos todos los clientes
      $clientes = Cliente::all();

      // Pasamos todos los datos a la vista
      return view('cliente.edit', [
        'cliente' => $cliente, 
        'clientes' => $clientes
      ]);
    }
}
