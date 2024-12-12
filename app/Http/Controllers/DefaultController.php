<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Cuenta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DefaultController extends Controller
{

  function home() {
    return view('home');
  }

  function stadistics() {

    // Cuenta con saldo máximo
    $cuentaSMax = Cuenta::orderBy('saldo', 'desc')->first();

    // Cuenta con saldo mínimo
    $cuentaSMin = Cuenta::orderBy('saldo', 'asc')->first();

    $promedio = DB::table('cuentas')->avg('saldo');

    $cuentas = DB::table('cuentas')->count();

    //dd($cuentaSM);

    return view('default.stadistics', [
      'cuentaSMax' => $cuentaSMax, 'cuentaSMin' => $cuentaSMin, 
      'promedio' => $promedio, 'cuentas' => $cuentas
  ]);
  }

}
