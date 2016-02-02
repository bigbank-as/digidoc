# PHP Library for Estonian Digital ID (DigiDocService)

[![Latest Stable Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]

This is a PHP library for communicating with the [Certification Centre](https://sk.ee/en)'s [DigiDocService API][link-digidoc].
The API is SOAP-based, documentation is available [here][link-api-doc].

## Install

Via Composer

``` bash
$ composer require bigbank/digidoc
```

The library requires PHP `>=5.6`, `curl`, `soap`, `xml`, `mbstring` and `openssl` extensions.

## Usage

``` php
// Instantiate the main class
$digiDoc = new DigiDoc(DigiDoc::URL_TEST);

// Ask for a service (see: Services)
/** @var AuthenticatorInterface $authenticator */
$authenticator = $digiDoc->getService(AuthenticatorInterface::class);

// Start mobile ID authentication
$userDetails = $authenticator->authenticate('14212128025', '+37200007', 'Testimine', 'My Test App');

// Wait for the user to complete the process
$authenticator->waitForAuthentication(function ($authResult) {
 return $authResult === 'USER_AUTHENTICATED' ? 'welcome!' : 'not authenticated';
});
```

More detailed usage examples are provided in the [examples](examples) directory.

To use a HTTP proxy, set `HTTP_PROXY` environment variable.

## Services

The library provides access to the following services:

### Authentication With Mobile ID

Authenticate the user with his mobile ID.

- Interface Name: `AuthenticatorInterface`
- DigiDocService: `7. Queries and Responses for Authentication / 7.1 MobileAuthenticate`

#### Usage

See [examples/mobile/authentication.php](examples/mobile/authentication.php).

### Digital Signature With Mobile ID

Allow users to digitally sign files using mobile ID.

- Interface Name: `FileSignerInterface`
- DigiDocService: `8. Queries and Responses for Digital Signature`

#### Usage

See [examples/mobile/signing.php](examples/mobile/signing.php).

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Known Issues

- Challenge verification is not done for authentication queries (see `Challenge` and `SPChallenge` parameters for `MobileAuthenticate` query). This is planned in future versions.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits

- [Bigbank's developers][link-bb-developers]
- [All Contributors][link-contributors]

## License

The Apache 2 License. Please see [License File](LICENSE.md) for more information.


[link-bb-developers]: https://github.com/orgs/bigbank-as/people
[link-contributors]: ../../contributors
[link-digidoc]: https://www.sk.ee/en/services/validity-confirmation-services/digidoc-service/
[link-api-doc]: http://www.sk.ee/upload/files/DigiDocService_spec_eng.pdf

[ico-version]: https://poser.pugx.org/bigbank/digidoc/v/stable
[ico-license]: https://poser.pugx.org/bigbank/digidoc/license
[ico-travis]: https://api.travis-ci.org/bigbank-as/digidoc.svg
[ico-downloads]: https://poser.pugx.org/bigbank/digidoc/downloads

[link-packagist]: https://packagist.org/packages/bigbank/digidoc
[link-travis]: https://travis-ci.org/bigbank-as/digidoc
[link-downloads]: https://packagist.org/packages/bigbank/digidoc