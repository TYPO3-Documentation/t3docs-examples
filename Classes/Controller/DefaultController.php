<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Francois Suter (typo3@cobweb.ch)
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
class Tx_Examples_Controller_DefaultController extends Tx_Extbase_MVC_Controller_ActionController {

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
			t3lib_FlashMessage::NOTICE
		);
		$this->flashMessageContainer->add(
			'This is an information message',
			'Information',
			t3lib_FlashMessage::INFO
		);
		$this->flashMessageContainer->add(
			'This is a success message',
			'Hooray!',
			t3lib_FlashMessage::OK
		);
		$this->flashMessageContainer->add(
			'This is a warning message',
			'Watch out',
			t3lib_FlashMessage::WARNING
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
			t3lib_FlashMessage::ERROR
		);
	}
}
?>