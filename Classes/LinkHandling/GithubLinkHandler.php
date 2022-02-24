<?php

declare(strict_types=1);

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

namespace T3docs\Examples\LinkHandling;

use TYPO3\CMS\Core\LinkHandling\LinkHandlingInterface;

/**
 * Resolves links to pages and the parameters given
 */
class GithubLinkHandler implements LinkHandlingInterface
{
    
    /**
     * The Base URN for this link handling to act on
     * @var string
     */
    protected $baseUrn = 'github:';
    
    /**
     * Returns all valid parameters for linking to a TYPO3 page as a string
     *
     * @param array $parameters
     * @return string
     */
    public function asString(array $parameters): string
    {
        
       
        return $this->baseUrn.$parameters['github'];
    }
    
    /**
     * Returns all relevant information built in the link to a page (see asString())
     *
     * @param array $data
     * @return array
     */
    public function resolveHandlerData(array $data): array
    {
       
        if (stripos($data['urn'], $this->baseUrn) === 0){
            
            $result = [
                'type' => substr($this->baseUrn,0,-1),
                substr($this->baseUrn,0,-1) => substr($data['urn'], strlen($this->baseUrn))];
            
            $data['result'] = $result;
        }
        return $result ?? [];
    }


}