<img src="https://github.com/kkamara/useful/raw/main/php-scraper.gif" alt="php-scraper.gif" width=""/>

# PhP Scraper [![API](https://github.com/kkamara/php-scraper/actions/workflows/build.yml/badge.svg)](https://github.com/kkamara/php-scraper/actions/workflows/build.yml)

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
php artisan browser:scrape
php artisan browser:test
```

[BrowserInvoker.php](https://raw.githubusercontent.com/kkamara/php-scraper/develop/app/Console/Commands/BrowserInvoker.php)

#### When choosing to not explicitly define GUI configuration in the code, the following is an option to enable GUI by way of your environment

```bash
export PANTHER_NO_HEADLESS=true # see gui when crawling with panther client
export PANTHER_DEVTOOLS='' # enabled
```

## Adding a new command <a name="adding-commands"></a>

```bash
php artisan make:crawler crawler_test
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
