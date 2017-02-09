Component for downloading images by URL
======================================

This is component for downloading images by URL from another servers.
This component uses [cURL](http://php.net/manual/en/book.curl.php) PHP library.

[![Total Downloads](https://poser.pugx.org/greeflas/php-image-downloader/downloads)](https://packagist.org/packages/greeflas/php-image-downloader)
[![Latest Stable Version](https://poser.pugx.org/greeflas/php-image-downloader/v/stable)](https://packagist.org/packages/greeflas/php-image-downloader)
[![Latest Unstable Version](https://poser.pugx.org/greeflas/php-image-downloader/v/unstable)](https://packagist.org/packages/greeflas/php-image-downloader)
[![License](https://poser.pugx.org/greeflas/php-image-downloader/license)](https://packagist.org/packages/greeflas/php-image-downloader)

Installation
------------
The preferred way to install the component is through [composer](https://getcomposer.org/download/).

Either run
```
composer require greeflas/php-image-downloader
```
or add
```json
"greeflas/php-image-downloader": "dev-master"
```
to the require section of your composer.json.

Using
-----
Create component instance
```php
$downloader = new \greeflas\tools\ImageDownloader([
    'class' => \greeflas\tools\validators\ImageValidator::class
]);
```
in array you should specify the validator class. It used for validation of downloaded files.
If you don't want run validation, you can use a `\greeflas\tools\validators\FakeValidator::class`.

Then you should call method for downloading
```php
$downloader->download($url, $imagesRoot, $fileName);
```
this method takes as agruments: URL to image, path to catalog where file will be saved and name for downloaded file.