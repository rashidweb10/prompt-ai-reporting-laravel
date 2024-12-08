<?php

namespace App\Http\Controllers;

use App\Services\OpenAIService;
use App\Services\GeminiService;
use App\Services\SchemaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    protected $openAIService;
    protected $schemaService;
    protected $geminiService;

    public function __construct(OpenAIService $openAIService, SchemaService $schemaService , GeminiService $geminiService)
    {
        $this->openAIService = $openAIService;
        $this->schemaService = $schemaService;
        $this->geminiService = $geminiService;
    }

    public function generateReport(Request $request)
    {
        $schemas = $this->schemaService->getSchemas();
        $prompt = $request->input('prompt');
        $api = $request->input('api');

        //return $prompt;
        //return $schemas;

        // Generate SQL query using OpenAI
        $sqlQuery = $api === 'gpt'
            ? $this->openAIService->generateSQLQuery($prompt, $schemas)
            : $this->geminiService->generateSQLQuery($prompt, $schemas);

            //return $sqlQuery;

        try {
            //$results = DB::select(DB::raw($sqlQuery));
            $results = DB::select($sqlQuery); 
        } catch (\Exception $e) {
            return $e->getMessage();
            return back()->with('error', 'Invalid query: ' . $e->getMessage());
        }

        return view('report', compact('results', 'sqlQuery'));
    }
}
