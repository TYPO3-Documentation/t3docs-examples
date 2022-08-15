<?php

defined('TYPO3') or die();

// Declare static TS file
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'examples',
    'Configuration/TypoScript/',
    'Examples TypoScript'
);

// Declare static TS file
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'examples',
    'Configuration/TypoScript/HmenuSpecial/',
    'Examples: HMENU special userfunc'
);
