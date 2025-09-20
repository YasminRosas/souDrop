<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class ChatbotController extends Controller
{



public function chat(Request $request)
{
    $userProducts = Auth::user()->products->toJson(); 
    $prompt = "Com base nos seguintes produtos: {$userProducts}, responda à pergunta: {$request->input('message')}. Seja direto e informativo.";

    $client = new Client();
    $response = $client->post('https://api.groq.com/v1/chat/completions', [
        'headers' => [
            'Authorization' => 'Bearer SEU_API_KEY_GROQ',
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'model' => 'llama3-8b-8192', 
            'messages' => [
                ['role' => 'system', 'content' => 'Você é um assistente virtual de produtos.'],
                ['role' => 'user', 'content' => $prompt]
            ],
        ],
    ]);

    $responseData = json_decode($response->getBody()->getContents(), true);
    return response()->json(['response' => $responseData['choices'][0]['message']['content']]);
}
}