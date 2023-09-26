<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Area extends Model
{
    use HasFactory;

    const area = [
        "Antropologia",
        "Filosofia",
        "Geografia",
        "História",
        "Letras Modernas",
        "Letras Clássicas",
        "Letras Orientais",
        "Sociologia",
        "Teoria Literária",
        "Literatura Comparada",
    ];
}
