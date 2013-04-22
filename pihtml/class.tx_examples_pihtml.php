<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Documentation Team <documentation@typo3.org>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  A copy is found in the textfile GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Controller for the backend module
 *
 * @author		Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package		TYPO3
 * @subpackage	tx_examples
 *
 * $Id$
 */
class tx_examples_pihtml extends \TYPO3\CMS\Frontend\Plugin\AbstractPlugin {
	var $prefixId      = 'tx_examples_pihtml';		// Same as class name
	var $scriptRelPath = 'pierror/class.tx_examples_pihtml.php';	// Path to this script relative to the extension dir.
	var $extKey        = 'examples';	// The extension key.
	var $pi_checkCHash = true;

	/**
	 * This is the main method of the plugin. It returns the content to display
	 *
	 * @param    string        $content: The plugin content
	 * @param    array        $conf: The plugin configuration
	 * @throws Exception
	 * @return    string        The content that is displayed on the website
	 */
	function main($content, $conf) {
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
?>