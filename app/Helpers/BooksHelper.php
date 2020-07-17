<?php


namespace App\Helpers;


trait BooksHelper
{
    public function mapRequest($bookRequest){
        $bookData = [];

        foreach ($bookRequest as $key => $data){
            $bookData[$key]['id']     = $data->id;
            $bookData[$key]['isbn']   = $data->isbn;
            $bookData[$key]['price']  = $data->price;
            $bookData[$key]['amount'] = $data->amount;

            foreach ($data->translation as $translation){
                $bookData[$key][$translation->locale]['title']       = $translation->title;
                $bookData[$key][$translation->locale]['description'] = $translation->description;
            }
        }

        return $bookData;
    }
}
