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

import LinkBrowser
	from "@typo3/backend/link-browser.js";

/**
 * Module: @t3docs/examples/github_link_handler.js
 * Github issue link interaction
 */

class GitHubLinkHandler {
	constructor() {
		var form_el = document.getElementById("lgithubform");
		form_el.addEventListener("submit", function(event) {
			event.preventDefault();
			var value = document.getElementById('lgithub').value;
			if (value === 't3://github?issue=') {
				return;
			}
			if (value.indexOf('t3://github?issue=') === 0) {
				value = value.substring(18);
			}
			LinkBrowser.finalizeFunction('t3://github?issue=' + value);
		});
	}
}

export default new GitHubLinkHandler();
