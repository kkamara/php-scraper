<?php

namespace App\Console\Commands\App;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeCrawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crawler {crawler}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new browser crawler command.';

    protected $workingDir = null;

    protected $template = null;

    protected $templateName = 'NewCrawler2022';

    public function __construct()
    {
        parent::__construct();

        $this->workingDir = base_path('app/Console/Commands');
        $this->template = storage_path('app/'.$this->templateName.'.php');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $crawler = Str::ucfirst(Str::camel($this->argument('crawler')));

        $newCrawler = $this->workingDir.'/'.$crawler.'.php';

        if (true === file_exists($newCrawler)) {
            throw new Exception('File already exists.');
        }

        copy($this->template, $newCrawler);

        file_put_contents(
            $newCrawler,
            str_replace($this->templateName, $crawler, file_get_contents($newCrawler)),
        );

        $this->info('Browser crawler created successfully.');

        return 0;
    }
}
