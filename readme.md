<img src="https://github.com/kkamara/useful/raw/main/php-scraper.gif" alt="php-scraper.gif" width=""/>

# PhP Scraper [![API](https://github.com/kkamara/php-scraper/actions/workflows/build.yml/badge.svg)](https://github.com/kkamara/php-scraper/actions/workflows/build.yml)

(2022) Use PHP technologies to crawl and click buttons on websites with GUI. I highly recommend working with Linux (including virtual machines) or MacOs. Laravel 12.

* [Important note:](#note)

* [Using Postman?](#postman)

* [Requirements](#requirements)

* [Installation](#installation)

* [Usage](#usage)

* [Adding a new command](#adding-commands)

* [Browser Testing](#testing)

* [Misc](#misc)

* [Contributing](#contributing)

* [License](#license)

## Important note: <a name="note"></a>

Before you try to scrape any website, go through its robots.txt file. You can access it via `domainname/robots.txt`. There, you will see a list of pages allowed and disallowed for scraping. You should not violate any terms of service of any website you scrape.

<a name="postman"></a>
## Using Postman?

[Postman client](https://www.postman.com/).

[Published Postman API Collection](https://documenter.getpostman.com/view/17125932/TzzAKvVe).

## Requirements

* [https://laravel.com/docs/11.x/installation](https://laravel.com/docs/11.x/installation)
* [https://laravel.com/docs/11.x/vite#main-content](https://laravel.com/docs/11.x/vite#main-content)
* [Java](https://www.java.com/en/)

## Installation

```bash
cp .env.example .env
# Don't worry when the following step errors related to chromedriver binary, we will install them right after.
composer install
```

#### Add chromedriver to Path

Make sure Chromedriver is installed and added to your environment Path.

```bash
# install chromedriver for Panther client.
vendor/bin/bdi detect drivers
sudo mv drivers/chromedriver /usr/local/bin/chromedriver
# Or
# chromedriver_mac64
# chromedriver_win32
# See https://chromedriver.storage.googleapis.com
# for drivers list.
wget https://chromedriver.storage.googleapis.com/2.37/chromedriver_linux64.zip
unzip chromedriver_linux64.zip
sudo mv chromedriver /usr/local/bin/chromedriver
chromedriver --version
```

#### Continue installation

```bash
composer install
php artisan key:generate
# Before running the next command:
# Update your database details in .env
php artisan migrate --seed
yarn install
yarn build
```

#### Download Selenium Server jar file

[Download Selenium Server jar file](https://www.selenium.dev/documentation/grid/getting_started/).

Run the following in a new terminal.

```bash
java -jar selenium-server-4.29.0.jar standalone --override-max-sessions true --max-sessions 10
```

[CLI options in the Selenium Grid](https://www.selenium.dev/documentation/grid/configuration/cli_options/).

## Usage

Update the command at [./app/Console/Commands/BrowserScrape.php](https://raw.githubusercontent.com/kkamara/php-scraper/develop/app/Console/Commands/BrowserScrape.php)

```bash
php artisan browser:scrape
```

[BrowserInvoker.php](https://raw.githubusercontent.com/kkamara/php-scraper/develop/app/Console/Commands/BrowserInvoker.php)

#### Panther Environment Variables

[Panther Environment Variables](https://github.com/symfony/panther?tab=readme-ov-file#environment-variables).

#### Capabilities

[Capabilities](https://www.browserstack.com/docs/automate/capabilities).

[Using Desired Capabilities](https://chromedriver.chromium.org/capabilities#h.p_ID_52).

## Adding a new command <a name="adding-commands"></a>

```bash
php artisan make:crawler TestCrawler
```

## Misc

[See Python Selenium web scraper.](https://github.com/kkamara/python-selenium)

[See MRVL Desktop.](https://github.com/kkamara/mrvl-desktop)

[See MRVL Web.](https://github.com/kkamara/mrvl-web)

[See Github to Bitbucket Backup Repo Updater.](https://github.com/kkamara/ghbbupdater)

[See PHP Docker Skeleton.](https://github.com/kkamara/php-docker-skeleton)

[See Laravel 10 API 3.](https://github.com/kkamara/laravel-10-api-3)

[See movies app.](https://github.com/kkamara/movies)

[See food nutrition facts search web app.](https://github.com/kkamara/food-nutrition-facts-search-web-app)

[See ecommerce web.](https://github.com/kkamara/ecommerce-web)

[See city maps mobile.](https://github.com/kkamara/city-maps-mobile)

[See ecommerce mobile.](https://github.com/kkamara/ecommerce-mobile)

[See crm.](https://github.com/kkamara/crm)

[See birthday currency.](https://github.com/kkamara/birthday-currency)

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[BSD](https://opensource.org/licenses/BSD-3-Clause)
