=== Waypoint WiPay for WooCommerce ===
Contributors: waypoint
Tags: woocommerce, payment-gateway, wipay, hosted-checkout
Requires at least: 6.4
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Independent WooCommerce gateway that redirects customers to WiPay's hosted card checkout.

== Description ==

This independent plugin is maintained by Waypoint and is not affiliated with, sponsored by, or endorsed by WiPay. Card details are entered on WiPay's hosted checkout page; this plugin does not collect card numbers or CVV values.

Payments are only completed after the server verifies WiPay's response hash using the exact order total pinned when checkout starts. Refund processing is not supported in this release. This software is provided under the GPL-2.0-or-later license without warranty; see LICENSE.

== Installation ==

1. Install and activate WooCommerce.
2. Install this plugin and open WooCommerce > Settings > Payments > Waypoint WiPay.
3. Leave Environment set to Sandbox while configuring and reviewing the integration.
4. Choose the WiPay processing platform associated with your merchant account.
5. For live use only, define `WAYPOINT_WIPAY_API_KEY` in `wp-config.php` and enter the live account number in gateway settings. Never commit or share the key.
6. Keep the gateway disabled until your own sandbox known-answer and checkout tests pass. This package has not been tested against a live WiPay account.

WiPay's current Payments API documentation publishes sandbox account `1234567890` and sandbox response-verification key `123`. The plugin uses these test values only when Sandbox is selected. Live payments require the store owner's verified WiPay Business account.

== Supported platform codes ==

This version offers BB, GD, GY, JM, and TT, matching WiPay's current published Payments API platform list. St. Lucia is not listed as a Payments API platform in the documentation reviewed for this release.

== Configuration ==

- Environment: Sandbox or Live.
- WiPay platform: BB, GD, GY, JM, or TT.
- Live account number: your own merchant account number.
- Fee structure: merchant_absorb, customer_pay, or split.
- Live API key: server-side `WAYPOINT_WIPAY_API_KEY` constant in `wp-config.php`; the key is not stored in plugin settings or printed into JavaScript.
- Diagnostics: optional, off by default. Logs contain event names, order IDs, and HTTP status codes only; customer data, request/response bodies, hashes, and keys are not logged.

The plugin supports classic WooCommerce checkout and declares HPOS compatibility. Checkout Blocks are not supported in this version. Refunds must be handled through the merchant's WiPay account and recorded in WooCommerce manually.

== Disclaimer ==

This software is provided "as is", without warranty of any kind. Waypoint accepts no liability for any loss, damages, payment disputes, or other claims arising from use of this plugin. The merchant is responsible for testing, configuration, compliance, and reconciliation. This is not legal, financial, or PCI compliance advice.

WiPay is a trademark of its respective owner. Mention of WiPay identifies the payment service this independent plugin connects to and does not imply endorsement.

== Changelog ==

= 1.0.0 =
* Initial Waypoint-maintained release.
