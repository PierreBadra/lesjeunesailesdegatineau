<?php get_header(); ?>

<section class="px-6 py-30 pt-60">
    <div class="text-center flex flex-col items-center justify-center">
        <!-- Large 404 Number -->
        <div class="mb-8">
            <h1 class="text-8xl md:text-9xl font-bold text-blue-600 opacity-20 select-none">404</h1>
        </div>

        <!-- Error Message -->
        <h2
            class="text-3xl font-bold bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent mb-4 uppercase font-[Oswald] tracking-wider sm:tracking-widest">
            Page introuvable</h2>
        <p class="text-lg text-gray-600 mb-8 font-[Inter] max-w-3xl mx-auto sm:text-xl">
            Oups ! Il semble que la page que vous recherchez n'existe pas ou a été déplacée. Pas de panique, nous
            sommes là pour vous aider à retrouver votre chemin.
        </p>

        <!-- Quick Actions -->
        <a href="/" class="w-full sm:w-auto bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 text-white rounded-xl
          first:rounded-t-lg last:rounded-b-lg py-4 sm:py-5 sm:px-8 tracking-wider sm:tracking-widest text-md
          text-center flex items-center justify-center gap-2 transition-colors duration-200 gradient-animate uppercase">
            Retour à l'accueil
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                class="inline-block">
                <path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                </path>
            </svg>
        </a>
    </div>
</section>



<?php get_footer(); ?>