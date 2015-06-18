<?php
namespace Visol\Idurl2speakingurl\Controller;
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

use TYPO3\CMS\Core\Utility\GeneralUtility;

class ConversionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController  {

	public function indexAction() {	}

	/**
	 * Performs the conversion and returns the converted URLs
	 *
	 * @param string $urlList
	 * @param integer $targetFormat
	 */
	public function conversionResultAction($urlList, $targetFormat = 0) {
		if (!empty($urlList)) {
			$speakingUrls = array();
			$errors = array();
			$urls = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(PHP_EOL, $urlList);
			$i = 0;
			foreach ($urls as $url) {
				$parsedUrl = parse_url($url);
				$relativeSource = '';
				if (is_array($parsedUrl)) {
					$schemeAndHostWithTrailingSlash = $parsedUrl['scheme'] . '://' . $parsedUrl['host'] . '/';
					$relativeSource = str_replace($schemeAndHostWithTrailingSlash, '', $url);
				}
				$queryParts = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode('&', $parsedUrl['query']);
				$targetPageUid = 0;
				$arguments = array();
				foreach ($queryParts as $queryPart) {
					if (GeneralUtility::isFirstPartOfStr($queryPart, 'id=')) {
						// Page UID
						$targetPageUid = substr($queryPart, 3);
					} elseif (GeneralUtility::isFirstPartOfStr($queryPart, 'MP=')) {
						// Mountpoint
						$mountPointVar = substr($queryPart, 3);
						$arguments['MP'] = $mountPointVar;
					} elseif (GeneralUtility::isFirstPartOfStr($queryPart, 'L=')) {
						// Language
						$languageVar = substr($queryPart, 2);
						$arguments['L'] = $languageVar;
					}
				}

				if ($targetPageUid > 0) {
					$uriBuilder = $this->uriBuilder->reset()->setCreateAbsoluteUri(TRUE);
					$uriBuilder->setTargetPageUid($targetPageUid);
					if (!empty($arguments)) {
						$uriBuilder->setArguments($arguments);
					}
					$targetUrl = $uriBuilder->build();
					if (!empty($targetUrl)) {
						$speakingUrls[$i]['relativeSource'] = $relativeSource;
						$speakingUrls[$i]['target'] = $targetUrl;
					} else {
						// No URL could be generated
						$errors[] = $url;
					}
				} else {
					continue;
				}

				$i++;
			}
			$this->view->assign('speakingUrls', $speakingUrls);
			$this->view->assign('targetFormat', $targetFormat);
			$this->view->assign('errors', $errors);
		}
	}

}
