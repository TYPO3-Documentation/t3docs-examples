..  include:: /Includes.rst.txt
..  _code-quality:

=============
Code Qualität
=============

Um die Qualität des Codes zu gewährleisten, sind einige Composer-Skripte verfügbar. Diese werden in einem
Docker-Container ausgeführt, um die gleichen Prüfungen wie bei der GitHub-Aktion.

:bash:`composer check`
    Alle Prüfungen durchführen
:bash:`composer check:composer`
    Alle Prüfungen bezüglich composer.json durchführen
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
