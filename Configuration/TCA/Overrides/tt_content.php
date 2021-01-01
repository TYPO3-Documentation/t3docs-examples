<?php
defined('TYPO3_MODE') or die();

// Declare static TS file
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'examples',
    'Configuration/TypoScript/',
    'Examples TypoScript'
);

// Add a "no print" checkbox
// USAGE: TCA Reference >  $TCA array reference > Extending the $TCA array
$temporaryColumn = [
    'tx_examples_noprint' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tt_content.tx_examples_noprint',
        'config' => [
            'type' => 'check',
        ],
    ],
    'tx_examples_separator' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tt_content.tx_examples_separator',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['Standard CSV data formats', '--div--'],
                ['Comma separated', ','],
                ['Semicolon separated', ';'],
                ['Special formats', '--div--'],
                ['Pipe separated (TYPO3 tables)', '|'],
                ['Tab separated', "\t"],
            ],
            'default' => ','
        ],
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $temporaryColumn);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'tt_content',
    'visibility',
    'tx_examples_noprint',
    'after:linkToTop'
);

// Create various FE plugins to demonstrate FlexForms definition
// USAGE: TCA Reference > $TCA array reference > ['columns'][fieldname]['config'] / TYPE: "flex"

// Add the plugins to the list of plugins
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
    [
        'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pi1',
        'examples_pi1',
    ],
    'list_type',
    'examples'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
    [
        'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pi2',
        'examples_pi2',
    ],
    'list_type',
    'examples'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
    [
        'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pi3',
        'examples_pi3',
    ],
    'list_type',
    'examples'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
    [
        'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pi4',
        'examples_pi4',
    ],
    'list_type',
    'examples'
);

// Register the "error" plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Examples',
    'Error',
    'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pierror'
);
// Register the HTML Parser plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Examples',
    'HtmlParser',
    'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:htmlparser_plugin_title'
);
// Register the FAL example plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Examples',
    'FalExamples',
    'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:falexample_plugin_title'
);

// Disable the display of layout and select_key fields for the plugins
// provided by the extension
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['examples_pi1'] = 'layout,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['examples_pi2'] = 'layout,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['examples_pi3'] = 'layout,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['examples_pi4'] = 'layout,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['examples_error'] = 'layout,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['examples_htmlparser'] = 'layout,select_key,pages';

// Activate the display of the plug-in flexform field and set FlexForm definition
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['examples_pi1'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'examples_pi1', 'FILE:EXT:examples/Configuration/Flexforms/flexform_ds1.xml'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['examples_pi2'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'examples_pi2', 'FILE:EXT:examples/Configuration/Flexforms/flexform_ds2.xml'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['examples_pi3'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'examples_pi3', 'FILE:EXT:examples/Configuration/Flexforms/flexform_ds3.xml'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['examples_pi4'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'examples_pi4', 'FILE:EXT:examples/Configuration/Flexforms/flexform_ds4.xml'
);


$standardTabs = '--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;;frames,
            --palette--;;appearanceLinks,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
            --palette--;;language,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;hidden,
            --palette--;;access,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
            categories,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
            rowDescription,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,';


// Adds the content element to the "Type" dropdown
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:examples_newcontentcsv_title',
        'examples_newcontentcsv',
        'mimetypes-x-content-table',
    ],
    );


$GLOBALS['TCA']['tt_content']['types']['examples_newcontentcsv'] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            --palette--;;headers,
            imagecols,
            tx_examples_separator,
            bodytext;LLL:EXT:examples/Resources/Private/Language/locallang.xlf:examples_newcontentcsv_bodytext,
    '.$standardTabs,
    'columnsOverrides' => [
        'bodytext' => [
            'config' => [
                'enableRichtext' => false,
            ],
        ],
    ],
];


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:examples_dataprocdb_title',
        'examples_dataprocdb',
        'mimetypes-x-content-table',
    ],
);

$GLOBALS['TCA']['tt_content']['types']['examples_dataprocdb'] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            --palette--;;headers,
            pages,
            recursive,
    '.$standardTabs,
];


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:examples_dataprocmenu_title',
        'examples_dataprocmenu',
        'mimetypes-x-content-table',
    ],
    );

$GLOBALS['TCA']['tt_content']['types']['examples_dataprocmenu'] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            --palette--;;headers,
            pages,
    '.$standardTabs,
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:examples_dataproclang_title',
        'examples_dataproclang',
        'mimetypes-x-content-table',
    ],
    );

$GLOBALS['TCA']['tt_content']['types']['examples_dataproclang'] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            --palette--;;headers,
    '.$standardTabs,
];


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:examples_dataprocsite_title',
        'examples_dataprocsite',
        'mimetypes-x-content-table',
    ],
    );

$GLOBALS['TCA']['tt_content']['types']['examples_dataprocsite'] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            --palette--;;headers,
            pages,
    '.$standardTabs,
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:examples_dataprocsplit_title',
        'examples_dataprocsplit',
        'mimetypes-x-content-table',
    ],
    );

$GLOBALS['TCA']['tt_content']['types']['examples_dataprocsplit'] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            --palette--;;headers,
    '.$standardTabs,
];
