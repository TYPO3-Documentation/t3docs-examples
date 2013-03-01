<?php
namespace TYPO3\Examples\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012-2013 Documentation Team <documentation@typo3.org>
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
class DefaultController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * Renders the list of all possible flash messages
	 *
	 * @return void
	 */
	public function flashAction() {
			// Issue one of each type of flash messages
		$this->flashMessageContainer->add(
			'This is a notice message',
			'Notification',
			\TYPO3\CMS\Core\Messaging\FlashMessage::NOTICE
		);
		$this->flashMessageContainer->add(
			'This is an information message',
			'Information',
			\TYPO3\CMS\Core\Messaging\FlashMessage::INFO
		);
		$this->flashMessageContainer->add(
			'This is a success message',
			'Hooray!',
			\TYPO3\CMS\Core\Messaging\FlashMessage::OK
		);
		$this->flashMessageContainer->add(
			'This is a warning message',
			'Watch out',
			\TYPO3\CMS\Core\Messaging\FlashMessage::WARNING
		);
		$this->flashMessageContainer->add(
			'
				<p>This is an error message</p>
				<ul>
					<li>It\'s inside a div</li>
					<li>so it can contain</li>
					<li>pretty much <strong>any markup</strong></li>
				</ul>
			',
			'Whoops!',
			\TYPO3\CMS\Core\Messaging\FlashMessage::ERROR
		);
	}
}
?>