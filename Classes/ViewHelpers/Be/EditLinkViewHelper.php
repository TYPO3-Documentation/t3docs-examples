<?php
namespace T3docs\Examples\ViewHelpers\Be;

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
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This class generates links to edit records or create new ones
 *
 * = Examples =
 *
 * <code title="Default">
 * <Ex:be.editLink parameters="edit[pages][1]=edit" title="Edit page" />
 * </code>
 * <output>
 * <a title="Edit page" href="alt_doc.php?edit[pages][1]=edit">...</a>
 * </output>
 *
 * @author Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package TYPO3
 * @subpackage tx_examples
 */
class EditLinkViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper
{

    /**
     * @var string
     */
    protected $tagName = 'a';

    /**
     * Initialize arguments
     *
     * @return void
     * @api
     */
    public function initializeArguments()
    {
        $this->registerUniversalTagAttributes();
        $this->registerTagAttribute('name', 'string', 'Specifies the name of an anchor');
        $this->registerTagAttribute('target', 'string', 'Specifies where to open the linked document');
    }

    /**
     * Crafts a link to edit a database record or create a new one
     *
     * @param string $action Action to perform (new, edit)
     * @param string $table Name of the related table
     * @param int $uid Id of the record to edit
     * @param string $columnsOnly Comma-separated list of fields to restrict editing to
     * @param array $defaultValues List of default values for some fields (key-value pairs)
     * @param string $returnUrl URL to return to
     * @return string The <a> tag
     * @see \TYPO3\CMS\Backend\Utility::editOnClick()
     */
    public function render($action, $table, $uid, $columnsOnly = '', $defaultValues = [], $returnUrl = '')
    {

        // Edit all icon:
        $urlParameters = [
            'edit' => [
                $table => [
                    $uid => $action,
                ],
            ],
            'columnsOnly' => $columnsOnly,
            'createExtension' => 0,
            'returnUrl' => GeneralUtility::getIndpEnv('REQUEST_URI'),
        ];
        if (count($defaultValues) > 0) {
            $urlParameters['defVals'] = $defaultValues;
        }
        $uri = BackendUtility::getModuleUrl('record_edit', $urlParameters);

        $this->tag->addAttribute('href', $uri);
        $this->tag->setContent($this->renderChildren());
        $this->tag->forceClosingTag(true);
        return $this->tag->render();
    }
}

