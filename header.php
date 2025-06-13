<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Oswald:wght@200..700&display=swap"
    rel="stylesheet">
  <link href="<?= get_template_directory_uri(); ?>/assets/css/output.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="<?= get_template_directory_uri() ?>/assets/images/logo.webp" type="image/x-icon">
  <title><?php wp_title('|', true, 'right'); ?> Les Jeunes Ailés de Gatineau</title>
</head>

<body>
  <style>
    .gradient-animate {
      background-size: 200% 200%;
      background-position: left center;
      transition: background-position 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Keep the original hover on the element itself */
    .gradient-animate:hover {
      background-position: right center;
    }

    /* Add the parent hover effect */
    .group:hover .gradient-animate {
      background-position: right center;
    }
  </style>
  <header
    class="px-6 py-3 fixed w-full z-50 bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 transition-all duration-300">
    <div class="flex justify-between items-center container max-w-7xl mx-auto">
      <a href="/" class="flex items-center gap-2 z-50 relative">
        <img class="w-24 h-24" src="<?= get_template_directory_uri(); ?>/assets/images/logo.webp" alt="Logo Image">
      </a>

      <nav class="font-[Inter]">
        <!-- Mobile menu button -->
        <button id="mobile-menu-toggle"
          class="xl:hidden relative z-50 flex flex-col justify-center items-center text-white focus:outline-none group"
          aria-label="Toggle menu" aria-expanded="false">
          <span id="hamburger-line-1"
            class="block w-6 h-0.5 bg-current transform transition-all duration-300 ease-in-out"></span>
          <span id="hamburger-line-2"
            class="block w-6 h-0.5 bg-current transform transition-all duration-300 ease-in-out mt-1.5"></span>
          <span id="hamburger-line-3"
            class="block w-6 h-0.5 bg-current transform transition-all duration-300 ease-in-out mt-1.5"></span>
        </button>

        <!-- Desktop Menu -->
        <ul class="hidden xl:flex gap-10 tracking-widest text-sm text-white font-light">
          <?php

          $pages = get_pages([
            'sort_column' => 'menu_order',
            'sort_order' => 'asc',
          ]);
          $index = 0;
          foreach ($pages as $page):
            $index++;
            ?>
            <li>
              <a href="<?= get_permalink($page->ID); ?>" class="hover:text-gray-300 transition-colors duration-200">
                <?= esc_html($page->post_title); ?>
              </a>
            </li>
            <?php if ($index === 2): ?>
              <li class="relative group">
                <button class="flex items-center hover:text-gray-300 transition-colors duration-200">
                  <a href="/programmes">Programmes</a>
                  <svg class="ml-1 h-5 w-5 transform group-hover:rotate-180 transition-transform duration-200"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd" />
                  </svg>
                </button>
                <!-- Desktop Dropdown -->
                <ul
                  class="absolute left-0 mt-2 w-fit bg-white text-gray-900 rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transform scale-95 group-hover:scale-100 transition-all duration-200 z-50">
                  <?php
                  $collections = get_posts([
                    'post_type' => 'programmes',
                    'post_status' => 'publish',
                    'order' => 'ASC',
                  ]);
                  foreach ($collections as $collection): ?>
                    <li>
                      <a href="<?= get_permalink($collection->ID); ?>"
                        class="truncate block px-4 py-3 hover:bg-gray-100 transition-colors duration-200 first:rounded-t-lg last:rounded-b-lg">
                        <?= esc_html(get_the_title($collection->ID)); ?>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </li>
            <?php endif; ?>
            <?php if ($index === 3): ?>
              <li>
                <a href="/emplois" class="hover:text-gray-300 transition-colors duration-200">
                  Emplois
                </a>
              </li>
            <?php endif; ?>
          <?php endforeach; ?>
          <li class="flex items-center gap-3">
            <a href="#" target="_blank" class="hover:opacity-70 transition-opacity duration-200">
              <img class="w-4 h-4" src="<?= get_template_directory_uri(); ?>/assets/images/facebook-icon.svg"
                alt="Lien Facebook">
            </a>
            <a href="https://www.instagram.com/jeunesailesdegatineau/" target="_blank" class="hover:opacity-70 transition-opacity duration-200">
              <img class="w-4 h-4" src="<?= get_template_directory_uri(); ?>/assets/images/instagram-icon.svg"
                alt="Lien Instagram">
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </header>
  <!-- Mobile Menu Dropdown -->
  <div id="mobile-menu"
    class="xl:hidden fixed top-0 left-0 right-0 pt-[88px] backdrop-blur-sm bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 bg-opacity-0 transform -translate-y-full opacity-0 invisible transition-all duration-300 ease-in-out z-40 shadow-lg">
    <div class="p-6">
      <ul class="space-y-6">
        <?php
        $index = 0;
        foreach ($pages as $page):
          $index++;
          ?>
          <li>
            <a href="<?= get_permalink($page->ID); ?>"
              class="block text-xl text-white tracking-widest font-light hover:text-gray-300 transition-colors duration-200 py-2">
              <?= esc_html($page->post_title); ?>
            </a>
          </li>
          <?php if ($index === 2): ?>
            <li>
              <button id="mobile-programmes-toggle"
                class="flex items-center justify-between w-full text-xl text-white tracking-widest font-light hover:text-gray-300 transition-colors duration-200 py-2">
                <a href="/programmes">Programmes</a>
                <svg id="mobile-dropdown-arrow" class="h-5 w-5 transform transition-transform duration-200"
                  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
                </svg>
              </button>
              <!-- Mobile Dropdown -->
              <ul id="mobile-programmes-menu"
                class="mt-2 ml-4 space-y-3 max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                <?php
                $collections = get_posts([
                  'post_type' => 'programmes',
                  'post_status' => 'publish',
                  'order' => 'ASC',
                ]);
                foreach ($collections as $collection): ?>
                  <li>
                    <a href="<?= get_permalink($collection->ID); ?>"
                      class="truncate block text-base text-gray-300 hover:text-white transition-colors duration-200 py-1">
                      <?= esc_html(get_the_title($collection->ID)); ?>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            </li>
          <?php endif; ?>
          <?php if ($index === 3): ?>
            <li>
              <a href="/emplois"
                class="block text-xl text-white tracking-widest font-light hover:text-gray-300 transition-colors duration-200 py-2">
                Emplois
              </a>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>

        <!-- Mobile Social Links -->
        <li class="flex items-center gap-6 pt-4 border-t border-white">
          <a href="#" target="_blank" class="hover:opacity-70 transition-opacity duration-200">
            <img class="w-5 h-5" src="<?= get_template_directory_uri(); ?>/assets/images/facebook-icon.svg"
              alt="Lien Facebook">
          </a>
          <a href="https://www.instagram.com/jeunesailesdegatineau/" target="_blank" class="hover:opacity-70 transition-opacity duration-200">
            <img class="w-5 h-5" src="<?= get_template_directory_uri(); ?>/assets/images/instagram-icon.svg"
              alt="Lien Instagram">
          </a>
        </li>
      </ul>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const header = document.querySelector('header');
      const heroSection = document.getElementById('hero-container');
      const mobileMenu = document.getElementById('mobile-menu');

      const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
      const hamburgerLine1 = document.getElementById('hamburger-line-1');
      const hamburgerLine2 = document.getElementById('hamburger-line-2');
      const hamburgerLine3 = document.getElementById('hamburger-line-3');

      // Mobile programmes dropdown
      const programmesToggle = document.getElementById('mobile-programmes-toggle');
      const programmesMenu = document.getElementById('mobile-programmes-menu');
      const dropdownArrow = document.getElementById('mobile-dropdown-arrow');

      let isMenuOpen = false;
      let isProgrammesOpen = false;
      let isScrolledPastHero = false;

      // Toggle mobile menu
      mobileMenuToggle.addEventListener('click', function () {
        isMenuOpen = !isMenuOpen;

        if (isMenuOpen) {
          // Open menu - slide down from top
          mobileMenu.classList.remove('-translate-y-full', 'opacity-0', 'invisible');
          mobileMenu.classList.add('translate-y-0', 'opacity-100', 'visible');

          // Animate hamburger to X
          hamburgerLine1.classList.add('rotate-45', 'translate-y-2');
          hamburgerLine2.classList.add('opacity-0');
          hamburgerLine3.classList.add('-rotate-45', '-translate-y-2');

          mobileMenuToggle.setAttribute('aria-expanded', 'true');
        } else {
          // Close menu - slide up
          mobileMenu.classList.remove('translate-y-0', 'opacity-100', 'visible');
          mobileMenu.classList.add('-translate-y-full', 'opacity-0', 'invisible');

          // Animate X back to hamburger
          hamburgerLine1.classList.remove('rotate-45', 'translate-y-2');
          hamburgerLine2.classList.remove('opacity-0');
          hamburgerLine3.classList.remove('-rotate-45', '-translate-y-2');

          mobileMenuToggle.setAttribute('aria-expanded', 'false');

          // Close programmes dropdown if open
          if (isProgrammesOpen) {
            isProgrammesOpen = false;
            programmesMenu.style.maxHeight = '0px';
            dropdownArrow.classList.remove('rotate-180');
          }
        }
      });

      // Toggle programmes dropdown in mobile menu
      if (programmesToggle) {
        programmesToggle.addEventListener('click', function () {
          isProgrammesOpen = !isProgrammesOpen;

          if (isProgrammesOpen) {
            programmesMenu.style.maxHeight = programmesMenu.scrollHeight + 'px';
            dropdownArrow.classList.add('rotate-180');
          } else {
            programmesMenu.style.maxHeight = '0px';
            dropdownArrow.classList.remove('rotate-180');
          }
        });
      }

      // Close mobile menu when clicking on links
      const mobileMenuLinks = mobileMenu.querySelectorAll('a');
      mobileMenuLinks.forEach(link => {
        link.addEventListener('click', function () {
          if (isMenuOpen) {
            mobileMenuToggle.click();
          }
        });
      });

      // Close menu when clicking outside
      document.addEventListener('click', function (e) {
        if (isMenuOpen && !mobileMenu.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
          mobileMenuToggle.click();
        }
      });
    });

  </script>