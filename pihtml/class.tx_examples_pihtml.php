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
class tx_examples_pihtml extends \TYPO3\CMS\Frontend\Plugin\AbstractPlugin {

	/**
	 * Same as class name
	 *
	 * @var string
	 */
	public $prefixId = 'tx_examples_pihtml';

	/**
	 * Path to this script relative to the extension dir.
	 *
	 * @var string
	 */
	public $scriptRelPath = 'pierror/class.tx_examples_pihtml.php';

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
		$testHTML = '
			<DIV>
				<IMG src="welcome.gif">
				<p>Line 1</p>
				<p>Line <B class="test">2</B></p>
				<p>Line <b><i>3</i></p>
				<img src="test.gif" />
				<BR><br/>
				<TABLE>
					<tr>
						<td>Another line here</td>
					</tr>
				</TABLE>
			</div>
			<B>Text outside div tag</B>
			<table>
				<tr>
					<td>Another line here</td>
				</tr>
			</table>
		';

		// Splitting HTML into blocks defined by <div> and <table> block tags
		$parseObj = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Html\\HtmlParser');
		$result = $parseObj->splitIntoBlock('div,table', $testHTML);

		$content = '<h2>Splitting by &lt;div&gt; and &lt;table&gt; tags</h2>';
		$content .= \TYPO3\CMS\Core\Utility\DebugUtility::viewArray($result);

		// Splitting HTML into blocks defined by <img> and <br> single tags
		$result = $parseObj->splitTags('img,br', $testHTML);
		$content .= '<h2>Extracting &lt;img&gt; and &lt;br&gt; tags</h2>';
		$content .= \TYPO3\CMS\Core\Utility\DebugUtility::viewArray($result);

		// Cleaning HTML
		$tagCfg = array(
			'b' => array(
				'nesting' => 1,
				'remap' => 'strong',
				'allowedAttribs' => 0
			),
			'img' => array(),
			'div' => array(),
			'br' => array(),
			'p' => array(
				'fixAttrib' => array(
					'class' => array(
						'set' => 'bodytext'
					)
				)
			)
		);
		$result = $parseObj->HTMLcleaner(
			$testHTML,
			$tagCfg,
			FALSE,
			FALSE,
			array('xhtml' => 1)
		);
		$content .= '<h2>Cleaning to XHTML, removing non-allowed tags and attributes</h2>';
		$content .= \TYPO3\CMS\Core\Utility\DebugUtility::viewArray($result);

		return $content;
	}
}
