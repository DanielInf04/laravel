<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuenta;
use App\Models\Cliente;
use Illuminate\Validation\Validator;

class CuentaController extends Controller
{

    function filtrar(Request $request)
    {

        $cadena = $request->cadena;
        $saldo = $request->saldo;

        //$filtro = $request->filtro;

        $messageCode = null;
        $messageSaldo = null;
        //dd($cadena, $saldo);

        // Filtro con AND
        if($request->filtro == 'Filtro AND') {
          
          $cuentas = Cuenta::buscaCodigoANDSaldo($cadena, $saldo);

          $messageCode = $cadena ? '<i>Filtrado por código</i> ... <b>' . $cadena . '</b>' : null;
          $messageSaldo = $saldo ? 'AND <i>Saldo mínimo</i> ... <b>' . $saldo . '</b>' : null;
        }
        // Filtro con OR
        else {

          $cuentas = Cuenta::buscaCodigoORSaldo($cadena, $saldo);

          $messageCode = $cadena ? '<i>Filtrado por código</i> ... <b>' . $cadena . '</b>' : null;
          $messageSaldo = $saldo ? 'OR <i>Saldo mínimo</i> ... <b>' . $saldo . '</b>' : null;
        }

        //dd($cuentas);

        return view('cuenta.list', ['cuentas' => $cuentas, 'messageCode' => $messageCode, 'messageSaldo' => $messageSaldo]);

    } 

    function list() 
    {
      //$cuentas = Cuenta::all();
      
      //$cuentas = Cuenta::with('cliente')->get();

      $cuentas = Cuenta::orderBy('saldo', 'desc')->get();

      return view('cuenta.list', ['cuentas' => $cuentas]);
    }

    function new(Request $request) 
    {
      if ($request->isMethod('post')) {    
        // Validamos los campos antes de crear una cuenta
        $validated = $request->validate([
            'codigo' => 'required|max:10|unique:cuentas',
            'saldo' => 'required'
        ]);

        // recogemos los campos del formulario en un objeto cuenta
        $cuenta = new Cuenta;
        $cuenta->codigo = $request->codigo;
        $cuenta->saldo = $request->saldo;
        $cuenta->cliente_id = $request->cliente_id;

        $cuenta->save();

        return redirect()->route('cuenta_list')->with('status', 'Nueva cuenta '.$cuenta->codigo.' creada!');
        
        }

    // si no venimos de hacer submit al formulario, tenemos que mostrar el formulario

      $clientes = Cliente::all();

      return view('cuenta.new', ['clientes' => $clientes]);
    }

    function delete($id) 
    { 
        $cuenta = Cuenta::find($id);
        $cuenta->delete();

        return redirect()->route('cuenta_list')->with('status', 'Cuenta '.$cuenta->codigo.' eliminada!');
    }

    function edit(Request $request, $id)
    {
      $cuenta = Cuenta::find($id);

      if($request->isMethod('post')) {
        // Validamos los campos antes de crear una cuenta
        $validated = $request->validate([
          'codigo' => 'required|max:10|unique:cuentas,codigo,'.$id,
          'saldo' => 'required'
        ]);

        // recogemos los campos del formulario en un objeto cuenta
        $cuenta->codigo = $request->input('codigo');
        $cuenta->saldo = $request->input('saldo');
        $cuenta->cliente_id = $request->input('cliente_id');

        $cuenta->save();

        return redirect()->route('cuenta_list')->with('status', 'Cuenta '.$cuenta->codigo.' actualizada correctamente!');

      }

      // Obtenemos todos los clientes
      $clientes = Cliente::all();

      // Pasamos todos los datos a la vista
      return view('cuenta.edit', [
        'cuenta' => $cuenta, 
        'clientes' => $clientes
      ]);
    }

}
