<?php
$images = get_posts([
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'post_status' => 'inherit',
    'posts_per_page' => -1,
]);
$image_urls = array_map('wp_get_attachment_url', wp_list_pluck($images, 'ID'));
?>

<section class="relative text-white overflow-hidden p-8 pt-20 sm:pt-24 lg:pt-28" id="hero-container">
    <!-- Background image container with two divs for crossfade -->
    <div id="bg-image-1"
        class="absolute inset-0 bg-center bg-cover bg-no-repeat transition-opacity duration-1000 ease-in-out opacity-100"
        style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-1.webp);"></div>

    <div id="bg-image-2"
        class="absolute inset-0 bg-center bg-cover bg-no-repeat transition-opacity duration-1000 ease-in-out opacity-0"
        style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-1.webp);"></div>

    <!-- Blue Overlay -->
    <div class="absolute inset-0 bg-[#092049]/85 z-[1]"></div>

    <div
        class="flex relative flex-col items-start justify-center w-full max-w-4xl min-h-[85vh] sm:min-h-[90vh] text-start z-10">
        <!-- Rest of your content remains the same -->
        <h1 class="text-5xl/15 sm:text-6xl/20 md:text-7xl/25 font-medium tracking-widest font-[Oswald]">
            LES JEUNES AILÉS <br>DE GATINEAU
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.webp"
                alt="Les Jeunes Ailés de Gatineau Logo" class="hidden md:inline w-30 h-30">
        </h1>

        <!-- Slogan -->
        <p class="text-xl md:-mt-6 font-light opacity-80 mb-6 sm:mb-8 lg:mb-11 max-w-md sm:max-w-lg lg:max-w-none">
            Là où renaît le talent
        </p>

        <h2 class="text-xl sm:text-2xl md:text-3xl font-[Oswald] tracking-wider sm:tracking-widest font-medium">
            INSCRIPTIONS POUR L'ÉTÉ 2025
        </h2>

        <!-- Announcement -->
        <p class="text-xl font-light opacity-80 mb-8 sm:mb-10 lg:mb-14 max-w-2xl leading-relaxed">
            Toute l'équipe de Les Jeunes Ailés de Gatineau est fière de vous annoncer que les inscriptions pour nos
            programmes d'été 2025 sont maintenant ouvertes !
        </p>

        <!-- Call to Action Button -->
        <a href="#"
            class="w-full sm:w-auto sm:min-w-[320px] md:min-w-[400px] bg-[#092049] hover:bg-[#143267] border border-white text-white font-bold py-4 sm:py-5 sm:px-8 tracking-wider sm:tracking-widest text-md text-center transition-colors duration-200 rounded-sm sm:rounded-none">
            INSCRIVEZ-VOUS MAINTENANT
        </a>
    </div>
</section>

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

    // Set initial images if we have any
    if (wpImages.length > 0) {
        bgImage1.style.backgroundImage = `url(${wpImages[0]})`;
        bgImage1.classList.add('bg-zoom-animation');

        // If we have more than one image, prepare the second one
        if (wpImages.length > 1) {
            bgImage2.style.backgroundImage = `url(${wpImages[1]})`;
        }
    }

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

    // Start the slideshow if we have more than one image
    if (wpImages.length > 1) {
        setInterval(switchImages, slideDuration);
    }
</script>