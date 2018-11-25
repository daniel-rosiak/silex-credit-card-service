# Simple API

## Requirements

    php 5.5.9*
    php.ini: always_populate_raw_post_data = -1


## Instalation

    composer update


## Running

    cd /web && php -S localhost:9001


## Run tests

    vendor/bin/phpunit 


## Api Routes

    POST ->   http://localhost:9001/api/v1/payment/credit-card
	  POST ->   http://localhost:9001/api/v1/payment/mobile

example parameters for credit-card:

    number:49927398716
    expirationDate:12-18
    cvv2:123
    email:danielrosiak@gmail.com
    auth[signature]:d56fd2f7494a28074ab1cb1dc4a72d33c9157fb6
    auth[timestamp]:1485099591

example parameters for mobile:

    phone:123123123
    auth[signature]:d56fd2f7494a28074ab1cb1dc4a72d33c9157fb6
    auth[timestamp]:1485099591


## Comments

+   Api accepts Content-Types like: application/json, application/xml and text/xml, but simple POST's with Content-Type: multipart/form-data are also accepted for test purposes
+   Authorization is a simple key, timestamp and signature combination, for test purposes signature is made only from timestamp and key (other data is ommited) see AuthService
+   ValidatorService returns only "true or false", but it can also return array with specific form errors
+   routes /payment/credit-card and /payment/mobile can be merged into one (/payment), using type parameter

## Author

    daniel.rosiak@gmail.com







