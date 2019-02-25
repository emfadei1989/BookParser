<?php

namespace App\Services;


use App\Book;

class BookManager
{
    /**
     * @param array $data
     * @return Book
     */
    public function create(array $data): Book
    {
        return Book::firstOrCreate([
            'name' => $data['name'],
            'authors' => $data['authors'],
            'link' => $data['link']
        ],
            [
                'image' => $data['image'],
                'price' => $data['price'],
                'year' => $data['year']
            ]
        );
    }
}