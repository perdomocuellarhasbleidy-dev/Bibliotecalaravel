<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Multa extends Model
{
    protected $table = 'multa';

    protected $primaryKey = 'idmulta';

    public $timestamps = false;

    protected $fillable = [
        'idprestamo',
        'motivo',
        'fecha',
        'valor',
    ];

    protected $casts = [
        'fecha' => 'date',
        'valor' => 'decimal:2',
    ];

    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class, 'idprestamo', 'idprestamo');
    }
}