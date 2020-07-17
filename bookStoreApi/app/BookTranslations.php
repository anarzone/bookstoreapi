<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookTranslations extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'description', 'locale', 'book_id'];

    public function book(){
        return $this->belongsTo(Book::class, 'book_id');
    }
}
