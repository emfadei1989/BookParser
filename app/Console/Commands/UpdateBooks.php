<?php

namespace App\Console\Commands;

use App\Services\BookService;
use Illuminate\Console\Command;

class UpdateBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'books:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update books';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param BookService $bookService
     * @return mixed
     */
    public function handle(BookService $bookService)
    {
        $bookService->pullAllBooksFromSources();

        return 'ok';
    }
}
