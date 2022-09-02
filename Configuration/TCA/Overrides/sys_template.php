<?php

defined('TYPO3') or die();

// Declare static TypoScript files
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'examples',
    'Configuration/TypoScript/',
    'Examples TypoScript'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'examples',
    'Configuration/TypoScript/HmenuSpecial/',
    'Examples: HMENU special userfunc'
);
