<?php
namespace Documentation\Examples\ViewHelpers\Be;

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
class EditLinkViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper {

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
	public function initializeArguments() {
		$this->registerUniversalTagAttributes();
		$this->registerTagAttribute('name', 'string', 'Specifies the name of an anchor');
		$this->registerTagAttribute('target', 'string', 'Specifies where to open the linked document');
	}

	/**
	 * Crafts a link to edit a database record or create a new one
	 *
	 * @param string $parameters Query string parameters
	 * @param string $returnUrl URL to return to
	 * @return string The <a> tag
	 * @see \TYPO3\CMS\Backend\Utility::editOnClick()
	 */
	public function render($parameters, $returnUrl = '') {
		$uri = 'alt_doc.php?' . $parameters;
		if (!empty($returnUrl)) {
			$uri .= '&returnUrl=' . rawurlencode($returnUrl);
		}

		$this->tag->addAttribute('href', $uri);
		$this->tag->setContent($this->renderChildren());
		$this->tag->forceClosingTag(TRUE);
		return $this->tag->render();
	}
}

