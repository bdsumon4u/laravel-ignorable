<p align="center">
<a href="https://packagist.org/packages/hotash/laravel-ignorable"><img src="https://img.shields.io/packagist/dt/hotash/laravel-ignorable" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/hotash/laravel-ignorable"><img src="https://img.shields.io/packagist/v/hotash/laravel-ignorable" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/hotash/laravel-ignorable"><img src="https://img.shields.io/packagist/l/hotash/laravel-ignorable" alt="License"></a>
</p>

## About Package

> **Note:** This package will help you to ignore chained method calls as per your defined condition.

## Installation

`require hotash/laravel-ignorable`

## Usages

```php
ignorable(new Foo(), $whenToIgnore)
    ->call()->your()->method()
    ->discard($whenToDiscard) // callable or bool
    ->call()->more()->method()
    ->ignore($whenToIgnore) // callable or bool
    ->conditional()->method()->call()
    ->discard($whenToDiscard) // callable or bool
    ->again()->call()->your()->method()
    ->dump()->value;
```

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide is not available yet.

## Code of Conduct

Description is PENDING.

## Security Vulnerabilities

Description is PENDING.

## License

The Ignorable package is open-sourced software licensed under the [MIT license](LICENSE.md).
