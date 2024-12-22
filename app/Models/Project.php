<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'name'
    ];

    public function tasks(): HasMany // Relação  (Um para Vários)
    {
        return $this->hasMany(Task::class);
    }

    public function user(): BelongsTo // Relação inversa (Um para Vários)
    {
        return $this->belongsTo(User::class);
    }
}
