..  include:: /Includes.rst.txt
..  _code-quality:

=============
Code Qualité
=============

To ensure code quality, some Composer scripts are available. These
are run in a Docker container to ensure the same checks as the
GitHub action.

:bash:`composer check`
    Run all checks
:bash:`composer check:composer`
    Run all checks regarding composer.json
:bash:`composer check:composer:config`
    Check if :file:`composer.json` is normalized
:bash:`composer check:php`
    Run all checks regarding PHP
:bash:`composer check:php:cs`
    Check coding standards
:bash:`composer check:php:lint`
    Lint all PHP files
:bash:`composer fix`
    Run all fixes
:bash:`composer fix:composer`
    Normalize :file:`composer.json`
:bash:`composer fix:php`
    Run all PHP fixes
:bash:`composer fix:php:cs`
    Fix coding standard violations
