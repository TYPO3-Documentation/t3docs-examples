<?php
namespace Documentation\Examples\Controller;

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
 * Frontend plugin for demonstrating collections
 *
 * @author Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package TYPO3
 * @subpackage tx_examples
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
