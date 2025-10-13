<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $userMessage = $request->input('message');
        
        if (empty($userMessage)) {
            return response()->json(['error' => 'Message is required'], 400);
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a helpful assistant for Andaman Ferry Booking. You help customers with ferry bookings, schedules, pricing, and general information about Andaman Islands. Be friendly, informative, and always encourage them to book through the website. Keep responses concise and helpful.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $userMessage
                    ]
                ],
                'max_tokens' => 500,
                'temperature' => 0.7,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $botMessage = $data['choices'][0]['message']['content'] ?? 'Sorry, I could not process your request.';
                
                return response()->json([
                    'success' => true,
                    'message' => $botMessage
                ]);
            } else {
                $errorData = $response->json();
                Log::error('OpenAI API Error: ' . $response->body());
                
                // Handle specific error cases
                if (isset($errorData['error']['code']) && $errorData['error']['code'] === 'insufficient_quota') {
                    return response()->json([
                        'success' => false,
                        'message' => 'Our AI assistant is temporarily unavailable due to quota limits. Please contact our support team directly at andamanferrybookings@gmail.com or call us for immediate assistance with your ferry booking needs.'
                    ], 500);
                } elseif (isset($errorData['error']['type']) && $errorData['error']['type'] === 'invalid_request_error') {
                    return response()->json([
                        'success' => false,
                        'message' => 'AI assistant configuration issue. Please contact our support team at andamanferrybookings@gmail.com for assistance.'
                    ], 500);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Sorry, I\'m having trouble connecting right now. Please try again later or contact our support team at andamanferrybookings@gmail.com.'
                    ], 500);
                }
            }
        } catch (\Exception $e) {
            Log::error('Chatbot Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Sorry, I\'m having trouble connecting right now. Please try again later or contact our support team.'
            ], 500);
        }
    }

    public function getInitialMessage()
    {
        return response()->json([
            'message' => 'Hello! I\'m your AI assistant for Andaman Ferry Booking. I can help you with ferry schedules, pricing, booking information, and answer questions about the Andaman Islands. How can I assist you today?'
        ]);
    }
}
