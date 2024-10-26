<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Prompt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class ChatController extends Controller
{
    public function index($id = null)
    {
        $prompts = Prompt::all();
        $messages = DB::table('messages')
            ->where('prompt_id', $id)
            ->get();

        $updatedPrompts = [];

        foreach ($prompts as $prompt) {

            $prompt['active'] = $prompt->id == $id;
            $updatedPrompts[] = $prompt;
        }

        return view('chat', [
            'prompts' => $updatedPrompts,
            'messages' => $messages,
            'using_prompt' => $id
        ]);
    }

    public function createNewPrompt()
    {
        $prompt = Prompt::create([
            'name' => 'Nova conversa',
            'user_id' => 1,
            'created_at' => now()
        ]);


        return redirect()->route('chat.index', ['id' => $prompt->id]);
    }

    public function delete(Prompt $id)
    {
        dd($id);
    }

    public function sendMessage(Request $request)
    {
        // Validar a mensagem do usuário
        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        $userMessage = $validated['message'];
        $prompt_id = $request->input('prompt_id');

        Message::create([
            'prompt_id' => $prompt_id,
            'user_id' => 1,
            'content' => $userMessage,
            'role' => 'user',
        ]);

        $historicMessages = DB::table('messages')
            ->where('prompt_id', $prompt_id)
            ->where('role', 'user')
            ->select('content', 'role')
            ->get();


        // Fazer a chamada para a API do Groq
        $response = $this->callGroqApi($userMessage, $historicMessages);

        Message::create([
            'prompt_id' => $prompt_id,
            'user_id' => 1,
            'content' => $response,
            'role' => 'bot',
        ]);

        return response()->json([
            'message' => $response
        ]);
    }

    private function callGroqApi($message, $historicMessages = [])
    {
        // Recuperar a chave da API do Groq do arquivo .env
        $apiKey = env('GROQ_API_KEY');

        // Definir a URL da API do Groq
        $groqApiUrl = 'https://api.groq.com/openai/v1/chat/completions';

        $formattedHistoricMessages = [];

        foreach ($historicMessages as $historicMessage) {
            $formattedHistoricMessages[] = [
                'role' => $historicMessage->role,
                'content' => $historicMessage->content
            ];
        }

        $messages = array_merge($formattedHistoricMessages, [
            [
                'role' => 'user',
                'content' => $message
            ]
        ]);


        // Fazer a requisição POST usando o Laravel HTTP Client
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
        ])->post($groqApiUrl, [
            'messages' => $messages,
            'model' => 'llama3-8b-8192', // Troque pelo modelo que está disponível
        ]);

        if ($response->successful()) {
            // Retornar a resposta do modelo
            return $response->json()['choices'][0]['message']['content'];
        }

        return 'Erro na API: ' . $response->body();
    }
}
