<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetallePrestamo extends Model
{
    protected $table = 'detalle_prestamo';

    protected $primaryKey = 'id_detalle_prestamo';

    public $timestamps = false;

    protected $fillable = [
        'id_prestamo',
        'id_libro',
        'cantidad',
        'estado',
    ];

    public function prestamo()
    {
        return $this->belongsTo(
            Prestamo::class,
            'id_prestamo',
            'idprestamo'
        );
    }

    public function libro()
    {
        return $this->belongsTo(
            Libro::class,
            'id_libro',
            'idlibro'
        );
    }
}