<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Visol.' . $_EXTKEY,
	'Conversion',
	array(
		'Conversion' => 'index,conversionResult',

	),
	array(
		'Conversion' => 'conversionResult'
	)
);