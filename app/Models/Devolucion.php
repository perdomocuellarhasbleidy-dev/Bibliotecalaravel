<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    protected $table = 'devolucion';

    protected $primaryKey = 'iddevolucion';

    public $timestamps = false;

    protected $fillable = [
        'idlibro',
        'fecha_devolucion',
        'estado',
        'id_usuario',
        'idprestamo',
    ];

    protected $casts = [
        'fecha_devolucion' => 'date',
    ];

    public function libro()
    {
        return $this->belongsTo(Libro::class, 'idlibro', 'idlibro');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class, 'idprestamo', 'idprestamo');
    }
}