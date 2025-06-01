<?php get_header(); ?>

<section class="px-6 pt-36">
    <div class="container mx-auto max-w-7xl">
        <div class="flex flex-col xl:flex-row items-center gap-8 mb-20 container max-w-7xl mx-auto">
            <!-- Text Content -->
            <div class="w-full xl:w-1/2 text-start">
                <div
                    class="flex items-center gap-1 text-blue-950 bg-amber-300 justify-center px-4 py-1 rounded-md w-fit mb-3">
                    <svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="w-4 h-4 lucide lucide-target-icon lucide-target">
                        <circle cx="12" cy="12" r="10"></circle>
                        <circle cx="12" cy="12" r="6"></circle>
                        <circle cx="12" cy="12" r="2"></circle>
                    </svg>
                    <div
                        class="inline-flex items-center rounded-full border font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 text-xs font-[Inter]">
                        Objectifs
                    </div>
                </div>

                <h1
                    class="text-3xl sm:text-4xl/10 md:text-5xl/15 font-bold bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent mb-4 uppercase font-[Oswald] tracking-wider sm:tracking-widest">
                    Nos Objectifs
                </h1>

                <p class="text-lg sm:text-xl text-gray-600 mb-4 font-[Inter]">
                    Chez Les Jeunes Ailés de Gatineau, nous nous engageons à développer le plein potentiel de chaque
                    jeune à travers le sport, l'éducation et le développement personnel.
                </p>
            </div>

            <!-- Image -->
            <div class="w-full xl:w-1/2 flex justify-center xl:justify-end">
                <img alt="Image d'avant page" class="w-full h-fit object-cover rounded-xl"
                    src="<?= get_template_directory_uri() ?>/assets/images/default-image.svg">
            </div>
        </div>
    </div>
</section>

