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
                <div class="flex items-center gap-4 mb-12" __v0_r="0,1446,1465">
                    <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6"
                        __v0_r="0,1494,1577"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-circle-check-big w-12 h-12 text-green-600" __v0_r="0,1616,1642">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-4" __v0_r="0,1691,1730">Merci pour votre commande !</h1>
                        <p class="text-xl text-gray-600 mb-2" __v0_r="0,1789,1817">Votre paiement a été traité avec succès.</p>
                        <p class="text-gray-600" __v0_r="0,1888,1903">Un courriel de confirmation a été envoyé à <span
                                class="font-medium text-blue-600" __v0_r="0,1997,2024">
                                <?= $order->get_billing_email(); ?></span>
                        </p>
                    </div>
                </div>
                <div class="grid lg:grid-cols-2 gap-8" __v0_r="0,2118,2145">
                    <div class="bg-white rounded-xl shadow-lg p-8" __v0_r="0,2208,2243">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6" __v0_r="0,2273,2312">Détails de la commande</h2>
                        <div class="space-y-6" __v0_r="0,2371,2382">
                            <div class="flex items-center gap-4" __v0_r="0,2452,2477">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center"
                                    __v0_r="0,2512,2581"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-package w-6 h-6 text-blue-600" __v0_r="0,2622,2645">
                                        <path d="m7.5 4.27 9 5.15"></path>
                                        <path
                                            d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z">
                                        </path>
                                        <path d="m3.3 7 8.7 5 8.7-5"></path>
                                        <path d="M12 22V12"></path>
                                    </svg></div>
                                <div>
                                    <h3 class="font-medium text-gray-900" __v0_r="0,2732,2759">Numéro de commande</h3>
                                    <p class="text-lg font-bold text-blue-600" __v0_r="0,2817,2850">
                                        <?= $order->get_order_number(); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4" __v0_r="0,2995,3020">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center"
                                    __v0_r="0,3055,3125"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-calendar w-6 h-6 text-green-600" __v0_r="0,3167,3191">
                                        <path d="M8 2v4"></path>
                                        <path d="M16 2v4"></path>
                                        <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                        <path d="M3 10h18"></path>
                                    </svg></div>
                                <div>
                                    <h3 class="font-medium text-gray-900" __v0_r="0,3278,3305">Date de commande</h3>
                                    <p class="text-gray-700" __v0_r="0,3361,3376">
                                        <?= wc_format_datetime($order->get_date_created()); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4" __v0_r="0,3522,3547">
                                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center"
                                    __v0_r="0,3582,3653"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-credit-card w-6 h-6 text-purple-600" __v0_r="0,3697,3722">
                                        <rect width="20" height="14" x="2" y="5" rx="2"></rect>
                                        <line x1="2" x2="22" y1="10" y2="10"></line>
                                    </svg></div>
                                <div>
                                    <h3 class="font-medium text-gray-900" __v0_r="0,3809,3836">Méthode de paiement</h3>
                                    <p class="text-gray-700" __v0_r="0,3895,3910">
                                        <?= wp_kses_post($order->get_payment_method_title()); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4" __v0_r="0,4051,4078">
                                <div class="flex justify-between items-center" __v0_r="0,4113,4148"><span
                                        class="text-lg font-medium text-gray-900" __v0_r="0,4186,4221">Total
                                        payé</span><span class="text-2xl font-bold text-green-600" __v0_r="0,4276,4311">$1.40
                                        CAD</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg p-8" __v0_r="0,4493,4528">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6" __v0_r="0,4558,4597">Résumé de commande</h2>
                        <div class="space-y-4 mb-6">
                            <?php if ($order): ?>
                                <?php foreach ($order->get_items() as $item_id => $item):
                                    $product = $item->get_product();
                                    ?>
                                    <div class="flex justify-between items-start p-4 bg-gray-50 rounded-lg">
                                        <div class="flex-grow">
                                            <h4 class="font-medium text-gray-900 mb-1">
                                                <?= esc_html($item->get_name()); ?>
                                            </h4>
                                            <?php if ($meta = wc_display_item_meta($item, array('echo' => false))): ?>
                                                <div class="text-xs text-gray-500"><?= $meta; ?></div>
                                            <?php endif; ?>
                                            <p class="text-sm text-gray-600">
                                                Quantité: <?= esc_html($item->get_quantity()); ?>
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-gray-900">
                                                <?= $order->get_formatted_line_subtotal($item); ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="border-t border-gray-200 pt-4 space-y-3">
                            <!-- Sous-total -->
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Sous-total</span>
                                <span class="font-medium">
                                    <?= wp_kses_post($order->get_subtotal_to_display()); ?>
                                </span>
                            </div>

                            <!-- Taxes (TPS, TVQ, etc.) -->
                            <?php foreach ($order->get_tax_totals() as $tax_code => $tax): ?>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600"><?= esc_html($tax->label); ?></span>
                                    <span class="font-medium"><?= wp_kses_post($tax->formatted_amount); ?></span>
                                </div>
                            <?php endforeach; ?>

                            <!-- Total -->
                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between">
                                    <span class="text-lg font-bold text-gray-900">Total</span>
                                    <span class="text-lg font-bold text-gray-900">
                                        <?= wp_kses_post($order->get_formatted_order_total()); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-6" __v0_r="0,6639,6694">
                    <div class="flex items-start gap-4" __v0_r="0,6723,6747">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0"
                            __v0_r="0,6778,6861"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-mail w-6 h-6 text-blue-600" __v0_r="0,6895,6918">
                                <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                            </svg></div>
                        <div>
                            <h3 class="font-bold text-blue-900 mb-2" __v0_r="0,6993,7023">Confirmation par courriel envoyée
                            </h3>
                            <p class="text-blue-800 mb-3" __v0_r="0,7092,7112">Un courriel de confirmation a été envoyé à
                                <strong><?= $order->get_billing_email(); ?></strong>.
                            </p>
                            <div class="bg-blue-100 rounded-lg p-3" __v0_r="0,7339,7367">
                                <p class="text-sm text-blue-800" __v0_r="0,7400,7423"><strong>Important:</strong> Si vous ne
                                    recevez pas le courriel dans les prochaines minutes, veuillez vérifier votre dossier de
                                    courrier indésirable (spam). Parfois, les courriels de confirmation peuvent s'y
                                    retrouver.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-8 bg-white rounded-xl shadow-lg p-8" __v0_r="0,7861,7901">
                    <h3 class="text-xl font-bold text-gray-900 mb-6" __v0_r="0,7929,7967">Prochaines étapes</h3>
                    <div class="space-y-4" __v0_r="0,8018,8029">
                        <div class="flex items-center gap-4" __v0_r="0,8060,8085">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center"
                                __v0_r="0,8118,8186"><span class="text-sm font-bold text-green-600"
                                    __v0_r="0,8222,8256">1</span></div>
                            <div>
                                <h4 class="font-medium text-gray-900" __v0_r="0,8343,8370">Confirmation reçue</h4>
                                <p class="text-gray-600 text-sm" __v0_r="0,8426,8449">Votre commande a été confirmée et
                                    enregistrée dans notre système</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4" __v0_r="0,8633,8658">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center" __v0_r="0,8691,8758">
                                <span class="text-sm font-bold text-blue-600" __v0_r="0,8794,8827">2</span>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900" __v0_r="0,8914,8941">Traitement de l'inscription</h4>
                                <p class="text-gray-600 text-sm" __v0_r="0,9006,9029">Notre équipe traitera votre
                                    inscription
                                    dans les 1-2 prochains jours ouvrables</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4" __v0_r="0,9227,9252">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center"
                                __v0_r="0,9285,9354"><span class="text-sm font-bold text-purple-600"
                                    __v0_r="0,9390,9425">3</span></div>
                            <div>
                                <h4 class="font-medium text-gray-900" __v0_r="0,9512,9539">Informations détaillées</h4>
                                <p class="text-gray-600 text-sm" __v0_r="0,9600,9623">Vous recevrez un courriel avec toutes
                                    les
                                    informations sur votre programme</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-12 text-center" __v0_r="0,9882,9901">
                    <div class="flex flex-col sm:flex-row gap-4 justify-center" __v0_r="0,9930,9978"><a href="/"
                            class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-slate-700 to-slate-900 hover:from-slate-800 hover:to-black text-white px-8 py-4 rounded-lg font-bold transition-colors"
                            __v0_r="0,10051,10239"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-home w-5 h-5" __v0_r="0,10288,10297">
                                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>Retour à l'accueil</a><a href="/programmes"
                            class="inline-flex items-center justify-center gap-2 bg-white border-2 border-gray-300 hover:border-gray-400 text-gray-800 px-8 py-4 rounded-lg font-bold transition-colors"
                            __v0_r="0,10439,10605">Voir nos programmes<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-5 h-5"
                                __v0_r="0,10696,10705">
                                <path d="M5 12h14"></path>
                                <path d="m12 5 7 7-7 7"></path>
                            </svg></a></div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php else: ?>
    <?php wc_get_template('checkout/order-received.php', array('order' => false)); ?>
<?php endif; ?>