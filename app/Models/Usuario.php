<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';

    protected $primaryKey = 'id_usuario';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'documento',
        'telefono',
        'email',
        'contraseña',
        'id_rol',
    ];

    protected $hidden = [
        'contraseña',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'id_usuario', 'id_usuario');
    }

    public function devoluciones()
    {
        return $this->hasMany(Devolucion::class, 'id_usuario', 'id_usuario');
    }
}