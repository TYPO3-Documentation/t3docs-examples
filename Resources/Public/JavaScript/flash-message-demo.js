/**
 * Module: @t3docs/examples/flash-message-demo
 * JavaScript code for extension "examples" backend module
 */

import Notification from "@typo3/backend/notification.js";

class FlashMessageDemo {
	constructor() {
		var button_el = document.getElementById('displayJavaScriptFlashMessage');
		button_el.addEventListener('click', function(event) {
			event.preventDefault();
			Notification.success('Success', 'This flash message was sent via JavaScript', 5);
		});
	}
}

export default new FlashMessageDemo();
