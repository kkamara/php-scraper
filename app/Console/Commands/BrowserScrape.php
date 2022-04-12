<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Browser;
use Facebook\WebDriver\WebDriverBy;

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
    protected $description = 'Navigates to amazon, searches for samsung phones and pulls the title and price data.';

    private Browser $browser;

    public function __construct(Browser $browser)
    {
        parent::__construct();
        $this->browser = $browser;
    }

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
        echo 'in browser scrape'.PHP_EOL;
        $this->browser->browse(function (\Laravel\Dusk\Browser $browser) {
            $browser->visit('https://www.amazon.co.uk/');

            $el = $browser->driver->findElement(WebDriverBy::xpath('//input[contains(@id,"twotabsearchtextbox")]'));
            $el->sendKeys('Samsung phones')->submit();

            $browser->screenshot('/home/kel/workspace/amazon-scraper/tests/Browser/screenshots/homepage2');

            $browser->driver->findElement(WebDriverBy::xpath('//span[text()="Samsung"]'))->click();

            $phoneNamesEl = $browser->driver->findElements(WebDriverBy::xpath('//span[contains(@class, "a-size-base-plus a-color-base a-text-normal")]'));
            $priceWholeNumberEl = $browser->driver->findElements(WebDriverBy::xpath('//span[contains(@class, "a-price-whole")]'));
            $priceDecimalNumberEl = $browser->driver->findElements(WebDriverBy::xpath('//span[contains(@class, "a-price-fraction")]'));

            $phones = [];
            $priceWholeNumbers = [];
            $priceDecimalNumbers = [];

            foreach($phoneNamesEl as $phone) {
                $phones[] = $phone->getText();
            }

            $msgs = [];
            for ($cnt = 0; $cnt < 51; $cnt++) {
                $msgs[] = '*';
            }
            echo implode('', $msgs).PHP_EOL;

            foreach($priceWholeNumberEl as $price) {
                $priceWholeNumbers[] = $price->getText();
            }
            
            echo implode('', $msgs).PHP_EOL;

            foreach($priceDecimalNumberEl as $price) {
                $priceDecimalNumbers[] = $price->getText();
            }

            $finalList = array_map([$this, 'combine'], $phones, $priceWholeNumbers, $priceDecimalNumbers);
            print_r($finalList);
        });

        $this->browser->quit();

        return 0;
    }

    private function combine($phone, $wholeNumber, $decimalNumber) {
        return array_merge([
            'price' => $wholeNumber.'.'.$decimalNumber,
        ],compact('phone'));
    }
}
