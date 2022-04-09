# Amazon Scraper

Navigates to amazon, searches for samsung phones and pulls the title and price data.

## Requirements
* [https://laravel.com/docs/master/installation](https://laravel.com/docs/master/installation)
* [https://laravel.com/docs/master/mix](https://laravel.com/docs/master/mix)

## Installation

```bash
cp .env.example .env
composer i
make dev && make backend-migrate
```

## Usage

```bash
alias sail='vendor/bin/sail'
sail dusk --filter scrape
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

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[BSD](https://opensource.org/licenses/BSD-3-Clause)
