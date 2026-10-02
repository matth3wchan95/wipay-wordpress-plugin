( function () {
	'use strict';

	if (
		! window.wc ||
		! window.wc.wcBlocksRegistry ||
		! window.wc.wcSettings ||
		! window.wp ||
		! window.wp.element
	) {
		return;
	}

	const registerPaymentMethod = window.wc.wcBlocksRegistry.registerPaymentMethod;
	const settings = window.wc.wcSettings.getSetting( 'waypoint_wipay_data', {} );
	const createElement = window.wp.element.createElement;
	const decodeEntities =
		window.wp.htmlEntities && window.wp.htmlEntities.decodeEntities
			? window.wp.htmlEntities.decodeEntities
			: function ( value ) {
					return value;
			  };
	const title = decodeEntities( settings.title || 'Credit card (WiPay)' );
	const description = decodeEntities(
		settings.description || 'You will complete payment on WiPay’s secure hosted checkout.'
	);

	const Label = function ( props ) {
		const PaymentMethodLabel = props.components.PaymentMethodLabel;
		return createElement( PaymentMethodLabel, { text: title } );
	};

	const Content = function () {
		return createElement( 'div', { className: 'waypoint-wipay-blocks-description' }, description );
	};

	registerPaymentMethod( {
		name: 'waypoint_wipay',
		label: createElement( Label ),
		ariaLabel: title,
		content: createElement( Content ),
		edit: createElement( Content ),
		canMakePayment: function () {
			return true;
		},
		supports: {
			features: settings.supports || [ 'products' ],
		},
	} );
} )();
