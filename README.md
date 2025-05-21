# Date Converter

[![Latest Version](https://img.shields.io/github/v/release/hussainweb/date-converter?style=flat-square)](https://github.com/hussainweb/date-converter/releases)
[![Software License](https://img.shields.io/badge/license-GPLv2-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/github/workflow/status/hussainweb/date-converter/PHP%20tests%20and%20style%20checks?style=flat-square)](https://github.com/hussainweb/date-converter/actions/workflows/test.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/hussainweb/date-converter.svg?style=flat-square)](https://packagist.org/packages/hussainweb/date-converter)

Date Converter is a PHP library to convert dates across various calendars, including Gregorian, Hijri (various algorithms), and Unix timestamp (Native) representations.

## Install

Via Composer

```bash
composer require hussainweb/date-converter
```

## Usage

To convert between dates, use the respective `Algorithm` class. Similar to [PHP's in-built date conversion functions](https://www.php.net/manual/en/function.gregoriantojd.php), these classes work with Julian Day as a primary means to convert dates.

## Supported Calendars

Below are examples of how to use each supported calendar algorithm. Ensure you import the necessary classes using `use` statements at the beginning of your PHP file.

### Gregorian Calendar

Example:
```php
// Ensure you have: 
// use Hussainweb\DateConverter\Algorithm\GregorianAlgorithm;
// use Hussainweb\DateConverter\Value\GregorianDate;

$gregorianAlgo = new GregorianAlgorithm();

// Convert Julian Day to Gregorian Date
// Example Julian Day: 2451545 (corresponds to 2000-01-01 Gregorian)
$gregorianDate = $gregorianAlgo->fromJulianDay(2451545);
echo "Gregorian Date: Day=" . $gregorianDate->getMonthDay() . ", Month=" . $gregorianDate->getMonth() . ", Year=" . $gregorianDate->getYear() . "\n";

// Convert Gregorian Date to Julian Day
$dateToConvert = new GregorianDate(1, 1, 2000); // Day, Month, Year
$julianDay = $gregorianAlgo->toJulianDay($dateToConvert);
echo "Julian Day: " . $julianDay . "\n";
```

### Hijri Calendar (Fatimid Astronomical)

Example:
```php
// Ensure you have:
// use Hussainweb\DateConverter\Algorithm\Hijri\HijriFatimidAstronomical;
// use Hussainweb\DateConverter\Value\HijriDate;

$hijriAlgo = new HijriFatimidAstronomical();

// Convert Julian Day to Hijri Date
// Example Julian Day: 2457198 (corresponds to 8-9-1436 Hijri Fatimid Astronomical)
$hijriDate = $hijriAlgo->fromJulianDay(2457198);
echo "Hijri Date: Day=" . $hijriDate->getMonthDay() . ", Month=" . $hijriDate->getMonth() . ", Year=" . $hijriDate->getYear() . "\n";

// Convert Hijri Date to Julian Day
$dateToConvert = new HijriDate(8, 9, 1436, $hijriAlgo); // Day, Month, Year, Algorithm instance
$julianDay = $hijriAlgo->toJulianDay($dateToConvert);
echo "Julian Day: " . $julianDay . "\n";
```

### Native Calendar (Unix Timestamp)

Example:
```php
// Ensure you have:
// use Hussainweb\DateConverter\Algorithm\NativeAlgorithm;
// use Hussainweb\DateConverter\Value\NativeDate;

$nativeAlgo = new NativeAlgorithm();

// Convert Julian Day to Native Date (Unix Timestamp)
// Example Julian Day: 2440588 (corresponds to Unix timestamp 0 -> 1970-01-01 00:00:00 UTC)
$nativeDate = $nativeAlgo->fromJulianDay(2440588);
echo "Native Date (Unix Timestamp): " . $nativeDate->getTimeStamp() . "\n";

// Convert Native Date (from Unix timestamp) to Julian Day
$timestamp = 0; // Example: 1970-01-01 00:00:00 UTC
$dateToConvert = new NativeDate($timestamp);
$julianDay = $nativeAlgo->toJulianDay($dateToConvert);
echo "Julian Day: " . $julianDay . "\n";
```
