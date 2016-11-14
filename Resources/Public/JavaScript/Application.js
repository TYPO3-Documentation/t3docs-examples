/**
 * JS code for extension "examples" BE module
 */
define([
	   'jquery',
	   'TYPO3/CMS/Backend/Notification'
   ],
   function ($, Notification) {
	   'use strict';
	   var ExamplesApplication = {

	   };

		/**
		 * Initializes this module.
		 */
		$(function() {
			$('.action-button').on('click', function () {
				var table = $(this).attr('name');
				$.ajax({
					url: TYPO3.settings.ajaxUrls['tx_examples_count'],
					data: {
						table: table
					},
					success: function (data, status, xhr) {
						var message = TYPO3.lang['record_count_message'];
						message = message.replace('{0}', data);
						message = message.replace('{1}', table);
						Notification.success(TYPO3.lang['record_count_title'], message, 5);
					}
				});
			});
		});

	   return ExamplesApplication;
   }
);
