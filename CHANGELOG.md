# Changelog

All notable changes to `OpenGraph` will be documented in this file.

## 1.1.3 - 2023-08-31
- Add support for Laravel 10

## 1.1.2 - 2022-06-09
- Fix: SSL get headers image verification

## 1.1.1 - 2022-02-18
- Add support for Laravel 9

## 1.1.0 - 2020-12-16
- Add support to fetch meta values.

## 1.0.16 - 2020-10-01
- Process the html tags for 4XX and 5XX pages.

## 1.0.15 - 2020-10-01
- Support to add custom user agent.

## 1.0.14 - 2020-07-10
- New param on the OpenGraph::fetch method to allow users to enable/disable the logging of the malformed HTML parsing.

## 1.0.13 - 2020-07-06
- Use exception

## 1.0.12 - 2020-07-06
- Remove illuminate Log

## 1.0.11 - 2020-07-06
- Replace try/catch

## 1.0.10 - 2020-07-03
- Added exception handling and warning if the url contains error

## 1.0.9 - 2020-07-03

- Handling the curl_exec() error.

## 1.0.8 - 2020-06-03

- Fix error when verifying image url

## 1.0.7 - 2019-12-13

- Fix non-ascii image url meta data.

## 1.0.6 - 2019-07-20

- Handling invalid image URL.

## 1.0.5 - 2019-06-13

- Added support to fetch language specific metadata.

## 1.0.4 - 2019-04-26

- Verify that the image url is valid in the metadata.

## 1.0.3 - 2019-01-04

- Added support to fetch all metadata

## 1.0.2 - 2018-11-23

- Added tests and autoload for laravel >= 5.5

## 1.0.1 - 2018-01-17

- Fix autoload

## 1.0.0 - 2018-01-17

- initial release
