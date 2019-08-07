<?php
namespace T3docs\Examples\Controller;

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

use TYPO3\CMS\Core\Html\HtmlParser;
use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Frontend plugin for demonstrating the HTML parser.
 *
 * @author Francois Suter (Cobweb) <francois.suter@typo3.org>
 * @package TYPO3
 * @subpackage tx_examples
 */
class HtmlParserController extends ActionController
{

    /**
     * Parses some HTML using TYPO3's HTML parser and sends the result to debug output.
     *
     * @return void
     */
    public function indexAction()
    {
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
        /** @var HtmlParser $parseObj */
        $parseObj = GeneralUtility::makeInstance(HtmlParser::class);
        $this->view->assign(
            'result1',
            $parseObj->splitIntoBlock('div,table', $testHTML)
        );

        // Splitting HTML into blocks defined by <img> and <br> single tags
        $this->view->assign(
            'result2',
            $parseObj->splitTags('img,br', $testHTML)
        );

        // Cleaning HTML
        $tagCfg = [
            'b' => [
                'nesting' => 1,
                'remap' => 'strong',
                'allowedAttribs' => 0,
            ],
            'img' => [],
            'div' => [],
            'br' => [],
            'p' => [
                'fixAttrib' => [
                    'class' => [
                        'set' => 'bodytext',
                    ],
                ],
            ],
        ];
        $this->view->assign(
            'result3',
            $result = $parseObj->HTMLcleaner(
                $testHTML,
                $tagCfg,
                false,
                false,
                ['xhtml' => 1]
            )
        );
    }
}
