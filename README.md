# PHP Library for Estonian Digital ID

Still in development. Additional documentation to be written as the library matures past 0.1.

This is a PHP library for communicating with the [Certification Centre](https://sk.ee/en)'s DigiDoc API.

## Install

Via Composer

``` bash
$ composer require bigbank/digidoc
```

## Usage

``` php
$digiDoc = new DigiDoc(DigiDoc::URL_TEST);

/** @var AuthenticatorInterface $authenticator */
$authenticator = $digiDoc->getService(AuthenticatorInterface::class);

$userDetails = $authenticator->authenticate('14212128025', '+37200007', 'Testimine', 'White House');
$authenticator->waitForAuthentication($response['Sesscode'], function($authResult){
 return $authResult == 'USER_AUTHENTICATED' ? 'ok' : 'not authenticated';
});
```

See usage examples in the [examples](examples) directory.


## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits

- [:author_name][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/league/:package_name.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/thephpleague/:package_name/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/thephpleague/:package_name.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/thephpleague/:package_name.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/league/:package_name.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/league/:package_name
[link-travis]: https://travis-ci.org/thephpleague/:package_name
[link-scrutinizer]: https://scrutinizer-ci.com/g/thephpleague/:package_name/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/thephpleague/:package_name
[link-downloads]: https://packagist.org/packages/league/:package_name
[link-author]: https://github.com/:author_username
[link-contributors]: ../../contributors
