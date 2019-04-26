# Laravel OpenGraph

A Laravel package to fetch Open Graph metadata of a website.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/shweshi/OpenGraph.svg?style=flat-square)](https://packagist.org/packages/shweshi/OpenGraph)
[![Total Downloads](https://img.shields.io/packagist/dt/shweshi/OpenGraph.svg?style=flat-square)](https://packagist.org/packages/shweshi/OpenGraph)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/shweshi/OpenGraph/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/shweshi/OpenGraph/?branch=master)
[![StyleCI](https://styleci.io/repos/116995669/shield?branch=master)](https://styleci.io/repos/116995669)
[![Build Status](https://scrutinizer-ci.com/g/shweshi/OpenGraph/badges/build.png?b=master)](https://scrutinizer-ci.com/g/shweshi/OpenGraph/build-status/master)
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fshweshi%2FOpenGraph.svg?type=shield)](https://app.fossa.io/projects/git%2Bgithub.com%2Fshweshi%2FOpenGraph?ref=badge_shield)

## Installation

Perform the following operations in order to use this package

- Install via composer

```
composer require "shweshi/opengraph"
```

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
  ```

  this will give you an array like this..

  ```
    array (
      'title' => 'Beautiful Free Images & Pictures | Unsplash',
      'description' => 'Beautiful, free images and photos that you can download and use for any project. Better than any royalty free or stock photos.',
      'type' => 'website',
      'url' => 'https://unsplash.com/',
      'image' => 'http://images.unsplash.com/photo-1542841791-1925b02a2bbb?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1080&fit=max&ixid=eyJhcHBfaWQiOjEyMDd9&s=aceabe8a2fd1a273da24e68c21768de0',
      'image:secure_url' => 'https://images.unsplash.com/photo-1542841791-1925b02a2bbb?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1080&fit=max&ixid=eyJhcHBfaWQiOjEyMDd9&s=aceabe8a2fd1a273da24e68c21768de0',
    )
  ```

  You can also pass an optional parameter either true or false along with url. When set false it will only fetch basic metadata and in case of true it will fetch all the other optional metadata as well like audio, video, music and twitter metatags as well.

  ```
  $data = OpenGraph::fetch("https://unsplash.com/", true);
  ```

  this will give you an array like this..

  ```
    array (
      'charset' => 'UTF8',
      'viewport' => 'width=device-width, initial-scale=1.0, maximum-scale=1.0, minimal-ui',
      'mobile-web-app-capable' => 'yes',
      'apple-mobile-web-app-capable' => 'yes',
      'apple-mobile-web-app-title' => 'Unsplash',
      'application-name' => 'Unsplash',
      'author' => 'Unsplash',
      'msapplication-config' => 'browserconfig.xml',
      'msapplication-TileColor' => '#ffffff',
      'msapplication-TileImage' => 'https://unsplash.com/mstile-144x144.png',
      'theme-color' => '#ffffff',
      'description' => 'Beautiful, free images and photos that you can download and use for any project. Better than any royalty free or stock photos.',
      'twitter:site' => '@unsplash',
      'twitter:title' => 'Beautiful Free Images & Pictures | Unsplash',
      'twitter:description' => 'Beautiful, free images and photos that you can download and use for any project. Better than any royalty free or stock photos.',
      'twitter:url' => 'https://unsplash.com/',
      'twitter:card' => 'summary_large_image',
      'twitter:image' => 'https://images.unsplash.com/photo-1546486610-e9fe4f1e6751?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1080&fit=max&ixid=eyJhcHBfaWQiOjEyMDd9',
      'title' => 'Beautiful Free Images & Pictures | Unsplash',
      'type' => 'website',
      'url' => 'https://unsplash.com/',
      'image' => 'http://images.unsplash.com/photo-1546486610-e9fe4f1e6751?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1080&fit=max&ixid=eyJhcHBfaWQiOjEyMDd9',
      'image:secure_url' => 'https://images.unsplash.com/photo-1546486610-e9fe4f1e6751?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1080&fit=max&ixid=eyJhcHBfaWQiOjEyMDd9',
  )
  ```

## Features

- Verifies the image metatag contains the valid image url.

## Testing

    composer test

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE OF CONDUCT](CODE_OF_CONDUCT.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fshweshi%2FOpenGraph.svg?type=large)](https://app.fossa.io/projects/git%2Bgithub.com%2Fshweshi%2FOpenGraph?ref=badge_large)

### Happy coding!
