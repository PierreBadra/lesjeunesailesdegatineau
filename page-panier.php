<?php
/*
Template Name: Panier
*/

get_header();
?>

<div class="pt-24 min-h-screen bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Mon Panier</h1>

        <?php if (class_exists('WooCommerce') && !WC()->cart->is_empty()): ?>

            <!-- Cart Items -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Articles dans votre panier</h2>

                    <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
                        <div class="space-y-6">
                            <?php
                            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                                $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                                $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                                if ($_product && $_product->exists() && $cart_item['quantity'] > 0) {
                                    $product_permalink = $_product->is_visible() ? $_product->get_permalink($cart_item) : '';
                                    ?>
                                    <div
                                        class="flex flex-col md:flex-row items-start md:items-center gap-6 p-6 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                                        <!-- Product Image -->
                                        <div class="w-full md:w-32 h-32 flex-shrink-0">
                                            <?php
                                            $thumbnail = $_product->get_image('thumbnail', array('class' => 'w-full h-full object-cover rounded-lg'));
                                            if ($product_permalink) {
                                                echo '<a href="' . esc_url($product_permalink) . '">' . $thumbnail . '</a>';
                                            } else {
                                                echo $thumbnail;
                                            }
                                            ?>
                                        </div>

                                        <!-- Product Details -->
                                        <div class="flex-grow">
                                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                                <div>
                                                    <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                                        <?php
                                                        if ($product_permalink) {
                                                            echo '<a href="' . esc_url($product_permalink) . '" class="hover:text-blue-600 transition-colors">' . $_product->get_name() . '</a>';
                                                        } else {
                                                            echo $_product->get_name();
                                                        }
                                                        ?>
                                                    </h3>

                                                    <!-- Display ACF fields if they exist -->
                                                    <?php
                                                    $age_range = get_field('tranche_age', $product_id);
                                                    $dates = get_field('dates', $product_id);

                                                    if ($age_range) {
                                                        echo '<p class="text-sm text-gray-600 mb-1"><strong>Âge:</strong> ' . esc_html($age_range) . '</p>';
                                                    }

                                                    if ($dates && is_array($dates)) {
                                                        $date_debut = $dates['date_debut'] ?? '';
                                                        $date_fin = $dates['date_fin'] ?? '';
                                                        if ($date_debut && $date_fin) {
                                                            echo '<p class="text-sm text-gray-600 mb-1"><strong>Dates:</strong> ' . esc_html($date_debut) . ' - ' . esc_html($date_fin) . '</p>';
                                                        }
                                                    }
                                                    ?>

                                                    <p class="text-lg font-bold text-blue-600">
                                                        <?php echo WC()->cart->get_product_price($_product); ?>
                                                    </p>
                                                </div>

                                                <!-- Quantity and Remove -->
                                                <div class="flex items-center gap-4">
                                                    <div class="flex items-center gap-2">
                                                        <label for="cart-<?php echo $cart_item_key; ?>"
                                                            class="text-sm font-medium text-gray-700">Quantité:</label>
                                                        <?php
                                                        woocommerce_quantity_input(
                                                            array(
                                                                'input_name' => "cart[{$cart_item_key}][qty]",
                                                                'input_value' => $cart_item['quantity'],
                                                                'max_value' => $_product->get_max_purchase_quantity(),
                                                                'min_value' => '0',
                                                                'product_name' => $_product->get_name(),
                                                                'input_id' => "cart-{$cart_item_key}",
                                                            ),
                                                            $_product,
                                                            false
                                                        );
                                                        ?>
                                                    </div>

                                                    <div class="text-right">
                                                        <p class="text-lg font-bold text-gray-800 mb-2">
                                                            <?php echo WC()->cart->get_product_subtotal($_product, $cart_item['quantity']); ?>
                                                        </p>
                                                        <a href="<?php echo esc_url(wc_get_cart_remove_url($cart_item_key)); ?>"
                                                            class="text-red-600 hover:text-red-800 text-sm font-medium transition-colors"
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article?')">
                                                            Supprimer
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>

                        <!-- Update Cart Button -->
                        <div class="mt-8 flex justify-between items-center">
                            <button type="submit" name="update_cart" value="Mettre à jour le panier"
                                class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition-colors font-medium">
                                Mettre à jour le panier
                            </button>

                            <a href="<?php echo esc_url(get_permalink(get_page_by_path('camps-de-jour'))); ?>"
                                class="text-blue-600 hover:text-blue-800 font-medium transition-colors">
                                ← Continuer les achats
                            </a>
                        </div>

                        <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                    </form>
                </div>
            </div>

            <!-- Cart Totals -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-semibold mb-6 text-gray-800">Résumé de la commande</h2>

                <div class="space-y-4">
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-gray-600">Sous-total:</span>
                        <span class="font-semibold"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                    </div>

                    <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()): ?>
                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="text-gray-600">Livraison:</span>
                            <span class="font-semibold">
                                <?php wc_cart_totals_shipping_html(); ?>
                            </span>
                        </div>
                    <?php endif; ?>

                    <?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()): ?>
                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="text-gray-600">Taxes:</span>
                            <span class="font-semibold"><?php wc_cart_totals_taxes_total_html(); ?></span>
                        </div>
                    <?php endif; ?>

                    <div
                        class="flex justify-between items-center py-4 text-xl font-bold text-gray-800 border-t-2 border-gray-300">
                        <span>Total:</span>
                        <span class="text-blue-600"><?php wc_cart_totals_order_total_html(); ?></span>
                    </div>
                </div>

                <!-- Checkout Button -->
                <div class="mt-8">
                    <a href="<?php echo esc_url(wc_get_checkout_url()); ?>"
                        class="w-full bg-blue-600 text-white text-center py-4 px-6 rounded-lg hover:bg-blue-700 transition-colors font-semibold text-lg block">
                        Procéder au paiement
                    </a>
                </div>
            </div>

        <?php elseif (class_exists('WooCommerce')): ?>

            <!-- Empty Cart -->
            <div class="bg-white rounded-lg shadow-lg p-12 text-center">
                <div class="mb-8">
                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6">
                        </path>
                    </svg>
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Votre panier est vide</h2>
                    <p class="text-xl text-gray-600 mb-8">Découvrez nos programmes et ajoutez des articles à votre panier.
                    </p>
                </div>

                <a href="<?php echo esc_url(get_permalink(get_page_by_path('camps-de-jour'))); ?>"
                    class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 transition-colors font-semibold text-lg inline-block">
                    Voir nos camps de jour
                </a>
            </div>

        <?php else: ?>

            <!-- WooCommerce Not Active -->
            <div class="bg-white rounded-lg shadow-lg p-12 text-center">
                <h2 class="text-3xl font-bold text-red-600 mb-4">Service non disponible</h2>
                <p class="text-xl text-gray-600">Le système de panier n'est pas disponible pour le moment.</p>
            </div>

        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>