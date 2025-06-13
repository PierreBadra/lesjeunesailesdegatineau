<section class="p-6 w-full flex flex-col items-center justify-center gap-16 mb-12">
    <div class="flex flex-col md:flex-row overflow-hidden container max-w-7xl mx-auto">
        <!-- Left side - Soccer field image -->
        <div class="w-full md:w-1/2 h-[300px] md:h-[400px] relative">
            <img src="<?= get_template_directory_uri() ?>/assets/images/default-image.svg"
                alt="Terrain de soccer avec lignes blanches"
                class="rounded-lg object-cover absolute inset-0 w-full h-full" />
        </div>

        <!-- Right side - Content -->
        <div class="w-full md:w-1/2 py-6 md:pl-6 xl:pl-10 flex flex-col justify-center">
            <!-- Programs label -->
            <div
                class="flex items-center gap-1 text-blue-950 bg-gradient-to-br from-yellow-400 via-yellow-200 via-white via-yellow-300 to-yellow-600 justify-center px-4 py-1 rounded-md w-fit mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="h-4 w-4">
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
                    Programmes
                </div>
            </div>

            <!-- Heading -->
            <h2
                class="text-3xl font-medium tracking-widest font-[Oswald]  bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent mb-4">
                DÉCOUVREZ NOS PROGRAMMES
            </h2>

            <!-- Description -->
            <p class="font-[Inter] text-gray-600 mb-8 text-muted-foreground text-xl max-w-3xl mx-auto">
                Le Club offre un large éventail de programmes récréatifs et compétitifs dès l'âge de 5 ans.
            </p>
            <!-- Button -->
            <a href="/programmes" class="w-full sm:w-auto bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 text-white rounded-xl
          first:rounded-t-lg last:rounded-b-lg py-4 sm:py-5 sm:px-8 tracking-wider sm:tracking-widest text-md
          text-center flex items-center justify-center gap-2 transition-colors duration-200 gradient-animate">
                VOIR NOS PROGRAMMES
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="inline-block">
                    <path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </svg>
            </a>
        </div>
    </div>

    <div class="flex flex-col md:flex-row overflow-hidden container max-w-7xl mx-auto">
        <!-- Left side - Soccer field image -->
        <div class="w-full md:w-1/2 h-[300px] md:h-[400px] relative">
            <img src="<?= get_template_directory_uri() ?>/assets/images/default-image.svg"
                alt="Terrain de soccer avec lignes blanches"
                class="rounded-lg object-cover absolute inset-0 w-full h-full" />
        </div>

        <!-- Right side - Content -->
        <div class="w-full md:w-1/2 py-6 md:pl-6 xl:pl-10 flex flex-col justify-center">
            <!-- Programs label -->
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

            <!-- Heading -->
            <h2
                class="text-3xl font-medium tracking-widest font-[Oswald]  bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent mb-4">
                TRAVAILLEZ POUR NOUS
            </h2>

            <!-- Description -->
            <p class="font-[Inter] text-gray-600 mb-8 text-muted-foreground text-xl max-w-3xl mx-auto">
                Le Club est à la recherche de personnes enthousiastes et engagées pour combler divers postes rémunérés.
            </p>

            <!-- Button -->
            <a href="/emplois" class="w-full sm:w-auto bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 text-white rounded-xl
          first:rounded-t-lg last:rounded-b-lg py-4 sm:py-5 sm:px-8 tracking-wider sm:tracking-widest text-md
          text-center flex items-center justify-center gap-2 transition-colors duration-200 gradient-animate">
                REJOIGNEZ L’ÉQUIPE TECHNIQUE
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="inline-block">
                    <path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </svg>
            </a>
        </div>
    </div>

    <div class="flex flex-col md:flex-row overflow-hidden container max-w-7xl mx-auto">
        <!-- Left side - Soccer field image -->
        <div class="w-full md:w-1/2 h-[300px] md:h-[400px] relative">
            <img src="<?= get_template_directory_uri() ?>/assets/images/default-image.svg"
                alt="Terrain de soccer avec lignes blanches"
                class="rounded-lg object-cover absolute inset-0 w-full h-full" />
        </div>

        <!-- Right side - Content -->
        <div class="w-full md:w-1/2 py-6 md:pl-6 xl:pl-10 flex flex-col justify-center">
            <!-- Programs label -->
            <div
                class="flex items-center gap-1 text-blue-950 bg-gradient-to-br from-yellow-400 via-yellow-200 via-white via-yellow-300 to-yellow-600 justify-center px-4 py-1 rounded-md w-fit mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="h-4 w-4">
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
                    Camp de Jour
                </div>
            </div>

            <!-- Heading -->
            <h2
                class="text-3xl font-medium tracking-widest font-[Oswald]  bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent mb-4">
                DÉCOUVREZ NOTRE CAMP DE
                JOUR
            </h2>

            <!-- Description -->
            <p class="font-[Inter] text-gray-600 mb-8 text-muted-foreground text-xl max-w-3xl mx-auto">
                Le Club propose un Camp de Jour dynamique pour les jeunes, offrant des activités sportives et ludiques
                adaptées à tous les niveaux dès l’âge de 5 ans.
            </p>

            <!-- Button -->
            <a href="/camp-de-jour" class="w-full sm:w-auto bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 text-white rounded-xl
          first:rounded-t-lg last:rounded-b-lg py-4 sm:py-5 sm:px-8 tracking-wider sm:tracking-widest text-md
          text-center flex items-center justify-center gap-2 transition-colors duration-200 gradient-animate">
                VOIR NOTRE CAMP DE JOUR
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="inline-block">
                    <path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </svg>
            </a>
        </div>
    </div>
</section>