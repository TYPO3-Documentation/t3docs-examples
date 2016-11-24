/**
 * JS code for extension "examples" wizard example
 */
define([
		'jquery'
	],
	function ($) {
		'use strict';
		var PlusMinusWizard = {};

		/**
		 * Initializes this module.
		 */
		$(function () {
			// Activate the "+" and "-" buttons
			$('.tx_examples_weirdness').on('click', function () {
				var action = $(this).data('action');
				var item = $(this).data('item');
				var inputField = $('input[data-formengine-input-name="' + item + '"]');
				var hiddenInputField = $('input[name="' + item + '"]');
				var currentValue = parseInt(inputField.val());
				// Act on plus or minus
				if (action === 'minus') {
					currentValue--;
				} else {
					currentValue++;
				}
				// Set the value in both the input field and its hidden counterpart
				inputField.val(currentValue);
				hiddenInputField.val(currentValue);
			});
		});

		return PlusMinusWizard;
	}
);
