<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employees extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'nip',
        'name',
        'address',
        'phone',
        'professions_id',
        'avatar',
        'status'
    ];

    public function professions(): BelongsTo
    {
        return $this->belongsTo(Professions::class);
    }
}
