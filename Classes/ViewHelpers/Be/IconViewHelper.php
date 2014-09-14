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
 * This class renders icons according to the BE sprite
 *
 * = Examples =
 *
 * <code title="Default">
 * <Ex:be.icon icon="actions-document-open" title="Open document" />
 * </code>
 * <output>
 * <span title="Open document" class="t3-icon t3-icon-actions t3-icon-actions-document t3-icon-document-open">&nbsp;</span>
 * </output>
 *
 * @author Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package TYPO3
 * @subpackage tx_examples
 */
class IconViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Be\AbstractBackendViewHelper {

	/**
	 * Renders an icon based on the TYPO3 backend sprite
	 *
	 * @param string $icon Icon to be used
	 * @param string $title Image title
	 * @return string The rendered icon
	 */
	public function render($icon, $title = '') {
		return \TYPO3\CMS\Backend\Utility\IconUtility::getSpriteIcon(
			$icon,
			array('title' => $title)
		);
	}
}

