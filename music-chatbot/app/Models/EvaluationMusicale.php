<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EvaluationMusicale extends Model
{
    use HasFactory;

    protected $table = 'evaluations_musicales';

    protected $fillable = [
        'user_id',
        'instrument',
        'note',
        'evaluation',
        'conseils',
        'reponses'
    ];

    protected $casts = [
        'conseils' => 'array',
        'reponses' => 'array',
        'note' => 'decimal:1',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Relation avec l'utilisateur
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope pour les évaluations par instrument
     */
    public function scopeParInstrument($query, $instrument)
    {
        return $query->where('instrument', $instrument);
    }

    /**
     * Scope pour les évaluations récentes
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Accessor pour la note formatée
     */
    public function getNoteFormateeAttribute(): string
    {
        return $this->note . '/20';
    }

    /**
     * Accessor pour le niveau (basé sur la note)
     */
    public function getNiveauAttribute(): string
    {
        return match(true) {
            $this->note >= 18 => 'Expert',
            $this->note >= 15 => 'Avancé',
            $this->note >= 12 => 'Intermédiaire',
            $this->note >= 8 => 'Débutant avancé',
            default => 'Débutant'
        };
    }
}