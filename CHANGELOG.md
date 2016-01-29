# Change Log

All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](http://semver.org). See [Keep A Changelog](http://keepachangelog.com) for instructions on how to maintain this file.

## [Unreleased] - [Unreleased]

### Fixed
- Fix random `SPChallenge` generation with PHP 7: return valid UTF-8 hex challenges, not binary

## 0.1.0 - 2015-11-04

Initial release that contains prototype mobile ID authentication and file signing functionality through the
`\Bigbank\DigiDoc\Services\MobileId\Authenticator` and `\Bigbank\DigiDoc\Services\MobileId\FileSigner` services.
