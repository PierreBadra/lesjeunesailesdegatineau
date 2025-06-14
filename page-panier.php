<?php
/*
Template Name: Panier
*/

get_header();
?>

<section class="w-full px-6 py-12 pt-40 mb-40">
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
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <h1
                                class="font-semibold flex items-center gap-2 text-2xl bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent uppercase font-[Oswald] tracking-widest">
                                Votre
                                panier</h1>
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
                                    $date_de_debut = get_field('date_de_debut', $_product->get_id());
                                    $date_de_fin = get_field('date_de_fin', $_product->get_id());
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
                                                <h3
                                                    class="font-bold bg-gradient-to-r transition-colors duration-200 gradient-animate from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent uppercase font-[Oswald] tracking-widest mb-1 truncate">
                                                    <?php
                                                    if ($product_permalink) {
                                                        echo '<a href="' . esc_url($product_permalink) . '">' . $_product->get_name() . '</a>';
                                                    } else {
                                                        echo $_product->get_name();
                                                    }
                                                    ?>
                                                </h3>
                                                <div class="text-sm font-[Inter] text-gray-600 mb-2 flex items-center gap-2"
                                                    __v0_r="0,4571,4599"><svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="w-4 h-4 lucide lucide-calendar-days-icon lucide-calendar-days">
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
                                                    <p>Du
                                                        <span><?= $date_de_debut ?></span> au <span><?= $date_de_fin ?></span>
                                                    </p>
                                                </div>
                                                <div class="text-sm text-gray-600 mb-2">
                                                    <?php
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

                                                <div class="text-lg font-bold text-blue-950">
                                                    <?php echo WC()->cart->get_product_price($_product); ?>
                                                </div>
                                            </div>

                                            <!-- Quantity Controls -->
                                            <div class="flex items-center gap-3">
                                                <div class="flex items-center border border-gray-300 rounded-lg"
                                                    __v0_r="0,5141,5194"><button class="p-2 hover:bg-gray-100 transition-colors"
                                                        __v0_r="0,5349,5390"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="lucide lucide-minus w-4 h-4" __v0_r="0,5460,5469">
                                                            <path d="M5 12h14"></path>
                                                        </svg></button><span class="px-4 py-2 font-medium"
                                                        __v0_r="0,5547,5570">2</span><button
                                                        class="p-2 hover:bg-gray-100 transition-colors" __v0_r="0,5747,5788"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="lucide lucide-plus w-4 h-4" __v0_r="0,5857,5866">
                                                            <path d="M5 12h14"></path>
                                                            <path d="M12 5v14"></path>
                                                        </svg></button></div>

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
                                                <div class="font-bold text-blue-950">
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
                                <span class="font-medium font-[Inter]"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                            </div>

                            <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()): ?>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 font-[Inter]">Livraison</span>
                                    <span class="font-medium font-[Inter]">
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
                                        <span class="text-gray-600 font-[Inter]">Taxes (TPS/TVQ)</span>
                                        <span
                                            class="font-medium font-[Inter]"><?php echo wc_price(WC()->cart->get_taxes_total()); ?></span>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex justify-between">
                                    <span class="text-lg font-bold text-blue-950">Total</span>
                                    <span
                                        class="text-lg font-bold text-blue-950"><?php echo WC()->cart->get_total(); ?></span>
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
                    </div>
                </div>
            </div>

        <?php elseif (class_exists('WooCommerce')): ?>
            <!-- Empty cart -->
            <div
                class="container max-w-7xl mx-auto rounded-lg min-h-[500px] xl:h-96 flex items-center justify-center border bg-card shadow-sm bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 text-white">
                <div class="p-8 text-center">
                    <div class="mb-8 flex justify-center">
                        <svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="h-12 w-12 lucide lucide-shopping-cart-icon lucide-shopping-cart">
                            <circle cx="8" cy="21" r="1"></circle>
                            <circle cx="19" cy="21" r="1"></circle>
                            <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-2xl mb-4 uppercase font-[Oswald] tracking-widest">Votre panier est vide
                    </h2>
                    <p class="text-white/80 mb-6 max-w-2xl mx-auto font-[Inter] text-lg sm:text-xl">Découvrez nos camps de
                        jour et ajoutez des articles à votre
                        panier.</p>
                    <div class="">
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('camps-de-jour'))); ?>"
                            class="w-full sm:w-auto sm:min-w-[320px] md:min-w-[400px] bg-white text-gray-900 rounded-xl hover:bg-gray-100 uppercase transition-colors duration-200 first:rounded-t-lg last:rounded-b-lg py-4 sm:py-5 sm:px-8 tracking-wider sm:tracking-widest text-md text-center flex items-center justify-center gap-2">
                            Voir nos camps de jour
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg" class="inline-block">
                                <path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
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