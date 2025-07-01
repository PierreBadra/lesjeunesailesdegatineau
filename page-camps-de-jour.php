<?php get_header() ?>
<section class="py-16 px-6 pt-40">
    <div class="container mx-auto max-w-7xl">
        <div class="flex flex-col xl:flex-row items-center gap-8 mb-20 container max-w-7xl mx-auto">
            <!-- Text Content -->
            <div class="w-full xl:w-1/2 text-start">
                <div
                    class="flex items-center gap-1 text-blue-950 bg-gradient-to-br from-yellow-400 via-yellow-200 via-white via-yellow-300 to-yellow-600 justify-center px-4 py-1 rounded-md w-fit mb-3">
                    <svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-sun-icon lucide-sun w-4 h-4">
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
            'post_type' => 'produit',
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
                    $product = wc_get_product($collection->ID);
                    $date_de_debut = parse_french_string_date_to_english(get_field('date_de_debut', $collection->ID));
                    $date_de_fin = parse_french_string_date_to_english(get_field('date_de_fin', $collection->ID));
                    $time_difference = calculate_time_difference_between_dates($date_de_debut, $date_de_fin)['text'];
                    $image = get_field('image_davant_page', $collection->ID);
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
                                    class="flex items-center gap-1 text-blue-950 bg-gradient-to-br from-yellow-400 via-yellow-200 via-white via-yellow-300 to-yellow-600 justify-center px-4 py-1 rounded-md w-fit">
                                    <svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
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
                                        Camps de Jour
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
                            <h3
                                class="truncate w-full text-xl font-medium bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-clip-text text-transparent mb-3 uppercase font-[Oswald] tracking-widest">
                                <?= $product->get_name(); ?>
                            </h3>
                            <?php
                            // Get the WYSIWYG content
                            $description = $product->get_description();

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
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div
                class="container max-w-7xl mx-auto rounded-lg min-h-[500px] xl:h-96 flex items-center justify-center border bg-card shadow-sm bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 text-white">
                <div class="p-8 text-center">
                    <div class="mb-8 flex justify-center">
                        <svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-sun-icon lucide-sun w-12 h-12">
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