<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Schema\Struct\SelectItem;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$customPageDoktype = 116;
$customIconClass = 'tx_examples-archive-page';

$GLOBALS['TCA']['pages']['types'][$customPageDoktype] = $GLOBALS['TCA']['pages']['types'][1];

// Allow all records
$GLOBALS['TCA']['pages']['types'][$customPageDoktype]['allowedRecordTypes'] = ['*'];
$GLOBALS['TCA']['pages']['ctrl']['typeicon_classes'][$customPageDoktype] = $customIconClass;

ExtensionManagementUtility::addTcaSelectItem(
    'pages',
    'doktype',
    new SelectItem(
        'select',
        label: 'examples.messages:archive_page_type',
        value: $customPageDoktype,
        icon: $customIconClass,
        group: 'special',
    ),
);
