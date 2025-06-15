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

        <div class="content">
            <?php if (class_exists('WooCommerce') && !WC()->cart->is_empty()): ?>
                <div class="grid lg:grid-cols-3 gap-8" id="cart-container">
                    <div class="lg:col-span-2">
                        <div>
                            <div class="flex items-center justify-between mb-6">
                                <h1
                                    class="font-semibold flex items-center gap-2 text-2xl bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent uppercase font-[Oswald] tracking-widest">
                                    Votre
                                    panier</h1>
                                <span class="text-gray-600" id="cart-count">
                                    <?php
                                    $cart_count = WC()->cart->get_cart_contents_count();
                                    echo $cart_count . ' article' . ($cart_count > 1 ? 's' : '');
                                    ?>
                                </span>
                            </div>
                            <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>"
                                method="post">
                                <div class="space-y-6" id="cart-items">
                                    <?php
                                    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                                        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                                        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                                        $date_de_debut = get_field('date_de_debut', $_product->get_id());
                                        $date_de_fin = get_field('date_de_fin', $_product->get_id());
                                        if ($_product && $_product->exists() && $cart_item['quantity'] > 0) {
                                            $product_permalink = $_product->is_visible() ? $_product->get_permalink($cart_item) : '';
                                            ?>
                                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 p-4 border border-gray-200 rounded-lg cart-item"
                                                data-cart-key="<?php echo esc_attr($cart_item_key); ?>">
                                                <!-- Product Image -->
                                                <div class="w-full sm:w-20 sm:h-20 h-32 flex-shrink-0">
                                                    <?php
                                                    $acf_image_url = get_field('image_davant_page', $_product->get_id());
                                                    ?>
                                                    <img src="<?= esc_url($acf_image_url); ?>"
                                                        alt="<?= esc_attr($_product->get_name()); ?>"
                                                        class="w-full h-full object-cover rounded-lg">
                                                </div>

                                                <!-- Product Details -->
                                                <div class="flex-grow w-full sm:w-auto space-y-2 sm:space-y-1">
                                                    <h3
                                                        class="font-bold bg-gradient-to-r transition-colors duration-200 gradient-animate from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent uppercase font-[Oswald] tracking-widest text-sm sm:text-base mb-1">
                                                        <?php
                                                        if ($product_permalink) {
                                                            echo '<a href="' . esc_url($product_permalink) . '">' . $_product->get_name() . '</a>';
                                                        } else {
                                                            echo $_product->get_name();
                                                        }
                                                        ?>
                                                    </h3>

                                                    <div
                                                        class="text-xs sm:text-sm font-[Inter] text-gray-600 mb-2 flex items-center gap-2">
                                                        <svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="w-3 h-3 sm:w-4 sm:h-4 lucide lucide-calendar-days-icon lucide-calendar-days flex-shrink-0">
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
                                                    <div class="hidden sm:block text-sm lg:text-base font-bold text-blue-950">
                                                        <?php echo WC()->cart->get_product_price($_product); ?>
                                                    </div>
                                                    <div class="text-xs sm:text-sm text-gray-600 mb-2">
                                                        <?php
                                                        $dates = get_field('dates', $product_id);
                                                        $details = array();

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
                                                            echo implode(' <span class="mx-2 hidden sm:inline">•</span> ', $details);
                                                        }
                                                        ?>
                                                    </div>

                                                    <div class="text-base sm:hidden font-bold text-blue-950">
                                                        <?php echo WC()->cart->get_product_price($_product); ?>
                                                    </div>
                                                </div>

                                                <!-- Quantity Controls -->
                                                <div
                                                    class="flex flex-row sm:flex-col items-center sm:items-end justify-between sm:justify-center w-full sm:w-auto gap-3 sm:gap-4">

                                                    <div class="flex items-center gap-3">
                                                        <div class="flex items-center border border-gray-300 rounded-lg">
                                                            <button type="button"
                                                                class="quantity-decrease p-1.5 sm:p-2 hover:bg-gray-100 transition-colors"
                                                                data-cart-key="<?php echo esc_attr($cart_item_key); ?>">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                    class="lucide lucide-minus w-3 h-3 sm:w-4 sm:h-4">
                                                                    <path d="M5 12h14"></path>
                                                                </svg>
                                                            </button>
                                                            <span
                                                                class="quantity-display px-2 sm:px-4 py-1.5 sm:py-2 font-medium text-sm sm:text-base min-w-[2rem] text-center"><?= $cart_item['quantity']; ?></span>
                                                            <button type="button"
                                                                class="quantity-increase p-1.5 sm:p-2 hover:bg-gray-100 transition-colors"
                                                                data-cart-key="<?php echo esc_attr($cart_item_key); ?>">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                    class="lucide lucide-plus w-3 h-3 sm:w-4 sm:h-4">
                                                                    <path d="M5 12h14"></path>
                                                                    <path d="M12 5v14"></path>
                                                                </svg>
                                                            </button>
                                                        </div>

                                                        <button type="button"
                                                            class="remove-item p-1.5 sm:p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                                            data-cart-key="<?php echo esc_attr($cart_item_key); ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-trash2 w-4 h-4 sm:w-5 sm:h-5">
                                                                <path d="M3 6h18"></path>
                                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                                                <line x1="10" x2="10" y1="11" y2="17"></line>
                                                                <line x1="14" x2="14" y1="11" y2="17"></line>
                                                            </svg>
                                                        </button>
                                                        <!-- Item Total -->
                                                        <div class="hidden sm:block text-right">
                                                            <div class="font-bold text-blue-950 text-sm lg:text-base item-total">
                                                                <?php echo WC()->cart->get_product_subtotal($_product, $cart_item['quantity']); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Item Total Mobile -->
                                                <div class="sm:hidden w-full text-right border-t border-gray-100 pt-3">
                                                    <div class="font-bold text-blue-950 text-base item-total-mobile">
                                                        Total:
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
                        <div class="sticky top-8" id="order-summary">
                            <h2
                                class="text-xl font-[Oswald] tracking-widest uppercase font-medium mb-4 bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent">
                                Résumé de commande</h2>

                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 font-[Inter]">Sous-total</span>
                                    <span class="font-medium font-[Inter]"
                                        id="cart-subtotal"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                                </div>

                                <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()): ?>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 font-[Inter]">Livraison</span>
                                        <span class="font-medium font-[Inter]" id="shipping-total">
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
                                            <span class="font-medium font-[Inter]"
                                                id="tax-total"><?php echo wc_price(WC()->cart->get_taxes_total()); ?></span>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <div class="border-t border-gray-200 pt-4">
                                    <div class="flex justify-between">
                                        <span class="text-lg font-bold text-blue-950">Total</span>
                                        <span class="text-lg font-bold text-blue-950"
                                            id="cart-total"><?php echo WC()->cart->get_total(); ?></span>
                                    </div>
                                </div>
                            </div>

                            <a href="/commander" class=" transition-colors duration-200 gradient-animate  w-full sm:w-auto bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 text-white rounded-xl
          first:rounded-t-lg last:rounded-b-lg py-4 sm:py-5 sm:px-8 tracking-wider sm:tracking-widest text-md
          text-center flex items-center justify-center gap-2">
                                PROCÉDER AU PAIEMENT
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="inline-block">
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
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="h-12 w-12 lucide lucide-shopping-cart-icon lucide-shopping-cart">
                                <circle cx="8" cy="21" r="1"></circle>
                                <circle cx="19" cy="21" r="1"></circle>
                                <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-2xl mb-4 uppercase font-[Oswald] tracking-widest">Votre panier est vide
                        </h2>
                        <p class="text-white/80 mb-6 max-w-2xl mx-auto font-[Inter] text-lg sm:text-xl">Découvrez nos camps
                            de
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
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Show loading overlay
        // function showLoading() {
        //     document.getElementById('cart-loading').classList.remove('hidden');
        //     document.getElementById('cart-loading').classList.add('flex');
        // }

        // // Hide loading overlay
        // function hideLoading() {
        //     document.getElementById('cart-loading').classList.add('hidden');
        //     document.getElementById('cart-loading').classList.remove('flex');
        // }

        // Update cart totals
        function updateCartTotals(data) {
            console.log('📊 Updating cart totals with data:', data);

            if (data.cart_subtotal) {
                const subtotalEl = document.getElementById('cart-subtotal');
                console.log('💰 Subtotal element:', subtotalEl, 'New value:', data.cart_subtotal);
                if (subtotalEl) subtotalEl.innerHTML = data.cart_subtotal;
            }

            if (data.cart_total) {
                const totalEl = document.getElementById('cart-total');
                console.log('💳 Total element:', totalEl, 'New value:', data.cart_total);
                if (totalEl) totalEl.innerHTML = data.cart_total;
            }

            if (data.tax_total && document.getElementById('tax-total')) {
                document.getElementById('tax-total').innerHTML = data.tax_total;
            }

            if (data.cart_count !== undefined) {
                const cartCount = document.getElementById('cart-count');
                if (cartCount) {
                    console.log('🛒 Cart count:', data.cart_count);
                    cartCount.textContent = data.cart_count + ' article' + (data.cart_count > 1 ? 's' : '');
                }
            }
        }


        // Replace the updateQuantity function in your JavaScript with this fixed version:

        function updateQuantity(cartKey, quantity) {
            console.log('🔄 Starting quantity update for cart key:', cartKey, 'to quantity:', quantity);



            const formData = new FormData();
            formData.append('action', 'update_cart_quantity');
            formData.append('cart_key', cartKey);
            formData.append('quantity', quantity);
            formData.append('nonce', '<?php echo wp_create_nonce('update_cart_quantity'); ?>');

            console.log('📤 Sending data:', {
                action: 'update_cart_quantity',
                cart_key: cartKey,
                quantity: quantity,
                nonce: '<?php echo wp_create_nonce('update_cart_quantity'); ?>'
            });

            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    console.log('📥 Raw response status:', response.status);
                    return response.text();
                })
                .then(responseText => {
                    console.log('📥 Raw response text:', responseText);

                    let data;
                    try {
                        data = JSON.parse(responseText);
                    } catch (e) {
                        console.error('❌ Failed to parse JSON:', e);
                        console.error('❌ Response was:', responseText);

                        alert('Erreur: Réponse du serveur invalide');
                        return;
                    }

                    console.log('📥 Parsed response data:', data);


                    if (data.success) {
                        console.log('✅ Server returned success, processing update...');

                        // FIXED: Access the actual data from the nested structure
                        const responseData = data.data || data; // WordPress AJAX puts data in 'data' property

                        console.log('📊 Actual response data:', responseData);

                        // Find the cart item
                        const cartItem = document.querySelector(`[data-cart-key="${cartKey}"]`);
                        console.log('🎯 Found cart item:', cartItem);

                        if (cartItem) {
                            // Update quantity display
                            const quantityDisplay = cartItem.querySelector('.quantity-display');
                            console.log('🔢 Quantity display element:', quantityDisplay);
                            console.log('🔢 New quantity from server:', responseData.new_quantity, 'Type:', typeof responseData.new_quantity);

                            if (quantityDisplay) {
                                if (responseData.new_quantity !== undefined && responseData.new_quantity !== null) {
                                    quantityDisplay.textContent = responseData.new_quantity;
                                    const headerCartCounts = Array.from(document.getElementsByClassName('cart-count-indicator'));
                                    headerCartCounts.forEach(count => {
                                        const headerCartCount = count.querySelector('.absolute.-top-2.-right-2.flex.items-center.justify-center.w-4.h-4.bg-red-500.text-white.text-xs.rounded-full.font-medium');
                                        headerCartCount.textContent = responseData.cart_count;
                                    });
                                    console.log('✅ Updated quantity display to:', responseData.new_quantity);
                                } else {
                                    console.error('❌ new_quantity is undefined or null');
                                }
                            } else {
                                console.error('❌ Could not find quantity display element');
                            }

                            // Update item totals
                            const itemTotal = cartItem.querySelector('.item-total');
                            const itemTotalMobile = cartItem.querySelector('.item-total-mobile');

                            console.log('💰 Item total element:', itemTotal);
                            console.log('💰 Item total mobile element:', itemTotalMobile);
                            console.log('💰 Item total from server:', responseData.item_total, 'Type:', typeof responseData.item_total);

                            if (itemTotal) {
                                if (responseData.item_total !== undefined && responseData.item_total !== null && responseData.item_total !== '') {
                                    itemTotal.innerHTML = responseData.item_total;
                                    console.log('✅ Updated item total to:', responseData.item_total);
                                } else {
                                    console.error('❌ item_total is undefined, null, or empty');
                                }
                            }

                            if (itemTotalMobile) {
                                if (responseData.item_total !== undefined && responseData.item_total !== null && responseData.item_total !== '') {
                                    itemTotalMobile.innerHTML = 'Total: ' + responseData.item_total;
                                    console.log('✅ Updated mobile item total to:', 'Total: ' + responseData.item_total);
                                } else {
                                    console.error('❌ item_total is undefined for mobile update');
                                }
                            }
                        } else {
                            console.error('❌ Could not find cart item with key:', cartKey);
                        }

                        // Update cart totals with the correct data
                        updateCartTotals(responseData);

                        // If quantity is 0, remove the item
                        if (responseData.new_quantity === 0) {
                            console.log('🗑️ Quantity is 0, removing item');
                            const cartItem = document.querySelector(`[data-cart-key="${cartKey}"]`);
                            if (cartItem) {
                                cartItem.remove();
                            }

                            // Check if cart is empty
                            if (responseData.cart_count === 0) {
                                console.log('🛒 Cart is now empty, reloading page');
                                location.reload();
                            }
                        }
                    } else {
                        console.error('❌ Server returned error:', data);
                        // FIXED: Handle error message properly
                        const errorMessage = data.data ? data.data.message : (data.message || 'Erreur inconnue');
                        alert('Erreur lors de la mise à jour du panier: ' + errorMessage);
                    }
                })
                .catch(error => {

                    console.error('❌ Fetch error:', error);
                    alert('Erreur lors de la mise à jour du panier');
                });
        }

        // Also update the removeItem function similarly:
        function removeItem(cartKey) {
            console.log('🗑️ Removing item with cart key:', cartKey);


            const formData = new FormData();
            formData.append('action', 'remove_cart_item');
            formData.append('cart_key', cartKey);
            formData.append('nonce', '<?php echo wp_create_nonce('remove_cart_item'); ?>');

            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    console.log('📥 Remove item response:', data);


                    if (data.success) {
                        // FIXED: Access the actual data from the nested structure
                        const responseData = data.data || data;

                        // Remove the item from DOM
                        const cartItem = document.querySelector(`[data-cart-key="${cartKey}"]`);
                        if (cartItem) {
                            cartItem.remove();
                        }

                        // Update cart totals with the correct data
                        updateCartTotals(responseData);

                        // Check if cart is empty
                        if (responseData.cart_count === 0) {
                            const container = document.querySelector('.content');
                            container.innerHTML = `<div
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
                            </div>`;
                            const headerCartCounts = Array.from(document.getElementsByClassName('cart-count-indicator'));
                            headerCartCounts.forEach(count => {
                                if (count)
                                    count.remove();
                            });
                        } else {
                            const headerCartCounts = Array.from(document.getElementsByClassName('cart-count-indicator'));
                            headerCartCounts.forEach(count => {
                                if (count) {
                                    const headerCartCount = count.querySelector('.absolute.-top-2.-right-2.flex.items-center.justify-center.w-4.h-4.bg-red-500.text-white.text-xs.rounded-full.font-medium');
                                    headerCartCount.textContent = responseData.cart_count;
                                }
                            });
                        }
                    } else {
                        console.error('❌ Remove item error:', data);
                        const errorMessage = data.data ? data.data.message : (data.message || 'Erreur inconnue');
                        alert('Erreur lors de la suppression: ' + errorMessage);
                    }
                })
                .catch(error => {

                    console.error('❌ Remove item fetch error:', error);
                    alert('Erreur lors de la suppression');
                });
        }

        // Event listeners for quantity buttons
        document.querySelectorAll('.quantity-increase').forEach(button => {
            button.addEventListener('click', function () {
                const cartKey = this.dataset.cartKey;
                const cartItem = this.closest('.cart-item');
                const quantityDisplay = cartItem.querySelector('.quantity-display');

                console.log('➕ Increase button clicked');
                console.log('🔑 Cart key:', cartKey);
                console.log('📦 Cart item:', cartItem);
                console.log('🔢 Quantity display:', quantityDisplay);

                if (quantityDisplay) {
                    const currentQuantity = parseInt(quantityDisplay.textContent);
                    console.log('🔢 Current quantity:', currentQuantity);
                    updateQuantity(cartKey, currentQuantity + 1);
                } else {
                    console.error('❌ Could not find quantity display element');
                }
            });
        });

        document.querySelectorAll('.quantity-decrease').forEach(button => {
            button.addEventListener('click', function () {
                const cartKey = this.dataset.cartKey;
                const cartItem = this.closest('.cart-item');
                const quantityDisplay = cartItem.querySelector('.quantity-display');

                console.log('➖ Decrease button clicked');
                console.log('🔑 Cart key:', cartKey);

                if (quantityDisplay) {
                    const currentQuantity = parseInt(quantityDisplay.textContent);
                    console.log('🔢 Current quantity:', currentQuantity);
                    if (currentQuantity > 1) {
                        updateQuantity(cartKey, currentQuantity - 1);
                    } else {
                        removeItem(cartKey);
                    }
                } else {
                    console.error('❌ Could not find quantity display element');
                }
            });
        });

        // Event listeners for remove buttons
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function () {
                const cartKey = this.dataset.cartKey;
                console.log('🗑️ Remove button clicked for cart key:', cartKey);
                removeItem(cartKey);
            });
        });

        // Debug: Log all cart items and their structure
        console.log('🔍 Debugging cart structure:');
        document.querySelectorAll('.cart-item').forEach((item, index) => {
            console.log(`Cart item ${index}:`, {
                element: item,
                cartKey: item.dataset.cartKey,
                quantityDisplay: item.querySelector('.quantity-display'),
                itemTotal: item.querySelector('.item-total'),
                itemTotalMobile: item.querySelector('.item-total-mobile')
            });
        });
    });
</script>

<?php get_footer(); ?>