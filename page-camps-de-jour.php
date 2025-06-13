<?php get_header() ?>
<section class="py-16 px-6 pt-40">
    <div class="container mx-auto max-w-7xl">
        <div class="flex flex-col xl:flex-row items-center gap-8 mb-20 container max-w-7xl mx-auto">
            <!-- Text Content -->
            <div class="w-full xl:w-1/2 text-start">
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
                        Camps de Jour
                    </div>
                </div>

                <h1
                    class="text-3xl sm:text-4xl/10 md:text-5xl/15 font-bold bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent mb-4 uppercase font-[Oswald] tracking-wider sm:tracking-widest">
                    DÉCOUVREZ NOS CAMPS DE JOUR
                </h1>

                <p class="text-lg sm:text-xl text-gray-600 mb-4 font-[Inter]">
                    Explorez nos camps de jour adaptés à chaque groupe d’âge pour favoriser l’épanouissement et le
                    plaisir de tous.
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
            'post_type' => 'product',
            'post_status' => 'publish',
            'order' => 'ASC',
            'tax_query' => [
                [
                    'taxonomy' => 'product_cat',
                    'field' => 'slug', // or 'term_id'
                    'terms' => 'camps-de-jour', // replace with your category slug
                ],
            ],
        ]); ?>
        <h2
            class="font-semibold flex mb-6 items-center gap-2 text-2xl bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent uppercase font-[Oswald] tracking-widest">
            Nos Camps de Jour</h2>
        <?php if ($collections): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <?php foreach ($collections as $collection):
                    // $titre = get_field('titre', $collection->ID);
                    // $salaire_par_heure = get_field('salaire_par_heure', $collection->ID);
                    // $type_demploi = get_field('$type_demploi', $collection->ID);
                    // $date_limite_pour_la_candidature = get_field('date_limite_pour_la_candidature', $collection->ID);
                    // $description = get_field('description', $collection->ID);
                    $date_de_debut = get_field('date_de_debut', $collection->ID);
                    ?>
                    <p><?= $date_de_debut ?></p>
                    <!-- <a href="<?= get_permalink($collection->ID); ?>" class="group">
                        <div class="py-6">
                            <div class="flex items-center justify-between mb-3">
                                <div
                                    class="flex items-center gap-1 text-blue-950 bg-gradient-to-br from-yellow-400 via-yellow-200 via-white via-yellow-300 to-yellow-600 justify-center px-4 py-1 rounded-md w-fit">
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
                                    // $date = new DateTime($collection->post_date);
                                    // $formatter = new IntlDateFormatter(
                                    //     'fr_FR',
                                    //     IntlDateFormatter::LONG,
                                    //     IntlDateFormatter::NONE,
                                    //     'America/Toronto',
                                    //     IntlDateFormatter::GREGORIAN,
                                    //     'd MMMM yyyy'
                                    // );
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
                            $max_length = 135;
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
                    </a> -->
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div
                class="container max-w-7xl mx-auto rounded-lg min-h-[500px] xl:h-96 flex items-center justify-center border bg-card shadow-sm bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 text-white">
                <div class="p-8 text-center">
                    <div class="mb-8 flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-briefcase w-12 h-12">
                            <path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                            <rect width="20" height="14" x="2" y="6" rx="2"></rect>
                        </svg>
                    </div>
                    <h2 class="text-2xl mb-4 uppercase font-[Oswald] tracking-widest">Aucun camp de jour disponible
                        actuellement
                    </h2>
                    <p class="text-white/80 mb-6 max-w-2xl mx-auto font-[Inter] text-lg sm:text-xl ">Nous n’avons pas de
                        Aucun camp de jour n’est offert pour le moment. Revenez bientôt pour découvrir nos prochaines
                        activités estivales!</p>
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