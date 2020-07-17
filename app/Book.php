<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Book extends Model
{
    protected $fillable = ['title', 'description', 'isbn', 'description', 'price', 'amount'];

    public function translation($lang = null){
        $locale = $lang ?? App::getLocale();
        return $this->hasMany(BookTranslations::class, 'book_id')->where('locale', $locale);
    }

    public function author(){
        return $this->belongsToMany(Author::class);
    }
}
