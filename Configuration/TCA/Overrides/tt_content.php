<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// Declare static TS file
ExtensionManagementUtility::addStaticFile(
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
            'renderType' => 'checkboxToggle',
            'items' => [
                [
                    0 => '',
                    1 => ''
                ]
            ],
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
    'tx_examples_main_category' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tt_content.tx_examples_main_category',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['None', '0'],
            ],
            'foreign_table' => 'sys_category',
            'foreign_table_where' => 'AND {#sys_category}.{#pid} = ###PAGE_TSCONFIG_ID### AND {#sys_category}.{#hidden} = 0 ' .
                   'AND {#sys_category}.{#deleted} = 0 AND {#sys_category}.{#sys_language_uid} IN (0,-1) ORDER BY sys_category.uid',
            'default' => '0'
        ],
    ],
];

ExtensionManagementUtility::addTCAcolumns(
    'tt_content',
    $temporaryColumn
);

ExtensionManagementUtility::addFieldsToPalette(
    'tt_content',
    'access',
    'tx_examples_noprint',
    'before:editlock'
);

// Create various FE plugins to demonstrate FlexForms definition
// USAGE: TCA Reference > $TCA array reference > ['columns'][fieldname]['config'] / TYPE: "flex"

// Add the plugins to the list of plugins
ExtensionManagementUtility::addPlugin(
    [
        'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pi2',
        'examples_pi2',
    ],
    'list_type',
    'examples'
);
ExtensionManagementUtility::addPlugin(
    [
        'LLL:EXT:examples/Resources/Private/Language/locallang_db.xlf:tt_content.list_type_pi3',
        'examples_pi3',
    ],
    'list_type',
    'examples'
);
ExtensionManagementUtility::addPlugin(
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


$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['examples_pi2'] = 'pi_flexform';
ExtensionManagementUtility::addPiFlexFormValue(
    'examples_pi2', 'FILE:EXT:examples/Configuration/Flexforms/flexform_ds2.xml'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['examples_pi3'] = 'pi_flexform';
ExtensionManagementUtility::addPiFlexFormValue(
    'examples_pi3', 'FILE:EXT:examples/Configuration/Flexforms/flexform_ds3.xml'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['examples_pi4'] = 'pi_flexform';
ExtensionManagementUtility::addPiFlexFormValue(
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
ExtensionManagementUtility::addTcaSelectItem(
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

// Adds the content element to the "Type" dropdown
ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:examples_newcontentelement_title',
        'examples_newcontentelement',
        'content-text',
    ],
    'textmedia',
    'after'
);

// Configure the default backend fields for the content element
$GLOBALS['TCA']['tt_content']['types']['examples_newcontentelement'] = [
    'showitem' => '
           --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
               --palette--;;general,
               header; Internal title (not displayed),
               bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
           --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
               --palette--;;hidden,
               --palette--;;access,
       ',
    'columnsOverrides' => [
        'bodytext' => [
            'config' => [
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
            ],
        ],
    ],
];


ExtensionManagementUtility::addTcaSelectItem(
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


ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:examples_dataprocmenu_title',
        'examples_dataprocmenu',
        'content-special-uploads',
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

ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:examples_dataproclang_title',
        'examples_dataproclang',
        'install-manage-language',
    ],
    );

$GLOBALS['TCA']['tt_content']['types']['examples_dataproclang'] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            --palette--;;headers,
    '.$standardTabs,
];


ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:examples_dataprocsite_title',
        'examples_dataprocsite',
        'apps-pagetree-folder-root',
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

ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:examples_dataprocsitelanguage_title',
        'examples_dataprocsitelanguage',
        'content-message',
    ],
);

$GLOBALS['TCA']['tt_content']['types']['examples_dataprocsitelanguage'] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            --palette--;;headers,
            pages,
    '.$standardTabs,
];

ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:examples_dataprocsplit_title',
        'examples_dataprocsplit',
        'content-timeline',
    ],
    );

$GLOBALS['TCA']['tt_content']['types']['examples_dataprocsplit'] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            --palette--;;headers,
    '.$standardTabs,
];


ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:examples_dataprocfiles_title',
        'examples_dataprocfiles',
        'content-image',
    ],
    );

$GLOBALS['TCA']['tt_content']['types']['examples_dataprocfiles'] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            --palette--;;headers,
            image,
            --palette--;;mediaAdjustments,
    '.$standardTabs,
];

ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:examples_dataprocgallery_title',
        'examples_dataprocgallery',
        'content-dashboard',
    ],
    );

$GLOBALS['TCA']['tt_content']['types']['examples_dataprocgallery'] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            --palette--;;headers,
            image,
            --palette--;;mediaAdjustments,
            --palette--;;gallerySettings,
    '.$standardTabs,
];

ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:examples_dataproccustom_title',
        'examples_dataproccustom',
        'content-dashboard',
    ],
    );

$GLOBALS['TCA']['tt_content']['types']['examples_dataproccustom'] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            --palette--;;headers,
            tx_examples_main_category,
    '.$standardTabs,
];
