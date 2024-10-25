<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        // Validar a mensagem do usuário
        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        $userMessage = $validated['message'];

        // Fazer a chamada para a API do Groq
        $response = $this->callGroqApi($userMessage);

        return response()->json([
            'message' => $response
        ]);
    }

    private function callGroqApi($message)
    {
        // Recuperar a chave da API do Groq do arquivo .env
        $apiKey = env('GROQ_API_KEY');

        // Definir a URL da API do Groq
        $groqApiUrl = 'https://api.groq.com/openai/v1/chat/completions';

        // Fazer a requisição POST usando o Laravel HTTP Client
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
        ])->post($groqApiUrl, [
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $message
                ]
            ],
            'model' => 'llama3-8b-8192', // Troque pelo modelo que está disponível
        ]);

        if ($response->successful()) {
            // Retornar a resposta do modelo
            return $response->json()['choices'][0]['message']['content'];
        }

        return 'Erro na API: ' . $response->body();
    }
}
