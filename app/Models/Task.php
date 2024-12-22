<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'description',
        'completed',
    ];

    protected function casts()
    {
        return [
            'completed' => 'boolean',
        ];
    }

    public function project(): BelongsTo // Relação inversa (Um para Vários)
    {
        return $this->belongsTo(Project::class);
    }
}
