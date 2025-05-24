<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
  <link href="wp-content/themes/lesjeunesailesdegatineau/assets/css/output.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <title><?php wp_title('|', true, 'right'); ?></title>
  <!-- <?php wp_head(); ?> -->
</head>

<body>
  <header class="bg-gray-700 p-8">
    <div class="flex justify-between items-center">
      <a href="/" class="flex items-center gap-2">
        <img class="w-16 h-16" src="wp-content/themes/lesjeunesailesdegatineau/assets/images/logo.webp"
          alt="Logo Image">
        <h2 class="hidden md:block tracking-widest text-2xl text-white font-[Oswald]">LES JEUNES AILÉS DE GATINEAU</h2>
      </a>
      <nav>
        <ul class="flex gap-4">
          <?php
          wp_list_pages([
            'title_li' => '', // Removes the default "Pages" title
            'exclude' => '', // Add page IDs to exclude if needed, e.g., '1,2'
          ]);
          ?>
        </ul>
      </nav>
    </div>
  </header>