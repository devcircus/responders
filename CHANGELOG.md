# Changelog

All notable changes to BrightComponents/Responders will be documented in this file

## 0.1.0 - 2018-05-25

-   initial release

## 0.1.1 - 2018-07-03

-   Add abilty to customize the Responder method name.
-   Remove helpers from Responder.
-   Clean up Responder stub.
-   Add request and payload properties with accessors and setters to Responder.
-   Update config options.
-   Update README.

## 0.1.2 - 2018-07-15

-   Change command namespace to 'bright' from 'make'.
-   Start adding tests.
-   Replace command 'name' property with 'signature' property.

## 0.1.3 - 2018-07-26

-   With the new bright-components/adr package, we're renaming the command namespace to "adr" from "bright".

## 1.0.0-beta.1 - 2018-09-02

-   First beta release. Features locked.

## 1.0.0-beta.1.1 - 2018-09-05

-   Bump required PHP version to ^7.1.3
-   Remove individual illuminate components.
-   Require laravel/framework 5.7.\*
-   Bump orchestra/testbench version to ~3.7

## 1.0.0-beta.1.2 - 2018-01-01

-   Make Responder implement the Responsable interface

## 1.0.0-beta.1.3 - 2019-02-28

-   Update for compatibility with Laravel 5.8

## 1.0.0-beta.1.4 - 2019-03-21

-   Require bright-components/common for payloads.

## 1.0.0 - 2019-03-23

-   Initial stable release.

## 2.0.0 - 2019-03-28

-   A dependency bump due to logic change in the BrightComponents/Common package could cause bc breaks.
    - Bump version to 2.0.
    - Update .travis.yml