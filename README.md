# Amazon Scraper

Navigates to amazon, searches for samsung phones and pulls the title and price data.

## Important note: 

Before you try to scrape any website, go through its robots.txt file. You can access it via `domainname/robots.txt`. There, you will see a list of pages allowed and disallowed for scraping. You should not violate any terms of service of any website you scrape.

## Proven in a production environment

[Getting up and running on amazon ec2.](https://raw.githubusercontent.com/kkamara/amazon-scraper/develop/scripts/setup-project.sh)

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

## Using Docker?

```bash
docker build -t laravel-docker-aws .
docker run -it -p 8001:80 laravel-docker-aws
```

## Usage

```bash
php artisan browser:scrape
```

[Browser class code.](https://raw.githubusercontent.com/kkamara/amazon-scraper/develop/app/Browser.php)

[BrowserScrape command code.](https://raw.githubusercontent.com/kkamara/amazon-scraper/develop/app/Console/Commands/BrowserScrape.php)

## Adding a new command

Duplicate [app/Console/Commands/BrowserScrape.php](https://raw.githubusercontent.com/kkamara/amazon-scraper/develop/app/Console/Commands/BrowserScrape.php).

```bash
cp app/Console/Commands/BrowserScrape.php app/Console/Commands/NewCrawler.php
```

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

[See python amazon scraper.](https://github.com/kkamara/python-amazon-scraper)

[Using Laravel dusk outside of tests.](https://stefanzweifel.io/posts/2021/09/26/using-laravel-dusk-outside-of-tests-to-upload-files)

[Running ChromeDriver and Selenium in Python on an AWS EC2 Instance.](https://praneeth-kandula.medium.com/running-chromedriver-and-selenium-in-python-on-an-aws-ec2-instance-2fb4ad633bb5)

The `Makefile` for this project contains useful commands for a Laravel application and can be found at [laravel-makefile](https://github.com/kkamara/laravel-makefile).

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[BSD](https://opensource.org/licenses/BSD-3-Clause)