<section class="px-6 pb-12 md:pb-30">
    <div class="container mx-auto max-w-7xl flex flex-col gap-6">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 justify-center gap-8 md:gap-12">
            <!-- Objectif 1 -->
            <div class="flex flex-col items-center text-center">
                <div class="p-4 rounded-full bg-primary/10">
                    <!-- Icon : Target -->
                    <svg width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="url(#gradient)" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <defs>
                            <linearGradient id="gradient" x1="0" y1="0" x2="24" y2="0" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#0f172a" /> <!-- slate-900 -->
                                <stop offset="50%" stop-color="#1e40af" /> <!-- blue-900 -->
                                <stop offset="100%" stop-color="#0f172a" /> <!-- slate-800 (approx) -->
                            </linearGradient>
                        </defs>
                        <circle cx="12" cy="12" r="10" />
                        <circle cx="12" cy="12" r="6" />
                        <circle cx="12" cy="12" r="2" />
                    </svg>

                </div>
                <h3
                    class="text-lg tracking-widest font-[Oswald] uppercase bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent font-semibold mb-2">
                    Développement des compétences
                </h3>
                <p class="text-base font-[Inter] text-gray-600 text-muted-foreground">
                    Développer les compétences et techniques fondamentales du football grâce à un entraînement
                    structuré.
                </p>
            </div>

            <!-- Objectif 2 -->
            <div class="flex flex-col items-center text-center">
                <div class="p-4 rounded-full bg-primary/10">
                    <!-- Icon : Handshake -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none"
                        stroke="url(#handshake-gradient)" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="w-24 h-24 lucide lucide-handshake-icon lucide-handshake">
                        <defs>
                            <linearGradient id="handshake-gradient" x1="0" y1="0" x2="24" y2="0"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#0f172a" /> <!-- slate-900 -->
                                <stop offset="50%" stop-color="#1e40af" /> <!-- blue-900 -->
                                <stop offset="100%" stop-color="#1e293b" /> <!-- slate-800 -->
                            </linearGradient>
                        </defs>
                        <path d="m11 17 2 2a1 1 0 1 0 3-3"></path>
                        <path
                            d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4">
                        </path>
                        <path d="m21 3 1 11h-2"></path>
                        <path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3"></path>
                        <path d="M3 4h8"></path>
                    </svg>
                </div>
                <h3
                    class="text-lg tracking-widest font-[Oswald] uppercase bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent font-semibold mb-2">
                    Travail d'équipe
                </h3>
                <p class="text-base font-[Inter] text-gray-600 text-muted-foreground">
                    Favoriser la collaboration, la communication et l'unité sur et en dehors du terrain.
                </p>
            </div>

            <!-- Objectif 3 -->
            <div class="flex flex-col items-center text-center">
                <div class="p-4 rounded-full bg-primary/10">
                    <!-- Icon : Heart -->
                    <svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="url(#handshake-gradient)" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"
                        class="w-24 h-24 lucide lucide-heart-icon lucide-heart">
                        <defs>
                            <linearGradient id="handshake-gradient" x1="0" y1="0" x2="24" y2="0"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#0f172a" /> <!-- slate-900 -->
                                <stop offset="50%" stop-color="#1e40af" /> <!-- blue-900 -->
                                <stop offset="100%" stop-color="#1e293b" /> <!-- slate-800 -->
                            </linearGradient>
                        </defs>
                        <path
                            d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z">
                        </path>
                    </svg>
                </div>
                <h3
                    class="text-lg tracking-widest font-[Oswald] uppercase bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent font-semibold mb-2">
                    Passion du jeu
                </h3>
                <p class="text-base font-[Inter] text-gray-600 text-muted-foreground">
                    Inspirer une passion durable pour le football à travers des activités amusantes et engageantes.
                </p>
            </div>

            <!-- Objectif 4 -->
            <div class="flex flex-col items-center text-center">
                <div class="p-4 rounded-full bg-primary/10">
                    <!-- Icon : Zap -->
                    <svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="url(#handshake-gradient)" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"
                        class="w-24 h-24 lucide lucide-zap-icon lucide-zap">
                        <defs>
                            <linearGradient id="handshake-gradient" x1="0" y1="0" x2="24" y2="0"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#0f172a" /> <!-- slate-900 -->
                                <stop offset="50%" stop-color="#1e40af" /> <!-- blue-900 -->
                                <stop offset="100%" stop-color="#1e293b" /> <!-- slate-800 -->
                            </linearGradient>
                        </defs>
                        <path
                            d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z">
                        </path>
                    </svg>
                </div>
                <h3
                    class="text-lg tracking-widest font-[Oswald] uppercase bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent font-semibold mb-2">
                    Condition physique
                </h3>
                <p class="text-base font-[Inter] text-gray-600 text-muted-foreground">
                    Promouvoir des habitudes de vie saine et le développement physique par le jeu actif.
                </p>
            </div>

            <!-- Objectif 5 -->
            <div class="flex flex-col items-center text-center">
                <div class="p-4 rounded-full bg-primary/10">
                    <!-- Icon : Plant -->
                    <svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="url(#handshake-gradient)" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"
                        class="w-24 h-24 lucide lucide-sprout-icon lucide-sprout">
                        <defs>
                            <linearGradient id="handshake-gradient" x1="0" y1="0" x2="24" y2="0"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#0f172a" /> <!-- slate-900 -->
                                <stop offset="50%" stop-color="#1e40af" /> <!-- blue-900 -->
                                <stop offset="100%" stop-color="#1e293b" /> <!-- slate-800 -->
                            </linearGradient>
                        </defs>
                        <path d="M7 20h10"></path>
                        <path d="M10 20c5.5-2.5.8-6.4 3-10"></path>
                        <path
                            d="M9.5 9.4c1.1.8 1.8 2.2 2.3 3.7-2 .4-3.5.4-4.8-.3-1.2-.6-2.3-1.9-3-4.2 2.8-.5 4.4 0 5.5.8z">
                        </path>
                        <path d="M14.1 6a7 7 0 0 0-1.1 4c1.9-.1 3.3-.6 4.3-1.4 1-1 1.6-2.3 1.7-4.6-2.7.1-4 1-4.9 2z">
                        </path>
                    </svg>
                    </svg>
                </div>
                <h3
                    class="text-lg tracking-widest font-[Oswald] uppercase bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent font-semibold mb-2">
                    Formation du caractère
                </h3>
                <p class="text-base font-[Inter] text-gray-600 text-muted-foreground">
                    Développer le leadership, la discipline et l'esprit sportif chez les jeunes athlètes.
                </p>
            </div>

            <!-- Objectif 6 -->
            <div class="flex flex-col items-center text-center">
                <div class="p-4 rounded-full bg-primary/10">
                    <!-- Icon : Trophy -->
                    <svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="url(#handshake-gradient)" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"
                        class="w-24 h-24 lucide lucide-trophy-icon lucide-trophy">
                        <defs>
                            <linearGradient id="handshake-gradient" x1="0" y1="0" x2="24" y2="0"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#0f172a" /> <!-- slate-900 -->
                                <stop offset="50%" stop-color="#1e40af" /> <!-- blue-900 -->
                                <stop offset="100%" stop-color="#1e293b" /> <!-- slate-800 -->
                            </linearGradient>
                        </defs>
                        <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path>
                        <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path>
                        <path d="M4 22h16"></path>
                        <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path>
                        <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path>
                        <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path>
                    </svg>
                </div>
                <h3
                    class="text-lg tracking-widest font-[Oswald] uppercase bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent font-semibold mb-2">
                    Accomplissement
                </h3>
                <p class="text-base font-[Inter] text-gray-600 text-muted-foreground">
                    Célébrer les progrès et les succès tout en renforçant la confiance et l'estime de soi.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="px-6 w-full flex flex-col items-center justify-center gap-10 md:gap-24">
    <div class="flex md:py-8 flex-col md:flex-row overflow-hidden container max-w-7xl mx-auto">

        <!-- Right side - Content -->
        <div class="w-full md:w-1/2 py-6 md:pr-6 xl:pr-10 flex flex-col justify-center">
            <!-- Heading -->
            <h2
                class="text-3xl font-medium tracking-widest font-[Oswald]  bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent mb-4">
                NOTRE MISSION
            </h2>

            <!-- Description -->
            <p class="font-[Inter] text-gray-600 mb-8 text-muted-foreground text-xl max-w-3xl mx-auto">
                Offrir un environnement stimulant, sécuritaire et inclusif où les jeunes peuvent développer leurs
                compétences sportives, leur confiance en soi et leur esprit d'équipe à travers des programmes de
                qualité adaptés à tous les niveaux.
            </p>
            <p class="font-[Inter] text-gray-600 mb-8 text-muted-foreground text-xl max-w-3xl mx-auto">
                Nous nous engageons à former non seulement de meilleurs athlètes, mais aussi de meilleurs citoyens,
                prêts à contribuer positivement à leur communauté.
            </p>
        </div>

        <!-- Left side - Soccer field image -->
        <div class="w-full md:w-1/2 h-[300px] md:h-[400px] relative">
            <img src="<?= get_template_directory_uri() ?>/assets/images/default-image.svg"
                alt="Terrain de soccer avec lignes blanches"
                class="rounded-lg object-cover absolute inset-0 w-full h-full" />
        </div>
    </div>

    <div class="flex md:py-8 flex-col-reverse md:flex-row overflow-hidden container max-w-7xl mx-auto">
        <!-- Left side - Soccer field image -->
        <div class="w-full md:w-1/2 h-[300px] md:h-[400px] relative">
            <img src="<?= get_template_directory_uri() ?>/assets/images/default-image.svg"
                alt="Terrain de soccer avec lignes blanches"
                class="rounded-lg object-cover absolute inset-0 w-full h-full" />
        </div>

        <!-- Right side - Content -->
        <div class="w-full md:w-1/2 py-6 md:pl-6 xl:pl-10 flex flex-col justify-center">
            <!-- Heading -->
            <h2
                class="text-3xl font-medium tracking-widest font-[Oswald]  bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent mb-4">
                NOTRE VISION
            </h2>

            <!-- Description -->
            <p class="font-[Inter] text-gray-600 mb-8 text-muted-foreground text-xl max-w-3xl mx-auto">
                Devenir l'organisation de référence dans la région de Gatineau pour le développement des jeunes à
                travers le sport, reconnue pour l'excellence de ses programmes, la qualité de son encadrement et son
                impact positif sur la communauté.
            </p>
            <p class="font-[Inter] text-gray-600 mb-8 text-muted-foreground text-xl max-w-3xl mx-auto">
                Nous aspirons à créer un héritage durable où chaque jeune a l'opportunité de découvrir sa passion,
                développer son talent et atteindre son plein potentiel.
            </p>
        </div>
    </div>
