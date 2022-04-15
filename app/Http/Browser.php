<?php

namespace App\Http;

use Closure;
use Exception;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Laravel\Dusk\Chrome\ChromeProcess;
use Symfony\Component\Process\Process;
use Laravel\Dusk\Browser as DuskBrowser;

class Browser
{
    /**
     * @var DuskBrowser|null
     */
    public $browser;

    /**
     * @var Process
     */
    public $process;

    public function startProcess()
    {
        $this->process = (new ChromeProcess)->toProcess();
        $this->process->start();
    }

    public function quit()
    {
        $this->browser->quit();
        $this->process->stop();
    }

    /**
     * @param Closure $callback
     */
    public function browse(Closure $callback)
    {
        $this->startProcess();

        if (! $this->browser) {
            $this->browser = $this->newBrowser($this->createWebDriver());
        }

        $callback($this->browser);
    }

    /**
     * @throws Exception
     */
    function __destruct()
    {
        if ($this->browser) {
            $this->closeBrowser();
        }
    }

    /**
     * @throws Exception
     */
    protected function closeBrowser(): void
    {
        if (! $this->browser) {
            throw new Exception("The browser hasn't been initialized yet");
        }

        $this->browser->quit();
        $this->browser = null;
    }

    protected function newBrowser($driver): DuskBrowser
    {
        return new DuskBrowser($driver);
    }

    protected function createWebDriver(): RemoteWebDriver
    {
        return retry(5, function () {
            return $this->driver();
        }, 50);
    }

    protected function driver(): RemoteWebDriver
    {
        $options = (new ChromeOptions)->addArguments(collect([
            '--window-size=1920,1080',
            '--disable-blink-features=AutomationControlled',
        ])->unless(
            $this->hasHeadlessDisabled(), 
            fn ($items) => $items->merge(['--disable-gpu', '--headless',]),
        )->all());
      
        return RemoteWebDriver::create(
            $this->getServerURL(),
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
            )
        );
    }

    /**
     * @return String
     */
    private function getServerURL() {
        if ('testing' === config('app.env')) {
            return 'http://localhost:9515';
        }

        return sprintf($_ENV['DUSK_DRIVER_URL'], $_ENV['FORWARD_SELENIUM_PORT']);
    }

    /**
     * Determine whether the Dusk command has disabled headless mode.
     *
     * @return bool
     */
    protected function hasHeadlessDisabled()
    {
        return isset($_SERVER['DUSK_HEADLESS_DISABLED']) ||
               isset($_ENV['DUSK_HEADLESS_DISABLED']);
    }

}
