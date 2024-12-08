<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected $apiKey;
    protected $apiBase;

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY'); // Your Gemini API key
        $this->apiBase = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent'; // Correct base URL
    }

    public function generateSQLQuery(string $prompt, array $schemas): string
    {
        // Prepare the request payload
        $schemasJson = json_encode($schemas); // JSON encode the schemas for sending
        $cleanPrompt = "Generate **ONLY** the MySQL query for the following request. Provide the query in **valid SQL syntax** without any extra text, descriptions, or comments. Use the provided schema to ensure the query is accurate and executable. Here is the request: \"$prompt\". Schema: $schemasJson.";
    
        $payload = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $cleanPrompt],
                    ]
                ]
            ]
        ];
    
        // Make the API request
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("{$this->apiBase}?key={$this->apiKey}", $payload);
    
        // Check for errors in the response
        if ($response->failed()) {
            return 'Error: ' . $response->json('message', 'Failed to generate query.');
        }
    
        // Extract the generated SQL query from the response
        $generatedQuery = $response->json('candidates.0.content.parts.0.text', '');
    
        // Clean up the response by trimming and removing unwanted markdown
        $sqlQuery = trim($generatedQuery);
        
        // Remove the markdown "```sql" at the beginning and "```" at the end
        $sqlQuery = preg_replace('/^```sql\s*/', '', $sqlQuery);  // Remove opening "```sql" if present
        $sqlQuery = preg_replace('/\s*```$/', '', $sqlQuery);      // Remove closing "```" if present
    
        // Remove any unnecessary whitespace and newlines
        $sqlQuery = preg_replace('/\s+/s', ' ', $sqlQuery);  // Collapse multiple spaces or newlines to a single space
        
        return $sqlQuery;
    }    
       
}
