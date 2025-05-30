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
                    class="text-3xl sm:text-4xl/10 md:text-5xl/15 font-bold bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent mb-4 uppercase font-[Oswald] tracking-wider sm:tracking-widest">
                    Rejoignez notre équipe
                </h1>

                <p class="text-lg sm:text-xl text-gray-600 mb-4 font-[Inter]">
                    Les Jeunes Ailés de Gatineau recherche des personnes passionnées et dévouées pour contribuer au
                    développement de nos jeunes athlètes. Découvrez nos opportunités d'emploi et faites partie de notre
                    communauté.
                </p>
            </div>

            <!-- Image -->
            <div class="w-full xl:w-1/2 flex justify-center xl:justify-end">
                <img class="rounded-lg w-full h-full object-cover"
                    src="<?= get_template_directory_uri() ?>/assets/images/default-image.svg" alt="Image d'avant page">
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            <?php
            $collections = get_posts([
                'post_type' => 'emplois',
                'post_status' => 'publish',
                'order' => 'ASC',
            ]);
            // var_dump($collections);
            
            foreach ($collections as $collection):
                $titre = get_field('titre', $collection->ID);
                $salaire_par_heure = get_field('salaire_par_heure', $collection->ID);
                $type_demploi = get_field('$type_demploi', $collection->ID);
                $date_limite_pour_la_candidature = get_field('date_limite_pour_la_candidature', $collection->ID);
                $description = get_field('description', $collection->ID);
                ?>
                <a href="<?= get_permalink($collection->ID); ?>" class="group">
                    <div class="py-6">
                        <div class="flex items-center justify-between mb-3">
                            <div
                                class="flex items-center gap-1 text-blue-950 bg-amber-300 justify-center px-4 py-1 rounded-md w-fit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4">
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
                            <div class="flex items-center gap-2 text-sm text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4">
                                    <path d="M8 2v4"></path>
                                    <path d="M16 2v4"></path>
                                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                    <path d="M3 10h18"></path>
                                </svg>
                                <?php
                                $date = new DateTime($collection->post_date);
                                $formatter = new IntlDateFormatter(
                                    'fr_FR',
                                    IntlDateFormatter::LONG,
                                    IntlDateFormatter::NONE,
                                    'America/Toronto',
                                    IntlDateFormatter::GREGORIAN,
                                    'd MMMM yyyy'
                                );
                                ?>
                                <span><?= $formatter->format($date) ?></span>
                            </div>
                        </div>
                        <h3
                            class="truncate w-full text-xl font-medium bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent mb-3 uppercase font-[Oswald] tracking-widest">
                            <?= $titre ?>
                        </h3>
                        <?php
                        // Get the WYSIWYG content
                        $description = get_field('description', $collection->ID);

                        // Strip HTML tags and decode entities
                        $plain_text = wp_strip_all_tags($description);

                        // Truncate to 150 characters (or whatever you want)
                        $max_length = 145;
                        if (strlen($plain_text) > $max_length) {
                            $truncated = mb_substr($plain_text, 0, $max_length) . '...';
                        } else {
                            $truncated = $plain_text;
                        }
                        ?>
                        <p class="text-gray-600 mb-4 leading-relaxed font-[Inter]"><?= esc_html($truncated) ?></p>
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
    </div>
</section>

<?php get_footer() ?>