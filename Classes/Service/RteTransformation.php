<?php
namespace Documentation\Examples\Service;

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
 * This class performs RTE transformations
 *
 * @author Francois Suter <francois@typo3.org>
 * @package TYPO3
 * @subpackage tx_examples
 */
class RteTransformation
{
    /**
     * NOTE: must be public as it is accessed by \TYPO3\CMS\Core\Html\RteHtmlParser without API
     *
     * @var \TYPO3\CMS\Core\Html\RteHtmlParser
     */
    public $htmlParser;

    /**
     * NOTE: must be public as it is accessed by \TYPO3\CMS\Core\Html\RteHtmlParser without API
     *
     * @var string
     */
    public $transformationKey = 'tx_examples_transformation';

    /**
     * @var array
     */
    protected $configuration;

    /**
     * Loads the transformation's configuration
     *
     * @return void
     */
    protected function loadConfiguration()
    {
        $this->configuration = $this->htmlParser->procOptions['usertrans.'][$this->transformationKey . '.'];
    }

    /**
     * Transforms RTE content prior to database storage.
     *
     * @param string $value RTE HTML to clean for database storage
     * @return string
     */
    public function transform_db($value)
    {
        $this->loadConfiguration();

        // Remove the "artificially" added ruler before saving to the database
        if ($this->configuration['addHrulerInRTE']) {
            $value = preg_replace('/<hr[[:space:]]*[\/]>[[:space:]]*$/i', '', $value);
        }

        return $value;
    }

    /**
     * Transforms database content for RTE display.
     *
     * @param string $value Database content to transform into RTE-ready HTML
     * @return string
     */
    public function transform_rte($value)
    {
        $this->loadConfiguration();

        // Adds a ruler at the bottom of the RTE content
        if ($this->configuration['addHrulerInRTE']) {
            $value .= '<hr/>';
        }

        return $value;
    }
}
