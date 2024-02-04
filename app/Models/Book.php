<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'author_id',
        'year',
        'gender',
        'number',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'book_id', 'id'); 
        #relacionamento one to many, um  usuario varios comentarios
        #(Comment::class, 'user_id', 'id'), mas como ja esta correto na tabela do comment, ele ja pega por defaul esses valores
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id'); 
        #relacionamento many to one, varios comentarios um usuario
        #(user::class, 'user_id', 'id'), mas como ja esta correto na tabela do comment, ele ja pega por defaul esses valores
    }
}
