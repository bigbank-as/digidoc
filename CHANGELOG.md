# Change Log

All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](http://semver.org). See [Keep A Changelog](http://keepachangelog.com) for instructions on how to maintain this file.

## 0.3.0 - 2016-07-16

Add Id Card signing support
Refactor both Mobile Id and Id Card signing to use the same base class

## 0.2.0 - 2016-02-02

Refactoring release. Minor backwards compatibility break for the `Authenticator` class.

### Added
- Overall documentation improvements

### Fixed
- Fix random `SPChallenge` generation with PHP 7: return valid UTF-8 hex challenges, not binary

### Changed
- Use `ircmaxell/random-lib` to generate random numbers for mobile ID authentication queries
- Public interface of `Authenticator` has changed: session code is now held internally and is not passed as a parameter to calls after `authenticate`

## 0.1.0 - 2015-11-04

Initial release that contains prototype mobile ID authentication and file signing functionality through the
`\Bigbank\DigiDoc\Services\MobileId\Authenticator` and `\Bigbank\DigiDoc\Services\MobileId\FileSigner` services
