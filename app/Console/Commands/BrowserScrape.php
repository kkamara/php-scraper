<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use Symfony\Component\Panther\Client as PantherClient;

class BrowserScrape extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'browser:scrape';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Apply for jobs programmatically with one-click ability.';

    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var string
     */
    private string $url = 'https://www.imdb.com/search/name/?birth_monthday=12-10';

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
        (PantherClient::createChromeClient())
          ->get('https://www.imdb.com/search/name/?birth_monthday=12-10')
          ->takeScreenshot($saveAs = 'screenshot.jpg');

        $client = $this->client;
        $crawler = $client->request('GET', 'https://www.imdb.com/search/name/?birth_monthday=12-10');
        $links = $crawler->evaluate('//div[@class="lister-list"][1]//h3/a');

        foreach ($links as $link) {
            $this->info($link->textContent.PHP_EOL);
        }

        $crawler = $client->request('GET', 'https://www.imdb.com/search/name/?birth_monthday=12-10');

        $crawler->filter('div.lister-list h3 > a')->each(function ($node) {
            echo $node->text().PHP_EOL;
        });

        /*
        $client
          ->request('GET', 'https://www.imdb.com/search/name/?birth_monthday=12-10')
          ->filter('div.lister-list h3 a')
          ->each(function ($node) use ($client) {
              $name = $node->text();

              $birthday = $client
                  ->click($node->link())
                  ->filter('#name-born-info > time')->first()
                  ->attr('datetime');

              $year = (new \DateTimeImmutable($birthday))->format('Y');

              echo "{$name} was born in {$year}\n";
          });
          */
        /*
        while (true)
        {
            $crawler = $client->request('GET', $this->url);

            $crawler
                ->filter('div.lister-list h3 a')
                ->each(function ($node) use ($client) {
                    $name = $node->text();

                    $birthday = $client
                        ->click($node->link())
                        ->filter('#name-born-info > time')->first()
                        ->attr('datetime');

                    $year = (new \DateTimeImmutable($birthday))->format('Y');

                    echo "{$name} was born in {$year}\n";
                });

            // Try to find the "Next" link
            $next = $crawler->filter('a.next-page');

            // Stop, if there is no more "Next" link
            if ($next->count() == 0) break;

            $this->url = $next->link()->getUri();
        }
        */

        return 0;
    }
}
