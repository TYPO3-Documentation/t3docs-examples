<?php
namespace T3docs\Examples\Controller;

/*
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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Class FalExampleController
 *
 * @package T3docs\Examples\Controller
 */
class FalExampleController extends ActionController
{
    /**
     * Displays a list of links to the other actions.
     *
     * @return void
     */
    public function indexAction()
    {

    }

    /**
     * Displays a list of files for a chosen storage and folder.
     *
     * @return void
     */
    public function listFilesAction()
    {
        /** @var \TYPO3\CMS\Core\Resource\ResourceFactory $resourceFactory */
        $resourceFactory = GeneralUtility::makeInstance(ResourceFactory::class);
        $defaultStorage = $resourceFactory->getDefaultStorage();
        if ($defaultStorage) {
            $folder = $defaultStorage->getFolder('/user_upload/images/galerie/');
            $files = $defaultStorage->getFilesInFolder($folder);
            $this->view->assignMultiple(
                [
                    'folder' => $folder,
                    'files' => $files,
                ]
            );
        }
    }

    /**
     * Displays a list of files from a chosen collection.
     *
     * @return void
     */
    public function collectionAction()
    {
        /** @var \TYPO3\CMS\Core\Resource\ResourceFactory $resourceFactory */
        $resourceFactory = GeneralUtility::makeInstance(ResourceFactory::class);
        $collection = $resourceFactory->getCollectionObject(1);
        if ($collection) {
            $collection->loadContents();
            $this->view->assignMultiple(
                [
                    'collection' => $collection,
                    'files' => $collection->getItems(),
                ]
            );
        }
    }
}
