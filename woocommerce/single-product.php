<?php get_header(); ?>

<?php

$days = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
$horaire = get_field('horaire');
$product = wc_get_product();
$category_list = wc_get_product_category_list($product->get_id());
$categories = explode(',', $category_list);
$first_category = trim($categories[0]);
?>
<script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>

<section class="w-full p-6 pt-40">
	<div class="mb-8 container max-w-7xl mx-auto">
		<a href="<?= isset($_SESSION['previous_page']) ? htmlspecialchars($_SESSION['previous_page']) : '/'; ?>"
			class="inline-flex items-center gap-2 text-blue-950 hover:text-blue-900 transition-colors">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
				stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
				class="lucide lucide-arrow-left w-4 h-4">
				<path d="m12 19-7-7 7-7"></path>
				<path d="M19 12H5"></path>
			</svg>
			Retour aux <?= strtolower($first_category); ?>
		</a>
	</div>
	<div class="flex flex-col xl:flex-row items-center gap-8 mb-12 container max-w-7xl mx-auto">
		<!-- Text Content -->
		<div class="w-full xl:w-1/2 text-start">
			<div
				class="flex items-center gap-1 text-blue-950 bg-gradient-to-br from-yellow-400 via-yellow-200 via-white via-yellow-300 to-yellow-600 justify-center px-4 py-1 rounded-md w-fit">
				<svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
					fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
					class="lucide lucide-sun-icon lucide-sun w-4 h-4">
					<circle cx="12" cy="12" r="4"></circle>
					<path d="M12 2v2"></path>
					<path d="M12 20v2"></path>
					<path d="m4.93 4.93 1.41 1.41"></path>
					<path d="m17.66 17.66 1.41 1.41"></path>
					<path d="M2 12h2"></path>
					<path d="M20 12h2"></path>
					<path d="m6.34 17.66-1.41 1.41"></path>
					<path d="m19.07 4.93-1.41 1.41"></path>
				</svg>
				<div class="inline-flex items-center rounded-full border font-semibold 
									transition-colors focus:outline-none focus:ring-2 focus:ring-ring 
									focus:ring-offset-2 border-transparent bg-secondary text-secondary-foreground 
									hover:bg-secondary/80 text-xs font-[Inter]">
					<?= $first_category; ?>
				</div>
			</div>

			<h1
				class="text-3xl sm:text-4xl/10 md:text-5xl/15 font-bold bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent mb-4 uppercase font-[Oswald] tracking-widest">
				<?= $product->get_name(); ?>
			</h1>

			<p class="text-lg sm:text-xl text-gray-600 mb-4 font-[Inter]">
				<?= $product->get_description(); ?>
			</p>

			<?php
			global $product;
			if ($product && $product->is_purchasable() && $product->is_in_stock()):
				?>
				<form class="cart"
					action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
					method="post" enctype='multipart/form-data'>

					<?php
					// Add variation fields if it's a variable product
					if ($product->is_type('variable')) {
						woocommerce_variable_add_to_cart();
					} else {
						// For simple products, just add the hidden product ID
						?>
						<input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" />
						<?php
					}
					?>

					<button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="w-full bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 text-white
		  rounded-xl py-4 sm:py-5 sm:px-8 tracking-wider sm:tracking-widest text-md
		  text-center flex items-center justify-center gap-2 transition-colors duration-200 gradient-animate">
						AJOUTER AU PANIER
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
							class="inline-block">
							<path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2"
								stroke-linecap="round" stroke-linejoin="round" />
						</svg>
					</button>
				</form>
			<?php endif; ?>
		</div>

		<!-- Image -->
		<div class="w-full xl:w-1/2 flex justify-center xl:justify-end">
			<img class="rounded-lg w-full h-full object-cover" src="<?= get_field('image_davant_page'); ?>"
				alt="Image d'avant page">
		</div>
	</div>


	<div class="mb-6 container max-w-7xl mx-auto">
		<div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white text-gray-900"
			data-inactive-classes="text-gray-500">
			<h2 id="accordion-flush-heading-1">
				<button type="button"
					class="min-w-0 flex items-center justify-between w-full py-5 px-4 font-medium mb-6 text-left border-b border-gray-200  bg-white  text-gray-900 "
					data-accordion-target="#accordion-flush-body-1" aria-expanded="true"
					aria-controls="accordion-flush-body-1">
					<div
						class="truncate min-w-0 flex-1 mr-4 font-semibold flex items-center gap-2 text-2xl bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent uppercase font-[Oswald] tracking-widest">
						<svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
							viewBox="0 0 24 24" fill="none" stroke="url(#handshake-gradient)" stroke-width="2"
							stroke-linecap="round" stroke-linejoin="round"
							class="flex-shrink-0 lucide w-6 h-6 lucide-info-icon lucide-info">
							<defs>
								<linearGradient id="handshake-gradient" x1="0" y1="0" x2="24" y2="0"
									gradientUnits="userSpaceOnUse">
									<stop offset="0%" stop-color="#0f172a" /> <!-- slate-900 -->
									<stop offset="50%" stop-color="#1e40af" /> <!-- blue-900 -->
									<stop offset="100%" stop-color="#1e293b" /> <!-- slate-800 -->
								</linearGradient>
							</defs>
							<circle cx="12" cy="12" r="10"></circle>
							<path d="M12 16v-4"></path>
							<path d="M12 8h.01"></path>
						</svg>
						<span
							class="font-semibold text-2xl bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent uppercase font-oswald tracking-widest truncate min-w-0">Informations
							Générales</span>
					</div>
					<svg data-accordion-icon="" class="w-6 h-6 shrink-0 rotate-180" fill="currentColor"
						viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd"
							d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
							clip-rule="evenodd"></path>
					</svg>
				</button>
			</h2>
			<div id="accordion-flush-body-1" class="" aria-labelledby="accordion-flush-heading-1">
				<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
					<div class="rounded-lg border text-card-foreground shadow-sm border-blue-200 bg-blue-50/50">
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
							<h2 class="font-semibold text-blue-950 mb-2 font-[Oswald] tracking-widest uppercase">
								Période</h2>
							<p class="text-sm font-medium text-blue-950"><?= get_field('date_de_debut'); ?></p>
							<p class="text-xs text-gray-600">au</p>
							<p class="text-sm font-medium text-blue-950"><?= get_field('date_de_fin'); ?></p>
						</div>
					</div>
					<div class="rounded-lg border text-card-foreground shadow-sm border-blue-200 bg-blue-50/50">
						<div class="p-6 text-center">
							<svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
								viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
								stroke-linecap="round" stroke-linejoin="round"
								class="mx-auto h-8 w-8 text-blue-950 mb-3 lucide lucide-dollar-sign-icon lucide-dollar-sign">
								<line x1="12" x2="12" y1="2" y2="22"></line>
								<path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
							</svg>
							<h2 class="font-semibold text-blue-950 mb-2 font-[Oswald] tracking-widest uppercase">
								Prix</h2>
							<p class="text-2xl font-bold text-blue-950"><?= $product->get_price(); ?>$</p>
							<p class="text-xs text-gray-600 mt-1">Pour la période complète</p>
						</div>
					</div>
					<div class="rounded-lg border text-card-foreground shadow-sm border-blue-200 bg-blue-50/50">
						<div class="p-6 text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
								viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
								stroke-linecap="round" stroke-linejoin="round"
								class="lucide lucide-users h-8 w-8 text-blue-950 mx-auto mb-3">
								<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
								<circle cx="9" cy="7" r="4"></circle>
								<path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
								<path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
							</svg>
							<h2 class="font-semibold text-blue-950 mb-2 font-[Oswald] tracking-widest uppercase">
								Encadrement</h2>
							<p class="text-sm text-blue-950 font-medium">Éducateurs diplômés</p>
							<p class="text-xs text-gray-600 mt-1">Formation professionnelle</p>
						</div>
					</div>
				</div>
			</div>
			<h2 id="accordion-flush-heading-2">
				<button type="button"
					class="flex items-center justify-between w-full py-5 px-4 mb-6 font-medium text-left border-b border-gray-200  text-gray-500"
					data-accordion-target="#accordion-flush-body-2" aria-expanded="false"
					aria-controls="accordion-flush-body-2">
					<div
						class="truncate min-w-0 flex-1 mr-4 font-semibold flex items-center gap-2 text-2xl bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent uppercase font-[Oswald] tracking-widest">
						<svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
							viewBox="0 0 24 24" fill="none" stroke="url(#handshake-gradient)" stroke-width="2"
							stroke-linecap="round" stroke-linejoin="round"
							class="flex-shrink-0 lucide w-6 h-6 lucide-calendar-days-icon lucide-calendar-days text-blue-950">
							<defs>
								<linearGradient id="handshake-gradient" x1="0" y1="0" x2="24" y2="0"
									gradientUnits="userSpaceOnUse">
									<stop offset="0%" stop-color="#0f172a" /> <!-- slate-900 -->
									<stop offset="50%" stop-color="#1e40af" /> <!-- blue-900 -->
									<stop offset="100%" stop-color="#1e293b" /> <!-- slate-800 -->
								</linearGradient>
							</defs>
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
						<span
							class="font-semibold text-2xl bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent uppercase font-oswald tracking-widest truncate min-w-0">Horaire</span>
					</div>
					<svg data-accordion-icon="" class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
						xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd"
							d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
							clip-rule="evenodd"></path>
					</svg>
				</button>
			</h2>
			<div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
				<?php if (!is_array_fully_empty($horaire)): ?>
					<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
						<?php foreach ($days as $day): ?>
							<?php if (
								$horaire[$day]['nom_de_la_seance'] != null &&
								$horaire[$day]['heure_de_debut'] != null &&
								$horaire[$day]['heure_de_fin'] != null &&
								$horaire[$day]['addresse'] != null
							): ?>
								<div
									class="rounded-lg border text-card-foreground shadow-sm bg-blue-50 border-blue-200 min-h-[200px]">
									<div class="p-4">
										<h2
											class="font-bold text-lg mb-3 font-[Oswald] tracking-widest uppercase bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent">
											<?= $day ?>
										</h2>
										<div class="space-y-3">
											<div class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24"
													height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
													stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
													class="lucide lucide-clock h-4 w-4 text-blue-950">
													<circle cx="12" cy="12" r="10"></circle>
													<polyline points="12 6 12 12 16 14"></polyline>
												</svg><span
													class="text-sm text-blue-950 font-medium"><?= $horaire[$day]['heure_de_debut'] ?>
													-
													<?= $horaire[$day]['heure_de_fin'] ?></span></div>
											<div class="inline-flex items-center rounded-md border px-2.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 text-white w-full justify-center py-1"
												data-v0-t="badge"><?= $horaire[$day]['nom_de_la_seance'] ?></div>
											<div class="flex items-start gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24"
													height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
													stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
													class="lucide lucide-map-pin h-4 w-4 text-gray-600 mt-0.5 flex-shrink-0">
													<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
													<circle cx="12" cy="10" r="3"></circle>
												</svg><span
													class="text-xs text-gray-700 leading-relaxed"><?= $horaire[$day]['addresse'] ?></span>
											</div>
										</div>
									</div>
								</div>
							<?php else: ?>
								<div
									class="rounded-lg border text-card-foreground shadow-sm bg-blue-50 border-blue-200 min-h-[200px]">
									<div class="p-4">
										<h2 class="font-bold text-lg mb-3 font-[Oswald] tracking-widest uppercase text-blue-950">
											<?= $day ?>
										</h2>
										<div class="flex items-center justify-center h-full"><span
												class="text-gray-500 text-sm italic">Pas d'entraînement</span></div>
									</div>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				<?php else: ?>
					<div class="flex items-center justify-start px-5 h-full">
						<span class="text-gray-500">L'horaire n'a pas été defini</span>
					</div>
				<?php endif; ?>
			</div>
			<h2 id="accordion-flush-heading-3">
				<button type="button"
					class="flex items-center justify-between w-full py-5 px-4 mb-6 font-medium text-left border-b border-gray-200  text-gray-500"
					data-accordion-target="#accordion-flush-body-3" aria-expanded="false"
					aria-controls="accordion-flush-body-3">
					<div
						class="truncate min-w-0 flex-1 mr-4 font-semibold flex items-center gap-2 text-2xl bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent uppercase font-[Oswald] tracking-widest">
						<svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
							viewBox="0 0 24 24" fill="none" stroke="url(#handshake-gradient)" stroke-width="2"
							stroke-linecap="round" stroke-linejoin="round"
							class="flex-shrink-0 lucide w-6 h-6 lucide-circle-plus-icon lucide-circle-plus">
							<defs>
								<linearGradient id="handshake-gradient" x1="0" y1="0" x2="24" y2="0"
									gradientUnits="userSpaceOnUse">
									<stop offset="0%" stop-color="#0f172a" /> <!-- slate-900 -->
									<stop offset="50%" stop-color="#1e40af" /> <!-- blue-900 -->
									<stop offset="100%" stop-color="#1e293b" /> <!-- slate-800 -->
								</linearGradient>
							</defs>
							<circle cx="12" cy="12" r="10"></circle>
							<path d="M8 12h8"></path>
							<path d="M12 8v8"></path>
						</svg>
						<span
							class="font-semibold text-2xl bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent uppercase font-oswald tracking-widest truncate min-w-0">
							Informations Supplémentaires
						</span>
					</div>
					<svg data-accordion-icon="" class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
						xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd"
							d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
							clip-rule="evenodd"></path>
					</svg>
				</button>
			</h2>
			<div id="accordion-flush-body-3" class="hidden" aria-labelledby="accordion-flush-heading-3">
				<?php if (!empty(get_field('informations_supplementaires'))): ?>
					<div class="flex items-center justify-start px-5 h-full">
						<span class="text-gray-600 leading-relaxed"><?= get_field('informations_supplementaires') ?></span>
					</div>
				<?php else: ?>
					<div class="flex items-center justify-start px-5 h-full">
						<span class="text-gray-500">Aucune information supplémentaire n'a été defini</span>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div
		class="container max-w-7xl mx-auto rounded-lg min-h-[500px] xl:h-96 flex items-center justify-center border bg-card shadow-sm bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 text-white">
		<div class="p-8 text-center">
			<h2 class="text-2xl mb-4 uppercase font-[Oswald] tracking-widest">Prêt à rejoindre ce programme ?</h2>
			<p class="text-white/80 mb-6 max-w-2xl mx-auto font-[Inter] text-lg sm:text-xl ">Inscrivez-vous dès
				maintenant pour réserver votre
				place
				dans ce programme d'excellence. Places limitées !</p>
			<div class="flex flex-col md:flex-row gap-4 justify-center">
				<form class="cart"
					action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
					method="post" enctype='multipart/form-data'>

					<?php
					// Add variation fields if it's a variable product
					if ($product->is_type('variable')) {
						woocommerce_variable_add_to_cart();
					} else {
						// For simple products, just add the hidden product ID
						?>
						<input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" />
						<?php
					}
					?>

					<button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>"
						class="bg-white text-gray-900 py-4 sm:py-5 sm:px-8 rounded-md hover:bg-white-100 transition-colors duration-200 font-[Inter] tracking-widest text-center flex items-center justify-center gap-2 uppercase">
						AJOUTER AU PANIER
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
							class="inline-block">
							<path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2"
								stroke-linecap="round" stroke-linejoin="round" />
						</svg>
					</button>
				</form>

				<a href="/nous-joindre"
					class="border border-white text-white py-4 sm:py-5 sm:px-8 rounded-md hover:bg-white hover:bg-white-100 transition-colors duration-200 font-[Inter] tracking-widest hover:text-gray-900 text-center flex items-center justify-center gap-2 uppercase">
					Plus d'informations
					<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"
						xmlns="http://www.w3.org/2000/svg" class="inline-block">
						<path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2"
							stroke-linecap="round" stroke-linejoin="round">
					</svg>
				</a>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>