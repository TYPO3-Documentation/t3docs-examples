<?php
namespace Documentation\Examples\ViewHelpers\Be;

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
 * @author		Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package		TYPO3
 * @subpackage	tx_examples
 *
 * $Id$
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

?>