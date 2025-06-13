<?php get_header() ?>

<section class="w-full px-6 py-12 pt-40">
    <div class="container max-w-7xl mx-auto">
        <div class="mb-8"><a href="/emplois"
                class="inline-flex items-center gap-2 text-blue-950 hover:text-blue-900 transition-colors"><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-arrow-left w-4 h-4">
                    <path d="m12 19-7-7 7-7"></path>
                    <path d="M19 12H5"></path>
                </svg>Retour aux emplois</a></div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class=" rounded-xl   mb-8">
                    <div
                        class="flex items-center gap-1 text-blue-950 bg-gradient-to-br from-yellow-400 via-yellow-200 via-white via-yellow-300 to-yellow-600 justify-center px-4 py-1 rounded-md w-fit mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-briefcase w-4 h-4">
                            <path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                            <rect width="20" height="14" x="2" y="6" rx="2"></rect>
                        </svg>
                        <div class="inline-flex items-center rounded-full border font-semibold 
                    transition-colors focus:outline-none focus:ring-2 focus:ring-ring 
                    focus:ring-offset-2 border-transparent bg-secondary text-secondary-foreground 
                    hover:bg-secondary/80 text-xs font-[Inter]">
                            Emplois
                        </div>
                    </div>
                    <h1
                        class="text-3xl sm:text-4xl/10 md:text-5xl/15 font-bold bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent mb-4 uppercase font-[Oswald] tracking-widest">
                        <?= get_field('titre') ?>
                    </h1>
                    <div class="flex flex-col items-center justify-stretch md:flex-row gap-6 mb-8">
                        <?php if (!empty(get_field('salaire_par_heure'))): ?>
                            <div
                                class="w-full rounded-lg border text-card-foreground shadow-sm border-blue-200 bg-blue-50/50">
                                <div class="p-6 text-center">
                                    <svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="url(#handshake-gradient)" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="mx-auto h-8 w-8 text-blue-950 mb-3 lucide lucide-dollar-sign-icon lucide-dollar-sign">
                                        <defs>
                                            <linearGradient id="handshake-gradient" x1="0" y1="0" x2="24" y2="0"
                                                gradientUnits="userSpaceOnUse">
                                                <stop offset="0%" stop-color="#0f172a"></stop> <!-- slate-900 -->
                                                <stop offset="50%" stop-color="#1e40af"></stop> <!-- blue-900 -->
                                                <stop offset="100%" stop-color="#1e293b"></stop> <!-- slate-800 -->
                                            </linearGradient>
                                        </defs>
                                        <line x1="12" x2="12" y1="2" y2="22"></line>
                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                    </svg>
                                    <p class="text-sm font-medium text-blue-950">Salaire</p>
                                    <h2 class="font-semibold text-blue-950 mb-2 font-[Oswald] tracking-widest uppercase">
                                        <?= get_field('salaire_par_heure') ?>$ / heure
                                    </h2>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty(get_field('type_demploi'))): ?>
                            <div
                                class="w-full rounded-lg border text-card-foreground shadow-sm border-blue-200 bg-blue-50/50">
                                <div class="p-6 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="url(#handshake-gradient)" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="mx-auto mb-3 lucide lucide-briefcase w-8 h-8">
                                        <defs>
                                            <linearGradient id="handshake-gradient" x1="0" y1="0" x2="24" y2="0"
                                                gradientUnits="userSpaceOnUse">
                                                <stop offset="0%" stop-color="#0f172a"></stop> <!-- slate-900 -->
                                                <stop offset="50%" stop-color="#1e40af"></stop> <!-- blue-900 -->
                                                <stop offset="100%" stop-color="#1e293b"></stop> <!-- slate-800 -->
                                            </linearGradient>
                                        </defs>
                                        <path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                        <rect width="20" height="14" x="2" y="6" rx="2"></rect>
                                    </svg>
                                    <p class="text-sm font-medium text-blue-950">Type d'emploi</p>
                                    <h2 class="font-semibold text-blue-950 mb-2 font-[Oswald] tracking-widest uppercase">
                                        <?= get_field('type_demploi') ?>
                                    </h2>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty(get_field('date_limite_pour_la_candidature'))): ?>
                            <div
                                class="w-full rounded-lg border text-card-foreground shadow-sm border-blue-200 bg-blue-50/50">
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
                                    <p class="text-sm font-medium text-blue-950">Date limite</p>
                                    <h2 class="font-semibold text-blue-950 mb-2 font-[Oswald] tracking-widest uppercase">
                                        <?= get_field('date_limite_pour_la_candidature') ?>
                                    </h2>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="rounded-xl">
                    <h2
                        class="font-semibold flex mb-6 items-center gap-2 text-2xl bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent uppercase font-[Oswald] tracking-widest">
                        Description du poste
                    </h2>
                    <div class="prose max-w-none">
                        <div class="text-gray-600 leading-relaxed"><?= get_field('description') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-y-6">
                <div class=" rounded-xl">
                    <h3
                        class="text-xl font-[Oswald] tracking-widest uppercase font-medium mb-4 bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent">
                        Postuler maintenant</h3>
                    <?php
                    $date_limite = parse_french_string_date_to_english(get_field('date_limite_pour_la_candidature'));
                    $temps_restant = calculate_time_difference_between_dates(date('Y-m-d'), $date_limite);
                    $jours_restants = $temps_restant['days'];
                    $texte_restant = $temps_restant['text'];

                    // Determine color classes
                    if ($jours_restants === null) {
                        $bg_class = 'bg-gray-200';
                        $text_class = 'text-gray-700';
                    } elseif ($jours_restants <= 0) {
                        $bg_class = 'bg-red-100';
                        $text_class = 'text-red-700';
                    } elseif ($jours_restants <= 3) {
                        $bg_class = 'bg-amber-50';
                        $text_class = 'text-amber-700';
                    } else {
                        $bg_class = 'bg-green-50';
                        $text_class = 'text-green-700';
                    }
                    ?>
                    <div class="mb-4 p-4 <?= $bg_class ?> rounded-lg">
                        <div class="flex items-center gap-2 <?= $text_class ?> mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-clock w-4 h-4">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <span class="font-medium">
                                <?= $jours_restants <= 0 ? "Candidature expirée" : "Candidatures ouvertes" ?>
                            </span>
                        </div>
                        <p class="text-sm <?= $text_class ?>">
                            <?php if ($jours_restants <= 0): ?>
                                La date limite pour postuler est dépassée.
                            <?php else: ?>
                                Il vous reste <?= $texte_restant ?> pour postuler
                            <?php endif; ?>
                        </p>
                    </div>
                    <a href="<?= $jours_restants <= 0 ? '#' : get_field('lien_de_candidature') ?>" <?= $jours_restants <= 0 ? '' : 'target="_blank"' ?> class=" <?= $jours_restants <= 0 ? 'opacity-50 cursor-not-allowed' : 'transition-colors duration-200 gradient-animate' ?>  w-full sm:w-auto bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 text-white rounded-xl
          first:rounded-t-lg last:rounded-b-lg py-4 sm:py-5 sm:px-8 tracking-wider sm:tracking-widest text-md
          text-center flex items-center justify-center gap-2">
                        POSTULER EN LIGNE
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="inline-block">
                            <path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>
                <div class="rounded-xl  ">
                    <h3
                        class="text-lg mb-4 font-[Oswald] tracking-widest uppercase font-medium bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent">
                        Questions?</h3>
                    <p class="text-gray-600 mb-4">Pour toute question concernant ce poste, contactez notre
                        équipe.
                    </p>
                    <div class="space-y-3">
                        <a href="tel:8197757836"
                            class="w-fit text-sm flex items-center gap-3 text-blue-950 underline"><svg class="w-4 h-4"
                                fill="none" stroke="url(#handshake-gradient)" viewBox="0 0 24 24">
                                <defs>
                                    <linearGradient id="handshake-gradient" x1="0" y1="0" x2="24" y2="0"
                                        gradientUnits="userSpaceOnUse">
                                        <stop offset="0%" stop-color="#0f172a"></stop> <!-- slate-900 -->
                                        <stop offset="50%" stop-color="#1e40af"></stop> <!-- blue-900 -->
                                        <stop offset="100%" stop-color="#1e293b"></stop> <!-- slate-800 -->
                                    </linearGradient>
                                </defs>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>(819) 775-7836
                        </a>
                        <a href="mailto:<?= get_option('admin_email') ?>"
                            class="text-sm w-fit flex items-center gap-3 text-blue-950 underline"><svg class="w-4 h-4"
                                fill="none" stroke="url(#handshake-gradient)" viewBox="0 0 24 24">
                                <defs>
                                    <linearGradient id="handshake-gradient" x1="0" y1="0" x2="24" y2="0"
                                        gradientUnits="userSpaceOnUse">
                                        <stop offset="0%" stop-color="#0f172a"></stop> <!-- slate-900 -->
                                        <stop offset="50%" stop-color="#1e40af"></stop> <!-- blue-900 -->
                                        <stop offset="100%" stop-color="#1e293b"></stop> <!-- slate-800 -->
                                    </linearGradient>
                                </defs>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg><?= get_option('admin_email') ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer() ?>