<?php

namespace App\Console\Commands;

use Facebook\WebDriver\WebDriverBy;
use Illuminate\Console\Command;
use App\Browser;

class NewCrawler2022 extends Command
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
     * @var Browser
     */
    private Browser $browser;

    public function __construct(Browser $browser)
    {
        parent::__construct();
        $this->browser = $browser;
    }

    /**
     * @return void
     */
    private function getInput() {
        echo 'say smtn:'.PHP_EOL;
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
        $this->browser->browse(function (\Laravel\Dusk\Browser $browser) {
            $browser->visit('https://www.selenium.dev/');
        });

        $this->browser->quit();

        return 0;
    }
}
