<?php

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

defined('TYPO3') || die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// Add a "no print" checkbox
// USAGE: TCA Reference >  $TCA array reference > Extending the $TCA array
$temporaryColumn = [
    'tx_examples_noprint' => [
        'exclude' => 0,
        'label' => 'LLL:examples.db:tt_content.tx_examples_noprint',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
        ],
    ],
    'tx_examples_separator' => [
        'exclude' => 0,
        'label' => 'LLL:examples.db:tt_content.tx_examples_separator',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                [
                    'label' => 'Standard CSV data formats',
                    'value' => '--div--',
                ],
                [
                    'label' => 'Comma separated',
                    'value' => ',',
                ],
                [
                    'label' => 'Semicolon separated',
                    'value' => ';',
                ],
                [
                    'label' => 'Special formats',
                    'value' => '--div--',
                ],
                [
                    'label' => 'Pipe separated (TYPO3 tables)',
                    'value' => '|',
                ],
                [
                    'label' => 'Tab separated',
                    'value' => "\t",
                ],
            ],
            'default' => ',',
        ],
    ],
    'tx_examples_main_category' => [
        'exclude' => 0,
        'label' => 'LLL:examples.db:tt_content.tx_examples_main_category',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                [
                    'label' => 'None',
                    'value' => '0',
                ],
            ],
            'foreign_table' => 'sys_category',
            'foreign_table_where' => 'AND {#sys_category}.{#pid} = ###PAGE_TSCONFIG_ID### AND {#sys_category}.{#hidden} = 0 ' .
                   'AND {#sys_category}.{#deleted} = 0 AND {#sys_category}.{#sys_language_uid} IN (0,-1) ORDER BY sys_category.uid',
            'default' => '0',
        ],
    ],
];

ExtensionManagementUtility::addTCAcolumns(
    'tt_content',
    $temporaryColumn,
);

ExtensionManagementUtility::addFieldsToPalette(
    'tt_content',
    'access',
    'tx_examples_noprint',
    'before:editlock',
);

$standardTabs = '--div--;LLL:frontend.ttc:tabs.appearance,
            --palette--;;frames,
            --palette--;;appearanceLinks,
        --div--;LLL:core.form.tabs:language,
            --palette--;;language,
        --div--;LLL:core.form.tabs:access,
            --palette--;;hidden,
            --palette--;;access,
        --div--;LLL:core.form.tabs:categories,
            categories,
        --div--;LLL:core.form.tabs:notes,
            rowDescription,
        --div--;LLL:core.form.tabs:extended,';

// Adds the content element to the "Type" dropdown
ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'LLL:examples.messages:examples_newcontentcsv_title',
        'value' => 'examples_newcontentcsv',
        'icon' => 'mimetypes-x-content-table',
        'group' => 'dataProcessingExamples',
        'description' => 'LLL:examples.messages:examples_newcontentcsv_description',
    ],
);

$GLOBALS['TCA']['tt_content']['types']['examples_newcontentcsv'] = [
    'showitem' => '
        --div--;LLL:core.form.tabs:general,
            --palette--;;general,
            --palette--;;headers,
            imagecols,
            tx_examples_separator,
            bodytext;LLL:examples.messages:examples_newcontentcsv_bodytext,
    ' . $standardTabs,
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
        'label' => 'LLL:examples.messages:examples_newcontentelement_title',
        'value' => 'examples_newcontentelement',
        'icon' => 'content-text',
        'group' => 'default',
    ],
    'textmedia',
    'after',
);

// Configure the default backend fields for the content element
$GLOBALS['TCA']['tt_content']['types']['examples_newcontentelement'] = [
    'showitem' => '
           --div--;LLL:core.form.tabs:general,
               --palette--;;general,
               header; Internal title (not displayed),
               bodytext;LLL:frontend.ttc:bodytext_formlabel,
           --div--;LLL:core.form.tabs:access,
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
        'label' => 'LLL:examples.messages:examples_dataprocmenu_title',
        'value' => 'examples_dataprocmenu',
        'icon' => 'content-special-uploads',
        'group' => 'dataProcessingExamples',
        'description' => 'LLL:examples.messages:examples_dataprocmenu_description',
    ],
);

