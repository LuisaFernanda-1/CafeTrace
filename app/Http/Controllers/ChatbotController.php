<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate(['message' => 'required|string|max:500']);

        $context = $request->input('context', 'caficultor');
        $systemPrompt = $this->getSystemPrompt($context);
        $apiKey = env('GROQ_API_KEY');

        if (!$apiKey) {
            return response()->json([
                'reply' => 'El asistente IA aún no está configurado. Pide al administrador que agregue la clave GROQ_API_KEY al servidor.'
            ]);
        }

        try {
            $response = Http::timeout(20)->withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type'  => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model'    => 'llama-3.1-8b-instant',
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user',   'content' => $request->message],
                ],
                'max_tokens'  => 400,
                'temperature' => 0.7,
            ]);

            if ($response->successful()) {
                $content = $response->json('choices.0.message.content');
                return response()->json(['reply' => $content]);
            }

            return response()->json(['reply' => 'No pude procesar tu pregunta. Intenta de nuevo en un momento.']);

        } catch (\Exception $e) {
            return response()->json(['reply' => 'Error de conexión con el asistente. Intenta de nuevo.']);
        }
    }

    private function getSystemPrompt(string $context): string
    {
        if ($context === 'caficultor') {
            return 'Eres CaféBot, asistente especializado en café colombiano para caficultores. ' .
                   'Tu objetivo es ayudarlos a vender mejor y mejorar su calidad de vida. ' .
                   'Ayuda con: precios de mercado actuales del café en Colombia, variedades (Castillo, Colombia, Caturra, Geisha, Borbón, Tabi), ' .
                   'técnicas de cultivo y fertilización, proceso de beneficio (despulpado, fermentación, lavado, secado), ' .
                   'certificaciones orgánicas y comercio justo, cómo registrar y vender lotes en CaféTrace, ' .
                   'cómo mejorar el puntaje de calidad Q-grader, trazabilidad blockchain, y gestión de finca cafetera. ' .
                   'Usa términos del campo colombiano. Sé práctico y directo. Responde en español. Máximo 3 párrafos cortos.';
        }

        return 'Eres CaféBot, asistente especializado en café colombiano para compradores. ' .
               'Tu objetivo es ayudarlos a comprar café de origen con confianza. ' .
               'Ayuda con: qué significan los atributos de un lote (altura msnm, variedad, proceso beneficio), ' .
               'diferencias entre variedades y sus perfiles de sabor (acidez, cuerpo, dulzura, aromas), ' .
               'qué es el comercio justo y por qué importa, cómo interpretar la trazabilidad blockchain, ' .
               'cómo calcular cuánto café necesitar para tu negocio o consumo, ' .
               'diferencia entre café especial y convencional, cómo comprar y hacer seguimiento en CaféTrace. ' .
               'Sé amigable y educativo. Responde en español. Máximo 3 párrafos cortos.';
    }
}
