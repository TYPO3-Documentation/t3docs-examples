<?php
defined('TYPO3_MODE') or die();

// Load XCLASSing of db_new
// USAGE: Core APIs > TYPO3 API overview > PHP Class Extension > Which classes? > Example - Adding a small feature in the interface
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\TYPO3\CMS\Backend\Controller\NewRecordController::class] = [
    'className' => \Documentation\Examples\Xclass\NewRecordController::class,
];

// Define custom permission options
// USAGE: Core APIs > TYPO3 API overview > Various examples > Custom permission
$GLOBALS['TYPO3_CONF_VARS']['BE']['customPermOptions'] = [
    'tx_examples_cat1' => [
        'header' => 'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:permissions_header',
        'items' => [
            'key1' => [
                'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:permissions_option1',
                'actions-system-typoscript-documentation-open',
                'LLL:EXT:examples/Resources/Private/Language/locallang.xlf:permissions_option1_description',
            ],
            'key2' => ['LLL:EXT:examples/Resources/Private/Language/locallang.xlf:permissions_option2'],
            'key3' => ['LLL:EXT:examples/Resources/Private/Language/locallang.xlf:permissions_option3'],
        ],
    ],
];

$GLOBALS['TYPO3_CONF_VARS']['LOG']['Documentation']['Examples']['Controller']['writerConfiguration'][\TYPO3\CMS\Core\Log\LogLevel::DEBUG] = $GLOBALS['TYPO3_CONF_VARS']['LOG']['writerConfiguration'][\TYPO3\CMS\Core\Log\LogLevel::DEBUG];
// Add example configuration for the logging API
$GLOBALS['TYPO3_CONF_VARS']['LOG']['Documentation']['Examples']['Controller']['writerConfiguration'][\TYPO3\CMS\Core\Log\LogLevel::WARNING] = [
    // configuration for WARNING severity, including all
    // levels with higher severity (ERROR, CRITICAL, EMERGENCY)
    // add a SyslogWriter
    \TYPO3\CMS\Core\Log\Writer\SyslogWriter::class => [],
];
$GLOBALS['TYPO3_CONF_VARS']['LOG']['Documentation']['Examples']['Controller']['processorConfiguration'] = [
    // configuration for ERROR level log entries
    \TYPO3\CMS\Core\Log\LogLevel::ERROR => [
        // add a MemoryUsageProcessor
        \TYPO3\CMS\Core\Log\Processor\MemoryUsageProcessor::class => [
            'formatSize' => true,
        ],
    ],
];

// Register the "error " plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Documentation.Examples',
    'Error',
    [
        'Error' => 'index',
    ],
    [
        'Error' => 'index',
    ]
);
// Add TSconfig for new content element wizard
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:examples/Configuration/TSconfig/Page/ContentElementWizard.txt">');

// Register the HTML parser plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Documentation.Examples',
    'HtmlParser',
    [
        'HtmlParser' => 'index',
    ]
);

// Register the collections plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Documentation.Examples',
    'Collections',
    [
        'Collection' => 'index',
    ],    [
        'Collection' => 'index',
    ]
);

// Register the FAL examples plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Documentation.Examples',
    'FalExamples',
    [
        'FalExample' => 'index,listFiles,collection',
    ],
    // non-cacheable actions
    [
        'FalExample' => 'index,listFiles,collection',
    ]
);

// Add custom translations overriding default labels
$GLOBALS['TYPO3_CONF_VARS']['SYS']['locallangXMLOverride']['EXT:cms/locallang_tca.xlf'][] = 'EXT:examples/Resources/Private/Language/custom.xlf';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['locallangXMLOverride']['de']['EXT:cms/locallang_tca.xlf'][] = 'EXT:examples/Resources/Private/Language/de.custom.xlf';

// Register custom RTE transformation
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_parsehtml_proc.php']['transformation']['tx_examples_transformation'] = \Documentation\Examples\Service\RteTransformation::class;
// Add necessary TSconfig to active custom RTE transformation
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '
            RTE.default.proc.usertrans.tx_examples_transformation.addHrulerInRTE = 1
	        RTE.config.tx_examples_haiku.poem.proc.overruleMode = tx_examples_transformation,ts_css
    '
);
