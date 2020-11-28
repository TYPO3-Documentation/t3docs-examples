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
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Backend\Routing\UriBuilder;

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
        $this->registerArgument('table', 'string', 'The table to be edited');
        $this->registerArgument('uid', 'integer', 'The uid of the record to be edited');
        $this->registerArgument('action', 'string', 'The action to be executed');
        $this->registerArgument('columnsOnly', 'string', 'Only edit these columns');
        $this->registerArgument('defaultValues', 'array', 'The default values');
    }

    /**
     * Crafts a link to edit a database record or create a new one
     *
     * @return string The <a> tag
     * @see \TYPO3\CMS\Backend\Utility::editOnClick()
     */
    public function render()
    {
        /** @var UriBuilder $uriBuilder */
        $uriBuilder = GeneralUtility::makeInstance(UriBuilder::class);

        // Edit all icon:
        $uriParameters = [
            'edit' => [
                $this->arguments['table'] => [
                    $this->arguments['uid'] => $this->arguments['action'],
                ],
            ],
            'columnsOnly' => $this->arguments['columnsOnly'],
            'createExtension' => 0,
            'returnUrl' => GeneralUtility::getIndpEnv('REQUEST_URI'),
        ];
        $defaultValues = $this->arguments['defaultValues'];
        if (is_array($defaultValues) && count($defaultValues) > 0) {
            $uriParameters['defVals'] = $defaultValues;
        }
        $uri = $uriBuilder->buildUriFromRoute('record_edit', $uriParameters);

        $this->tag->addAttribute('href', $uri);
        $this->tag->setContent($this->renderChildren());
        $this->tag->forceClosingTag(true);
        return $this->tag->render();
    }
}

