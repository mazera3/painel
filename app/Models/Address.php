<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'postal_code',
        'rua',
        'number',
        'complement',
        'bairro',
        'city',
        'uf',
        'avatar_url',
    ];

    protected $table = 'addresses';
    protected $primaryKey = 'id';

    public function users(): HasOne
    {
        return $this->HasOne(User::class);
    }
}
