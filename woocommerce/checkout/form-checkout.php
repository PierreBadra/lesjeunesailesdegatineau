<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

if (!defined('ABSPATH')) {
	exit;
}

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
	echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
	return;
}

?>

<div class="container mx-auto px-4 py-8" __v0_r="0,5212,5241">
	<div class="mb-8" __v0_r="0,5293,5299">
		<nav class="flex items-center gap-2 text-sm text-gray-600" __v0_r="0,5326,5373"><a href="/"
				class="hover:text-blue-600" __v0_r="0,5412,5433">Accueil</a><span>/</span><a href="/panier"
				class="hover:text-blue-600" __v0_r="0,5547,5568">Panier</a><span>/</span><span class="text-gray-900"
				__v0_r="0,5666,5681">Commander</span></nav>
	</div>
	<form class="grid lg:grid-cols-3 gap-8 checkout woocommerce-checkout" __v0_r="0,5780,5807" name="checkout"
		method="post" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data"
		aria-label="<?php echo esc_attr__('Checkout', 'woocommerce'); ?>">
		<div class="lg:col-span-2 space-y-8" __v0_r="0,5862,5887">
			<!-- Personal Info, Billing, Shipping -->
			<?php do_action('woocommerce_checkout_before_customer_details'); ?>
			<?php do_action('woocommerce_checkout_billing'); ?>
			<?php do_action('woocommerce_checkout_shipping'); ?>
			<?php do_action('woocommerce_checkout_after_customer_details'); ?>
		</div>
		<div class="lg:col-span-1" __v0_r="0,23615,23630">
			<!-- Order Review and Payment -->
			<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>
			<?php do_action('woocommerce_checkout_before_order_review'); ?>
			<?php do_action('woocommerce_checkout_order_review'); ?>
			<?php do_action('woocommerce_checkout_after_order_review'); ?>

		</div>
	</form>
</div>


<?php do_action('woocommerce_checkout_before_customer_details'); ?>
<?php do_action('woocommerce_checkout_billing'); ?>
<?php do_action('woocommerce_checkout_shipping'); ?>
<?php do_action('woocommerce_checkout_after_customer_details'); ?>
<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>
<?php do_action('woocommerce_checkout_before_order_review'); ?>
<?php do_action('woocommerce_checkout_order_review'); ?>
<?php do_action('woocommerce_checkout_after_order_review'); ?>
<?php do_action('woocommerce_after_checkout_form', $checkout); ?>