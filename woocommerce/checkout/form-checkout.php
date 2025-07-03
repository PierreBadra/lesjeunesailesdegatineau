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
								<a href="/programmes/perfectionnement-avance"
									class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 transition-colors">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
										fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
										stroke-linejoin="round" class="lucide lucide-arrow-left w-4 h-4"
										__v0_r="0,42055,42064">
										<path d="m12 19-7-7 7-7"></path>
										<path d="M19 12H5"></path>
									</svg>
									Retour au programme
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
						<div class="flex items-center gap-2 text-blue-800 mb-2">
							<div class="w-2 h-2 bg-blue-600 rounded-full"></div>
							<span class="font-medium text-sm">Étape <span id="current-step-display">1</span> sur
								3</span>
						</div>
						<p class="text-xs text-blue-700" id="step-description">
							Entrez vos informations de contact
						</p>
					</div>

					<!-- Security Notice -->
					<div class="mt-4 text-center">
						<p class="text-xs text-gray-500">
							<i data-lucide="lock" class="w-3 h-3 inline mr-1"></i>
							Paiement sécurisé • Données protégées • SSL 256-bit
						</p>
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
<script>
	// Application state
	let currentStep = 1;
	let isProcessing = false;
	let children = [];
	let programAvailability = {}; // Track available spots for each program

	// Order items (sample data)
	const orderItems = [
		{
			id: "1",
			name: "Semaine 1 - Programme de perfectionnement avancé",
			price: 180,
			quantity: 1,
			programId: "semaine1-perfectionnement-avance",
			programName: "Semaine 1 - Programme de perfectionnement avancé",
			startDate: "30 juin 2025",
			endDate: "4 juillet 2025"
		},
		{
			id: "2",
			name: "Semaine 2 - Programme de perfectionnement avancé",
			price: 220,
			quantity: 1,
			programId: "semaine2-perfectionnement-avance",
			programName: "Semaine 2 - Programme de perfectionnement avancé",
			startDate: "7 juillet 2025",
			endDate: "11 juillet 2025"
		},
		{
			id: "3",
			name: "Semaine 3 - Programme de perfectionnement avancé",
			price: 220,
			quantity: 2,
			programId: "semaine3-perfectionnement-avance",
			programName: "Semaine 3 - Programme de perfectionnement avancé",
			startDate: "14 juillet 2025",
			endDate: "18 juillet 2025"
		}
	];

	// Initialize program availability tracking
	function initializeProgramAvailability() {
		programAvailability = {};
		orderItems.forEach(item => {
			programAvailability[item.programId] = {
				total: item.quantity,
				available: item.quantity,
				selected: 0
			};
		});
	}

	// Update program availability when checkbox is changed
	function updateProgramAvailability(childId, programId, isChecked) {
		if (!programAvailability[programId]) return;

		const childIndex = children.findIndex(c => c.id === childId);
		if (childIndex === -1) return;

		const child = children[childIndex];
		if (!child.programs) child.programs = [];

		const programIndex = child.programs.indexOf(programId);

		if (isChecked && programIndex === -1) {
			// Adding program to child
			if (programAvailability[programId].available > 0) {
				child.programs.push(programId);
				programAvailability[programId].selected++;
				programAvailability[programId].available--;
			} else {
				// Uncheck the checkbox if no spots available
				const checkbox = document.getElementById(`child-${childId}-program-${programId}`);
				if (checkbox) checkbox.checked = false;
				return;
			}
		} else if (!isChecked && programIndex !== -1) {
			// Removing program from child
			child.programs.splice(programIndex, 1);
			programAvailability[programId].selected--;
			programAvailability[programId].available++;
		}

		// Update all program displays
		updateAllProgramDisplays();

		// Update allocation status (optional)
		updateProgramAllocationStatus();

		// Clear any existing allocation error messages when changes are made
		$('.allocation-error-message').remove();
	}

	// Update all program availability displays
	function updateAllProgramDisplays() {
		const maxChildren = getMaxChildren();

		// Update displays for all children and all programs
		Object.keys(programAvailability).forEach(programId => {
			for (let childId = 1; childId <= maxChildren; childId++) {
				updateProgramDisplay(childId, programId);
			}
		});
	}

	// Helper function to restore click handlers
	function restoreContainerClickHandler(container, checkbox) {
		// Remove any existing listeners by cloning (if needed)
		const newContainer = container.cloneNode(true);
		container.parentNode.replaceChild(newContainer, container);

		// Get the new checkbox reference
		const newCheckbox = newContainer.querySelector('input[type="checkbox"]');

		// Add click event listener to container
		newContainer.addEventListener('click', function (e) {
			if (e.target !== newCheckbox && !newCheckbox.disabled) {
				e.preventDefault();
				e.stopPropagation();
				newCheckbox.click();
			}
		});

		// Add change event listener to checkbox - FIXED VERSION
		newCheckbox.addEventListener('change', function (e) {
			e.stopPropagation();
			const isChecked = e.target.checked;
			const programId = e.target.dataset.programId;
			const childId = parseInt(e.target.dataset.childId);

			// Get the current container reference (not the stale one)
			const currentContainer = e.target.closest('[data-program-container]');
			if (currentContainer) {
				currentContainer.classList.remove('border-red-500');
			}

			updateProgramAvailability(childId, programId, isChecked);
		});

		// Prevent checkbox click from bubbling
		newCheckbox.addEventListener('click', function (e) {
			e.stopPropagation();
		});
	}


	// Update individual program display
	function updateProgramDisplay(childId, programId) {
		const checkbox = document.getElementById(`child-${childId}-program-${programId}`);
		const container = checkbox?.closest('.relative');
		const availabilitySpan = container?.querySelector('.availability-indicator');

		if (!checkbox || !container || !availabilitySpan) return;

		const availability = programAvailability[programId];
		const isChecked = checkbox.checked;

		// Update availability text and styling
		availabilitySpan.textContent = `${availability.available}/${availability.total} places`;

		if (availability.available === 0 && !isChecked) {
			// Program is full and this child doesn't have it selected
			availabilitySpan.textContent = 'Complet';
			availabilitySpan.className = 'availability-indicator text-xs px-2 py-1 rounded-full bg-red-100 text-red-800';

			// Disable the entire container
			container.classList.add('opacity-50', 'cursor-not-allowed');
			container.classList.remove('hover:bg-gray-50', 'hover:border-gray-400', 'cursor-pointer');
			checkbox.disabled = true;

			// Remove click handler by cloning the element
			const newContainer = container.cloneNode(true);
			container.parentNode.replaceChild(newContainer, container);
		} else {
			// Program has spots available or this child has it selected
			availabilitySpan.className = 'availability-indicator text-xs px-2 py-1 rounded-full bg-green-100 text-green-800';

			// Enable the container
			container.classList.remove('opacity-50', 'cursor-not-allowed');
			container.classList.add('hover:bg-gray-50', 'hover:border-gray-400', 'cursor-pointer');
			checkbox.disabled = false;

			// Restore click handler - but we need to re-add event listeners
			restoreContainerClickHandler(container, checkbox);
		}
	}

	// Calculate totals
	function calculateTotals() {
		const subtotal = orderItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
		const tps = subtotal * 0.05;
		const tvq = subtotal * 0.09975;
		const total = subtotal + tps + tvq;

		return { subtotal, tps, tvq, total };
	}

	// Update order summary
	function updateOrderSummary() {
		const orderItemsContainer = document.getElementById('order-items');
		const { subtotal, tps, tvq, total } = calculateTotals();

		// Update order items
		orderItemsContainer.innerHTML = orderItems.map(item => `
		<div class="flex justify-between items-start">
			<div class="flex-grow">
				<h4 class="font-medium text-gray-900 text-sm">${item.name}</h4>
				<span class="text-sm font-medium text-gray-600">× ${item.quantity}</span>
			</div>
			<div class="text-sm font-medium text-gray-900">$${(item.price * item.quantity).toFixed(2)}</div>
		</div>
	`).join('');

		// Update totals
		document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
		document.getElementById('tps').textContent = `$${tps.toFixed(2)}`;
		document.getElementById('tvq').textContent = `$${tvq.toFixed(2)}`;
		document.getElementById('total').textContent = `$${total.toFixed(2)} CAD`;
	}

	// Get unique programs
	function getUniquePrograms() {
		const uniquePrograms = [];
		const seen = new Set();

		orderItems.forEach(item => {
			if (!seen.has(item.programId)) {
				uniquePrograms.push({
					...item
				});
				seen.add(item.programId);
			}
		});

		return uniquePrograms;
	}

	// Get max children
	function getMaxChildren() {
		return Math.max(...orderItems.map(item => item.quantity));
	}

	// Update step indicators
	function updateStepIndicators() {
		for (let i = 1; i <= 3; i++) {
			const indicator = document.getElementById(`step${i}-indicator`);
			const progress = document.getElementById(`progress${i}`);

			if (i < currentStep) {
				indicator.className = 'w-12 h-12 rounded-full flex items-center justify-center font-medium transition-all duration-300 bg-green-600 text-white';
				indicator.querySelector('.lucide-circle-check-big').classList.remove('hidden');
				document.getElementById(`step${i}-indicator-icon`).classList.add('hidden');
				if (progress) progress.className = 'flex-1 h-1 mx-4 transition-all duration-300 bg-green-600';
			} else if (i === currentStep) {
				indicator.className = 'w-12 h-12 rounded-full flex items-center justify-center font-medium transition-all duration-300 bg-blue-600 text-white';
				indicator.querySelector('.lucide-circle-check-big').classList.add('hidden');
				document.getElementById(`step${i}-indicator-icon`).classList.remove('hidden');
				if (progress) progress.className = 'flex-1 h-1 mx-4 transition-all duration-300 bg-gray-200';
			} else {
				indicator.className = 'w-12 h-12 rounded-full flex items-center justify-center font-medium transition-all duration-300 bg-gray-200 text-gray-600';
				if (progress) progress.className = 'flex-1 h-1 mx-4 transition-all duration-300 bg-gray-200';
			}
		}

		// Update progress bar
		const progressBar = document.getElementById('progress-bar');
		if (progressBar) {
			progressBar.style.width = `${((currentStep - 1) / 2) * 100}%`;
		}

		// Update step display
		document.getElementById('current-step-display').textContent = currentStep;

		// Show/hide steps
		for (let i = 1; i <= 3; i++) {
			const stepElement = document.getElementById(`step${i}`);
			if (stepElement) {
				stepElement.style.display = i === currentStep ? 'block' : 'none';
			}
		}
	}

	// Navigate to next step
	function nextStep() {
		if (isProcessing || currentStep >= 3) return;

		// Validate current step before proceeding
		if (!validateCurrentStep()) {
			return;
		}

		const currentStepDiv = document.getElementById(`step${currentStep}`);
		const nextStepDiv = document.getElementById(`step${currentStep + 1}`);

		// Slide current step out to the left
		currentStepDiv.classList.remove('translate-x-0', 'opacity-100');
		currentStepDiv.classList.add('-translate-x-4', 'opacity-0');

		// Prepare next step (positioned to the right)
		requestAnimationFrame(() => {
			nextStepDiv.classList.remove('translate-x-4', 'opacity-0', 'pointer-events-none');
			nextStepDiv.classList.add('translate-x-0', 'opacity-100', 'pointer-events-auto');
		});

		currentStep++;

		if (currentStep === 2) {
			generateAllChildrenForms();
		}

		updateStepIndicators();
	}

	// Navigate to previous step
	function prevStep() {
		if (isProcessing || currentStep <= 1) return;

		const currentStepDiv = document.getElementById(`step${currentStep}`);
		const prevStepDiv = document.getElementById(`step${currentStep - 1}`);

		// Slide current step out to the right
		currentStepDiv.classList.remove('translate-x-0', 'opacity-100');
		currentStepDiv.classList.add('translate-x-4', 'opacity-0', 'pointer-events-none');

		// Slide previous step in from the left
		requestAnimationFrame(() => {
			prevStepDiv.classList.remove('-translate-x-4', 'pointer-events-none');
			prevStepDiv.classList.add('translate-x-0', 'opacity-100', 'pointer-events-auto');
		});

		currentStep--;
		updateStepIndicators();
	}

	// Validate current step
	function validateCurrentStep() {
		switch (currentStep) {
			case 1:
				return validateContactInfo();
			case 2:
				// Validate both children info AND program allocation
				const childrenValid = validateChildrenInfo();
				const allocationValid = validateProgramAllocation();
				return childrenValid && allocationValid;
			case 3:
				return true;
			default:
				return true;
		}
	}

	function validateProgramAllocation() {
		let isValid = true;
		const unallocatedPrograms = [];

		// Check each program's availability
		Object.keys(programAvailability).forEach(programId => {
			const availability = programAvailability[programId];
			if (availability.available > 0) {
				isValid = false;
				// Find the program name for better error messaging
				const program = orderItems.find(item => item.programId === programId);
				if (program) {
					unallocatedPrograms.push({
						programId: program.programId,
						name: program.programName,
						remaining: availability.available
					});
				}
			}
		});

		// Display error message if validation fails
		if (!isValid) {
			// Remove any existing allocation error messages
			$('.allocation-error-message').remove();

			// Create error message
			const errorMessage = document.createElement('div');
			errorMessage.className = 'allocation-error-message bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4';

			const errorTitle = document.createElement('div');
			errorTitle.className = 'font-medium mb-2';
			errorTitle.textContent = 'Tous les programmes doivent être assignés';

			const errorDetails = document.createElement('div');
			errorDetails.className = 'text-sm';

			if (unallocatedPrograms.length === 1) {
				errorDetails.textContent = `Il reste ${unallocatedPrograms[0].remaining} place(s) non assignée(s) pour "${unallocatedPrograms[0].name}".`;
			} else {
				errorDetails.innerHTML = 'Les programmes suivants ont des places non assignées:<ul class="list-disc list-inside mt-1">' +
					unallocatedPrograms.map(prog =>
						`<li>${prog.name}: ${prog.remaining} place(s) restante(s)</li>`
					).join('') + '</ul>';
			}

			errorMessage.appendChild(errorTitle);
			errorMessage.appendChild(errorDetails);

			// Insert error message at the top of the children container
			const childrenContainer = document.getElementById('children-container');
			if (childrenContainer) {
				childrenContainer.insertBefore(errorMessage, childrenContainer.firstChild);

				// Scroll to the error message
				errorMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
			}

			// Highlight unallocated program parents
			unallocatedPrograms.forEach(prog => {
				const els = document.querySelectorAll(`[data-program-container="${prog.programId}"]`);
				if (els) {
					els.forEach(el => {
						el.classList.add('border-red-500');
					});
				}
			});
		} else {
			// Remove any existing allocation error messages if validation passes
			$('.allocation-error-message').remove();

			unallocatedPrograms.forEach(prog => {
				const els = document.querySelectorAll(`[data-program-container="${prog.programId}"]`);
				if (els) {
					els.forEach(el => {
						el.classList.remove('border-red-500');
					});
				}
			});
		}

		return isValid;
	}

	// Validate contact information
	function validateContactInfo() {
		let isValid = true;

		const fields = ['firstName', 'lastName', 'email', 'phone'];
		fields.forEach(field => {
			if (!validateField(field)) {
				isValid = false;
			}
		});

		return isValid;
	}

	// Validate children information
	function validateChildrenInfo() {
		let isValid = true;
		const maxChildren = getMaxChildren();

		// Remove previous error messages and error classes
		$('.child-error-message').remove();
		$('.border-red-500').removeClass('border-red-500');

		for (let i = 1; i <= maxChildren; i++) {
			// Validate First Name, Last Name, and Date of Birth
			if (!validateField(`child-${i}-firstName`)) isValid = false;
			if (!validateField(`child-${i}-lastName`)) isValid = false;
			if (!validateField(`child-${i}-dateOfBirth`)) isValid = false;

			// Validate that at least one program is selected for each child
			const child = children.find(c => c.id === i);
			if (!child) {
				const childForm = document.getElementById(`child-form-${i}`);
				if (childForm) {
					const errorDiv = document.createElement('div');
					errorDiv.className = 'child-error-message text-red-500 text-sm mt-2 p-2 bg-red-50 rounded';
					// errorDiv.textContent = 'Veuillez sélectionner au moins un programme pour cet enfant.';
					childForm.appendChild(errorDiv);
					isValid = false;
				}
			}
		}

		return isValid;
	}

	function generateAllChildrenForms() {
		const container = document.getElementById('children-container');
		if (!container) return;

		container.innerHTML = '';
		const maxChildren = getMaxChildren();
		const programs = getUniquePrograms();

		// Generate forms for all children slots
		for (let i = 1; i <= maxChildren; i++) {
			const childData = children.find(c => c.id === i) || { programs: [] };
			generateChildForm(i, childData, programs, maxChildren);
		}

		// Update all program displays after generating forms
		setTimeout(() => {
			updateAllProgramDisplays();
		}, 100); // Small delay to ensure DOM is ready
	}

	function updateProgramAllocationStatus() {
		// Add this to your program display to show allocation status
		const statusContainer = document.getElementById('allocation-status');
		if (!statusContainer) return;

		const statusHTML = Object.keys(programAvailability).map(programId => {
			const availability = programAvailability[programId];
			const program = orderItems.find(item => item.programId === programId);

			if (!program) return '';

			const isFullyAllocated = availability.available === 0;
			const statusClass = isFullyAllocated ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800';
			const statusText = isFullyAllocated ? 'Complet' : `${availability.available} place(s) restante(s)`;

			return `
			<div class="flex items-center justify-between p-3 rounded-lg border ${isFullyAllocated ? 'border-green-200' : 'border-yellow-200'}">
				<span class="font-medium text-gray-900">${program.programName}</span>
				<span class="text-xs px-2 py-1 rounded-full ${statusClass}">${statusText}</span>
			</div>
		`;
		}).join('');

		statusContainer.innerHTML = `
		<div class="bg-white p-4 rounded-lg border border-gray-200">
			<h4 class="font-medium text-gray-900 mb-3">État d'allocation des programmes</h4>
			<div class="space-y-2">
				${statusHTML}
			</div>
		</div>
	`;
	}

	// Generate children forms
	function generateChildForm(childId, childData, programs, maxChildren) {
		const container = document.getElementById('children-container');
		if (!container) return;

		const childForm = document.createElement('div');
		childForm.id = `child-form-${childId}`;
		childForm.className = 'bg-white p-6 rounded-lg border border-gray-200';
		childForm.innerHTML = `
		<h3 class="text-lg font-semibold text-gray-900 mb-4">Enfant ${childId}</h3>
		<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
			<div>
				<label for="child-${childId}-firstName" class="block text-sm font-medium text-gray-700 mb-2">Prénom *</label>
				<input type="text" id="child-${childId}-firstName" value="${childData.firstName || ''}" 
					class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
			</div>
			<div>
				<label for="child-${childId}-lastName" class="block text-sm font-medium text-gray-700 mb-2">Nom de famille *</label>
				<input type="text" id="child-${childId}-lastName" value="${childData.lastName || ''}" 
					class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
			</div>
		</div>
		<div class="mb-4">
			<label for="child-${childId}-dateOfBirth" class="block text-sm font-medium text-gray-700 mb-2">Date de naissance *</label>
			<input type="date" id="child-${childId}-dateOfBirth" value="${childData.dateOfBirth || ''}" 
				class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
		</div>
		<div class="mb-4">
			<label for="child-${childId}-allergies" class="block text-sm font-medium text-gray-700 mb-2">Allergies</label>
			<textarea id="child-${childId}-allergies" value="${childData.allergies || ''}" 
				class="w-full resize-none h-fit px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"></textarea>
		</div>
		<label class="block text-sm font-medium text-gray-700 mb-2">Programmes sélectionnés</label> 
		<div class="space-y-2">
			${programs.map(program => {
			const availability = programAvailability[program.programId];
			const isChecked = childData.programs && childData.programs.includes(program.programId);

			return `
				<div class="relative rounded-lg border transition-all duration-200 border-gray-300 bg-white hover:bg-gray-50 hover:border-gray-400 cursor-pointer has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50" data-program-container="${program.programId}">
					<div class="flex items-center p-4">
						<input class="w-5 h-5 text-blue-600 border-2 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" 
							   type="checkbox" 
							   id="child-${childId}-program-${program.programId}"  
							   data-child-id="${childId}" 
							   data-program-id="${program.programId}"
							   ${isChecked ? 'checked' : ''}>
						<div class="ml-4 flex-grow">
							<div class="flex flex-col-reverse lg:flex-row items-start lg:items-center justify-between">
								<h4 class="font-medium text-gray-900">${program.name}</h4>
								<div class="flex items-center gap-2">
									<span class="availability-indicator text-xs px-2 py-1 rounded-full bg-green-100 text-green-800">${availability.available}/${availability.total} places</span>
								</div>
							</div>
							<p class="flex items-center gap-1 text-sm mt-1 text-gray-600">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4">
									<path d="M8 2v4"></path>
									<path d="M16 2v4"></path>
									<rect width="18" height="18" x="3" y="4" rx="2"></rect>
									<path d="M3 10h18"></path>
								</svg>
								Du ${program.startDate} au ${program.endDate}
							</p>
						</div>
					</div>
					<div class="absolute top-2 right-2 opacity-0 has-[:checked]:opacity-100 transition-opacity">
						<div class="w-2 h-2 bg-blue-500 rounded-full"></div>
					</div>
				</div>`;
		}).join('')}
		</div>
	`;

		container.appendChild(childForm);

		// Add event listeners after the form is added to the DOM
		addEventListenersToChildForm(childId, programs);
	}

	// Separate function to add event listeners
	function addEventListenersToChildForm(childId, programs) {
		programs.forEach(program => {
			const checkbox = document.getElementById(`child-${childId}-program-${program.programId}`);
			const container = checkbox?.closest('[data-program-container]');
			console.log(container);

			if (checkbox && container) {
				// Add change event listener to checkbox
				checkbox.addEventListener('change', function (e) {
					e.stopPropagation();
					const isChecked = e.target.checked;
					const programId = e.target.dataset.programId;
					const childId = parseInt(e.target.dataset.childId);

					container.classList.remove('border-red-500');

					updateProgramAvailability(childId, programId, isChecked);
				});

				// Add click event listener to container
				container.addEventListener('click', function (e) {
					if (e.target !== checkbox && !checkbox.disabled) {
						e.preventDefault();
						checkbox.click();
					}
				});

				// Prevent checkbox click from bubbling to container
				checkbox.addEventListener('click', function (e) {
					e.stopPropagation();
				});
			}
		});

		// Add event listeners for form fields
		addFormFieldListeners(childId);
	}

	// Function to add form field event listeners
	function addFormFieldListeners(childId) {
		const firstNameInput = document.getElementById(`child-${childId}-firstName`);
		const lastNameInput = document.getElementById(`child-${childId}-lastName`);
		const dobInput = document.getElementById(`child-${childId}-dateOfBirth`);

		if (firstNameInput) {
			firstNameInput.addEventListener('blur', function () {
				validateField(`child-${childId}-firstName`);
				updateChildData(childId, 'firstName', this.value);
			});
		}

		if (lastNameInput) {
			lastNameInput.addEventListener('blur', function () {
				validateField(`child-${childId}-lastName`);
				updateChildData(childId, 'lastName', this.value);
			});
		}

		if (dobInput) {
			dobInput.addEventListener('blur', function () {
				validateField(`child-${childId}-dateOfBirth`);
				updateChildData(childId, 'dateOfBirth', this.value);
			});
		}
	}

	// Helper function to update child program selection
	function updateChildProgramSelection(childId, programId, isSelected) {
		const childIndex = children.findIndex(c => c.id === childId);
		if (childIndex === -1) return;

		const child = children[childIndex];
		if (!child.programs) {
			child.programs = [];
		}

		const programIndex = child.programs.indexOf(programId);

		if (isSelected && programIndex === -1) {
			child.programs.push(programId);
		} else if (!isSelected && programIndex !== -1) {
			child.programs.splice(programIndex, 1);
		}

		// console.log(`Updated child ${childId} programs:`, child.programs);
	}

	// Helper function to update child data
	function updateChildData(childId, field, value) {
		const childIndex = children.findIndex(c => c.id === childId);
		if (childIndex === -1) return;

		children[childIndex][field] = value;
		// console.log(`Updated child ${childId} ${field}:`, value);
	}

	// Alternative approach using event delegation (more efficient for many elements)
	function setupEventDelegation() {
		const container = document.getElementById('children-container');
		if (!container) return;

		// Use event delegation for all program checkboxes
		container.addEventListener('change', function (e) {
			if (e.target.type === 'checkbox' && e.target.id.includes('-program-')) {
				const isChecked = e.target.checked;
				const programId = e.target.dataset.programId;
				const childId = parseInt(e.target.dataset.childId);

				// Call your program availability update function
				if (typeof updateProgramAvailability === 'function') {
					updateProgramAvailability(childId, programId, isChecked);
				}

				// Update child data
				updateChildProgramSelection(childId, programId, isChecked);

				console.log(`Program ${programId} for child ${childId} is ${isChecked ? 'selected' : 'deselected'}`);
			}
		});

		// Handle container clicks
		container.addEventListener('click', function (e) {
			const programContainer = e.target.closest('[data-program-container]');
			if (programContainer) {
				const checkbox = programContainer.querySelector('input[type="checkbox"]');
				if (checkbox && e.target !== checkbox && !checkbox.disabled) {
					checkbox.click();
				}
			}
		});
	}

	// Generate payment summary
	function generatePaymentSummary() {
		const container = document.getElementById('payment-summary');
		if (!container) return;

		const { subtotal, tps, tvq, total } = calculateTotals();

		container.innerHTML = `
		<div class="bg-gray-50 p-6 rounded-lg">
			<h3 class="text-lg font-semibold text-gray-900 mb-4">Résumé de la commande</h3>
			<div class="space-y-2 mb-4">
				${orderItems.map(item => `
					<div class="flex justify-between text-sm">
						<span>${item.name} (×${item.quantity})</span>
						<span>$${(item.price * item.quantity).toFixed(2)}</span>
					</div>
				`).join('')}
			</div>
			<div class="border-t pt-4 space-y-2">
				<div class="flex justify-between text-sm">
					<span>Sous-total</span>
					<span>$${subtotal.toFixed(2)}</span>
				</div>
				<div class="flex justify-between text-sm">
					<span>TPS (5%)</span>
					<span>$${tps.toFixed(2)}</span>
				</div>
				<div class="flex justify-between text-sm">
					<span>TVQ (9.975%)</span>
					<span>$${tvq.toFixed(2)}</span>
				</div>
				<div class="flex justify-between text-lg font-semibold border-t pt-2">
					<span>Total</span>
					<span>$${total.toFixed(2)} CAD</span>
				</div>
			</div>
		</div>
	`;
	}

	// Show error message
	function showError(message) {
		const errorElement = document.getElementById('error-message');
		if (errorElement) {
			errorElement.textContent = message;
			errorElement.style.display = 'block';
			setTimeout(() => {
				errorElement.style.display = 'none';
			}, 5000);
		} else {
			alert(message);
		}
	}

	// Show success message
	function showSuccess(message) {
		const successElement = document.getElementById('success-message');
		if (successElement) {
			successElement.textContent = message;
			successElement.style.display = 'block';
			setTimeout(() => {
				successElement.style.display = 'none';
			}, 5000);
		} else {
			alert(message);
		}
	}

	// Process payment
	function processPayment() {
		if (isProcessing) return;

		isProcessing = true;
		const submitButton = document.getElementById('submit-payment');
		if (submitButton) {
			submitButton.disabled = true;
			submitButton.textContent = 'Traitement en cours...';
		}

		// Simulate payment processing
		setTimeout(() => {
			isProcessing = false;
			if (submitButton) {
				submitButton.disabled = false;
				submitButton.textContent = 'Confirmer le paiement';
			}
			showSuccess('Paiement traité avec succès!');

			// Redirect or show confirmation
			setTimeout(() => {
				window.location.href = '/confirmation';
			}, 2000);
		}, 3000);
	}

	function initializeChildren() {
		const maxChildren = getMaxChildren();
		children = [];

		// Create empty child objects for each slot
		for (let i = 1; i <= maxChildren; i++) {
			children.push({
				id: i,
				firstName: '',
				lastName: '',
				dateOfBirth: '',
				allergies: '',
				programs: [] // This will track which programs each child has selected
			});
		}
	}
	// Initialize application
	function initializeApp() {
		initializeProgramAvailability();
		initializeChildren();
		updateStepIndicators();
		updateOrderSummary();

		// Add event listeners for navigation buttons
		const nextButtons = document.querySelectorAll('[data-action="next"]');
		const prevButtons = document.querySelectorAll('[data-action="prev"]');
		const submitButton = document.getElementById('submit-payment');

		nextButtons.forEach(button => {
			button.addEventListener('click', nextStep);
		});

		prevButtons.forEach(button => {
			button.addEventListener('click', prevStep);
		});

		if (submitButton) {
			submitButton.addEventListener('click', processPayment);
		}

		$('#cc-number').payment('formatCardNumber');
		$('#cc-exp').payment('formatCardExpiry');
		$('#cc-cvc').payment('formatCardCVC');

		$('#checkout-form').on('submit', function (e) {
			e.preventDefault();
			var cardType = $.payment.cardType($('#cc-number').val());
			let validNumber = $.payment.validateCardNumber($('#cc-number').val());
			let validExpiry = $.payment.validateCardExpiry($('#cc-exp').val());
			let validCVC = $.payment.validateCardCVC($('#cc-cvc').val(), cardType);

			console.log($.payment.validateCardExpiry('10-27'));

			console.log('Number:', $('#cc-number').val(), 'Valid:', validNumber);
			console.log('Expiry:', $('#cc-exp').val(), 'Valid:', validExpiry);
			console.log('CVC:', $('#cc-cvc').val(), 'Valid:', validCVC);

			if (validNumber && validExpiry && validCVC) {
				processPayment();
			} else {
				showError('Veuillez vérifier les informations de votre carte.');
			}
		});

		$(document).ready(function () {
			$('#firstName').on('blur', function () {
				validateField('firstName');
			});

			$('#lastName').on('blur', function () {
				validateField('lastName');
			});

			$('#email').on('blur', function () {
				validateField('email');
			});

			$('#phone').on('blur', function () {
				validateField('phone');
			});
		});
	}

	// Individual field validation function
	function validateField(fieldId) {
		// Clear previous error for this field
		$(`#${fieldId}`).removeClass('border-red-500');
		$(`#${fieldId}`).next('.error-message').remove();

		function showError(message) {
			$(`#${fieldId}`).addClass('border-red-500');
			$(`#${fieldId}`).after(`<div class="error-message text-red-500 text-sm mt-1">${message}</div>`);
		}

		const value = $(`#${fieldId}`).val().trim();

		switch (true) {
			case fieldId.includes('firstName'):
				if (!value) {
					showError('Le prénom est requis');
					return false;
				}
				break;

			case fieldId.includes('lastName'):
				if (!value) {
					showError('Le nom de famille est requis');
					return false;
				}
				break;

			case fieldId === 'email':
				if (!value) {
					showError('L\'adresse courriel est requise');
					return false;
				} else {
					const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
					if (!emailRegex.test(value)) {
						showError('Veuillez entrer une adresse courriel valide');
						return false;
					}
				}
				break;

			case fieldId === 'phone':
				if (!value) {
					showError('Le numéro de téléphone est requis');
					return false;
				} else {
					const phoneRegex = /^[\+]?[1]?[\s\-\.]?\(?([0-9]{3})\)?[\s\-\.]?([0-9]{3})[\s\-\.]?([0-9]{4})$/;
					if (!phoneRegex.test(value)) {
						showError('Veuillez entrer un numéro de téléphone valide');
						return false;
					}
				}
				break;
			case fieldId.includes('dateOfBirth'):
				if (!value) {
					showError('La date de naissance est requise');
					return false;
				}

				// check if dob is in the future or even better if dob is smaller than the smallest possible age range (to restrict adding 2 month old, etc)

				else {
					// validation if dob matches the right age range for the selected programs
				}
				break;
		}

		return true;
	}

	document.addEventListener('DOMContentLoaded', initializeApp);
</script>


<?php do_action('woocommerce_after_checkout_form', $checkout); ?>