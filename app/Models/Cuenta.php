<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Cuenta extends Model
{

    //
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public static function buscaCodigo($cadena)
    {
        return Cuenta::where('codigo', 'like', '%'.$cadena.'%')
            ->get();
    }

    public static function buscaCodigoANDSaldo($cadena, $saldo)
    {
        return Cuenta::where('codigo', 'like', '%'.$cadena.'%')
            ->where('saldo', '>=', $saldo)
            ->get();
    }

    public static function buscaCodigoORSaldo($cadena, $saldo)
    {
        return Cuenta::where('codigo', 'like', '%'.$cadena.'%')
            ->orwhere('saldo', '>=', $saldo)
            ->get();
    }

}
