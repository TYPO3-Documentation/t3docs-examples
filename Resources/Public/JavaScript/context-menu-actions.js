/**
 * Module: @t3docs/examples/context-menu-actions
 *
 * JavaScript to handle the click action of the "Hello World" context menu item
 */

class ContextMenuActions {

	helloWorld(table, uid) {
		if (table === 'pages') {
			//If needed, you can access other 'data' attributes here from $(this).data('someKey')
			//see item provider getAdditionalAttributes method to see how to pass custom data attributes
			top.TYPO3.Notification.error('Hello World', 'Hi there!', 5);
		}
	};
}

export default new ContextMenuActions();
