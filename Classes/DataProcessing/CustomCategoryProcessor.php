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

namespace T3docs\Examples\DataProcessing;

use T3docs\Examples\Domain\Repository\CategoryRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * Class for data processing comma separated categories
 */
class CustomCategoryProcessor implements DataProcessorInterface
{
    /**
     * Process data for the content element "My new content element"
     *
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     * @return array the processed data as key/value store
     */
    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData,
    ) {
        if (isset($processorConfiguration['if.']) && !$cObj->checkIf($processorConfiguration['if.'])) {
            return $processedData;
        }
        // categories by comma separated list
        $categoryIdList = $cObj->stdWrapValue('categoryList', $processorConfiguration);
        $categories = [];
        if ($categoryIdList) {
            $categoryIdList = GeneralUtility::intExplode(',', (string)$categoryIdList, true);
            /** @var CategoryRepository $categoryRepository */
            $categoryRepository = GeneralUtility::makeInstance(CategoryRepository::class);
            foreach ($categoryIdList as $categoryId) {
                $categories[] = $categoryRepository->findByUid($categoryId);
            }
            // set the categories into a variable, default "categories"
            $targetVariableName = $cObj->stdWrapValue('as', $processorConfiguration, 'categories');
            $processedData[$targetVariableName] = $categories;
        }
        return $processedData;
    }
}
