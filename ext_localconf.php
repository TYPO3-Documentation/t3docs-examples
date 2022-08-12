<?php
// Prevent Script from being called directly
defined('TYPO3') or die();

// encapsulate all locally defined variables
(function () {

    // Load XCLASSing of db_new
    // USAGE: Core APIs > TYPO3 API overview > PHP Class Extension > Which classes? > Example - Adding a small feature in the interface
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\TYPO3\CMS\Backend\Controller\NewRecordController::class] = [
        'className' => \T3docs\Examples\Xclass\NewRecordController::class,
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

    // Register a node in ext_localconf.php
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1609888016] = [
        'nodeName' => 'specialField',
        'priority' => 40,
        'class' => \T3docs\Examples\Form\Element\SpecialFieldElement::class,
    ];


    // Add example configuration for the logging API
    $GLOBALS['TYPO3_CONF_VARS']['LOG']['T3docs']['Examples']['Controller']['writerConfiguration'] = [
        // configuration for ERROR level log entries
        \TYPO3\CMS\Core\Log\LogLevel::ERROR => [
            // add a FileWriter
            \TYPO3\CMS\Core\Log\Writer\FileWriter::class => [
                // configuration for the writer
                'logFile' => \TYPO3\CMS\Core\Core\Environment::getVarPath() . '/log/typo3_examples.log',
            ]
        ]
    ];

    $GLOBALS['TYPO3_CONF_VARS']['LOG']['T3docs']['Examples']['Controller']['writerConfiguration'][\TYPO3\CMS\Core\Log\LogLevel::DEBUG] = [
        \TYPO3\CMS\Core\Log\Writer\DatabaseWriter::class => [
            'logTable' => 'tx_examples_log',
        ],
    ];

    $GLOBALS['TYPO3_CONF_VARS']['LOG']['T3docs']['Examples']['Controller']['writerConfiguration'][\TYPO3\CMS\Core\Log\LogLevel::WARNING] = [
        // configuration for WARNING severity, including all
        // levels with higher severity (ERROR, CRITICAL, EMERGENCY)
        // add a SyslogWriter
        \TYPO3\CMS\Core\Log\Writer\SyslogWriter::class => [],
    ];
    $GLOBALS['TYPO3_CONF_VARS']['LOG']['T3docs']['Examples']['Controller']['processorConfiguration'] = [
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
        'Examples',
        'Error',
        [
            \T3docs\Examples\Controller\ErrorController::class => 'index',
        ],
        [
            \T3docs\Examples\Controller\ErrorController::class => 'index',
        ]
    );

    // Configure the HTML parser plugin
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Examples',
        'HtmlParser',
        [
            \T3docs\Examples\Controller\HtmlParserController::class => 'index',
        ]
    );

    // Register the FAL examples plugin
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Examples',
        'FalExamples',
        [
            \T3docs\Examples\Controller\FalExampleController::class => 'index,listFiles,collection',
        ],
        // non-cacheable actions
        [
            \T3docs\Examples\Controller\FalExampleController::class => 'index,listFiles,collection',
        ]
    );

    // Add custom translations overriding default labels
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['locallangXMLOverride']
            ['EXT:frontend/Resources/Private/Language/locallang_tca.xlf'][] =
        'EXT:examples/Resources/Private/Language/custom.xlf';
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['locallangXMLOverride']['de']
            ['EXT:frontend/Resources/Private/Language/locallang_tca.xlf'][] =
        'EXT:examples/Resources/Private/Language/de.custom.xlf';
})();
