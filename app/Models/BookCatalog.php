<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCatalog extends Model
{
    use HasFactory;

    // Modelo de la tabla "book_catalogs"
    protected  $fillable = ['title' , 'author' , 'bookgenre' , 'date'];

    public $timestamps = false;
}
