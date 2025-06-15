<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined('ABSPATH') || exit;
?>

<?php
if ($order):

    do_action('woocommerce_before_thankyou', $order->get_id());
    ?>
    <?php if ($order->has_status('failed')): ?>

        <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed">
            <?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?>
        </p>

        <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
            <a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>"
                class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
            <?php if (is_user_logged_in()): ?>
                <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"
                    class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
            <?php endif; ?>
        </p>

    <?php else: ?>
        <section class="w-full px-6 py-12 pt-40">
            <div class="container mx-auto max-w-7xl" __v0_r="0,1312,1342">
                <div class="mb-8"><a href="/"
                        class="inline-flex items-center gap-2 text-blue-950 hover:text-blue-900 transition-colors"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-arrow-left w-4 h-4">
                            <path d="m12 19-7-7 7-7"></path>
                            <path d="M19 12H5"></path>
                        </svg>Retour à la page d'accueil</a></div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8" __v0_r="0,2118,2145">
                    <div class="lg:col-span-2" __v0_r="0,2208,2243">
                        <div>
                            <h1 class="text-3xl sm:text-4xl/10 md:text-5xl/15 font-bold bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent mb-4 uppercase font-[Oswald] tracking-widest"
                                __v0_r="0,1691,1730">Merci pour votre commande !</h1>
                            <p class="text-lg sm:text-xl text-gray-600 mb-4 font-[Inter]" __v0_r="0,1789,1817">Votre paiement a
                                été traité avec succès.</p>
                            <p class="text-gray-600 mb-4" __v0_r="0,1888,1903">Un courriel de confirmation a été envoyé à <span
                                    class="text-sm flex items-center gap-3 text-blue-950 underline" __v0_r="0,1997,2024">
                                    <?= $order->get_billing_email(); ?></span>
                            </p>
                            <div class="bg-blue-100 rounded-lg p-3 mb-4" __v0_r="0,7339,7367">
                                <p class="text-sm font-[Inter] text-blue-800" __v0_r="0,7400,7423"><strong>Important:</strong>
                                    Si vous ne
                                    recevez pas le courriel dans les prochaines minutes, veuillez vérifier votre dossier de
                                    courrier indésirable (spam ou junk). Parfois, les courriels de confirmation peuvent s’y
                                    retrouver.
                                </p>
                            </div>
                        </div>
                        <div class="flex md:flex-row flex-col items-stretch justify-stretch gap-6" __v0_r="0,2371,2382">
                            <div class="w-full rounded-lg border text-card-foreground shadow-sm border-blue-200 bg-blue-50/50">

                                <div class="p-6 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="mx-auto h-8 w-8 text-blue-950 mb-3 
    lucide lucide-package text-blue-600" __v0_r="0,2622,2645">
                                        <defs>
                                            <linearGradient id="handshake-gradient" x1="0" y1="0" x2="24" y2="0"
                                                gradientUnits="userSpaceOnUse">
                                                <stop offset="0%" stop-color="#0f172a"></stop> <!-- slate-900 -->
                                                <stop offset="50%" stop-color="#1e40af"></stop> <!-- blue-900 -->
                                                <stop offset="100%" stop-color="#1e293b"></stop> <!-- slate-800 -->
                                            </linearGradient>
                                        </defs>
                                        <path d="m7.5 4.27 9 5.15"></path>
                                        <path
                                            d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z">
                                        </path>
                                        <path d="m3.3 7 8.7 5 8.7-5"></path>
                                        <path d="M12 22V12"></path>
                                    </svg>

                                    <p class="text-sm font-medium text-blue-950">Numéro de commande</p>
                                    <h2 class="font-semibold text-blue-950 mb-2 font-[Oswald] tracking-widest uppercase">
                                        #<?= $order->get_order_number(); ?></h2>
                                </div>
                            </div>
                            <div class="w-full rounded-lg border text-card-foreground shadow-sm border-blue-200 bg-blue-50/50">
                                <div class="p-6 text-center">
                                    <svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="mx-auto mb-3 h-8 w-8 lucide lucide-calendar-days-icon lucide-calendar-days text-blue-950">
                                        <path d="M8 2v4"></path>
                                        <path d="M16 2v4"></path>
                                        <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                        <path d="M3 10h18"></path>
                                        <path d="M8 14h.01"></path>
                                        <path d="M12 14h.01"></path>
                                        <path d="M16 14h.01"></path>
                                        <path d="M8 18h.01"></path>
                                        <path d="M12 18h.01"></path>
                                        <path d="M16 18h.01"></path>
                                    </svg>

                                    <p class="text-sm font-medium text-blue-950">Date de commande</p>
                                    <h2 class="font-semibold text-blue-950 mb-2 font-[Oswald] tracking-widest uppercase">
                                        <?= wc_format_datetime($order->get_date_created()); ?>
                                    </h2>
                                </div>
                            </div>

                            <div class="w-full rounded-lg border text-card-foreground shadow-sm border-blue-200 bg-blue-50/50">
                                <div class="p-6 text-center">
                                    <svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="url(#handshake-gradient)" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="mx-auto h-8 w-8 text-blue-950 mb-3 lucide lucide-dollar-sign-icon lucide-dollar-sign">
                                        <defs>
                                            <linearGradient id="handshake-gradient" x1="0" y1="0" x2="24" y2="0"
                                                gradientUnits="userSpaceOnUse">
                                                <stop offset="0%" stop-color="#0f172a"></stop> <!-- slate-900 -->
                                                <stop offset="50%" stop-color="#1e40af"></stop> <!-- blue-900 -->
                                                <stop offset="100%" stop-color="#1e293b"></stop> <!-- slate-800 -->
                                            </linearGradient>
                                        </defs>
                                        <rect width="20" height="14" x="2" y="5" rx="2"></rect>
                                        <line x1="2" x2="22" y1="10" y2="10"></line>




                                    </svg>
                                    <p class="text-sm font-medium text-blue-950">Méthode de paiement</p>
                                    <h2
                                        class="flex items-center justify-center font-semibold text-blue-950 mb-2 font-[Oswald] tracking-widest uppercase">
                                        <div class="wc-payment-gateway-method-logo-wrapper wc-payment-card-logo">
                                            <?= wp_kses_post($order->get_payment_method_title()); ?>
                                        </div>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="" __v0_r="0,4493,4528">
                        <h2 class="font-semibold flex mb-6 items-center gap-2 text-2xl bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent uppercase font-[Oswald] tracking-widest"
                            __v0_r="0,4558,4597">Résumé de commande</h2>
                        <div class="space-y-4 mb-6">
                            <?php if ($order): ?>
                                <?php foreach ($order->get_items() as $item_id => $item):
                                    $product = $item->get_product();
                                    ?>
                                    <div class="flex justify-between items-start p-4 border border-gray-200  rounded-lg">
                                        <div class="flex-grow">
                                            <h4
                                                class="font-bold bg-gradient-to-r transition-colors duration-200 gradient-animate from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent uppercase font-[Oswald] tracking-widest text-sm sm:text-base mb-1">
                                                <?= esc_html($item->get_name()); ?>
                                            </h4>
                                            <p class="text-sm text-gray-600">
                                                x <?= esc_html($item->get_quantity()); ?></p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-blue-950 text-sm lg:text-base item-total">
                                                <?= $order->get_formatted_line_subtotal($item); ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="border-t border-gray-200 pt-4 space-y-3">
                            <!-- Sous-total -->
                            <div class="flex justify-between">
                                <span class="text-gray-600 font-[Inter]">Sous-total</span>
                                <span class="font-medium font-[Inter]">
                                    <?= wp_kses_post($order->get_subtotal_to_display()); ?>
                                </span>
                            </div>

                            <!-- Taxes (TPS, TVQ, etc.) -->
                            <?php foreach ($order->get_tax_totals() as $tax_code => $tax): ?>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 font-[Inter]"><?= esc_html($tax->label); ?></span>
                                    <span class="font-medium font-[Inter]"><?= wp_kses_post($tax->formatted_amount); ?></span>
                                </div>
                            <?php endforeach; ?>

                            <!-- Total -->
                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between">
                                    <span class="text-lg font-bold text-blue-950">Total</span>
                                    <span class="text-lg font-bold text-blue-950">
                                        <?= wp_kses_post($order->get_formatted_order_total()); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </section>
    <?php endif; ?>
<?php else: ?>
    <?php wc_get_template('checkout/order-received.php', array('order' => false)); ?>
<?php endif; ?>