</section>

<section class="px-6 md:py-24 relative">
    <div class="container max-w-7xl mx-auto relative z-10">
        <div class="max-w-4xl mx-auto text-center mb-12">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="mx-auto lucide lucide-heart w-8 h-8 mb-3 text-white">
                <path
                    d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z">
                </path>
            </svg>
            <h2
                class="text-3xl font-medium bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent mb-4 uppercase tracking-widest font-[Oswald]">
                Nos Valeurs</h2>
            <p class="font-[Inter] text-gray-600 mb-8 text-muted-foreground text-xl max-w-3xl mx-auto">Nos valeurs
                fondamentales guident
                toutes nos actions et décisions,
                créant un environnement où chaque jeune peut s'épanouir.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="border border-blue-200 bg-blue-50/50 rounded-xl shadow-md p-6 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-users w-8 h-8 mx-auto mb-3 text-blue-950">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-3 uppercase font-[Oswald] tracking-widest">Inclusion
                </h3>
                <p class="text-gray-600">Nous accueillons tous les jeunes, quels que soient leur niveau, leur origine ou
                    leurs capacités. La diversité est notre force.</p>
            </div>
            <div class="border border-blue-200 bg-blue-50/50 rounded-xl shadow-md p-6 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-users w-8 h-8 mx-auto mb-3 text-blue-950">
                    <path
                        d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526">
                    </path>
                    <circle cx="12" cy="8" r="6"></circle>
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-3 uppercase font-[Oswald] tracking-widest">Excellence
                </h3>
                <p class="text-gray-600">Nous visons l'excellence dans tous nos programmes, encourageant chaque jeune à
                    donner le meilleur de lui-même, sur et en dehors du terrain.</p>
            </div>
            <div class="border border-blue-200 bg-blue-50/50 rounded-xl shadow-md p-6 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-users w-8 h-8 mx-auto mb-3 text-blue-950">
                    <path
                        d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z">
                    </path>
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-3 uppercase font-[Oswald] tracking-widest">Respect</h3>
                <p class="text-gray-600">Le respect mutuel est au cœur de notre approche : respect des coéquipiers, des
                    adversaires, des entraîneurs et de soi-même.</p>
            </div>
        </div>
    </div>
