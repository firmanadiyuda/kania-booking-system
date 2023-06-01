<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Busana extends Model
{
    use HasFactory;

    public function fotos(): HasMany
    {
        return $this->hasMany(Foto::class);
    }
}
