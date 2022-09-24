# Date Converter

[![Latest Version](https://img.shields.io/github/release/hussainweb/date-converter.svg?style=flat-square)](https://github.com/hussainweb/date-converter/releases)
[![Software License](https://img.shields.io/badge/license-GPLv2-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/github/workflow/status/hussainweb/date-converter/PHP%20tests%20and%20style%20checks?style=flat-square)](https://github.com/hussainweb/date-converter/actions/workflows/test.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/hussainweb/date-converter.svg?style=flat-square)](https://packagist.org/packages/hussainweb/date-converter)

Date Converter is a PHP library to convert dates across various calendars. Currently, support for only various Hijri calendars is planned.

## Install

Via Composer

```bash
composer require hussainweb/date-converter
```

## Usage

To convert between dates, use the respective `Algorithm` class. Similar to [PHP's in-built date conversion functions](https://www.php.net/manual/en/function.gregoriantojd.php), these classes work with Julian Day as a primary means to convert dates.

```php
$algorithm = new HijriFatimidAstronomical();
$hijri_date = $algorithm->fromJulianDay(2457198); // 8-9-1436
```
