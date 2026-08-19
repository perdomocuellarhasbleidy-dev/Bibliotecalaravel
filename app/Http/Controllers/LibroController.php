<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
                ->withCount([
                    'prestamos as prestamos_activos_count' => function ($query) {
                        $query->whereIn('estado', ['Activo', 'Pendiente', 'Vencido']);
                    },
                ])
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
            'imagen' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('libros', 'public');
        }

        Libro::create($datos);

        return redirect()
            ->route('dashboard', ['modulo' => 'libros'])
            ->with(
                'success',
                'Libro guardado correctamente.'
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
            'imagen' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        if ($request->hasFile('imagen')) {
            if ($libro->imagen) {
                Storage::disk('public')->delete($libro->imagen);
            }

            $datos['imagen'] = $request->file('imagen')->store('libros', 'public');
        }

        $libro->update($datos);

        return redirect()
            ->route('dashboard', ['modulo' => 'libros'])
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
            return redirect()
                ->route('dashboard', ['modulo' => 'libros'])
                ->with(
                'error',
                'No se puede eliminar un libro que tiene préstamos o devoluciones.'
                );
        }

        if ($libro->imagen) {
            Storage::disk('public')->delete($libro->imagen);
        }

        $libro->delete();

        return redirect()
            ->route('dashboard', ['modulo' => 'libros', 'mensaje' => 'eliminado'])
            ->with(
            'success',
                'Libro eliminado exitosamente.'
            );
    }

    public function catalogo(Request $request)
    {
        return redirect()->route('dashboard', array_merge(
            ['modulo' => 'libros'],
            $request->query()
        ));
    }
}