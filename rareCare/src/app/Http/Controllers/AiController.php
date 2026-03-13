<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OpenAI\Laravel\Facades\OpenAI;

class AiController extends Controller
{
    public function generateResume(Patient $patient)
    {
        $response = OpenAI::chat()->create([
            'model' => 'openai/gpt-oss-20b',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => "Fais un résumé médical text claire not table clair avec ces données : " . json_encode($patient)
                ]
            ],
            'max_tokens' => 2000
        ]);
        $resume = $response->choices[0]->message->content;
        return response()->json($resume);
    }
}
