<?php
namespace Documentation\Examples\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Documentation Team <documentation@typo3.org>
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
 * Frontend plugin for demonstrating collections
 *
 * @author		Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package		TYPO3
 * @subpackage	tx_examples
 *
 * $Id: DefaultController.php 74771 2013-04-24 10:01:29Z francois $
 */
class CollectionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
	/**
	 * @var \TYPO3\CMS\Core\Collection\RecordCollectionRepository
	 * @inject
	 */
	protected $collectionRepository;

	/**
	 * Renders the list of all existing collections and their content
	 *
	 * @return void
	 */
	public function indexAction() {
		// Get all existing collections
		/** @var \TYPO3\CMS\Core\Collection\AbstractRecordCollection $collections */
		$collections = $this->collectionRepository->findAll();

		// Load the records in each collection
		/** @var \TYPO3\CMS\Core\Collection\StaticRecordCollection $aCollection */
		foreach ($collections as $aCollection) {
			$aCollection->loadContents();
		}

		// Assign the "loaded" collections to the view
		$this->view->assign('collections', $collections);
	}
}
?>