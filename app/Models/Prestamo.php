<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $table = 'prestamo';

    protected $primaryKey = 'idprestamo';

    public $timestamps = false;

    protected $fillable = [
        'idlibro',
        'fecha_prestamo',
        'estado',
        'id_usuario',
    ];

    protected $casts = [
        'fecha_prestamo' => 'date',
    ];

    public function libro()
    {
        return $this->belongsTo(Libro::class, 'idlibro', 'idlibro');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function devolucion()
    {
        return $this->hasOne(Devolucion::class, 'idprestamo', 'idprestamo');
    }

    public function multas()
    {
        return $this->hasMany(Multa::class, 'idprestamo', 'idprestamo');
    }

    public function detalles()
    {
        return $this->hasMany(DetallePrestamo::class, 'id_prestamo', 'idprestamo');
    }
}