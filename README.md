# Laravel OpenGraph
A Laravel package to fetch Open Graph metadata of a website.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/shweshi/OpenGraph.svg?style=flat-square)](https://packagist.org/packages/shweshi/OpenGraph)
[![Total Downloads](https://img.shields.io/packagist/dt/shweshi/OpenGraph.svg?style=flat-square)](https://packagist.org/packages/shweshi/OpenGraph)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/shweshi/OpenGraph/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/shweshi/OpenGraph/?branch=master)
[![StyleCI](https://styleci.io/repos/116995669/shield?branch=master)](https://styleci.io/repos/116995669)
[![Build Status](https://scrutinizer-ci.com/g/shweshi/OpenGraph/badges/build.png?b=master)](https://scrutinizer-ci.com/g/shweshi/OpenGraph/build-status/master)

## Installation
Perform the following operations in order to use this package
- Run `composer require "shweshi/opengraph"` in your terminal

If you do not run Laravel 5.5 (or higher), then add the service provider in config/app.php:

- **Add Service Provider**
   Open `config/app.php` and add `shweshi\OpenGraph\Providers\OpenGraphProvider::class,` to the end of `providers` array:

    ```
    'providers' => array(
        ....
        shweshi\OpenGraph\Providers\OpenGraphProvider::class,
    ),
    ```
   Next under the `aliases` array:

    ```
    'aliases' => array(
        ....
        'OpenGraph' => shweshi\OpenGraph\Facades\OpenGraphFacade::class
    ),
    ```

If you do run the package on Laravel 5.5+, package auto-discovery takes care of the magic of adding the service provider.

## Requirements
- You need to install the [DOM](http://www.php.net/en/dom) extension.

## How to use

- After following the above steps,

    ```
    use OpenGraph;

    $data = OpenGraph::fetch("https://unsplash.com/");

    print_r($data);
    ```

# Happy coding!    
