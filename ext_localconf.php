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

use T3docs\Examples\Controller\ErrorController;
use T3docs\Examples\Controller\FalExampleController;
use T3docs\Examples\Controller\HtmlParserController;
use T3docs\Examples\Form\Element\SpecialFieldElement;
use T3docs\Examples\LinkHandler\GithubLinkBuilder;
use T3docs\Examples\LinkHandler\GitHubLinkHandling;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Log\LogLevel;
use TYPO3\CMS\Core\Log\Processor\MemoryUsageProcessor;
use TYPO3\CMS\Core\Log\Writer\DatabaseWriter;
use TYPO3\CMS\Core\Log\Writer\FileWriter;
use TYPO3\CMS\Core\Log\Writer\SyslogWriter;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

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

defined('TYPO3') or die();

// encapsulate all locally defined variables
(function () {
    // Load XCLASSing of db_new
    // USAGE: Core APIs > TYPO3 API overview > PHP Class Extension > Which classes? > Example - Adding a small feature in the interface
    /*
    // Disabled, @see #60
    // @TODO: 1) find new case for an xclass, 2) remove old xclass, 3) add new xclass
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\TYPO3\CMS\Backend\Controller\NewRecordController::class] = [
        'className' => \T3docs\Examples\Xclass\NewRecordController::class,
    ];
    */

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
        'class' => SpecialFieldElement::class,
    ];

    $GLOBALS['TYPO3_CONF_VARS']['FE']['typolinkBuilder']['github'] =
        GithubLinkBuilder::class;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['linkHandler']['github'] =
        GitHubLinkHandling::class;

    // Add example configuration for the logging API
    $GLOBALS['TYPO3_CONF_VARS']['LOG']['T3docs']['Examples']['Controller']['writerConfiguration'] = [
        // configuration for ERROR level log entries
        LogLevel::ERROR => [
            // add a FileWriter
            FileWriter::class => [
                // configuration for the writer
                'logFile' => Environment::getVarPath() . '/log/typo3_examples.log',
            ],
        ],
    ];

    $GLOBALS['TYPO3_CONF_VARS']['LOG']['T3docs']['Examples']['Controller']['writerConfiguration'][LogLevel::DEBUG] = [
        DatabaseWriter::class => [
            'logTable' => 'tx_examples_log',
        ],
    ];

    $GLOBALS['TYPO3_CONF_VARS']['LOG']['T3docs']['Examples']['Controller']['writerConfiguration'][LogLevel::WARNING] = [
        // configuration for WARNING severity, including all
        // levels with higher severity (ERROR, CRITICAL, EMERGENCY)
        // add a SyslogWriter
        SyslogWriter::class => [],
    ];
    $GLOBALS['TYPO3_CONF_VARS']['LOG']['T3docs']['Examples']['Controller']['processorConfiguration'] = [
        // configuration for ERROR level log entries
        LogLevel::ERROR => [
            // add a MemoryUsageProcessor
            MemoryUsageProcessor::class => [
                'formatSize' => true,
            ],
        ],
    ];

    // Register the "error " plugin
    ExtensionUtility::configurePlugin(
        'Examples',
        'Error',
        [
            ErrorController::class => 'index',
        ],
        [
            ErrorController::class => 'index',
        ],
        ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT,
    );

    // Configure the HTML parser plugin
    ExtensionUtility::configurePlugin(
        'Examples',
        'HtmlParser',
        [
            HtmlParserController::class => 'index',
        ],
        [],
        ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT,
    );

    // Register the FAL examples plugin
    ExtensionUtility::configurePlugin(
        'Examples',
        'FalExamples',
        [
            FalExampleController::class => 'index,listFiles,collection',
        ],
        // non-cacheable actions
        [
            FalExampleController::class => 'index,listFiles,collection',
        ],
        ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT,
    );

    // Add custom translations overriding default labels
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['locallangXMLOverride']
            ['EXT:frontend/Resources/Private/Language/locallang_tca.xlf'][] =
        'EXT:examples/Resources/Private/Language/custom.xlf';
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['locallangXMLOverride']['de']
            ['EXT:frontend/Resources/Private/Language/locallang_tca.xlf'][] =
        'EXT:examples/Resources/Private/Language/de.custom.xlf';
})();
