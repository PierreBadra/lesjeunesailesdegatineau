<?php get_header(); ?>
<?php
$days = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
$horaire = get_field('horaire');
?>
<script src="https://unpkg.com/lucide@latest"></script>

<div class="min-h-screen pt-36">
    <div class="p-6">
        <!-- <div class=""> -->
        <div class="flex flex-col xl:flex-row items-center gap-8 mb-12">
            <!-- Text Content -->
            <div class="w-full xl:w-1/2 text-start">
                <div class="flex items-center gap-1 text-blue-950 bg-amber-300 justify-center px-4 py-1 rounded-md w-fit mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="h-3 w-3">
                    <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path>
                    <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path>
                    <path d="M4 22h16"></path>
                    <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path>
                    <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path>
                    <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path>
                </svg>
                <div class="inline-flex items-center rounded-full border font-semibold 
                transition-colors focus:outline-none focus:ring-2 focus:ring-ring 
                focus:ring-offset-2 border-transparent bg-secondary text-secondary-foreground 
                hover:bg-secondary/80 text-xs font-[Inter]">
                    Programme de Soccer
                </div>
        </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-blue-950 mb-4 
        uppercase font-[Oswald] tracking-wider sm:tracking-widest">
                    <?= get_field('titre') ?>
                </h1>
                <p class="text-lg sm:text-xl text-gray-600 mb-4 font-[Inter]">
                    <?= get_field('description') ?>
                </p>
                <a href="#"
                    class="w-full sm:w-auto sm:min-w-[320px] md:min-w-[400px] bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition-colors duration-200 first:rounded-t-lg last:rounded-b-lg py-4 sm:py-5 sm:px-8 tracking-wider sm:tracking-widest text-md text-center flex items-center justify-center gap-2">
                    INSCRIVEZ-VOUS MAINTENANT
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="inline-block">
                        <path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>

            <!-- Image -->
            <div class="w-full xl:w-1/2 xl:h-full flex justify-center xl:justify-end">
                <img class="rounded-lg w-full h-auto object-cover max-h-[500px] xl:max-h-none"
                    src="<?= get_template_directory_uri(); ?>/assets/images/programme-hero-image.webp"
                    alt="Programme de Soccer">
            </div>
        </div>
        <!-- </div> -->


        <div class="mb-6">
            <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white text-gray-900"
                data-inactive-classes="text-gray-500">
                <h3 id="accordion-flush-heading-1">
                    <button type="button"
                        class="flex items-center justify-between w-full py-5 px-4 font-medium mb-6 text-left border-b border-gray-200  bg-white  text-gray-900 "
                        data-accordion-target="#accordion-flush-body-1" aria-expanded="true"
                        aria-controls="accordion-flush-body-1">
                        <p
                            class="font-semibold flex items-center gap-2 text-2xl text-blue-950 uppercase font-[Oswald] tracking-widest">
                            <svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide w-6 h-6 lucide-info-icon lucide-info">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M12 16v-4"></path>
                                <path d="M12 8h.01"></path>
                            </svg>
                            Informations Générales
                        </p>
                        <svg data-accordion-icon="" class="w-6 h-6 shrink-0 rotate-180" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </h3>
                <div id="accordion-flush-body-1" class="" aria-labelledby="accordion-flush-heading-1">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="rounded-lg border text-card-foreground shadow-sm border-blue-200 bg-blue-50/50"
                            data-v0-t="card">
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
                                <h3 class="font-semibold text-blue-950 mb-2 font-[Oswald] tracking-widest uppercase">Période</h3>
                                <p class="text-sm font-medium text-blue-950"><?=get_field('date_de_debut'); ?></p>
                                <p class="text-xs text-gray-600">au</p>
                                <p class="text-sm font-medium text-blue-950"><?=get_field('date_de_fin'); ?></p>
                            </div>
                        </div>
                        <div class="rounded-lg border text-card-foreground shadow-sm border-blue-200 bg-blue-50/50"
                            data-v0-t="card">
                            <div class="p-6 text-center">
                                <svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto h-8 w-8 text-blue-950 mb-3 lucide lucide-dollar-sign-icon lucide-dollar-sign"><line x1="12" x2="12" y1="2" y2="22"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                <h3 class="font-semibold text-blue-950 mb-2 font-[Oswald] tracking-widest uppercase">Prix</h3>
                                <p class="text-2xl font-bold text-blue-950"><?= get_field('prix') ?>$</p>
                                <p class="text-xs text-gray-600 mt-1">Pour la saison complète</p>
                            </div>
                        </div>
                        <div class="rounded-lg border text-card-foreground shadow-sm border-blue-200 bg-blue-50/50"
                            data-v0-t="card">
                            <div class="p-6 text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-users h-8 w-8 text-blue-950 mx-auto mb-3">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <h3 class="font-semibold text-blue-950 mb-2 font-[Oswald] tracking-widest uppercase">Encadrement</h3>
                                <p class="text-sm text-blue-950 font-medium">Éducateurs diplômés</p>
                                <p class="text-xs text-gray-600 mt-1">Formation professionnelle</p>
                            </div>
                        </div>
                    </div>
                </div>
                <h3 id="accordion-flush-heading-2">
                    <button type="button"
                        class="flex items-center justify-between w-full py-5 px-4 mb-6 font-medium text-left border-b border-gray-200  text-gray-500"
                        data-accordion-target="#accordion-flush-body-2" aria-expanded="false"
                        aria-controls="accordion-flush-body-2">
                        <p
                            class="font-semibold flex items-center gap-2 text-2xl text-blue-950 uppercase font-[Oswald] tracking-widest">
                            <svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide w-6 h-6 lucide-calendar-days-icon lucide-calendar-days text-blue-950">
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
                            Horaire
                        </p>
                        <svg data-accordion-icon="" class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </h3>
                <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        <?php if ($horaire): ?>
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
                                            <h3
                                                class="font-bold text-lg mb-3 font-[Oswald] tracking-widest uppercase text-blue-950">
                                                <?= $day ?>
                                            </h3>
                                            <div class="space-y-3">
                                                <div class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-clock h-4 w-4 text-blue-950">
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                    </svg><span
                                                        class="text-sm text-blue-950 font-medium"><?= $horaire[$day]['heure_de_debut'] ?>
                                                        -
                                                        <?= $horaire[$day]['heure_de_fin'] ?></span></div>
                                                <div class="inline-flex items-center rounded-md border px-2.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent bg-blue-950 text-white w-full justify-center py-1"
                                                    data-v0-t="badge"><?= $horaire[$day]['nom_de_la_seance']?></div>
                                                <div class="flex items-start gap-2"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-map-pin h-4 w-4 text-gray-600 mt-0.5 flex-shrink-0">
                                                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                                        <circle cx="12" cy="10" r="3"></circle>
                                                    </svg><span class="text-xs text-gray-700 leading-relaxed"><?= $horaire[$day]['addresse']?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="rounded-lg border text-card-foreground shadow-sm bg-blue-50 border-blue-200 min-h-[200px]"
                                        data-v0-t="card">
                                        <div class="p-4">
                                            <h3
                                                class="font-bold text-lg mb-3 font-[Oswald] tracking-widest uppercase text-blue-950">
                                                <?= $day ?></h3>
                                            <div class="flex items-center justify-center h-full"><span
                                                    class="text-gray-500 text-sm italic">Pas d'entraînement</span></div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                                                                       <div class="flex items-center justify-center h-full"><span
                                                    class="text-gray-500 text-sm italic">L'horaire n'a pas été defini</span></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>

        <div class="rounded-lg h-[500px] xl:h-96 flex items-center justify-center border bg-card shadow-sm bg-gray-900 text-white"
            data-v0-t="card">
            <div class="p-8 text-center">
                <h2 class="text-2xl mb-4 uppercase font-[Oswald] tracking-widest">Prêt à rejoindre ce programme ?</h2>
                <p class="text-white/80 mb-6 max-w-2xl mx-auto font-[Inter] text-lg sm:text-xl ">Inscrivez-vous dès maintenant pour réserver votre
                    place
                    dans ce programme d'excellence. Places limitées !</p>
                <div class="flex flex-col md:flex-row gap-4 justify-center">
                    <a href="#" class="bg-white text-gray-900 py-4 sm:py-5 sm:px-8 rounded-md hover:bg-white-100 transition-colors duration-200 font-[Inter] tracking-widest text-center flex items-center justify-center gap-2 uppercase">
                        S'inscrire
                        maintenant
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="inline-block">
                        <path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    </a>
                   <a href="#"
  class="border border-white text-white py-4 sm:py-5 sm:px-8 rounded-md hover:bg-white hover:bg-white-100 transition-colors duration-200 font-[Inter] tracking-widest hover:text-gray-900 text-center flex items-center justify-center gap-2 uppercase">
  Plus d'informations
  <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="inline-block">
   <path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  </svg>
</a></div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>