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

<form name="checkout" method="post" class="checkout woocommerce-checkout"
	action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data"
	aria-label="<?php echo esc_attr__('Checkout', 'woocommerce'); ?>">
	lsfkjsdjlk
	<?php if ($checkout->get_checkout_fields()): ?>

		<?php do_action('woocommerce_checkout_before_customer_details'); ?>

		<div class="col2-set" id="customer_details">
			<div class="col-1">
				<?php do_action('woocommerce_checkout_billing'); ?>
			</div>

			<div class="col-2">
				<?php do_action('woocommerce_checkout_shipping'); ?>
			</div>
		</div>

		<?php do_action('woocommerce_checkout_after_customer_details'); ?>

	<?php endif; ?>

	<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

	<h3 id="order_review_heading"><?php esc_html_e('Your order', 'woocommerce'); ?></h3>

	<?php do_action('woocommerce_checkout_before_order_review'); ?>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<?php do_action('woocommerce_checkout_order_review'); ?>
	</div>

	<?php do_action('woocommerce_checkout_after_order_review'); ?>

</form>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>

<div class="container mx-auto px-4 py-8" __v0_r="0,5212,5241">
	<div class="mb-8" __v0_r="0,5293,5299">
		<nav class="flex items-center gap-2 text-sm text-gray-600" __v0_r="0,5326,5373"><a href="/"
				class="hover:text-blue-600" __v0_r="0,5412,5433">Accueil</a><span>/</span><a href="/panier"
				class="hover:text-blue-600" __v0_r="0,5547,5568">Panier</a><span>/</span><span class="text-gray-900"
				__v0_r="0,5666,5681">Commander</span></nav>
	</div>
	<form class="grid lg:grid-cols-3 gap-8" __v0_r="0,5780,5807">
		<div class="lg:col-span-2 space-y-8" __v0_r="0,5862,5887">
			<div class="bg-white rounded-xl shadow-lg p-6" __v0_r="0,5953,5988">
				<div class="text-center" __v0_r="0,6019,6032">
					<div class="bg-gray-100 rounded-lg p-4 mb-4" __v0_r="0,6065,6098">
						<p class="text-gray-600 text-sm" __v0_r="0,6131,6154">Paiement express disponible</p>
						<div class="flex justify-center gap-4 mt-3" __v0_r="0,6220,6252">
							<div class="bg-black text-white px-4 py-2 rounded text-sm" __v0_r="0,6289,6336">Apple Pay
							</div>
							<div class="bg-blue-600 text-white px-4 py-2 rounded text-sm" __v0_r="0,6388,6438">Google
								Pay</div>
						</div>
					</div>
					<p class="text-gray-500 text-sm" __v0_r="0,6533,6556">— OU —</p>
				</div>
			</div>
			<div class="bg-white rounded-xl shadow-lg p-6" __v0_r="0,6691,6726">
				<div class="flex items-center gap-3 mb-6" __v0_r="0,6757,6787"><svg xmlns="http://www.w3.org/2000/svg"
						width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
						stroke-linecap="round" stroke-linejoin="round"
						class="lucide lucide-credit-card w-6 h-6 text-blue-600" __v0_r="0,6827,6850">
						<rect width="20" height="14" x="2" y="5" rx="2"></rect>
						<line x1="2" x2="22" y1="10" y2="10"></line>
					</svg>
					<h3 class="text-xl font-bold text-gray-900" __v0_r="0,6884,6917">Détails de facturation et paiement
					</h3><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
						stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
						class="lucide lucide-lock w-5 h-5 text-green-600" __v0_r="0,6990,7014">
						<rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
						<path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
					</svg>
				</div>
				<div class="mb-8" __v0_r="0,7112,7118">
					<h4 class="text-lg font-semibold text-gray-900 mb-4" __v0_r="0,7150,7192">Informations personnelles
					</h4>
					<div class="grid md:grid-cols-2 gap-4 mb-4" __v0_r="0,7256,7288">
						<div><label for="billing_first_name" class="block text-sm font-medium text-gray-700 mb-2"
								__v0_r="0,7380,7426">Prénom <span class="text-red-500"
									__v0_r="0,7473,7487">*</span></label><input id="billing_first_name" required=""
								class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
								__v0_r="0,7853,7982" type="text" value="" name="billing_first_name"></div>
						<div><label for="billing_last_name" class="block text-sm font-medium text-gray-700 mb-2"
								__v0_r="0,8121,8167">Nom <span class="text-red-500"
									__v0_r="0,8211,8225">*</span></label><input id="billing_last_name" required=""
								class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
								__v0_r="0,8588,8717" type="text" value="" name="billing_last_name"></div>
					</div>
					<div class="grid md:grid-cols-2 gap-4" __v0_r="0,8821,8848">
						<div><label for="billing_phone" class="block text-sm font-medium text-gray-700 mb-2"
								__v0_r="0,8935,8981">Téléphone <span class="text-gray-500"
									__v0_r="0,9031,9046">(facultatif)</span></label><input id="billing_phone"
								class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
								__v0_r="0,9376,9505" type="tel" value="" name="billing_phone"></div>
						<div><label for="billing_email" class="block text-sm font-medium text-gray-700 mb-2"
								__v0_r="0,9640,9686">Adresse e-mail <span class="text-red-500"
									__v0_r="0,9741,9755">*</span></label><input id="billing_email" required=""
								class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
								__v0_r="0,10107,10236" type="email" value="" name="billing_email"></div>
					</div>
				</div>
				<div class="mb-8" __v0_r="0,10401,10407">
					<h4 class="text-lg font-semibold text-gray-900 mb-4" __v0_r="0,10439,10481">Adresse de facturation
					</h4>
					<div class="mb-4" __v0_r="0,10542,10548"><label for="billing_country"
							class="block text-sm font-medium text-gray-700 mb-2" __v0_r="0,10611,10657">Pays/région
							<span class="text-red-500" __v0_r="0,10707,10721">*</span></label>
						<div class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50"
							__v0_r="0,10791,10854"><strong>Canada</strong></div><input type="hidden" value="CA"
							name="billing_country">
					</div>
					<div class="mb-4" __v0_r="0,11056,11062"><label for="billing_address_1"
							class="block text-sm font-medium text-gray-700 mb-2" __v0_r="0,11127,11173">Numéro et nom de
							rue <span class="text-red-500" __v0_r="0,11232,11246">*</span></label><input
							id="billing_address_1" placeholder="Numéro de voie et nom de la rue" required=""
							class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
							__v0_r="0,11657,11786" type="text" value="" name="billing_address_1"></div>
					<div class="mb-4" __v0_r="0,11863,11869"><label for="billing_address_2"
							class="block text-sm font-medium text-gray-700 mb-2" __v0_r="0,11934,11980">Appartement,
							suite, unité, etc. <span class="text-gray-500"
								__v0_r="0,12050,12065">(facultatif)</span></label><input id="billing_address_2"
							placeholder="Bâtiment, appartement, lot, etc. (facultatif)"
							class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
							__v0_r="0,12472,12601" type="text" value="" name="billing_address_2"></div>
					<div class="grid md:grid-cols-3 gap-4" __v0_r="0,12678,12705">
						<div><label for="billing_city" class="block text-sm font-medium text-gray-700 mb-2"
								__v0_r="0,12791,12837">Ville <span class="text-red-500"
									__v0_r="0,12883,12897">*</span></label><input id="billing_city" required=""
								class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
								__v0_r="0,13245,13374" type="text" value="" name="billing_city"></div>
						<div><label for="billing_state" class="block text-sm font-medium text-gray-700 mb-2"
								__v0_r="0,13509,13555">Province <span class="text-red-500"
									__v0_r="0,13604,13618">*</span></label><select id="billing_state"
								name="billing_state" required=""
								class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
								__v0_r="0,13936,14065">
								<option value="">Sélectionner une option…</option>
								<option value="AB">Alberta</option>
								<option value="BC">Colombie-Britannique</option>
								<option value="MB">Manitoba</option>
								<option value="NB">Nouveau-Brunswick</option>
								<option value="NL">Terre-Neuve-et-Labrador</option>
								<option value="NT">Territoires du Nord-Ouest</option>
								<option value="NS">Nouvelle-Écosse</option>
								<option value="NU">Nunavut</option>
								<option value="ON">Ontario</option>
								<option value="PE">Île du Prince-Édouard</option>
								<option value="QC">Québec</option>
								<option value="SK">Saskatchewan</option>
								<option value="YT">Yukon</option>
							</select></div>
						<div><label for="billing_postcode" class="block text-sm font-medium text-gray-700 mb-2"
								__v0_r="0,15141,15187">Code postal <span class="text-red-500"
									__v0_r="0,15239,15253">*</span></label><input id="billing_postcode" required=""
								class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
								__v0_r="0,15613,15742" type="text" value="" name="billing_postcode"></div>
					</div>
				</div>
				<div class="border-t border-gray-200 pt-8" __v0_r="0,15907,15938">
					<h4 class="text-lg font-semibold text-gray-900 mb-4" __v0_r="0,15970,16012">Informations de paiement
					</h4>
					<div class="flex items-center gap-3 mb-4" __v0_r="0,16075,16105"><span class="font-medium"
							__v0_r="0,16141,16154">Cartes acceptées:</span>
						<div class="flex gap-2" __v0_r="0,16213,16225"><img alt="Visa" class="h-6"
								__v0_r="0,16315,16320" src="/placeholder.svg?height=24&amp;width=38"><img
								alt="Mastercard" class="h-6" __v0_r="0,16418,16423"
								src="/placeholder.svg?height=24&amp;width=38"><img alt="American Express" class="h-6"
								__v0_r="0,16527,16532" src="/placeholder.svg?height=24&amp;width=38"><img alt="Discover"
								class="h-6" __v0_r="0,16628,16633" src="/placeholder.svg?height=24&amp;width=38"></div>
					</div>
					<div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-4" __v0_r="0,16717,16772">
						<div class="space-y-4" __v0_r="0,16807,16818">
							<div><label for="card_number" class="block text-sm font-medium text-gray-700 mb-2"
									__v0_r="0,16907,16953">Numéro de carte <span class="text-red-500"
										__v0_r="0,17011,17025">*</span></label><input id="card_number"
									placeholder="1234 5678 9012 3456" required=""
									class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
									__v0_r="0,17340,17469" type="text" name="card_number"></div>
							<div class="grid grid-cols-2 gap-4" __v0_r="0,17558,17582">
								<div><label for="card_expiry" class="block text-sm font-medium text-gray-700 mb-2"
										__v0_r="0,17675,17721">Date d'expiration <span class="text-red-500"
											__v0_r="0,17783,17797">*</span></label><input id="card_expiry"
										placeholder="MM/AA" required=""
										class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
										__v0_r="0,18114,18243" type="text" name="card_expiry"></div>
								<div><label for="card_cvc" class="block text-sm font-medium text-gray-700 mb-2"
										__v0_r="0,18388,18434">Code CVC <span class="text-red-500"
											__v0_r="0,18487,18501">*</span></label><input id="card_cvc"
										placeholder="123" required=""
										class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
										__v0_r="0,18810,18939" type="text" name="card_cvc"></div>
							</div>
							<div><label for="card_name" class="block text-sm font-medium text-gray-700 mb-2"
									__v0_r="0,19109,19155">Nom sur la carte <span class="text-red-500"
										__v0_r="0,19214,19228">*</span></label><input id="card_name"
									placeholder="Nom tel qu'il apparaît sur la carte" required=""
									class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
									__v0_r="0,19555,19684" type="text" name="card_name"></div>
						</div>
					</div>
					<div class="flex items-center gap-3 mb-4" __v0_r="0,19817,19847"><input id="save_payment_method"
							class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
							__v0_r="0,20140,20207" type="checkbox" name="save_payment_method"><label
							for="save_payment_method" class="text-sm text-gray-700" __v0_r="0,20294,20317">Enregistrer
							les informations de paiement dans mon compte pour mes prochains achats.</label></div>
					<div class="bg-green-50 border border-green-200 rounded-lg p-4" __v0_r="0,20505,20557">
						<div class="flex items-center gap-2 text-green-800 mb-2" __v0_r="0,20592,20637"><svg
								xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
								fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
								stroke-linejoin="round" class="lucide lucide-lock w-4 h-4" __v0_r="0,20675,20684">
								<rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
								<path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
							</svg><span class="font-medium" __v0_r="0,20724,20737">Paiement sécurisé</span></div>
						<p class="text-sm text-green-700" __v0_r="0,20819,20843">Vos informations de paiement sont
							cryptées et sécurisées. Nous n'enregistrons pas vos données de carte de crédit.</p>
					</div>
				</div>
			</div>
			<div class="bg-white rounded-xl shadow-lg p-6" __v0_r="0,21156,21191">
				<h3 class="text-xl font-bold text-gray-900 mb-6" __v0_r="0,21221,21259">Informations complémentaires
				</h3>
				<div><label for="order_comments" class="block text-sm font-medium text-gray-700 mb-2"
						__v0_r="0,21373,21419">Notes de commande <span class="text-gray-500"
							__v0_r="0,21473,21488">(facultatif)</span></label><textarea id="order_comments"
						name="order_comments"
						placeholder="Commentaires concernant votre commande, ex. : consignes de livraison." rows="3"
						class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
						__v0_r="0,21892,22021"></textarea></div>
			</div>
			<div class="bg-blue-50 border border-blue-200 rounded-xl p-6" __v0_r="0,22147,22197">
				<div class="flex items-start gap-3 mb-4" __v0_r="0,22228,22257"><input id="accept_terms" required=""
						class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mt-1"
						__v0_r="0,22542,22614" type="checkbox" name="accept_terms"><label for="accept_terms"
						class="text-sm text-gray-700" __v0_r="0,22690,22713">J'accepte les <a
							href="/conditions-generales" class="text-blue-600 hover:underline"
							__v0_r="0,22815,22846">conditions générales</a> et la <a href="/politique-confidentialite"
							class="text-blue-600 hover:underline" __v0_r="0,23017,23048">politique de
							confidentialité</a>.</label></div>
				<p class="text-sm text-blue-800" __v0_r="0,23219,23242">Vos données personnelles seront utilisées pour
					le traitement de votre commande, vous accompagner au cours de votre visite du site web, et pour
					d'autres raisons décrites dans notre politique de confidentialité.</p>
			</div>
		</div>
		<div class="lg:col-span-1" __v0_r="0,23615,23630">
			<div class="bg-white rounded-xl shadow-lg p-6 sticky top-8" __v0_r="0,23659,23707">
				<h3 class="text-xl font-bold text-gray-900 mb-6" __v0_r="0,23737,23775">Votre commande</h3>
				<div class="space-y-4 mb-6" __v0_r="0,23860,23876">
					<div class="flex justify-between items-start" __v0_r="0,23969,24003">
						<div class="flex-grow" __v0_r="0,24040,24051">
							<h4 class="font-medium text-gray-900 text-sm" __v0_r="0,24089,24124">Semaine 3 - programme
								de perfectionnement avancé</h4><span class="text-sm font-medium text-gray-600"
								__v0_r="0,24180,24215">× 1</span>
						</div>
						<div class="text-sm font-medium text-gray-900" __v0_r="0,24303,24338">$1.22</div>
					</div>
				</div>
				<div class="border-t border-gray-200 pt-4 space-y-3" __v0_r="0,24519,24560">
					<div class="flex justify-between text-sm" __v0_r="0,24593,24623"><span class="text-gray-600"
							__v0_r="0,24659,24674">Sous-total</span><span class="font-medium"
							__v0_r="0,24727,24740">$1.22</span></div>
					<div class="flex justify-between text-sm" __v0_r="0,24826,24856"><span class="text-gray-600"
							__v0_r="0,24892,24907">TPS</span><span class="font-medium"
							__v0_r="0,24953,24966">$0.06</span></div>
					<div class="flex justify-between text-sm" __v0_r="0,25047,25077"><span class="text-gray-600"
							__v0_r="0,25113,25128">TVQ</span><span class="font-medium"
							__v0_r="0,25174,25187">$0.12</span></div>
					<div class="border-t border-gray-200 pt-3" __v0_r="0,25268,25299">
						<div class="flex justify-between" __v0_r="0,25334,25356"><span class="font-bold text-gray-900"
								__v0_r="0,25394,25419">Total</span><span class="font-bold text-gray-900"
								__v0_r="0,25469,25494">$1.40</span></div>
					</div>
				</div>
				<div class="mt-6 space-y-4" __v0_r="0,25662,25678"><button type="submit"
						class="w-full bg-gradient-to-r from-slate-700 to-slate-900 hover:from-slate-800 hover:to-black text-white px-6 py-4 rounded-lg font-bold transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
						__v0_r="0,25806,26042">Commander</button><a href="/panier"
						class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors text-sm"
						__v0_r="0,26495,26587"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
							viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
							stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left w-4 h-4"
							__v0_r="0,26645,26654">
							<path d="m12 19-7-7 7-7"></path>
							<path d="M19 12H5"></path>
						</svg>Retour au panier</a></div>
				<div class="mt-4 text-center" __v0_r="0,26768,26786">
					<p class="text-xs text-gray-500" __v0_r="0,26817,26840"><svg xmlns="http://www.w3.org/2000/svg"
							width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
							stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
							class="lucide lucide-lock w-3 h-3 inline mr-1" __v0_r="0,26876,26897">
							<rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
							<path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
						</svg>Paiement sécurisé • Données protégées</p>
				</div>
			</div>
		</div>
	</form>
</div>