$GLOBALS['TCA']['tt_content']['types']['examples_dataprocmenu'] = [
    'showitem' => '
        --div--;LLL:core.form.tabs:general,
            --palette--;;general,
            --palette--;;headers,
            pages,
    ' . $standardTabs,
];

ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'LLL:examples.messages:examples_dataproclang_title',
        'value' => 'examples_dataproclang',
        'icon' => 'install-manage-language',
        'group' => 'dataProcessingExamples',
        'description' => 'LLL:examples.messages:examples_dataproclang_description',
    ],
);

$GLOBALS['TCA']['tt_content']['types']['examples_dataproclang'] = [
    'showitem' => '
        --div--;LLL:core.form.tabs:general,
            --palette--;;general,
            --palette--;;headers,
    ' . $standardTabs,
];

ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'LLL:examples.messages:examples_dataprocsite_title',
        'value' => 'examples_dataprocsite',
        'icon' => 'apps-pagetree-folder-root',
        'group' => 'dataProcessingExamples',
        'description' => 'LLL:examples.messages:examples_dataprocsite_description',
    ],
);

$GLOBALS['TCA']['tt_content']['types']['examples_dataprocsite'] = [
    'showitem' => '
        --div--;LLL:core.form.tabs:general,
            --palette--;;general,
            --palette--;;headers,
            pages,
    ' . $standardTabs,
];

ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'LLL:examples.messages:examples_dataprocsitelanguage_title',
        'value' => 'examples_dataprocsitelanguage',
        'icon' => 'content-message',
        'group' => 'dataProcessingExamples',
        'description' => 'LLL:examples.messages:examples_dataprocsitelanguage_description',
    ],
);

$GLOBALS['TCA']['tt_content']['types']['examples_dataprocsitelanguage'] = [
    'showitem' => '
        --div--;LLL:core.form.tabs:general,
            --palette--;;general,
            --palette--;;headers,
            pages,
    ' . $standardTabs,
];

ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'LLL:examples.messages:examples_dataprocsplit_title',
        'value' => 'examples_dataprocsplit',
        'icon' => 'content-timeline',
        'group' => 'dataProcessingExamples',
        'description' => 'LLL:examples.messages:examples_dataprocsplit_description',
    ],
);

$GLOBALS['TCA']['tt_content']['types']['examples_dataprocsplit'] = [
    'showitem' => '
        --div--;LLL:core.form.tabs:general,
            --palette--;;general,
            --palette--;;headers,
    ' . $standardTabs,
];

ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'LLL:examples.messages:examples_dataprocfiles_title',
        'value' => 'examples_dataprocfiles',
        'icon' => 'content-image',
        'group' => 'dataProcessingExamples',
        'description' => 'LLL:examples.messages:examples_dataprocfiles_description',
    ],
);

$GLOBALS['TCA']['tt_content']['types']['examples_dataprocfiles'] = [
    'showitem' => '
        --div--;LLL:core.form.tabs:general,
            --palette--;;general,
            --palette--;;headers,
            image,
            --palette--;;mediaAdjustments,
    ' . $standardTabs,
];

ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'LLL:examples.messages:examples_dataprocgallery_title',
        'value' => 'examples_dataprocgallery',
        'icon' => 'content-dashboard',
        'group' => 'dataProcessingExamples',
        'description' => 'LLL:examples.messages:examples_dataprocgallery_description',
    ],
);

$GLOBALS['TCA']['tt_content']['types']['examples_dataprocgallery'] = [
    'showitem' => '
        --div--;LLL:core.form.tabs:general,
            --palette--;;general,
            --palette--;;headers,
            image,
            --palette--;;mediaAdjustments,
            --palette--;;gallerySettings,
    ' . $standardTabs,
];

ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'LLL:examples.messages:examples_dataproccustom_title',
        'value' => 'examples_dataproccustom',
        'icon' => 'content-dashboard',
        'group' => 'dataProcessingExamples',
        'description' => 'LLL:examples.messages:examples_dataproccustom_description',
    ],
);

$GLOBALS['TCA']['tt_content']['types']['examples_dataproccustom'] = [
    'showitem' => '
        --div--;LLL:core.form.tabs:general,
            --palette--;;general,
            --palette--;;headers,
            tx_examples_main_category,
    ' . $standardTabs,
];
