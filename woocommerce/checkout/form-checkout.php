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

<section class="w-full p-6 pt-40 overflow-x-hidden">
	<div class="container mx-auto max-w-7xl">
		<div class="mb-8">
			<a href="/panier"
				class="inline-flex items-center gap-2 text-blue-950 hover:text-blue-900 transition-colors">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
					stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
					class="lucide lucide-arrow-left w-4 h-4">
					<path d="m12 19-7-7 7-7"></path>
					<path d="M19 12H5"></path>
				</svg>
				Retour au panier
			</a>
		</div>

		<?php
		// Output error messages and notices here, OUTSIDE the grid
		do_action('woocommerce_before_checkout_form', $checkout);
		?>

		<form class="grid lg:grid-cols-2 lg:grid-rows-[auto_1fr] gap-8 checkout woocommerce-checkout" name="checkout"
			method="post" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data"
			aria-label="<?php echo esc_attr__('Checkout', 'woocommerce'); ?>">
			<div class="lg:row-span-3 lg:row-start-2 space-y-8">
				<!-- Personal Info, Billing, Shipping -->
				<?php do_action('woocommerce_checkout_before_customer_details'); ?>
				<?php do_action('woocommerce_checkout_billing'); ?>
				<?php do_action('woocommerce_checkout_shipping'); ?>
				<?php do_action('woocommerce_checkout_after_customer_details'); ?>
			</div>
			<div class="lg:row-span-3 lg:row-start-2">
				<!-- Order Review and Payment -->
				<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>
				<?php do_action('woocommerce_checkout_before_order_review'); ?>
				<?php do_action('woocommerce_checkout_order_review'); ?>
				<?php do_action('woocommerce_checkout_after_order_review'); ?>
			</div>
		</form>
	</div>
</section>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>