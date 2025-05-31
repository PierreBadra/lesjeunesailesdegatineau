<?php get_header() ?>

<section class="py-16 px-6 pt-36">
    <div class="container mx-auto max-w-7xl">
        <div class="flex flex-col xl:flex-row items-center gap-8 mb-20 container max-w-7xl mx-auto">
            <!-- Text Content -->
            <div class="w-full xl:w-1/2 text-start">
                <div
                    class="flex items-center gap-1 text-blue-950 bg-amber-300 justify-center px-4 py-1 rounded-md w-fit mb-3">
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

                <h1
                    class="text-3xl sm:text-4xl/10 md:text-5xl/15 font-bold bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent mb-4 uppercase font-[Oswald] tracking-wider sm:tracking-widest">
                    Découvrez Nos Programmes
                </h1>

                <p class="text-lg sm:text-xl text-gray-600 mb-4 font-[Inter]">
                    Découvrez notre gamme complète de programmes conçus pour développer le potentiel de chaque groupe
                    d'âge.
                </p>
            </div>

            <!-- Image -->
            <div class="w-full xl:w-1/2 flex justify-center xl:justify-end">
                <img class="rounded-lg w-full h-full object-cover"
                    src="<?= get_template_directory_uri() ?>/assets/images/default-image.svg" alt="Image d'avant page">
            </div>
        </div>
        <?php
        $collections = get_posts([
            'post_type' => 'programmes',
            'post_status' => 'publish',
            'order' => 'ASC',
        ]); ?>
        <h2
            class="font-semibold flex mb-6 items-center gap-2 text-2xl bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent uppercase font-[Oswald] tracking-widest">
            Nos Programmes</h2>
        <?php if ($collections): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <?php foreach ($collections as $collection):
                    $titre = get_field('titre', $collection->ID);
                    $image = get_field('image_davant_page', $collection->ID);
                    $date_de_debut = parse_french_string_date_to_english(get_field('date_de_debut', $collection->ID));
                    $date_de_fin = parse_french_string_date_to_english(get_field('date_de_fin', $collection->ID));
                    $time_difference = calculate_time_difference_between_dates($date_de_debut, $date_de_fin)['text'];
                    $description = get_field('description', $collection->ID);
                    ?>
                    <a href="<?= get_permalink($collection->ID); ?>" class="group">
                        <div class="relative">
                            <img alt="Programmes d'été"
                                class="w-full h-48 rounded-lg object-cover transition-transform duration-300"
                                src="<?= $image ?>">
                        </div>
                        <div class="py-6">
                            <div class="flex items-center justify-between mb-3">
                                <div
                                    class="flex items-center gap-1 text-blue-950 bg-amber-300 justify-center px-4 py-1 rounded-md w-fit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="h-4 w-4">
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
                                <div class="flex items-center gap-2 text-sm text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4">
                                        <path d="M8 2v4"></path>
                                        <path d="M16 2v4"></path>
                                        <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                        <path d="M3 10h18"></path>
                                    </svg>
                                    <span><?= $time_difference ?></span>
                                </div>
                            </div>
                            <h2
                                class="truncate w-full text-xl font-medium bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent mb-3 uppercase font-[Oswald] tracking-widest">
                                <?= $titre ?>
                            </h2>
                            <p class="text-gray-600 mb-4 leading-relaxed line-clamp-3 font-[Inter]"><?= $description ?></p>
                            <div href="<?= get_permalink($collection->ID); ?>" class="w-full sm:w-auto text-white rounded-xl
                                first:rounded-t-lg last:rounded-b-lg py-4 sm:py-5 sm:px-8 tracking-wider sm:tracking-widest text-md
                                text-center flex items-center justify-center gap-2 bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 
                            [background-size:200%_200%] [background-position:left_center] 
                            transition-[background-position] duration-500 ease-out
                            hover:[background-position:right_center] 
                            group-hover:[background-position:right_center]">
                                EN SAVOIR PLUS
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="inline-block">
                                    <path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div
                class="container max-w-7xl mx-auto rounded-lg min-h-[500px] xl:h-96 flex items-center justify-center border bg-card shadow-sm bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 text-white">
                <div class="p-8 text-center">
                    <div class="mb-8 flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="h-12 w-12">
                            <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path>
                            <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path>
                            <path d="M4 22h16"></path>
                            <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path>
                            <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path>
                            <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl mb-4 uppercase font-[Oswald] tracking-widest">Aucun programme ouvert aux
                        inscriptions
                    </h2>
                    <p class="text-white/80 mb-6 max-w-2xl mx-auto font-[Inter] text-lg sm:text-xl">Les inscriptions pour
                        nos programmes ne sont pas ouvertes actuellement. Si vous avez des questions concernant nos
                        programmes ou les inscriptions, n’hésitez pas à nous joindre.</p>
                    <div class="">
                        <a href="/nous-joindre"
                            class="w-full sm:w-auto sm:min-w-[320px] md:min-w-[400px] bg-white text-gray-900 rounded-xl hover:bg-gray-100 uppercase transition-colors duration-200 first:rounded-t-lg last:rounded-b-lg py-4 sm:py-5 sm:px-8 tracking-wider sm:tracking-widest text-md text-center flex items-center justify-center gap-2">
                            Contactez nous
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg" class="inline-block">
                                <path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer() ?>