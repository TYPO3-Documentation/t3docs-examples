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
import LinkBrowser from "@typo3/backend/link-browser.js";
import RegularEvent from "@typo3/core/event/regular-event.js";

class GithubLinkHandler {
	constructor() {
		new RegularEvent("submit", ((e, r) => {
			e.preventDefault();
			let l = r.querySelector('[name="lurl"]').value.trim();
			"" !== l && LinkBrowser.finalizeFunction(l)
		})).delegateTo(document, "#lgithub")
	}
}

export default new GithubLinkHandler;
