<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reserved',
        'book_id',
        'user_name',
        'devolutionDate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_name', 'name'); 
        #relacionamento many to one, varios comentarios um usuario
        #(user::class, 'user_id', 'id'), mas como ja esta correto na tabela do comment, ele ja pega por defaul esses valores
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id'); 
        #relacionamento many to one, varios comentarios um usuario
        #(user::class, 'user_id', 'id'), mas como ja esta correto na tabela do comment, ele ja pega por defaul esses valores
    }
}
