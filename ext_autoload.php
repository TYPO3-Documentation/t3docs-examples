<?php
/*
 * Register necessary class names with autoloader
 */
$extensionPath = t3lib_extMgm::extPath('examples');
return array(
	'tx_examples_tca' => $extensionPath . 'class.tx_examples_tca.php',
);
?>
