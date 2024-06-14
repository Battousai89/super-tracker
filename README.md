## SETUP

```shell
./vendor/bin/sail up -d
composer install --ignore-platform-reqs
cp ./.env.example ./.env
./vendor/bin/sail artisan migrate --seed
./vendor/bin/sail npm run build
```
