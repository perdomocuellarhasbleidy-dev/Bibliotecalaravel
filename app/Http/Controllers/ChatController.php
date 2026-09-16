<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function responder(Request $request)
    {
        $mensaje = $request->input('mensaje', '');

        if (empty($mensaje)) {
            return response()->json(['respuesta' => 'Por favor escribe un mensaje.']);
        }

        try {
            $response = Http::timeout(60)->post('http://localhost:11434/api/generate', [
                'model'  => 'llama3',
                'prompt' => "Eres el asistente virtual de la Biblioteca Humberto Montealegre Sanchez. Responde de forma amable, clara y concisa en español. Solo responde preguntas relacionadas con la biblioteca, préstamos, libros, multas y el sistema de gestión. Pregunta del usuario: {$mensaje}",
                'stream' => false,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return response()->json(['respuesta' => $data['response'] ?? 'No pude generar una respuesta.']);
            }

            return response()->json(['respuesta' => 'Ollama no respondió correctamente. Verifica que esté activo.']);
        } catch (\Exception $e) {
            return response()->json(['respuesta' => 'No se pudo conectar con el asistente IA. Verifica que Ollama esté ejecutándose en tu equipo.']);
        }
    }
}
