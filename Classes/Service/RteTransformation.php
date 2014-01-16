<?php
namespace Documentation\Examples\Service;

/***************************************************************
*  Copyright notice
*
*  (c) 2013 Francois Suter <francois@typo3.org>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * This class performs RTE transformations
 *
 * @author Francois Suter <francois@typo3.org>
 * @package TYPO3
 * @subpackage tx_examples
 */
class RteTransformation {
	/**
	 * NOTE: must be public as it is accessed by \TYPO3\CMS\Core\Html\RteHtmlParser without API
	 *
	 * @var \TYPO3\CMS\Core\Html\RteHtmlParser
	 */
	public $pObj;

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
	protected function loadConfiguration() {
		$this->configuration = $this->pObj->procOptions['usertrans.'][$this->transformationKey . '.'];
	}

	/**
	 * Transforms RTE content prior to database storage
	 *
	 * @param string $value RTE HTML to clean for database storage
	 * @return string
	 */
	public function transform_db($value) {
		$this->loadConfiguration();

		if ($this->configuration['addHrulerInRTE'])    {
			$value = preg_replace('/<hr[[:space:]]*[\/]>[[:space:]]*$/i', '', $value);
		}

		return $value;
	}

	/**
	 * Transforms database content for RTE display
	 *
	 * @param string $value Database content to transform into RTE-ready HTML
	 * @return string
	 */
	public function transform_rte($value) {
		$this->loadConfiguration();

		if ($this->configuration['addHrulerInRTE'])    {
			$value .= '<hr/>';
		}

		return $value;
	}
}
?>
