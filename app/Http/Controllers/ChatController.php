<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Message;
use App\Models\Prompt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;


class ChatController extends Controller
{
    public function index($id = null)
    {
        $prompts = Prompt::all();

        $messages = Message::with('image')
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

    private function callGroqApi($message = null, $historicMessages = [], $googleLabels = [])
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

        foreach ($googleLabels as $label) {
            $formattedHistoricMessages[] = [
                'role' => 'system',
                'content' => $label
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

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $prompt_id = $request->input('prompt_id');

        // Salvar a imagem no storage
        $imagePath = $request->file('image')->store('images', 'public');

        // Salvar informações da imagem no banco de dados
        $image = new Image();
        $image->image_path = $imagePath; // Salvar o caminho da imagem
        $image->content = implode(', ', $this->analyzeImage(storage_path("app/public/$imagePath"))); // Salvar labels como conteúdo
        $image->user_id = 1; // Presumindo que você tenha um sistema de autenticação
        $image->prompt_id = $prompt_id; // Ajuste conforme necessário
        $image->role = 'user'; // Ajuste conforme necessário
        $image->save(); // Salvar no banco de dados

        // Chamar o método de análise do Google Vision
        $googleLabels = $this->analyzeImage(storage_path("app/public/$imagePath"));

        // Fazer a chamada para a API do Groq
        $response = $this->callGroqApi('Voc é uma IA que interpreta imagens a partir de objetos analisados dela, descrevendo a imagem. Interprete uma imagem baseada nos elementos descritos sem dizer que você está analisando, somente descrevendo a imagem analisada', [], $googleLabels);

        Message::create([
            'prompt_id' => $prompt_id,
            'user_id' => 1,
            'content' => $response,
            'role' => 'bot',
            'image_path' => $imagePath, // Salvar o caminho da imagem
        ]);

        return response()->json([
            'message' => $response
        ]);
    }

    private function analyzeImage($imagePath)
    {
        $apiKey = env('GOOGLE_VISION_KEY');
        // Configurar o cliente do Google Vision
        $client = new ImageAnnotatorClient([
            'credentials' => base_path($apiKey) // Caminho da chave JSON do Google Vision
        ]);

        $imageContent = file_get_contents($imagePath);

        // Enviar a imagem para o Google Vision para análise
        $response = $client->labelDetection($imageContent);
        $labels = $response->getLabelAnnotations();

        $result = [];
        foreach ($labels as $label) {
            $result[] = $label->getDescription();
        }

        $client->close();

        return $result;
    }
}
