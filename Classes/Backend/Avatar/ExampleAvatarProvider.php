<?php

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
     * @param array $backendUser be_users record
     * @param int $size
     * @return Image|null
     */
    public function getImage(array $backendUser, $size) {
        return GeneralUtility::makeInstance(
            Image::class,
            '/typo3conf/ext/examples/Resources/Public/Icons/Extension.png',20,20
        );
    }
}
