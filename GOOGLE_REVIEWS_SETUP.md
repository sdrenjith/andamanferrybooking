# Google Reviews Integration Setup

## Overview
This setup adds dynamic Google reviews to your homepage, fetching real reviews from your Google My Business listing.

## Setup Instructions

### 1. Get Google Places API Key
1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select an existing one
3. Enable the "Places API" for your project
4. Create credentials (API Key)
5. Restrict the API key to your domain for security

### 2. Add API Key to Environment
Add this line to your `.env` file:
```
GOOGLE_PLACES_API_KEY=your_api_key_here
```

### 3. Update Place ID (if needed)
The current place ID is set to: `ChIJdZOlij8XrjsR4BhVjWjYfHk`

To get your correct place ID:
1. Go to [Google Place ID Finder](https://developers.google.com/maps/documentation/places/web-service/place-id)
2. Search for "Andaman Ferry booking"
3. Copy the Place ID
4. Update the `$placeId` variable in `app/Http/Controllers/HomeController.php` (line 271)

### 4. Features
- ✅ Dynamic Google reviews loading
- ✅ Real-time rating display
- ✅ Responsive slider with auto-play
- ✅ Error handling and loading states
- ✅ Mobile-friendly design

### 5. API Costs
- Google Places API has usage limits
- First 1,000 requests per month are free
- After that, it's $0.017 per request
- Reviews are cached to minimize API calls

### 6. Customization
You can modify the number of reviews displayed by changing the `array_slice($reviews, 0, 5)` in the `getGoogleReviews()` method.

## Troubleshooting
- If reviews don't load, check the browser console for errors
- Ensure your API key has Places API enabled
- Verify the Place ID is correct
- Check that your domain is allowed in the API key restrictions
