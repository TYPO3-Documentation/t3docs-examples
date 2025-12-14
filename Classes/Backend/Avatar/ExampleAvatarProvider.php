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

namespace T3docs\Examples\Backend\Avatar;

use TYPO3\CMS\Backend\Attribute\AsAvatarProvider;
use TYPO3\CMS\Backend\Backend\Avatar\AvatarProviderInterface;
use TYPO3\CMS\Backend\Backend\Avatar\Image;
use TYPO3\CMS\Core\Utility\GeneralUtility;

#[AsAvatarProvider('exampleAvatarProvider')]
class ExampleAvatarProvider implements AvatarProviderInterface
{
    /**
     * Returns an Image object, prepared for output, based on a given be_users record
     *
     * @param array<string, scalar> $backendUser be_users record
     * @param int $size
     */
    public function getImage(array $backendUser, $size): ?Image
    {
        return GeneralUtility::makeInstance(
            Image::class,
            '/typo3conf/ext/examples/Resources/Public/Icons/Extension.png',
            20,
            20,
        );
    }
}
