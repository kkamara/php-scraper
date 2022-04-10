# Amazon Scraper

Navigates to amazon, searches for samsung phones and pulls the title and price data.

## Important note: 

Before you try to scrape any website, go through its robots.txt file. You can access it via `domainname/robots.txt`. There, you will see a list of pages allowed and disallowed for scraping. You should not violate any terms of service of any website you scrape.

## Requirements
* [https://laravel.com/docs/master/installation](https://laravel.com/docs/master/installation)
* [https://laravel.com/docs/master/mix](https://laravel.com/docs/master/mix)

## Installation

```bash
cp .env.example .env
touch database/database.sqlite
composer i
make dev && make backend-migrate
```

## Usage

```bash
php artisan browser:scrape
```

[Browser class code.](https://raw.githubusercontent.com/kkamara/amazon-scraper/develop/app/Browser.php)

[BrowserScrape command code.](https://raw.githubusercontent.com/kkamara/amazon-scraper/develop/app/Console/Commands/BrowserScrape.php)

## Browser Testing

```bash
  alias sail='vendor/bin/sail'
  sail dusk
```

## Mail Server

![docker-mailhog3.png](https://raw.githubusercontent.com/kkamara/useful/main/docker-mailhog3.png)

Mail environment credentials are at [.env](https://raw.githubusercontent.com/kkamara/laravel-react-boilerplate/develop/.env.example).

The [mailhog](https://github.com/mailhog/MailHog) docker image runs at `http://localhost:8025`.

## Misc

[Implementation source.](https://stefanzweifel.io/posts/2021/09/26/using-laravel-dusk-outside-of-tests-to-upload-files)

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[BSD](https://opensource.org/licenses/BSD-3-Clause)
