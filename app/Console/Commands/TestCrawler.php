<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use Symfony\Component\Panther\Client as PantherClient;

class TestCrawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'browser:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var Browser
     */
    private Browser $browser;

    public function __construct(Client $client)
    {
        parent::__construct();
        $this->client = new Client;
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
        $client = $this->client;
        $crawler = $client->request('GET', 'https://www.imdb.com/search/name/?birth_monthday=12-10');
        $links = $crawler->evaluate('//div[@class="lister-list"][1]//h3/a');

        foreach ($links as $link) {
            $this->info($link->textContent.PHP_EOL);
        }

        (PantherClient::createChromeClient())
          ->get('https://www.imdb.com/search/name/?birth_monthday=12-10')
          ->takeScreenshot($saveAs = 'screenshot.jpg');

        return 0;
    }
}
