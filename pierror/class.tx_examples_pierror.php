<?php
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
 * Controller for the backend module
 *
 * @author Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package TYPO3
 * @subpackage tx_examples
 */
class tx_examples_pierror extends \TYPO3\CMS\Frontend\Plugin\AbstractPlugin {

	/**
	 * Same as class name
	 *
	 * @var string
	 */
	public $prefixId = 'tx_examples_pierror';

	/**
	 * Path to this script relative to the extension dir.
	 *
	 * @var string
	 */
	public $scriptRelPath = 'pierror/class.tx_examples_pierror.php';

	/**
	 * The extension key.
	 *
	 * @var string
	 */
	public $extKey = 'examples';

	/**
	 * @var bool
	 */
	public $pi_checkCHash = TRUE;

	/**
	 * This is the main method of the plugin. It returns the content to display
	 *
	 * @param string $content The plugin content
	 * @param array $conf The plugin configuration
	 * @throws Exception
	 * @return string The content that is displayed on the website
	 */
	public function main($content, $conf) {
		throw new \Exception('This is a test Exception', 1360332631);
	}
}
