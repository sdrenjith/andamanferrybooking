# AI Chatbot Setup Guide

## Overview
This setup adds an AI-powered chatbot to your website that uses OpenAI's GPT-3.5-turbo model to help customers with ferry booking inquiries.

## Setup Instructions

### 1. Get OpenAI API Key
1. Go to [OpenAI Platform](https://platform.openai.com/)
2. Sign in with your ChatGPT Plus account
3. Navigate to "API Keys" in the left sidebar
4. Click "Create new secret key"
5. Give it a name (e.g., "Andaman Ferry Chatbot")
6. Copy the API key (starts with `sk-`)

### 2. Add API Key to Environment
Add this line to your `.env` file:
```
OPENAI_API_KEY=sk-your-api-key-here
```

### 3. Features
- ✅ **Floating Chat Button**: Appears in bottom-right corner with pulsing animation
- ✅ **Professional UI**: Clean, modern chat interface matching your brand colors
- ✅ **Mobile Responsive**: Works perfectly on all devices
- ✅ **Real-time Chat**: Instant responses using OpenAI GPT-3.5-turbo
- ✅ **Context Aware**: Specialized for Andaman Ferry Booking inquiries
- ✅ **Error Handling**: Graceful fallbacks if API is unavailable

### 4. Chatbot Capabilities
The AI assistant is trained to help with:
- Ferry schedules and timings
- Pricing information
- Booking procedures
- General Andaman Islands information
- Route planning
- Travel tips and recommendations

### 5. API Costs
- **GPT-3.5-turbo**: $0.002 per 1K tokens (very affordable)
- **Typical conversation**: ~$0.01-0.05 per conversation
- **Monthly estimate**: $10-50 depending on usage

### 6. Customization
You can modify the chatbot's personality by editing the system prompt in `ChatbotController.php`:

```php
'content' => 'You are a helpful assistant for Andaman Ferry Booking. You help customers with ferry bookings, schedules, pricing, and general information about Andaman Islands. Be friendly, informative, and always encourage them to book through the website. Keep responses concise and helpful.'
```

### 7. Security
- CSRF protection enabled
- API key stored securely in environment variables
- Input validation and sanitization
- Error logging for debugging

### 8. Troubleshooting
- **Chatbot not responding**: Check if `OPENAI_API_KEY` is set correctly
- **API errors**: Check Laravel logs in `storage/logs/laravel.log`
- **Styling issues**: Ensure Bootstrap Icons are loaded

### 9. Testing
1. Visit your homepage
2. Click the chat button in bottom-right corner
3. Type a message like "What are your ferry schedules?"
4. Verify the AI responds appropriately

## Files Modified
- `app/Http/Controllers/ChatbotController.php` (new)
- `routes/web.php` (added chatbot routes)
- `resources/views/layouts/app.blade.php` (added chatbot widget)

The chatbot is now ready to help your customers with their ferry booking inquiries!
