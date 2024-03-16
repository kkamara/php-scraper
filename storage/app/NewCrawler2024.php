<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Panther\Client;

class NewCrawler2024 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var Client
     */
    private Client $client;

    public function __construct()
    {
        parent::__construct();
        $this->client = Client::createSeleniumClient(
            'http://localhost:'.config('app.selenium_grid_port').'/wd/hub'
        );
    }

    /**
     * @return void
     */
    private function getInput() {
        $words = $this->ask('>>');
        $this->info($words);
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->client
            ->get('https://www.imdb.com/search/name/?birth_monthday=12-10');
        $crawler = $this->client->getCrawler();
        $preferences = $crawler->filterXPath('//button[@data-testid="accept-button"]');
        $preferences->click();
        $element = $crawler->filterXPath('//h3[text()="1. Kenneth Branagh"]');
        $element->click();
        $this->client->takeScreenshot($saveAs = 'screenshot.jpg');

        return 0;
    }
}
