id URL to Speaking URL
======================

A TYPO3 CMS 6.2+ extension that helps converting id URLs to speaking URLs. This is useful when a website that had no speaking URLs before is switching to URL rewriting (RealURL, CoolURI) and the results in search engines should be rewritten.

Example
-------
    http://www.mydomain.tld/id=3
    http://www.mydomain.tld/index.php?id=33

will be converted to

    http://www.mydomain.tld/foo
    http://www.mydomain.tld/bar
    
The extension can output plain target URLs or rewrites in Nginx and Apache format.

Usage
-----

* Install the extension
* If you have a multi-domain website, make sure that `config.typolinkEnableLinksAcrossDomains = 1` is set.
* Place the plugin "Convert id URLs to Speaking URLs" on a page (can be hidden in menus).
* Paste a list of links (separated by new line) to the text area and select the target format.
* Click convert and use the target URLs.
* When you're done, remove the plugin and extension.

Found a bug? Want to improve the extension?
===========================================

Pull requests are very welcome!