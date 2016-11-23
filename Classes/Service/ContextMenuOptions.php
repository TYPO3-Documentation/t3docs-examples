<?php
namespace Documentation\Examples\Service;

/**
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

use TYPO3\CMS\Backend\ClickMenu\ClickMenu;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class for declaring a new context menu item.
 *
 * @author Francois Suter <francois@typo3.org>
 * @package TYPO3
 * @subpackage tx_examples
 */
class ContextMenuOptions
{

    /**
     * Adds a sample item to the CSM.
     *
     * @param ClickMenu $parentObject Back-reference to the calling object
     * @param array $menuItems Current list of menu items
     * @param string $table Name of the table the clicked on item belongs to
     * @param integer $uid Id of the clicked on item
     *
     * @return array Modified list of menu items
     */
    public function main(ClickMenu $parentObject, $menuItems, $table, $uid)
    {
        // Activate the menu item only for "pages" table
        if ($table === 'pages') {
            // URL for the menu item. Point to the page tree example module, passing the page id.
            $baseUrl = BackendUtility::getModuleUrl(
                    'tools_ExamplesExamples',
                    array(
                            'tx_examples_tools_examplesexamples[action]' => 'tree',
                            'tx_examples_tools_examplesexamples[controller]' => 'Module',
                            'tx_examples_tools_examplesexamples[page]' => $uid
                    )
            );

            // Add new menu item with the following parameters:
            // 1) Label
            // 2) Icon
            // 3) URL
            // 4) = 1 disable item in docheader
            $iconFactory = GeneralUtility::makeInstance(IconFactory::class);
            $menuItems[] = $parentObject->linkItem(
                    $GLOBALS['LANG']->sL('LLL:EXT:examples/Resources/Private/Language/locallang.xml:csm_view_page'),
                    $iconFactory->getIcon(
                            'tx_examples-page-tree',
                            Icon::SIZE_SMALL
                    ),
                    $parentObject->urlRefForCM($baseUrl),
                    1
            );
        }
        return $menuItems;
    }
}
