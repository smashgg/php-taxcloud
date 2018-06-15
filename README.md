[![Latest Stable Version](https://poser.pugx.org/vmdoh/php-taxcloud/v/stable.png)](https://packagist.org/packages/vmdoh/php-taxcloud)
[![Total Downloads](https://poser.pugx.org/vmdoh/php-taxcloud/downloads.png)](https://packagist.org/packages/vmdoh/php-taxcloud)
[![Build Status](https://travis-ci.org/VMdoh/php-taxcloud.png?branch=master)](https://travis-ci.org/VMdoh/php-taxcloud)

At this point, most of the functionality needed to complete an order has been
implemented. The only feature left to fully test and implement is exemptions.

A smoketest is provided that connects to the TaxCloud API using credentials
stored in environment variables. It is intended for quick tests to ensure that
the core of the library works, but it is not a thorough test. **DO NOT RUN THE
SMOKETEST WITH CREDENTIALS FOR A LIVE SITE. IT WILL CREATE TRANSACTIONS.**

The smoketest also provides an excellent set of examples on how to use this
library.

About
----------------
PHP library to facilitate the ability of your PHP web application to
communicate with TaxCloud.

Compatibility
----------------
php-taxcloud is tested with PHP 5.3 and later.

Contributions
----------------
If you'd like to help with php-taxcloud, your efforts are appreciated!

However, your code should at least somewhat closely follow PSR-2 guidelines, and
API changes should be accompanied by tests.

Getting Started
----------------
This library requires that you have API credentials for [TaxCloud](https://taxcloud.net) and USPS.

To obtain TaxCloud API keys, you will need to first sign up for an account
with TaxCloud, [verify your website](https://taxcloud.net/account/websites/), and then obtain your **API ID** and **API KEY**
for your specific website.

To obtain a USPS Web Tools **User ID**, you will need to [fill out the form here](https://secure.shippingapis.com/registration/).
You will receive an email with a Username and Password. All you need is the
Username.

If you already have some sort of address verification in place, the USPS Web
Tools User ID is optional. What is important is that you have accurate ZIP+4
codes for your addresses for taxation purposes.

Examples
----------------
The smoketest is a great resource for a working example that goes through the
entire process in a basic and straightforward manner. The unit tests are a much
better resource if you need to see how specific functionality works. The unit
tests use stubs to mock the API, and these stubs can show you what sort of data
to expect.

Testing
----------------
php-taxcloud includes thorough unit tests that do not require a live connection
to the API. If you are contributing to php-taxcloud, please include unit tests
for your contributions.

[Travis-ci](https://travis-ci.org/VMdoh/php-taxcloud) runs unit tests for the repository. However, you can run them locally
with [PHPUnit](http://phpunit.de/manual/current/en/index.html).

A smoketest is also included that connects to the API and is intended only for
a very quick check that basic functionality has not been broken. To use the
smoketest, you will need to set the following environment variables:
* TaxCloud_apiLoginID
* TaxCloud_apiKey
* TaxCloud_uspsUserID

**DO NOT RUN THE SMOKETEST WITH CREDENTIALS FOR A LIVE SITE. IT WILL CREATE
TRANSACTIONS**
