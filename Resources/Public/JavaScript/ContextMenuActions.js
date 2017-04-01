/**
 * Module: TYPO3/CMS/Example/ContextMenuActions
 *
 * JavaScript to handle the click action of the "Hello World" context menu item
 * @exports TYPO3/CMS/Example/ContextMenuActions
 */
define(function () {
    'use strict';

    /**
     * @exports TYPO3/CMS/Example/ContextMenuActions
     */
    var ContextMenuActions = {};

    /**
     * Say hello
     *
     * @param {string} table
     * @param {int} uid of the page
     */
    ContextMenuActions.helloWorld = function (table, uid) {
        if (table === 'pages') {
            //If needed, you can access other 'data' attributes here from $(this).data('someKey')
            //see item provider getAdditionalAttributes method to see how to pass custom data attributes

            top.TYPO3.Notification.error('Hello World', 'Hi there!', 5);
        }
    };

    return ContextMenuActions;
});