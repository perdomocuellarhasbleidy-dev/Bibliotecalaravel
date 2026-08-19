<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function index(Request $request)
    {
        $buscar = trim(
            $request->get('buscar', '')
        );

        $categoria = trim(
            $request->get('categoria', '')
        );

        $libros = Libro::with('autor')
            ->when(
                $buscar,
                function ($query) use ($buscar) {

                    $query->where(
                        function ($q) use ($buscar) {

                            $q->where(
                                'titulo',
                                'like',
                                "%$buscar%"
                            )

                            ->orWhere(
                                'categoria',
                                'like',
                                "%$buscar%"
                            )

                            ->orWhereHas(
                                'autor',
                                function ($autor) use ($buscar) {
                                    $autor->where(
                                        'nombre',
                                        'like',
                                        "%$buscar%"
                                    );
                                }
                            );
                        }
                    );
                }
            )
            ->when(
                $categoria,
                fn ($q) => $q->where(
                    'categoria',
                    $categoria
                )
            )
            ->orderBy('titulo')
            ->get();

        $categorias = Libro::whereNotNull(
            'categoria'
        )
            ->where(
                'categoria',
                '<>',
                ''
            )
            ->distinct()
            ->orderBy('categoria')
            ->pluck('categoria');

        return view(
            'libros.index',
            compact(
                'libros',
                'categorias',
                'buscar',
                'categoria'
            )
        );
    }

    public function create()
    {
        $autores = Autor::orderBy(
            'nombre'
        )->get();

        return view(
            'libros.create',
            compact('autores')
        );
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'idautor' => [
                'required',
                'integer',
                'exists:autor,idautor'
            ],

            'titulo' => [
                'required',
                'string',
                'max:50'
            ],

            'categoria' => [
                'required',
                'string',
                'max:30'
            ],

            'año_publicacion' => [
                'nullable',
                'integer',
                'min:1000',
                'max:2100'
            ],
        ]);

        Libro::create($datos);

        return redirect()
            ->route('libros.index')
            ->with(
                'success',
                'Libro registrado correctamente.'
            );
    }

    public function edit(Libro $libro)
    {
        $autores = Autor::orderBy(
            'nombre'
        )->get();

        return view(
            'libros.edit',
            compact(
                'libro',
                'autores'
            )
        );
    }

    public function update(
        Request $request,
        Libro $libro
    ) {
        $datos = $request->validate([
            'idautor' => [
                'required',
                'integer',
                'exists:autor,idautor'
            ],

            'titulo' => [
                'required',
                'string',
                'max:50'
            ],

            'categoria' => [
                'required',
                'string',
                'max:30'
            ],

            'año_publicacion' => [
                'nullable',
                'integer',
                'min:1000',
                'max:2100'
            ],
        ]);

        $libro->update($datos);

        return redirect()
            ->route('libros.index')
            ->with(
                'success',
                'Libro actualizado correctamente.'
            );
    }

    public function destroy(Libro $libro)
    {
        if (
            $libro->prestamos()->exists()
            ||
            $libro->devoluciones()->exists()
        ) {
            return back()->with(
                'error',
                'No se puede eliminar un libro que tiene préstamos o devoluciones.'
            );
        }

        $libro->delete();

        return back()->with(
            'success',
            'Libro eliminado correctamente.'
        );
    }

    public function catalogo(Request $request)
    {
        return $this->index($request);
    }
}