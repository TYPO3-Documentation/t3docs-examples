<?php

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

namespace T3docs\Examples\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Class FalExampleController
 */
class FalExampleController extends ActionController
{
    protected ResourceFactory $resourceFactory;

    public function injectResourceFactory(ResourceFactory $resourceFactory)
    {
        $this->resourceFactory = $resourceFactory;
    }

    /**
     * Displays a list of links to the other actions.
     */
    public function indexAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * Displays a list of files for a chosen storage and folder.
     */
    public function listFilesAction(): ResponseInterface
    {
        $defaultStorage = $this->resourceFactory->getDefaultStorage();
        if ($defaultStorage) {
            $folder = $defaultStorage->getFolder('/user_upload/images/galerie/');
            $files = $defaultStorage->getFilesInFolder($folder);
            $this->view->assignMultiple(
                [
                    'folder' => $folder,
                    'files' => $files,
                ],
            );
        }
        return $this->htmlResponse();
    }

    /**
     * Displays a list of files from a chosen collection
     */
    public function collectionAction(): ResponseInterface
    {
        $collection = $this->resourceFactory->getCollectionObject(1);
        if ($collection) {
            $collection->loadContents();
            $this->view->assignMultiple(
                [
                    'collection' => $collection,
                    'files' => $collection->getItems(),
                ],
            );
        }
        return $this->htmlResponse();
    }
}
