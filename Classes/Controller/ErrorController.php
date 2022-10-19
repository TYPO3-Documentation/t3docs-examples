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
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Frontend plugin for demonstrating collections
 *
 * @author Francois Suter (Cobweb) <typo3@cobweb.ch>
 */
class ErrorController extends ActionController
{
    /**
     * Throws an exception (to demonstrate Core error handling).
     *
     * @throws \Exception
     */
    public function indexAction(): ResponseInterface
    {
        throw new \Exception('This is a test Exception', 1479561148);
    }
}
