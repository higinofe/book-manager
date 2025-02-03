<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model {
    use HasFactory;

    protected $fillable = [
        'titulo', 'descricao', 'autor', 'preco', 'quantidade_estoque', 
        'autor_biografia', 'autor_nacionalidade'
    ];
}

