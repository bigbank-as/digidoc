# PHP Library for Estonian Digital ID

*Still in development. Additional documentation to be written as the library nears 1.0.*

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

The Apache 2 License. Please see [License File](LICENSE.md) for more information.
