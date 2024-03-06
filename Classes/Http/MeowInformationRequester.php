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

namespace T3docs\Examples\Http;

use TYPO3\CMS\Core\Http\RequestFactory;

final readonly class MeowInformationRequester
{
    private const API_URL = 'https://catfact.ninja/fact';

    // We need the RequestFactory for creating and sending a request,
    // so we inject it into the class using constructor injection.
    public function __construct(
        private RequestFactory $requestFactory,
    ) {}

    /**
     * @throws \JsonException
     * @throws \RuntimeException
     */
    public function request(): string
    {
        // Additional headers for this specific request
        // See: https://docs.guzzlephp.org/en/stable/request-options.html
        $additionalOptions = [
            'headers' => ['Cache-Control' => 'no-cache'],
            'allow_redirects' => false,
        ];

        // Get a PSR-7-compliant response object
        $response = $this->requestFactory->request(
            self::API_URL,
            'GET',
            $additionalOptions,
        );

        if ($response->getStatusCode() !== 200) {
            throw new \RuntimeException(
                'Returned status code is ' . $response->getStatusCode(),
            );
        }

        if ($response->getHeaderLine('Content-Type') !== 'application/json') {
            throw new \RuntimeException(
                'The request did not return JSON data',
            );
        }
        // Get the content as a string on a successful request
        $content = $response->getBody()->getContents();
        return (string)json_decode($content, true, flags: JSON_THROW_ON_ERROR)['fact'] ??
            throw new \RuntimeException('The service returned an unexpected format.', 1666413230);
    }
}
