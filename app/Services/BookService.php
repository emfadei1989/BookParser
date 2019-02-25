<?php

namespace App\Services;


use App\Book;
use App\BookSource;
use App\SourcePage;

class BookService
{
    /**
     * @var BookSource
     */
    private $bookSource;
    /**
     * @var SourcePage
     */
    private $sourcePage;
    /**
     * @var BookParser
     */
    private $bookParser;
    /**
     * @var BookManager
     */
    private $bookManager;

    public function __construct(
        BookSource $bookSource,
        SourcePage $sourcePage,
        BookParser $bookParser,
        BookManager $bookManager
    ) {
        $this->bookSource = $bookSource;
        $this->sourcePage = $sourcePage;
        $this->bookParser = $bookParser;
        $this->bookManager = $bookManager;
    }

    public function pullAllBooksFromSources()
    {
        $bookSources = $this->bookSource->where('active', true)->get();

        foreach ($bookSources as $bookSource) {
            $selectors = $bookSource->selectors()->first();
            $pages = $bookSource->pages()->get();
            foreach ($pages as $page) {
                try {
                    $bookPaths = $this->bookParser->getLinkList($bookSource, $page, $selectors);
                } catch (\Exception $exception) {
                    \Log::error($exception->getMessage());
                    continue;
                }

                foreach ($bookPaths as $bookPath) {
                    try {
                        $bookInfo = $this->bookParser->getBookInfo($bookPath, $selectors, $bookSource);
                        $this->bookManager->create($bookInfo);
                    } catch (\Exception $exception) {
                        \Log::error($exception->getMessage());
                    }

                }
            }

        }
    }
}