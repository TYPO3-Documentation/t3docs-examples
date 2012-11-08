/**
 * ExtJS code for extension "examples" BE module
 *
 * $Id: Application.js 67582 2012-11-01 17:43:20Z francois $
 */
Ext.namespace('TYPO3.Examples');

Ext.onReady(function() {
	Ext.addBehaviors({
			// Add a listener for click on scheduler execute button
		'.action-button@click' : function(event, target) {
			var table = Ext.get(target).getAttribute('name');
				// ExtDirect call
			TYPO3.Examples.ExtDirect.countRecords(table, function(response) {
					// If the response contains data, display it in a JavaScript flash message
				if (response.data) {
					var message = String.format(TYPO3.lang['record_count_message'], response.data, table);
					TYPO3.Flashmessage.display(TYPO3.Severity.ok, TYPO3.lang['record_count_title'], message, 5);
				}
			});
		}
	});
});