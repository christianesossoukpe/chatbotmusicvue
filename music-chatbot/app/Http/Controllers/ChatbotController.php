<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Inertia\Inertia;

class ChatbotController extends Controller
{
    public function index()
    {
        return Inertia::render('Chatbot/Index', [
            'questions' => [
                'Comment est ta posture sur scène ?',
                'Sais-tu reproduire un chant entendu ?',
                'Comment entretiens-tu ton instrument ?',
            ]
        ]);
    }
}
