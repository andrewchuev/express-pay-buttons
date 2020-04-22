jQuery(document).ready(function ($) {
// 'use strict';
	var DEBUG = true;
	var ajaxurl = $('#ajaxurl').val();


	if ($('#paypal-button-container').length) {
		var productPrice = $('.woocommerce-Price-amount.amount').text();
		productPrice = productPrice.replace('$', '');
		if ( DEBUG ) console.log('productPrice = ' + productPrice);

		var productId = $('#epb-product-id').attr('id');
		if ( DEBUG ) console.log('productId = ' + productId);
		paypal.Buttons({
			style: {
				color: 'blue',
				shape: 'pill',
				label: 'paypal',
				height: 40,
				size: 'small',

			},
			env: 'sandbox',
			commit: true, // Show a 'Pay Now' button

			// Set up the transaction
			createOrder: function (data, actions) {
				return actions.order.create({
					purchase_units: [{
						amount: {
							value: productPrice
						},
						description: 'Muzikkon 8 Course Heartland Renaissance Lute, Right Handed Lacewood',
						custom_id: '43111',

					}],


				});
			},

			// Finalize the transaction
			onApprove: function (data, actions) {
				return actions.order.capture().then(function (details) {
					// Show a success message to the buyer
					if (DEBUG) console.log(details);
					send_order_response(details);
				});
			}

		}).render('#paypal-button-container');
	}


	function send_order_response(details) {
		$.ajax({
			url: ajaxurl,
			type: "POST",
			data: {action: 'order_response', details},
			success: function (response) {
				console.log(response);
				location.href = 'https://sooo.academweb.tech/order-complete/?id=' + response;
			},
			error: function (request, status, error) {
				console.log(request, status, error);
			}
		});

	}


	$('#stripe-button').on('click', function () {
		$('#stripe-form').show();
	});

	$('.close-stripe-form').on('click', function () {
		$('#stripe-form').hide();
	});


	if ($('#stripe-form').length) {
		var stripe = Stripe('pk_test_LYsKb2x7Tj9xXG8H5hCLo3Hu0074R2sClA', {locale: 'en'});
		var elements = stripe.elements();

		var card = elements.create('card', {
			hidePostalCode: true,
			style: {
				base: {
					iconColor: '#666EE8',
					color: '#31325F',
					lineHeight: '40px',
					fontWeight: 300,
					fontFamily: 'Helvetica Neue',
					fontSize: '15px',

					'::placeholder': {
						color: '#CFD7E0',
					},
				},
			}
		});
		card.mount('#card-element');

		console.log(card);

		function setOutcome(result) {
			var successElement = document.querySelector('.success');
			var errorElement = document.querySelector('.error');
			successElement.classList.remove('visible');
			errorElement.classList.remove('visible');

			if (result.token) {
				// In this example, we're simply displaying the token
				successElement.querySelector('.token').textContent = result.token.id;
				successElement.classList.add('visible');

				// In a real integration, you'd submit the form with the token to your backend server
				var form = document.querySelector('form');
				form.querySelector('input[name="token"]').setAttribute('value', result.token.id);
				form.submit();
			} else if (result.error) {
				errorElement.textContent = result.error.message;
				errorElement.classList.add('visible');
			}
		}

		card.on('change', function (event) {
			setOutcome(event);
		});

		document.querySelector('form').addEventListener('submit', function (e) {
			e.preventDefault();
			var options = {
				phone: document.getElementById('phone').value,
				name: document.getElementById('email').value,
				email: document.getElementById('name').value,
				address_line1: document.getElementById('address-line1').value,
				address_line2: document.getElementById('address-line2').value,
				address_city: document.getElementById('address-city').value,
				address_state: document.getElementById('address-state').value,
				address_zip: document.getElementById('address-zip').value,
				address_country: document.getElementById('address-country').value,
			};
			stripe.createToken(card, options).then(setOutcome);

		});

	}
})

