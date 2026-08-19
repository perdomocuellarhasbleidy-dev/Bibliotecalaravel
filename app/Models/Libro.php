<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table = 'libro';

    protected $primaryKey = 'idlibro';

    public $timestamps = false;

    protected $fillable = [
        'idautor',
        'titulo',
        'categoria',
        'año_publicacion',
        'consultar_libro',
    ];

    protected $casts = [
        'año_publicacion' => 'integer',
    ];

    public function autor()
    {
        return $this->belongsTo(Autor::class, 'idautor', 'idautor');
    }

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'idlibro', 'idlibro');
    }

    public function devoluciones()
    {
        return $this->hasMany(Devolucion::class, 'idlibro', 'idlibro');
    }
}