</section>

<section class="px-6 py-16">
    <div class="container max-w-7xl mx-auto">
        <div class="text-center">
            <h2
                class="text-3xl font-medium bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent mb-4 uppercase tracking-widest font-[Oswald]">
                Notre équipe de direction</h2>
            <div class="relative h-[300px] md:h-[400px] mb-8">
                <img alt="Équipe de direction des Jeunes Ailés de Gatineau"
                    class="w-full h-full object-cover rounded-xl"
                    src="<?= get_template_directory_uri(); ?>/assets/images/default-image.svg">
            </div>
            <p class="font-[Inter] text-gray-600 mb-8 text-muted-foreground text-xl">Notre équipe de direction combine
                expertise sportive, expérience
                éducative et passion pour le développement des jeunes. Ensemble, nous travaillons à créer un
                environnement où chaque participant peut atteindre son plein potentiel.</p>
        </div>
    </div>
</section>

<section class="p-6">
    <div
        class="container max-w-7xl mx-auto rounded-lg min-h-[500px] xl:h-96 flex items-center justify-center border bg-card shadow-sm bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 text-white">
        <div class="p-8 text-center">
            <h2 class="text-2xl mb-4 uppercase font-[Oswald] tracking-widest">Rejoignez notre mission</h2>
            <p class="text-white/80 mb-6 max-w-2xl mx-auto font-[Inter] text-lg sm:text-xl ">Ensemble, nous pouvons
                faire une différence dans la vie des jeunes de notre communauté. Découvrez comment vous pouvez
                contribuer à notre mission.</p>
            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <a href="/programmes"
                    class="bg-white text-gray-900 py-4 sm:py-5 sm:px-8 rounded-md hover:bg-white-100 transition-colors duration-200 font-[Inter] tracking-widest text-center flex items-center justify-center gap-2 uppercase">
                    Nos Programmes
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="inline-block">
                        <path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </a>
                <a href="/nous-joindre"
                    class="border border-white text-white py-4 sm:py-5 sm:px-8 rounded-md hover:bg-white hover:bg-white-100 transition-colors duration-200 font-[Inter] tracking-widest hover:text-gray-900 text-center flex items-center justify-center gap-2 uppercase">
                    Nous Joindre
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