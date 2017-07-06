# Line Wrap (filter for TWIG)

[![Total Downloads](https://img.shields.io/packagist/dt/techwilk/twig-linewrap.svg)](https://packagist.org/packages/techwilk/twig-linewrap)
[![Latest Stable Version](https://img.shields.io/packagist/v/techwilk/twig-linewrap.svg)](https://packagist.org/packages/techwilk/twig-linewrap)
[![License](https://img.shields.io/packagist/l/techwilk/twig-linewrap.svg)](https://packagist.org/packages/techwilk/twig-linewrap)

TWIG filter to wrap lines over a specified length with a newline, or optionally pass in a different separator.

## Installation

1. Install through composer.

```
composer require techwilk/twig-linewrap
```

2. Then add as an extension to TWIG:

``` php
$twig->addExtension(new \TechWilk\Twig\Extension\LineWrap($urlGenerator));
```

## Use

Use as a standard twig filter, passing in a maximum length after which to wrap:

``` twig
{{ 'this is some text that goes on forever' | linewrap(10) }}
```

outputs:

```
this is so
me text th
at goes on
 forever
```

Optionally pass in a different separator (such as for [iCal wrapping](examples/ical-wrapping.md)):

``` twig
{{ 'this is some text that goes on forever' | linewrap(75, "\n ") }}
```

