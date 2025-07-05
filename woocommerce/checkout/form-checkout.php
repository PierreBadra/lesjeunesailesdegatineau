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
		<!-- Progress Bar -->
		<div class="mb-12">
			<div class="max-w-2xl mx-auto">
				<!-- Step Indicators -->
				<div class="flex items-center justify-between mb-4">
					<div class="flex flex-col items-center justify-center">
						<div id="step1-indicator"
							class="w-12 h-12 rounded-full flex items-center justify-center font-medium transition-all duration-300 bg-blue-600 text-white">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
								fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
								stroke-linejoin="round" class="lucide hidden lucide-circle-check-big w-5 h-5"
								__v0_r="0,7185,7194">
								<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
								<path d="m9 11 3 3L22 4"></path>
							</svg>
							<svg id="step1-indicator-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
								viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
								stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-5 h-5"
								__v0_r="0,7241,7250">
								<path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
								<circle cx="12" cy="7" r="4"></circle>
							</svg>
						</div>
					</div>
					<div class="flex flex-col justify-center items-center">
						<div id="step2-indicator"
							class="w-12 h-12 rounded-full flex items-center justify-center font-medium transition-all duration-300 bg-gray-200 text-gray-600">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
								fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
								stroke-linejoin="round" class="lucide hidden lucide-circle-check-big w-5 h-5"
								__v0_r="0,7185,7194">
								<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
								<path d="m9 11 3 3L22 4"></path>
							</svg>
							<svg id="step2-indicator-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
								viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
								stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-5 h-5"
								__v0_r="0,7298,7307">
								<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
								<circle cx="9" cy="7" r="4"></circle>
								<path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
								<path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
							</svg>
						</div>
					</div>
					<div class="flex flex-col items-center justify-center">
						<div id="step3-indicator"
							class="w-12 h-12 rounded-full flex items-center justify-center font-medium transition-all duration-300 bg-gray-200 text-gray-600">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
								fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
								stroke-linejoin="round" class="lucide hidden lucide-circle-check-big w-5 h-5"
								__v0_r="0,7185,7194">
								<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
								<path d="m9 11 3 3L22 4"></path>
							</svg>
							<svg id="step3-indicator-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
								viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
								stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-credit-card w-5 h-5"
								__v0_r="0,7360,7369">
								<rect width="20" height="14" x="2" y="5" rx="2"></rect>
								<line x1="2" x2="22" y1="10" y2="10"></line>
							</svg>
						</div>
					</div>
				</div>

				<!-- Progress Bar -->
				<div class="mt-4 bg-gray-200 rounded-full h-2">
					<div id="progress-bar"
						class="bg-gradient-to-r from-green-600 to-blue-600 h-2 rounded-full transition-all duration-500 ease-out"
						style="width: 0%"></div>
				</div>
			</div>
		</div>

		<div class="grid lg:grid-cols-3 gap-8">
			<!-- Main Form -->
			<div class="lg:col-span-2 relative">
				<form id="checkout-form">
					<!-- Step 1: Billing Information -->
					<div id="step1"
						class="transition-all duration-500 ease-in-out opacity-100 translate-x-0 pointer-events-auto">
						<div class="border border-gray-200 rounded-xl p-8">
							<div class="flex items-center gap-3 mb-8">
								<div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
										fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
										stroke-linejoin="round" class="lucide lucide-user w-6 h-6 text-blue-600"
										__v0_r="0,11017,11040">
										<path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
										<circle cx="12" cy="7" r="4"></circle>
									</svg>
								</div>
								<div>
									<h2 class="text-2xl font-bold text-gray-900">Informations de facturation</h2>
									<p class="text-gray-600">Entrez vos informations de contact</p>
								</div>
							</div>

							<div class="space-y-6">
								<div>
									<label for="email" class="block text-sm font-medium text-gray-700 mb-2">
										Adresse courriel <span class="text-red-500">*</span>
									</label>
									<input type="email" id="email" name="email"
										class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
										placeholder="votre@courriel.com" />
								</div>

								<div class="grid md:grid-cols-2 gap-6">
									<div>
										<label for="firstName" class="block text-sm font-medium text-gray-700 mb-2">
											Prénom <span class="text-red-500">*</span>
										</label>
										<input type="text" id="firstName" name="firstName"
											class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
											placeholder="Votre prénom" />
									</div>

									<div>
										<label for="lastName" class="block text-sm font-medium text-gray-700 mb-2">
											Nom de famille <span class="text-red-500">*</span>
										</label>
										<input type="text" id="lastName" name="lastName"
											class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
											placeholder="Votre nom de famille" />
									</div>
								</div>

								<div>
									<label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
										Numéro de téléphone <span class="text-red-500">*</span>
									</label>
									<input type="tel" id="phone" name="phone"
										class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
										placeholder="(819) 555-0123" />
								</div>
							</div>

							<div class="flex justify-between mt-8">
								<a href="/panier"
									class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
										fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
										stroke-linejoin="round" class="lucide lucide-arrow-left w-4 h-4"
										__v0_r="0,42055,42064">
										<path d="m12 19-7-7 7-7"></path>
										<path d="M19 12H5"></path>
									</svg>
									Retour au panier
								</a>

								<button type="button" id="step1-next" data-action="next"
									class="inline-flex items-center gap-2 bg-gradient-to-r from-slate-700 to-slate-900 hover:from-slate-800 hover:to-black text-white px-8 py-3 rounded-lg font-medium transition-all disabled:opacity-50 disabled:cursor-not-allowed">
									Continuer
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
										fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
										stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4"
										__v0_r="0,15906,15915">
										<path d="M5 12h14"></path>
										<path d="m12 5 7 7-7 7"></path>
									</svg>
								</button>
							</div>
						</div>
					</div>

					<!-- Step 2: Children Information -->
					<div id="step2"
						class="transition-all duration-500 ease-in-out opacity-0 translate-x-4 pointer-events-none">
						<div class="bg-white rounded-xl border border-gray-200  p-8">
							<div class="flex items-center gap-3 mb-8">
								<div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
										fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
										stroke-linejoin="round" class="lucide lucide-users w-6 h-6 text-green-600"
										__v0_r="0,16731,16755">
										<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
										<circle cx="9" cy="7" r="4"></circle>
										<path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
										<path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
									</svg>
								</div>
								<div>
									<h2 class="text-2xl font-bold text-gray-900">Informations des enfants</h2>
									<p class="text-gray-600">Ajoutez les détails de chaque participant</p>
								</div>
							</div>

							<div id="children-container" class="space-y-8 mb-6">
								<!-- Children will be dynamically added here -->
							</div>

							<div class="flex justify-between mt-8">
								<button type="button" id="step2-prev" data-action="prev"
									class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
										fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
										stroke-linejoin="round" class="lucide lucide-arrow-left w-4 h-4"
										__v0_r="0,42055,42064">
										<path d="m12 19-7-7 7-7"></path>
										<path d="M19 12H5"></path>
									</svg>
									Retour
								</button>

								<button type="button" id="step2-next" data-action="next"
									class="inline-flex items-center gap-2 bg-gradient-to-r from-slate-700 to-slate-900 hover:from-slate-800 hover:to-black text-white px-8 py-3 rounded-lg font-medium transition-all disabled:opacity-50 disabled:cursor-not-allowed">
									Continuer
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
										fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
										stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4"
										__v0_r="0,15906,15915">
										<path d="M5 12h14"></path>
										<path d="m12 5 7 7-7 7"></path>
									</svg>
								</button>
							</div>
						</div>
					</div>

					<!-- Step 3: Payment Information -->
					<div id="step3"
						class="transition-all duration-500 ease-in-out opacity-0 translate-x-4 pointer-events-none">
						<div class="border border-gray-200 rounded-xl p-8">
							<div class="flex items-center gap-3 mb-8">
								<div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
										fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
										stroke-linejoin="round"
										class="text-purple-600 lucide lucide-credit-card w-5 h-5" __v0_r="0,7360,7369">
										<rect width="20" height="14" x="2" y="5" rx="2"></rect>
										<line x1="2" x2="22" y1="10" y2="10"></line>
									</svg>
								</div>
								<div>
									<h2 class="text-2xl font-bold text-gray-900">Informations de paiement</h2>
									<p class="text-gray-600">Finalisez votre inscription</p>
								</div>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
									fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
									stroke-linejoin="round" class="lucide lucide-lock w-5 h-5 text-green-600 ml-auto"
									__v0_r="0,34942,34974">
									<rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
									<path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
								</svg>
							</div>

							<div class="space-y-6">
								<div>
									<label for="cc-number" class="block text-sm font-medium text-gray-700 mb-2">
										Numéro de carte <span class="text-red-500">*</span>
									</label>
									<input type="text" id="cc-number" name="cc-number" placeholder="1234 5678 9012 3456"
										class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors" />
								</div>

								<div class="grid md:grid-cols-2 gap-6">
									<div>
										<label for="cc-exp" class="block text-sm font-medium text-gray-700 mb-2">
											Date d'expiration <span class="text-red-500">*</span>
										</label>
										<input type="text" id="cc-exp" name="cc-exp" placeholder="MM/AA" max="5"
											class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors" />
									</div>

									<div>
										<label for="cc-cvc" class="block text-sm font-medium text-gray-700 mb-2">
											CVV <span class="text-red-500">*</span>
										</label>
										<input type="text" id="cc-cvc" name="cc-cvc" placeholder="123"
											class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors" />
									</div>
								</div>

								<div class="flex items-center gap-3">
									<input type="checkbox" id="savePaymentMethod" name="savePaymentMethod"
										class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
									<label for="savePaymentMethod" class="text-sm text-gray-700">
										Enregistrer les informations de paiement pour mes prochains achats
									</label>
								</div>

								<div class="bg-green-50 border border-green-200 rounded-lg p-4">
									<div class="flex items-center gap-2 text-green-800 mb-2">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
											viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
											stroke-linecap="round" stroke-linejoin="round"
											class="lucide lucide-lock w-4 h-4" __v0_r="0,40047,40056">
											<rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
											<path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
										</svg>
										<span class="font-medium">Paiement sécurisé</span>
									</div>
									<p class="text-sm text-green-700">
										Vos informations de paiement sont cryptées et sécurisées. Nous n'enregistrons
										pas vos données de carte de crédit.
									</p>
								</div>

								<div class="flex items-start gap-3">
									<input type="checkbox" id="acceptTerms" name="acceptTerms" required
										class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mt-1" />
									<label for="acceptTerms" class="text-sm text-gray-700">
										J'accepte les
										<a href="/conditions-generales" class="text-blue-600 hover:underline">conditions
											générales</a>
										et la
										<a href="/politique-confidentialite"
											class="text-blue-600 hover:underline">politique de confidentialité</a>.
										<span class="text-red-500">*</span>
									</label>
								</div>
							</div>

							<div class="flex justify-between mt-8">
								<button type="button" id="step3-prev" data-action="prev"
									class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
										fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
										stroke-linejoin="round" class="lucide lucide-arrow-left w-4 h-4"
										__v0_r="0,42055,42064">
										<path d="m12 19-7-7 7-7"></path>
										<path d="M19 12H5"></path>
									</svg>
									Retour
								</button>

								<button type="submit" id="submit-btn"
									class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-8 py-4 rounded-lg font-bold transition-all disabled:opacity-50 disabled:cursor-not-allowed">
									<span id="submit-text">Finaliser l'inscription</span>
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
										fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
										stroke-linejoin="round" class="lucide lucide-lock w-4 h-4"
										__v0_r="0,42981,42990">
										<rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
										<path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
									</svg>
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>

			<!-- Order Summary - Sticky Sidebar -->
			<div class="lg:col-span-1">
				<div class="border border-gray-200 rounded-xl p-6 sticky top-8">
					<h3 class="text-xl font-bold text-gray-900 mb-6">Résumé de l'inscription</h3>

					<!-- Order Items -->
					<div id="order-items" class="space-y-4 mb-6">
						<!-- Items will be populated by JavaScript -->
					</div>

					<!-- Children Summary -->
					<div id="children-summary" class="border-t border-gray-200 pt-4 mb-6 hidden">
						<h4 class="font-medium text-gray-900 mb-3">Participants inscrits</h4>
						<div id="children-list" class="space-y-2">
							<!-- Children will be populated by JavaScript -->
						</div>
					</div>

					<!-- Order Totals -->
					<div class="border-t border-gray-200 pt-4 space-y-3">
						<div class="flex justify-between text-sm">
							<span class="text-gray-600">Sous-total</span>
							<span class="font-medium" id="subtotal">$0.00</span>
						</div>

						<div class="flex justify-between text-sm">
							<span class="text-gray-600">TPS (5%)</span>
							<span class="font-medium" id="tps">$0.00</span>
						</div>

						<div class="flex justify-between text-sm">
							<span class="text-gray-600">TVQ (9.975%)</span>
							<span class="font-medium" id="tvq">$0.00</span>
						</div>

						<div class="border-t border-gray-200 pt-3">
							<div class="flex justify-between">
								<span class="font-bold text-gray-900">Total</span>
								<span class="font-bold text-gray-900" id="total">$0.00 CAD</span>
							</div>
						</div>
					</div>

					<!-- Progress Indicator -->
					<div class="mt-6 p-4 bg-blue-50 rounded-lg">
						<div class="flex items-center gap-2 text-blue-800">
							<div class="w-2 h-2 bg-blue-600 animate-ping rounded-full"></div>
							<span class="font-medium text-sm">Étape <span id="current-step-display">1</span> sur
								3</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	document.querySelectorAll('.woocommerce-message').forEach(el => el.remove());
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/3.0.0/jquery.payment.min.js"></script>


<?php do_action('woocommerce_after_checkout_form', $checkout); ?>