<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ChatbotController extends Controller
{
    private $questionsParInstrument = [
        'guitare' => [
            'technique' => [
                'Maîtrises-tu les barrés sur tout le manche ?',
                'Quelle est ta vitesse en picking alterné ?',
                'Comment gères-tu les transitions entre accords complexes ?',
                'Utilises-tu les techniques de slide et bend avec précision ?'
            ],
            'theorie' => [
                'Connais-tu toutes les triades sur le manche ?',
                'Peux-tu improviser sur une grille de blues ?',
                'Maîtrises-tu les modes grecs ?',
                "Sais-tu analyser une progression d'accords ?"
            ],
            'creativite' => [
                'Composes-tu tes propres morceaux ?',
                'Comment développes-tus tes idées mélodiques ?',
                'Arranges-tu des reprises personnellement ?'
            ]
        ],
        'piano' => [
            'technique' => [
                'Maîtrises-tu les gammes en tierces et sixtes ?',
                'Quelle est ta dextérité main gauche ?',
                'Utilises-tu le pédalage avec précision ?',
                'Peux-tu jouer des passages rapides clairement ?'
            ],
            'theorie' => [
                'Lis-tu la clé de fa couramment ?',
                'Connais-tu les accords de 7ème et 9ème ?',
                'Sais-tu harmoniser une mélodie ?',
                'Maîtrises-tu la construction des cadences ?'
            ],
            'creativite' => [
                'Improvises-tu dans différents styles ?',
                'Composes-tu avec une structure définie ?',
                'Sais-tu reharmoniser un standard ?'
            ]
        ],
        'chant' => [
            'technique' => [
                'Maîtrises-tu ton souffle et le soutien diaphragmatique ?',
                "Quelle est l'étendue de ta tessiture ?",
                'Utilises-tu les résonnateurs efficacement ?',
                'Comment gères-tu les passages de registre ?'
            ],
            'theorie' => [
                "Reconnais-tu les intervalles à l'oreille ?",
                'Sais-tu reproduire une mélodie entendue ?',
                "Comprends-tu la structure harmonique d'un morceau ?",
                'Maîtrises-tu le solfège rythmique ?'
            ],
            'creativite' => [
                'Improvis-tu des mélodies spontanément ?',
                'Composes-tu tes propres textes et mélodies ?',
                'Interprètes-tu avec ta personnalité artistique ?'
            ]
        ]
    ];

    public function index()
    {
        return Inertia::render('Chatbot/Chatbot');
    }

    public function demarrerEvaluation(Request $request)
    {
        $instrument = $request->instrument;
        
        if (!array_key_exists($instrument, $this->questionsParInstrument)) {
            return response()->json(['error' => 'Instrument non supporté'], 400);
        }

        // Mélanger les questions pour chaque catégorie
        $questionsMelangees = [];
        foreach ($this->questionsParInstrument[$instrument] as $categorie => $questions) {
            shuffle($questions);
            $questionsMelangees = array_merge($questionsMelangees, 
                array_slice($questions, 0, 7) // Prendre 7 questions par catégorie max
            );
        }

        // S'assurer d'avoir exactement 20 questions
        shuffle($questionsMelangees);
        $questionsSelectionnees = array_slice($questionsMelangees, 0, 20);

        return response()->json([
            'questions' => $questionsSelectionnees,
            'total_questions' => count($questionsSelectionnees)
        ]);
    }

    public function evaluerReponses(Request $request)
    {
        $reponses = $request->reponses;
        $instrument = $request->instrument;
        
        $note = $this->calculerNote($reponses);
        $evaluation = $this->genererEvaluation($note, $instrument);
        $conseils = $this->genererConseils($reponses, $instrument, $note);

        return response()->json([
            'note' => $note,
            'evaluation' => $evaluation,
            'conseils' => $conseils
        ]);
    }

    private function calculerNote($reponses)
    {
        $points = 0;
        foreach ($reponses as $reponse) {
            // Supposons que chaque réponse est notée de 1 à 5
            $points += $reponse['score'] ?? 3;
        }
        return min(20, round(($points / (count($reponses) * 5)) * 20, 1));
    }

    private function genererEvaluation($note, $instrument)
    {
        if ($note >= 18) return "Excellent ! Maîtrise avancée de $instrument";
        if ($note >= 15) return "Très bon niveau, technique solide";
        if ($note >= 12) return "Niveau intermédiaire, de bons acquis";
        if ($note >= 8) return "Débutant avancé, continuez ainsi";
        return "Débutant, beaucoup de potentiel à développer";
    }

    private function genererConseils($reponses, $instrument, $note)
    {
        $conseils = [];
        
        // Analyser les réponses pour des conseils personnalisés
        $scoresParCategorie = [
            'technique' => 0,
            'theorie' => 0, 
            'creativite' => 0
        ];

        foreach ($reponses as $reponse) {
            // Logique d'analyse des réponses par catégorie
        }

        // Conseils généraux basés sur la note
        if ($note < 10) {
            $conseils[] = "Travailler les bases techniques quotidiennement";
            $conseils[] = "Pratiquer au moins 20 minutes par jour";
            $conseils[] = "Étudier le solfège fondamental";
        } elseif ($note < 15) {
            $conseils[] = "Développer la régularité dans votre pratique";
            $conseils[] = "Explorer différents styles musicaux";
            $conseils[] = "Travailler l'improvisation basique";
        } else {
            $conseils[] = "Perfectionner les techniques avancées";
            $conseils[] = "Développer votre identité musicale";
            $conseils[] = "Explorer la composition et l'arrangement";
        }

        return $conseils;
    }
}