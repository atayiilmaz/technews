# technews
News-App Project using Pure PHP.

# Installation

## Docker usage:

```bash
cp .env.example .env
docker-compose up
```

## For Composer

```bash
composer install
```

## Admin User

```bash
username: admin
password: admin
```

## API Endpoints

- http://localhost/api/news?api_key={generatedToken} //Get All News
- http://localhost/api/news?id={id}&api_key={generatedToken} //Get Single News By ID

Note: You need to register and login to the system to get api token!!
