<?php

namespace App\Services;

use App\BookSelector;
use App\BookSource;
use App\SourcePage;

class BookParser
{
    const DATA_NOT_FOUND = 'Данные не найдены';
    /**
     * @var \Goutte
     */
    private $parser;

    function __construct(\Goutte $parser)
    {

        $this->parser = $parser;
    }

    /**
     * @param BookSource $source
     * @param SourcePage $sourcePage
     * @param BookSelector $selector
     *
     * @return array
     *
     * @throws \Exception
     */
    public function getLinkList(BookSource $source, SourcePage $sourcePage, BookSelector $selector): array
    {
        if (!$selector->link) {
            throw new \Exception('Selector for book link undefined');
        }
        if (!$source->url) {
            throw new \Exception("Url for source with id {$source->id}  undefined");
        }
        if (!$sourcePage->path) {
            throw new \Exception("Path for page with id {$sourcePage->id}  undefined");
        }
        $results = [];
        $page = 1;
        do {
            $url = $source->url . $sourcePage->path . '?page=' . $page;
            $crawler = $this->parser::request('GET', $url);
            $links = $crawler->filter($selector->link)->each(function ($node) {
                return $node->attr('href');
            });
            $results = array_merge($links, $results);
            ++$page;
        } while (!empty($links));

        return $results;
    }

    /**
     * @param $path
     * @param BookSelector $selector
     * @param BookSource $bookSource
     *
     * @return array
     * @throws \Exception
     */
    public function getBookInfo($path, BookSelector $selector, BookSource $bookSource)
    {
        $results = [
            'name' => null,
            'image' => null,
            'authors' => null,
            'year' => null,
            'price' => null,
            'link' => null,
        ];

        if (!$selector->name) {
            throw new \Exception('Selector for book name undefined');
        }

        $crawler = $this->parser::request('GET', $path);

        $oName = $crawler->filter($selector->name);
        if ($oName->count() > 0) {
            $results['name'] = $oName->first()->text();
        } else {
            throw new \Exception('Book name not found in page');
        }

        if ($selector->image) {
            $oImage = $crawler->filter($selector->image);
            $results['image'] = $oImage->count() > 0 ? $oImage->first()->attr('src') : self::DATA_NOT_FOUND;
        }

        if ($selector->authors) {
            $oAuthors = $crawler->filter($selector->authors);
            $results['authors'] = $oAuthors->count() > 0 ? $oAuthors->first()->text() : self::DATA_NOT_FOUND;
        }

        if ($selector->year) {
            $oYear = $crawler->filter($selector->year);
            $results['year'] = $oYear->count() > 0 ? (int)$oYear->first()->text() : self::DATA_NOT_FOUND;
        }

        if ($selector->price) {
            $oPrice = $crawler->filter($selector->price);
            $results['price'] = $oPrice->count() > 0 ? $oPrice->first()->text() : self::DATA_NOT_FOUND;
        }

        $results['link'] = $bookSource->url . $path;

        return array_map('trim', $results);
    }
}