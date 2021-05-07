# Gimmersta Proxicore Package Changelog

## 1.0.0
##### 2021-05-07

- Dropped PHP 7.0 - 7.3 support
- Dropped Laravel 5.4 - 7.x support
- Changed minimum Laravel version to 8.12
- Changed internal http engine from Guzzle to Laravel HTTP Client (still with Guzzle under the hood)
- Added explicit Guzzle requirement (it was needed even earlier, but was missing from composer.json)

## 0.0.3.7
##### 2021-03-09

- Supports Laravel 5.4 - 8.x
- Supports PHP 7.0+
