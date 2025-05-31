</body>
<footer class="px-6 pt-20 pb-16 w-full bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800 text-white">
    <div class="container mx-auto max-w-7xl">
        <div
            class="flex flex-col md:grid md:grid-cols-2 xl:flex xl:flex-row items-start justify-between gap-12 xl:gap-0">
            <div class="w-full xl:max-w-96">
                <div class="flex items-start gap-3 mb-4">
                    <img class="w-16 h-16" src="<?= get_template_directory_uri(); ?>/assets/images/logo.webp"
                        alt="Logo Image">
                    <div>
                        <h3 class="text-lg uppercase font-[Oswald] tracking-widest">Les Jeunes Ailés de Gatineau</h3>
                        <p class="hover:text-gray-300 text-gray-300 transition-colors duration-200">Là où renaît le
                            talent</p>
                    </div>
                </div>
                <p class="text-xl md:text-base font-[Inter] text-gray-300 text-muted-foreground">Nous offrons des
                    programmes
                    enrichissants pour développer le potentiel de chaque jeune.</p>
            </div>
            <div class="">
                <h4 class="uppercase text-2xl md:text-lg mb-4 font-[Oswald] tracking-widest">Navigation</h4>
                <ul
                    class="flex font-[Inter] flex-col gap-6 md:gap-4 tracking-widest text-xl md:text-sm text-white font-light">
                    <li><a href="/objectifs"
                            class="hover:text-gray-300 transition-colors duration-200 py-2 md:py-0">Objectifs</a>
                    </li>
                    <li><a href="/camp-de-jour"
                            class="hover:text-gray-300 transition-colors duration-200 py-2 md:py-0">Camp de
                            Jour</a></li>
                    <li><a href="/programmes"
                            class="hover:text-gray-300 transition-colors duration-200 py-2 md:py-0">Programmes</a>
                    </li>
                    <li><a href="/emplois"
                            class="hover:text-gray-300 transition-colors duration-200 py-2 md:py-0">Emplois</a>
                    </li>
                    <li><a href="/nous-joindre"
                            class="hover:text-gray-300 transition-colors duration-200 py-2 md:py-0">Nous
                            Joindre</a></li>
                </ul>
            </div>
            <div class="w-full max-w-xs xl:max-w-fit">
                <h4 class="uppercase text-2xl md:text-lg mb-4 font-[Oswald] tracking-widest">Programmes</h4>
                <ul
                    class="flex font-[Inter] flex-col gap-6 md:gap-4 tracking-widest text-xl md:text-sm text-white font-light">
                    <?php
                    $collections = get_posts([
                        'post_type' => 'programmes',
                        'post_status' => 'publish',
                        'order' => 'ASC',
                    ]);
                    foreach ($collections as $collection): ?>
                        <li>
                            <a href="<?= get_permalink($collection->ID); ?>"
                                class="truncate hover:text-gray-300 transition-colors duration-200 py-2 md:py-0 block">
                                <?= esc_html(get_the_title($collection->ID)); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="">
                <h4 class="uppercase text-2xl md:text-lg mb-4 font-[Oswald] tracking-widest">Contact</h4>
                <div class="space-y-6 md:space-y-3">
                    <div class="flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-map-pin w-5 h-5 md:w-4 md:h-4 text-white flex-shrink-0">
                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <div class="truncate font-[Inter] text-xl md:text-sm tracking-widest text-gray-300">
                            <p>123 Rue des Jeunes</p>
                            <p>Gatineau, QC J8X 1A1</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-phone w-5 h-5 md:w-4 md:h-4 text-white flex-shrink-0">
                            <path
                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                            </path>
                        </svg><span class="truncate font-[Inter] text-xl md:text-sm tracking-widest text-gray-300">(819) 775-7836</span></div>
                    <div class="flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-mail w-5 h-5 md:w-4 md:h-4 text-white flex-shrink-0">
                            <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                        </svg><span
                            class="truncate font-[Inter] text-xl md:text-sm tracking-widest text-gray-300"><?= get_option('admin_email')?></span>
                    </div>
                </div>
                <div class="mt-6">
                    <h5 class="mb-3 uppercase text-xl md:text-base font-[Oswald] tracking-widest">Suivez-nous</h5>
                    <div class="flex gap-3">
                        <a href="#" target="_blank" class="hover:opacity-70 transition-opacity duration-200">
                            <img class="w-5 h-5 md:w-4 md:h-4"
                                src="<?= get_template_directory_uri(); ?>/assets/images/facebook-icon.svg"
                                alt="Lien Facebook">
                        </a>
                        <a href="#" target="_blank" class="hover:opacity-70 transition-opacity duration-200">
                            <img class="w-5 h-5 md:w-4 md:h-4"
                                src="<?= get_template_directory_uri(); ?>/assets/images/instagram-icon.svg"
                                alt="Lien Instagram">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-8 pt-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-center font-[Inter] text-blue-200 text-sm">© <?= date('Y') ?> Les Jeunes Ailés de
                    Gatineau. Tous
                    droits réservés.
                </p>
            </div>
        </div>
    </div>
</footer>

</html>