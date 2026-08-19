<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'autor';

    protected $primaryKey = 'idautor';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'nacionalidad',
        'librosescritos',
    ];

    public function libros()
    {
        return $this->hasMany(Libro::class, 'idautor', 'idautor');
    }
}