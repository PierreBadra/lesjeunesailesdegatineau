<?php
/*
Template Name: Commande
*/

get_header();
?>

<div class="pt-24 min-h-screen bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Finaliser votre commande</h1>
        
        <?php if (class_exists('WooCommerce') && !WC()->cart->is_empty()) : ?>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Checkout Form -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Informations de facturation</h2>
                    
                    <?php
                    // Start checkout form
                    $checkout = WC()->checkout();
                    ?>
                    
                    <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
                        
                        <div class="space-y-6">
                            <!-- Billing Fields -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="billing_first_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Prénom <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="billing_first_name" id="billing_first_name" 
                                           value="<?php echo esc_attr($checkout->get_value('billing_first_name')); ?>"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                                
                                <div>
                                    <label for="billing_last_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nom <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="billing_last_name" id="billing_last_name" 
                                           value="<?php echo esc_attr($checkout->get_value('billing_last_name')); ?>"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                            </div>
                            
                            <div>
                                <label for="billing_email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Adresse e-mail <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="billing_email" id="billing_email" 
                                       value="<?php echo esc_attr($checkout->get_value('billing_email')); ?>"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            
                            <div>
                                <label for="billing_phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    Téléphone <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" name="billing_phone" id="billing_phone" 
                                       value="<?php echo esc_attr($checkout->get_value('billing_phone')); ?>"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            
                            <div>
                                <label for="billing_address_1" class="block text-sm font-medium text-gray-700 mb-2">
                                    Adresse <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="billing_address_1" id="billing_address_1" 
                                       value="<?php echo esc_attr($checkout->get_value('billing_address_1')); ?>"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="billing_city" class="block text-sm font-medium text-gray-700 mb-2">
                                        Ville <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="billing_city" id="billing_city" 
                                           value="<?php echo esc_attr($checkout->get_value('billing_city')); ?>"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                                
                                <div>
                                    <label for="billing_postcode" class="block text-sm font-medium text-gray-700 mb-2">
                                        Code postal <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="billing_postcode" id="billing_postcode" 
                                           value="<?php echo esc_attr($checkout->get_value('billing_postcode')); ?>"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                            </div>
                            
                            <div>
                                <label for="billing_country" class="block text-sm font-medium text-gray-700 mb-2">
                                    Pays <span class="text-red-500">*</span>
                                </label>
                                <select name="billing_country" id="billing_country" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="CA" <?php selected($checkout->get_value('billing_country'), 'CA'); ?>>Canada</option>
                                    <option value="US" <?php selected($checkout->get_value('billing_country'), 'US'); ?>>États-Unis</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="order_comments" class="block text-sm font-medium text-gray-700 mb-2">
                                    Notes de commande (optionnel)
                                </label>
                                <textarea name="order_comments" id="order_comments" rows="4" 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                          placeholder="Notes sur votre commande, par exemple des instructions spéciales pour la livraison."><?php echo esc_textarea($checkout->get_value('order_comments')); ?></textarea>
                            </div>
                        </div>
                        
                        <!-- Payment Methods -->
                        <div class="mt-8">
                            <h3 class="text-xl font-semibold mb-4 text-gray-800">Méthode de paiement</h3>
                            <div class="space-y-4">
                                <?php
                                $available_gateways = WC()->payment_gateways->get_available_payment_gateways();
                                if (!empty($available_gateways)) {
                                    foreach ($available_gateways as $gateway) {
                                        ?>
                                        <div class="border border-gray-300 rounded-lg p-4">
                                            <label class="flex items-center cursor-pointer">
                                                <input type="radio" name="payment_method" value="<?php echo esc_attr($gateway->id); ?>" 
                                                       class="mr-3 text-blue-600 focus:ring-blue-500" 
                                                       <?php checked($gateway->chosen, true); ?>>
                                                <span class="font-medium"><?php echo $gateway->get_title(); ?></span>
                                            </label>
                                            <?php if ($gateway->has_fields() || $gateway->get_description()) : ?>
                                                <div class="mt-3 ml-6 text-sm text-gray-600">
                                                    <?php $gateway->payment_fields(); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        
                        <!-- Place Order Button -->
                        <div class="mt-8">
                            <?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>
                            <button type="submit" name="woocommerce_checkout_place_order" id="place_order" 
                                    class="w-full bg-green-600 text-white py-4 px-6 rounded-lg hover:bg-green-700 transition-colors font-semibold text-lg">
                                Finaliser la commande
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Order Summary -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Résumé de votre commande</h2>
                    
                    <div class="space-y-4 mb-6">
                        <?php
                        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                            $_product = $cart_item['data'];
                            if ($_product && $_product->exists() && $cart_item['quantity'] > 0) {
                                ?>
                                <div class="flex items-center gap-4 py-4 border-b border-gray-200">
                                    <div class="w-16 h-16 flex-shrink-0">
                                        <?php echo $_product->get_image('thumbnail', array('class' => 'w-full h-full object-cover rounded')); ?>
                                    </div>
                                    <div class="flex-grow">
                                        <h4 class="font-medium text-gray-800"><?php echo $_product->get_name(); ?></h4>
                                        <p class="text-sm text-gray-600">Quantité: <?php echo $cart_item['quantity']; ?></p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-gray-800">
                                            <?php echo WC()->cart->get_product_subtotal($_product, $cart_item['quantity']); ?>
                                        </p>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    
                    <!-- Totals -->
                    <div class="space-y-3">
                        <div class="flex justify-between py-2 border-b border-gray-200">
                            <span class="text-gray-600">Sous-total:</span>
                            <span class="font-semibold"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                        </div>
                        
                        <?php if (WC()->cart->needs_shipping()) : ?>
                            <div class="flex justify-between py-2 border-b border-gray-200">
                                <span class="text-gray-600">Livraison:</span>
                                <span class="font-semibold">Gratuite</span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) : ?>
                            <div class="flex justify-between py-2 border-b border-gray-200">
                                <span class="text-gray-600">Taxes:</span>
                                <span class="font-semibold"><?php wc_cart_totals_taxes_total_html(); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <div class="flex justify-between py-4 text-xl font-bold text-gray-800 border-t-2 border-gray-300">
                            <span>Total:</span>
                            <span class="text-green-600"><?php wc_cart_totals_order_total_html(); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php elseif (class_exists('WooCommerce')) : ?>
            
            <!-- Empty Cart -->
            <div class="bg-white rounded-lg shadow-lg p-12 text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Votre panier est vide</h2>
                <p class="text-xl text-gray-600 mb-8">Vous devez ajouter des articles à votre panier avant de pouvoir passer commande.</p>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('camps-de-jour'))); ?>" 
                   class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 transition-colors font-semibold text-lg inline-block">
                    Voir nos camps de jour
                </a>
            </div>
            
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>