<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

if (TYPO3_MODE === 'BE') {

	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
		$_EXTKEY,
		'Conversion',
		'Convert id URLs to Speaking URLs',
		'EXT:idurl2speakingurl/ext_icon.gif'
	);

}
