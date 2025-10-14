<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class GoogleReviewsController extends Controller
{
    public function getGoogleReviews()
    {
        $apiKey = env('GOOGLE_MAPS_API_KEY');
        $placeId = env('GOOGLE_PLACE_ID');
        
        if (!$apiKey || !$placeId) {
            return response()->json(['error' => 'Google Maps API key or Place ID not configured'], 500);
        }

        // Add debug logging
        \Log::info('Google Reviews API Debug - API Key: ' . (empty($apiKey) ? 'Not Set' : 'Set'));
        \Log::info('Google Reviews API Debug - Place ID: ' . (empty($placeId) ? 'Not Set' : 'Set'));

        // Cache reviews for 1 hour to avoid hitting API limits
        return Cache::remember('google_reviews', 3600, function () use ($apiKey, $placeId) {
            try {
                $response = Http::get("https://maps.googleapis.com/maps/api/place/details/json", [
                    'place_id' => $placeId,
                    'fields' => 'name,rating,reviews,user_ratings_total,url',
                    'key' => $apiKey
                ]);

                $data = $response->json();
                
                // Debug logging
                \Log::info('Google Places API Response Status: ' . $data['status']);
                \Log::info('Google Places API Response: ' . json_encode($data));

                if ($data['status'] !== 'OK') {
                    \Log::error('Google Places API Error: ' . $data['status'] . ' - ' . ($data['error_message'] ?? 'Unknown error'));
                    throw new \Exception('Google Places API error: ' . $data['status'] . ' - ' . ($data['error_message'] ?? 'Unknown error'));
                }

                $place = $data['result'];
                $reviews = $place['reviews'] ?? [];
                
                \Log::info('Found ' . count($reviews) . ' reviews from Google Places API');
                
                // Filter and format reviews
                $formattedReviews = [];
                foreach ($reviews as $review) {
                    if (isset($review['rating']) && isset($review['text'])) {
                        $formattedReviews[] = [
                            'author_name' => $review['author_name'] ?? 'Anonymous',
                            'rating' => $review['rating'],
                            'text' => $review['text'],
                            'time' => $review['time'] ?? time(),
                            'profile_photo_url' => $review['profile_photo_url'] ?? null,
                            'relative_time_description' => $review['relative_time_description'] ?? 'Recently'
                        ];
                    }
                }

                return [
                    'business_name' => $place['name'],
                    'overall_rating' => $place['rating'] ?? 0,
                    'total_ratings' => $place['user_ratings_total'] ?? 0,
                    'reviews' => $formattedReviews, // Show all available reviews (Google API returns 5 by default)
                    'api_status' => 'success',
                    'note' => 'Showing latest reviews from Google Maps'
                ];

            } catch (\Exception $e) {
                \Log::error('Google Reviews API Error: ' . $e->getMessage());
                \Log::error('API Key exists: ' . (!empty($apiKey) ? 'Yes' : 'No'));
                \Log::error('Place ID exists: ' . (!empty($placeId) ? 'Yes' : 'No'));
                
                // Return fallback reviews if Google API fails
                return [
                    'business_name' => 'Andaman Ferry Booking',
                    'overall_rating' => 4.9,
                    'total_ratings' => 1000,
                    'api_status' => 'fallback',
                    'note' => 'Using sample reviews - Google API unavailable',
                    'reviews' => [
                        [
                            'author_name' => 'Priya Sharma',
                            'rating' => 5,
                            'text' => 'Excellent service! Booked my ferry tickets in just 2 minutes. The process was smooth and the confirmation was instant. Highly recommended for Andaman travel.',
                            'time' => time(),
                            'profile_photo_url' => 'https://randomuser.me/api/portraits/women/44.jpg',
                            'relative_time_description' => '2 weeks ago'
                        ],
                        [
                            'author_name' => 'Rahul Verma',
                            'rating' => 5,
                            'text' => 'Great platform for ferry bookings! The customer support was helpful and the booking process was hassle-free. Will definitely use again for my next Andaman trip.',
                            'time' => time(),
                            'profile_photo_url' => 'https://randomuser.me/api/portraits/men/32.jpg',
                            'relative_time_description' => '1 month ago'
                        ],
                        [
                            'author_name' => 'Sandeep Kumar',
                            'rating' => 5,
                            'text' => 'I was worried about last-minute bookings, but Andaman Ferry Booking made it so easy. Got my tickets instantly and the journey was comfortable. Will use again!',
                            'time' => time(),
                            'profile_photo_url' => 'https://randomuser.me/api/portraits/men/65.jpg',
                            'relative_time_description' => '3 weeks ago'
                        ]
                    ]
                ];
            }
        });
    }
}
