<?php

namespace Tests\Browser\Scrape;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\WebDriverBy;

class AmazonScrapeTest extends DuskTestCase
{
    /**     *
     * @return void
     */
    public function testPullSamsungPhones()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('https://www.amazon.co.uk/');

            $el = $browser->driver->findElement(WebDriverBy::xpath('//input[contains(@id,"twotabsearchtextbox")]'));
            $el->sendKeys('Samsung phones')->submit();

            $browser->screenshot('homepage');

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
                $msgs[] = $cnt;
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
    }

    private function combine($phone, $wholeNumber, $decimalNumber) {
        return array_merge([
            'price' => $wholeNumber.'.'.$decimalNumber,
        ],compact('phone'));
    }
}
