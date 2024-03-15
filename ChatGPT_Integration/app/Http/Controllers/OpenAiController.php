<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
use App\Models\ChatHistory;


class OpenAiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        //echo $request->search_for;exit;
        $search = $request->search_for;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.env('OpenAiKey'),
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo-0125',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $search
                ]
            ],
            'temperature' => 0.5,
            'max_tokens' => 200,
            'top_p' => 1.0,
            'frequency_penalty' => 0.52,
            'presence_penalty' => 0.5,
            'stop' => ["11."],
        ]);

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to retrieve response from OpenAI API'], $response->status());
        }

        $data = $response->json();

        if (!isset($data['choices'][0]['message'])) {
            return response()->json(['error' => 'Unexpected response format from OpenAI API'], 500);
        }

        $message = $data['choices'][0]['message'];

        $chat_history = new ChatHistory();
        $chat_history->search_for = $search;
        $chat_history->result = json_encode($message);

        $chat_history->save();

         return response()->json($message, 200, [], JSON_PRETTY_PRINT);
        


    }
}
