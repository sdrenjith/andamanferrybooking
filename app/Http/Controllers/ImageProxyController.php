<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;

class ImageProxyController extends Controller
{
    public function proxyImage(Request $request)
    {
        $imageUrl = $request->query('url');
        
        \Log::info('Image proxy request:', ['url' => $imageUrl]);
        
        if (!$imageUrl) {
            return response()->json(['error' => 'No URL provided'], 400);
        }
        
        // Validate that it's a Google profile photo URL
        if (!str_contains($imageUrl, 'googleusercontent.com') && 
            !str_contains($imageUrl, 'google.com') && 
            !str_contains($imageUrl, 'lh3.googleusercontent.com')) {
            return response()->json(['error' => 'Invalid image URL'], 400);
        }
        
        try {
            // Fetch the image from Google
            \Log::info('Fetching image from:', ['url' => $imageUrl]);
            $response = Http::timeout(10)->get($imageUrl);
            
            \Log::info('Image fetch response:', [
                'status' => $response->status(),
                'successful' => $response->successful(),
                'content_type' => $response->header('Content-Type')
            ]);
            
            if (!$response->successful()) {
                \Log::error('Failed to fetch image:', ['status' => $response->status(), 'body' => $response->body()]);
                return response()->json(['error' => 'Failed to fetch image'], 404);
            }
            
            // Get the image content and headers
            $imageContent = $response->body();
            $contentType = $response->header('Content-Type', 'image/jpeg');
            
            // Return the image with proper headers
            return response($imageContent, 200)
                ->header('Content-Type', $contentType)
                ->header('Cache-Control', 'public, max-age=3600') // Cache for 1 hour
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET')
                ->header('Access-Control-Allow-Headers', 'Content-Type');
                
        } catch (\Exception $e) {
            \Log::error('Image proxy error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch image'], 500);
        }
    }
}
