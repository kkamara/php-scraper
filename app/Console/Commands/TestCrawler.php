<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Panther\Client;

class TestCrawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:crawler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var Client
     */
    protected Client $client;

    public function __construct()
    {
        parent::__construct();
        $this->client = Client::createChromeClient(null, [
            '--user-agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36',
            '--window-size=1200,1100',
            // '--headless',
            // '--disable-gpu',
        ]);
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
