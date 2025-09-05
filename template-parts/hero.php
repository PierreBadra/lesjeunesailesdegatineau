<?php
$images = get_posts([
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'post_status' => 'inherit',
    'posts_per_page' => -1,
]);
$image_urls = array_map('wp_get_attachment_url', wp_list_pluck($images, 'ID'));
// Check if we have at least one image

// Remove URLs containing 'woocommerce-placeholder'
$image_urls = array_filter($image_urls, function ($url) {
    return strpos($url, 'woocommerce-placeholder') === false;
});

$has_images = !empty($image_urls);
// Default background image as fallback
?>

<section class="relative text-white overflow-hidden px-6 pt-20 sm:pt-24 lg:pt-28" id="hero-container">
    <!-- Background image container with two divs for crossfade -->
    <div id="bg-image-1"
        class="absolute inset-0 bg-center bg-cover bg-no-repeat transition-opacity duration-1000 ease-in-out opacity-100"
        style="background-image: url(<?= $has_images ? $image_urls[0] : '' ?>"></div>

    <div id="bg-image-2"
        class="absolute inset-0 bg-center bg-cover bg-no-repeat transition-opacity duration-1000 ease-in-out opacity-0"
        style="background-image: url(<?= $has_images ? (count($image_urls) > 1 ? $image_urls[1] : $image_urls[0]) : '' ?>);">
    </div>


    <!-- Blue Overlay -->
    <div class="absolute inset-0 bg-[#092049]/85 z-[1]"></div>

    <div
        class="flex relative flex-col items-start justify-center w-full container max-w-7xl mx-auto min-h-[85vh] sm:min-h-[90vh] text-start z-10">
        <!-- Rest of your content remains the same -->
        <h1
            class="bg-gradient-to-b from-yellow-300 via-amber-400 to-orange-500 text-transparent bg-clip-text text-5xl/15 sm:text-6xl/20 md:text-7xl/25 font-medium tracking-widest font-[Oswald]">
            LES JEUNES AILÉS <br>DE GATINEAU
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.webp"
                alt="Les Jeunes Ailés de Gatineau Logo" class="hidden md:inline w-30 h-30">
        </h1>

        <!-- Slogan -->
        <p
            class="text-xl md:-mt-6 font-light opacity-80 mb-6 sm:mb-8 lg:mb-11 max-w-md sm:max-w-lg lg:max-w-none sm:text-2xl md:text-3xl">
            Là où renaît le talent
        </p>

        <h2
            class="text-white text-xl sm:text-2xl md:text-3xl font-[Oswald] tracking-wider sm:tracking-widest font-medium uppercase">
            Camps de jour été 2025
        </h2>

        <!-- Announcement -->
        <p class="text-xl font-light opacity-80 mb-8 sm:mb-10 lg:mb-14 max-w-2xl leading-relaxed">
            Du 30 juin au 18 juillet<br>Collège Héritage : 325 Bd de la Cité-des-Jeunes
        </p>

        <!-- Call to Action Button -->
        <a href="camps-de-jour"
            class="w-full sm:w-auto sm:min-w-[320px] md:min-w-[400px] bg-gradient-to-br gradient-animate from-yellow-400 via-yellow-200 via-white via-yellow-300 to-yellow-600 text-gray-900 rounded-xl  transition-colors duration-200 first:rounded-t-lg last:rounded-b-lg py-4 sm:py-5 sm:px-8 tracking-wider sm:tracking-widest text-md text-center flex items-center justify-center gap-2">
            INSCRIVEZ-VOUS MAINTENANT
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="inline-block">
                <path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>

    </div>
</section>

<?php if (count($image_urls) > 1): ?>
    <style>
        @keyframes slowZoom {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.1);
            }
        }

        .bg-zoom-animation {
            animation: slowZoom 5s linear forwards;
        }
    </style>

    <script>
        const bgImage1 = document.getElementById('bg-image-1');
        const bgImage2 = document.getElementById('bg-image-2');
        const wpImages = <?php echo json_encode($image_urls); ?>;
        let currentIndex = 0;
        let activeImage = 1; // Track which div is currently visible
        const slideDuration = 5000; // 5 seconds per slide
        // Only run if we have at least 2 images
        if (wpImages && wpImages.length > 1 && bgImage1 && bgImage2) {
            // Set initial images
            bgImage1.style.backgroundImage = `url(${wpImages[0]})`;
            bgImage1.classList.add('bg-zoom-animation');
            bgImage2.style.backgroundImage = `url(${wpImages[1]})`;

            function switchImages() {
                currentIndex = (currentIndex + 1) % wpImages.length;
                const nextImageIndex = (currentIndex + 1) % wpImages.length;

                if (activeImage === 1) {
                    // Prepare the next image in bg-image-2
                    bgImage2.style.backgroundImage = `url(${wpImages[currentIndex]})`;

                    // Start zoom on the next image that's about to appear
                    bgImage2.classList.add('bg-zoom-animation');

                    // Fade out current, fade in next
                    bgImage1.classList.remove('opacity-100');
                    bgImage1.classList.add('opacity-0');
                    bgImage2.classList.remove('opacity-0');
                    bgImage2.classList.add('opacity-100');

                    // After transition completes, reset the previous image
                    setTimeout(() => {
                        bgImage1.classList.remove('bg-zoom-animation');
                        bgImage1.style.backgroundImage = `url(${wpImages[nextImageIndex]})`;
                        activeImage = 2;
                    }, 1000);
                } else {
                    // Prepare the next image in bg-image-1
                    bgImage1.style.backgroundImage = `url(${wpImages[currentIndex]})`;

                    // Start zoom on the next image that's about to appear
                    bgImage1.classList.add('bg-zoom-animation');

                    // Fade out current, fade in next
                    bgImage2.classList.remove('opacity-100');
                    bgImage2.classList.add('opacity-0');
                    bgImage1.classList.remove('opacity-0');
                    bgImage1.classList.add('opacity-100');

                    // After transition completes, reset the previous image
                    setTimeout(() => {
                        bgImage2.classList.remove('bg-zoom-animation');
                        bgImage2.style.backgroundImage = `url(${wpImages[nextImageIndex]})`;
                        activeImage = 1;
                    }, 1000);
                }
            }

            // Start the slideshow
            setInterval(switchImages, slideDuration);
        } else if (wpImages && wpImages.length === 1 && bgImage1) {
            // If we only have one image, just apply the zoom effect to it
            bgImage1.classList.add('bg-zoom-animation');
        }
    </script>
<?php endif; ?>