/**
 * Module: @t3docs/examples/flash-message-demo
 * JavaScript code for extension "examples" backend module
 */

import Notification from "@typo3/backend/notification.js";

class FlashAjaxDemo {
	constructor() {
		// todo: Restore Ajax example, see code commented out below
		var button_el = document.getElementById('displayJavaScriptFlashAjaxMessage');
		button_el.addEventListener('click', function(event) {
			event.preventDefault();
			Notification.warning('Warning', 'This example is not implemented yet', 5);
		});
	}
}

export default new FlashAjaxDemo();
/*
define([
	   'jquery',
	   'TYPO3/CMS/Backend/Notification'
   ],
   function ($, Notification) {
	   'use strict';
	   var ExamplesApplication = {

	   };

		$(function () {
			$('.action-button').on('click', function () {
				var table = $(this).attr('name');
				$.ajax({
					url: TYPO3.settings.ajaxUrls['tx_examples_count'],
					data: {
						table: table
					},
					success: function (data, status, xhr) {
						var message = TYPO3.lang['record_count_message'];
						message = message.replace('{0}', data['count']);
						message = message.replace('{1}', table);
						Notification.success(TYPO3.lang['record_count_title'], message, 5);
					}
				});
			});
		});

		return ExamplesApplication;
   }
);

 */
