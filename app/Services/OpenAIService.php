<?php

namespace App\Services;

use OpenAI;

class OpenAIService
{
    protected $client;

    public function __construct()
    {
        $this->client = OpenAI::client(env('OPENAI_API_KEY'));
    }

    public function generateSQLQuery(string $prompt, array $schemas): string
    {
        $response = $this->client->chat()->create([
            'model' => 'gpt-3.5-turbo', // Use gpt-3.5-turbo or gpt-4
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a helpful assistant that generates SQL queries based on the given prompt and database schema.',
                ],
                [
                    'role' => 'user',
                    'content' => $prompt . "\n\nSchemas:\n" . json_encode($schemas),
                ],
            ],
            'max_tokens' => 150,
        ]);

        return trim($response['choices'][0]['message']['content']);
    }
}
