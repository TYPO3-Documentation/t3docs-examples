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

$EM_CONF[$_EXTKEY] = [
    'title' => 'Core Documentation Code Examples',
    'description' => 'This extension packages a number of code examples from the Core Documentation.',
    'category' => 'misc',
    'author' => 'Documentation Team',
    'author_email' => 'documentation@typo3.org',
    'state' => 'stable',
    'author_company' => '',
    'version' => '12.0.8',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-12.4.99',
            'extbase' => '12.4.0-12.4.99',
            'fluid' => '12.4.0-12.4.99',
            'fluid_styled_content' => '12.4.0-12.4.99',
            'impexp' => '12.4.0-12.4.99',
            'linkvalidator' => '12.4.0-12.4.99',
            'reactions' => '12.4.0-12.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
