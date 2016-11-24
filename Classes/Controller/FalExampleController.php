<?php
namespace Documentation\Examples\Controller;

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

use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Class FalExampleController
 *
 * @package Documentation\Examples\Controller
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
        $resourceFactory = ResourceFactory::getInstance();
        $defaultStorage = $resourceFactory->getDefaultStorage();
        $folder = $defaultStorage->getFolder('/user_upload/images/galerie/');
        $files = $defaultStorage->getFilesInFolder($folder);
        $this->view->assignMultiple(
            [
                'folder' => $folder,
                'files' => $files,
            ]
        );
    }

    /**
     * Displays a list of files from a chosen collection.
     *
     * @return void
     */
    public function collectionAction()
    {
        $resourceFactory = ResourceFactory::getInstance();
        $collection = $resourceFactory->getCollectionObject(1);
        /** @var \TYPO3\CMS\Core\Resource\Collection\AbstractFileCollection $files */
        $collection->loadContents();
        $this->view->assignMultiple(
            [
                'collection' => $collection,
                'files' => $collection->getItems(),
            ]
        );
    }
}
