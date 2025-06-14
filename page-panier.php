<?php
/*
Template Name: Panier
*/

get_header();
?>

<section class="w-full px-6 py-12 pt-40">
    <div class="container max-w-7xl mx-auto">
        <div class="mb-8 container max-w-7xl mx-auto">
            <a href="/camps-de-jour"
                class="inline-flex items-center gap-2 text-blue-950 hover:text-blue-900 transition-colors"><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-arrow-left w-4 h-4">
                    <path d="m12 19-7-7 7-7"></path>
                    <path d="M19 12H5"></path>
                </svg>Continuer vos achats
            </a>
        </div>

        <?php if (class_exists('WooCommerce') && !WC()->cart->is_empty()): ?>
            <div class="grid lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h1 class="text-2xl font-bold text-gray-900">Votre panier</h1>
                            <span class="text-gray-600">
                                <?php
                                $cart_count = WC()->cart->get_cart_contents_count();
                                echo $cart_count . ' article' . ($cart_count > 1 ? 's' : '');
                                ?>
                            </span>
                        </div>

                        <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>"
                            method="post">
                            <div class="space-y-6">
                                <?php
                                foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                                    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                                    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                                    if ($_product && $_product->exists() && $cart_item['quantity'] > 0) {
                                        $product_permalink = $_product->is_visible() ? $_product->get_permalink($cart_item) : '';
                                        ?>
                                        <div class="flex items-center gap-4 p-4 border border-gray-200 rounded-lg">
                                            <!-- Product Image -->
                                            <div class="w-20 h-20 flex-shrink-0">
                                                <?php
                                                $acf_image_url = get_field('image_davant_page', $_product->get_id());
                                                ?>
                                                <img src="<?= esc_url($acf_image_url); ?>"
                                                    alt="<?= esc_attr($_product->get_name()); ?>"
                                                    class="w-full h-full object-cover rounded-lg">
                                            </div>

                                            <!-- Product Details -->
                                            <div class="flex-grow">
                                                <h3 class="font-bold text-gray-900 mb-1 truncate">
                                                    <?php
                                                    if ($product_permalink) {
                                                        echo '<a href="' . esc_url($product_permalink) . '" class="hover:text-blue-600 truncate">' . $_product->get_name() . '</a>';
                                                    } else {
                                                        echo $_product->get_name();
                                                    }
                                                    ?>
                                                </h3>

                                                <div class="text-sm text-gray-600 mb-2">
                                                    <?php
                                                    // Display ACF fields if they exist
                                                    $age_range = get_field('tranche_age', $product_id);
                                                    $dates = get_field('dates', $product_id);

                                                    $details = array();

                                                    if ($age_range) {
                                                        $details[] = 'Âge: ' . esc_html($age_range);
                                                    }

                                                    if ($dates && is_array($dates)) {
                                                        $date_debut = $dates['date_debut'] ?? '';
                                                        $date_fin = $dates['date_fin'] ?? '';
                                                        if ($date_debut && $date_fin) {
                                                            $details[] = 'Dates: ' . esc_html($date_debut) . ' - ' . esc_html($date_fin);
                                                        }
                                                    }

                                                    // Display product attributes/variations
                                                    if ($_product->is_type('variation')) {
                                                        $attributes = $_product->get_variation_attributes();
                                                        foreach ($attributes as $attribute_name => $attribute_value) {
                                                            $taxonomy = str_replace('attribute_', '', $attribute_name);
                                                            if (taxonomy_exists($taxonomy)) {
                                                                $term = get_term_by('slug', $attribute_value, $taxonomy);
                                                                if ($term) {
                                                                    $details[] = wc_attribute_label($taxonomy) . ': ' . $term->name;
                                                                }
                                                            } else {
                                                                $details[] = wc_attribute_label($attribute_name) . ': ' . $attribute_value;
                                                            }
                                                        }
                                                    }

                                                    if (!empty($details)) {
                                                        echo implode(' <span class="mx-2">•</span> ', $details);
                                                    }
                                                    ?>
                                                </div>

                                                <div class="text-lg font-bold text-blue-600">
                                                    <?php echo WC()->cart->get_product_price($_product); ?>
                                                </div>
                                            </div>

                                            <!-- Quantity Controls -->
                                            <div class="flex items-center gap-3">
                                                <a href="<?php echo esc_url(wc_get_cart_remove_url($cart_item_key)); ?>"
                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-trash2 w-5 h-5">
                                                        <path d="M3 6h18"></path>
                                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                                        <line x1="10" x2="10" y1="11" y2="17"></line>
                                                        <line x1="14" x2="14" y1="11" y2="17"></line>
                                                    </svg>
                                                </a>
                                            </div>

                                            <!-- Item Total -->
                                            <div class="text-right">
                                                <div class="font-bold text-gray-900">
                                                    <?php echo WC()->cart->get_product_subtotal($_product, $cart_item['quantity']); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>

                            <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                        </form>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="sticky top-8">
                        <h2
                            class="text-xl font-[Oswald] tracking-widest uppercase font-medium mb-4 bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent">
                            Résumé de commande</h2>

                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-600 font-[Inter]">Sous-total</span>
                                <span class="font-medium"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                            </div>

                            <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()): ?>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Livraison</span>
                                    <span class="font-medium">
                                        <?php
                                        $shipping_total = WC()->cart->get_shipping_total();
                                        if ($shipping_total > 0) {
                                            echo wc_price($shipping_total);
                                        } else {
                                            echo 'Gratuite';
                                        }
                                        ?>
                                    </span>
                                </div>
                            <?php endif; ?>

                            <?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()): ?>
                                <?php if (WC()->cart->get_taxes_total() > 0): ?>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Taxes (TPS/TVQ)</span>
                                        <span class="font-medium"><?php echo wc_price(WC()->cart->get_taxes_total()); ?></span>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex justify-between">
                                    <span class="text-lg font-bold text-gray-900">Total</span>
                                    <span
                                        class="text-lg font-bold text-gray-900"><?php echo WC()->cart->get_total(); ?></span>
                                </div>
                            </div>
                        </div>

                        <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class=" transition-colors duration-200 gradient-animate  w-full sm:w-auto bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 text-white rounded-xl
          first:rounded-t-lg last:rounded-b-lg py-4 sm:py-5 sm:px-8 tracking-wider sm:tracking-widest text-md
          text-center flex items-center justify-center gap-2">
                            PROCÉDER AU PAIEMENT
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="inline-block">
                                <path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>

                        <div class="mt-4 text-center">
                            <p class="text-xs text-gray-500">Paiement sécurisé • Livraison rapide • Retours gratuits</p>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif (class_exists('WooCommerce')): ?>
            <!-- Empty Cart -->
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <div class="mb-8">
                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6">
                        </path>
                    </svg>
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">Votre panier est vide</h1>
                    <p class="text-xl text-gray-600 mb-8">Découvrez nos camps de jour et ajoutez des articles à votre
                        panier.</p>
                </div>

                <a href="<?php echo esc_url(get_permalink(get_page_by_path('camps-de-jour'))); ?>"
                    class="bg-gradient-to-r from-slate-700 to-slate-900 hover:from-slate-800 hover:to-black text-white px-8 py-4 rounded-lg font-bold transition-colors inline-flex items-center gap-2">
                    Voir nos camps de jour
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-arrow-right w-5 h-5">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </a>
            </div>

        <?php else: ?>
            <!-- WooCommerce Not Active -->
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <h1 class="text-3xl font-bold text-red-600 mb-4">Service non disponible</h1>
                <p class="text-xl text-gray-600">Le système de panier n'est pas disponible pour le moment.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>