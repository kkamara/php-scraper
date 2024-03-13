<img src="https://github.com/kkamara/useful/raw/main/selenium-py.png" alt="selenium-py.png" width=""/>

# PhP Scraper

(2022) Use PHP technologies to crawl and click buttons on websites with GUI. I highly recommend working with Linux (including virtual machines) or MacOs.

* [Important note:](#note)

* [Proven in a production environment](#proven)

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

With selenium we're limited to 10 max ongoing sessions ([reference](https://forum.katalon.com/t/what-is-the-relationship-between-the-setting-max-concurrent-instances-and-selenium-grid-settings-maxinstances-and-maxsessions/48082/2)).

I've successfully tested 1000 site crawls in a single process (3 hours, 44 minutes, and 47 seconds).

(4 hours x 1000 sites) * 2 = 2000 sites x 8 hours

2000 sites * 10 parallel sessions = 20, 000 sites

We're able to cover 20, 000 sites / night / machine. 

## Proven in a production environment <a name="proven"></a>

[Getting up and running on amazon ec2.](https://raw.githubusercontent.com/kkamara/amazon-scraper/develop/scripts/setup-project.sh)

## Requirements

* [https://laravel.com/docs/11.x/installation](https://laravel.com/docs/11.x/installation)
* [https://laravel.com/docs/11.x/vite#main-content](https://laravel.com/docs/11.x/vite#main-content)

## Installation

```bash
cp .env.example .env
touch database/database.sqlite
composer i
# install chromedriver for Panther
vendor/bin/bdi detect drivers
# (optional)
# make dev && make backend-migrate
# (optional)
# npm install
# npm run dev
```

#### The following installation step may or may not be required.

[Installing web drivers](https://symfony.com/doc/current/testing/end_to_end.html#installing-web-drivers).

```bash
# chromedriver_mac64
# chromedriver_win32
# See https://chromedriver.storage.googleapis.com
# for drivers list.
wget https://chromedriver.storage.googleapis.com/2.37/chromedriver_linux64.zip
unzip chromedriver_linux64.zip
sudo mv chromedriver /usr/bin/chromedriver
chromedriver --version
```

## Usage

Update the command at [./app/Console/Commands/BrowserScrape.php](https://raw.githubusercontent.com/kkamara/php-scraper/develop/app/Console/Commands/BrowserScrape.php)

```bash
export PANTHER_NO_HEADLESS=true # see gui when crawling with panther client
export PANTHER_DEVTOOLS='' # enabled

php artisan browser:scrape
php artisan browser:test
```

[BrowserInvoker.php](https://raw.githubusercontent.com/kkamara/php-scraper/develop/app/Console/Commands/BrowserInvoker.php)

## Adding a new command <a name="adding-commands"></a>

```bash
php artisan make:crawler crawler_test
```

## Misc

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

[See PHP scraper.](https://github.com/kkamara/php-scraper)

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[BSD](https://opensource.org/licenses/BSD-3-Clause)
