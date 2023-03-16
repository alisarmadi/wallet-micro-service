# Wallet micro-service
This is a simple micro-service to keep all data of user wallet, and has two endpoints, 
one for retrieving the balance of a specific user and other one for add money to a specific user's wallet.

## Installation
For install this project do these steps:
- Clone the project to your directory.
```shell
git clone https://github.com/alisarmadi/wallet-micro-service.git
```
- Copy .env.example to .env in the root directory (by default you don't need to change the contents of the file).
- Copy .env.example to .env in the /src directory (by default you don't need to change the contents of the file).

- Go to the root directory and run this commands:
```shell
$ docker-compose build
$ docker-compose up -d
```
## Set necessary permissions to some directory
Run this command to set necessary permissions to storage and bootstrap/cache directory (Please, don't do this in production.).
```shell
$ sudo chmod 777 src/storage src/bootstrap/ -R
```

## Test
We implemented a happy unit test and a happy feature test in this project, of course we can add other tests to increase our test coverage on the project.
- Run this command to execute the tests:
```shell
$ docker exec -it wallet_php php vendor/bin/phpunit
```

## Retrieving the balance of a specific user
Call following endpoint (maybe with postman) to return the balance of a user:
```
GET: http://127.0.0.1:8080/api/users/1/get-balance
```

## Add money to a specific user's wallet
Call following endpoint (maybe with postman) to add the balance of a user:
```
POST: http://127.0.0.1:8080/api/users/1/add-money
Payload: {
    "amount": 100
}
```
