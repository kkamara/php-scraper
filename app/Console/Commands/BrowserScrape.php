<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Panther\Client;
use Facebook\WebDriver\Remote\DesiredCapabilities;

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
    protected $description = 'Command description';

    /**
     * @var Client
     */
    private Client $client;

    public function __construct()
    {
        parent::__construct();
        $capabilities = array( // See https://www.browserstack.com/docs/automate/capabilities
            "os"                       => "Windows",
            "os_version"               => "11",
            "browser"                  => "Chrome",
            "browser_version"          => "latest",
            "name"                     => "Test",
            "build"                    => "Build 1.0",
            "browserstack.debug"       => true,
            "browserstack.console"     => "info",
            "browserstack.networkLogs" => true,
            "disableCorsRestrictions"  => true,
            "wsLocalSupport"           => true,
            "geoLocation"              => "GB",
            "goog:chromeOptions"       => [
                "args" => [
                    '--disable-popup-blocking',
                    '--disable-application-cache',
                    '--disable-web-security',
                    '--start-maximized',
                    '--ignore-certificate-errors',
                    '--user-agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36',
                    '--window-size=1920,1080',
                    // '--headless',
                    // '--disable-gpu',
                ],
            ],
        );
        $caps = DesiredCapabilities::chrome();
        foreach ($capabilities as $key => $value) {
            $caps->setCapability($key, $value);
        }
        $this->client = Client::createSeleniumClient(
            'http://localhost:'.config('app.selenium_grid_port').'/wd/hub',
            $caps,
        );
    }

    /**
     * @return string
     */
    private function getInput() {
        $words = $this->ask('>>');
        $this->info($words);
        return $words;
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
        sleep(1);
        $this->client->takeScreenshot('screenshot.jpg');

        return 0;
    }
}
