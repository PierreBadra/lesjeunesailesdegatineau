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
  <title><?php wp_title('|', true, 'right'); ?> Les Jeunes Ailés de Gatineau</title>
  <!-- <?php wp_head(); ?> -->
</head>

<body>
  <header class="p-6 fixed w-full z-1">
    <div class="flex justify-between items-center">
      <a href="/" class="flex items-center gap-2">
        <img class="w-16 h-16" src="<?= get_template_directory_uri(); ?>/assets/images/logo.webp" alt="Logo Image">
        <h2 class="hidden md:block tracking-widest text-2xl text-white font-[Oswald]">LES JEUNES AILÉS DE GATINEAU</h2>
      </a>
      <nav class="font-[Inter]">
        <ul class="flex gap-10 tracking-widest text-sm text-white font-light">
          <?php
          wp_list_pages([
            'title_li' => '', // Removes the default "Pages" title
            'exclude' => '', // Add page IDs to exclude if needed, e.g., '1,2'
          ]);
          ?>
          <li class="flex items-center gap-3">
            <a href="#" target="_blank"><img src="<?= get_template_directory_uri(); ?>/assets/images/facebook-icon.svg"
                alt="Lien Facebook"></a>
            <a href="#" target="_blank"><img src="<?= get_template_directory_uri(); ?>/assets/images/instagram-icon.svg"
                alt="Lien Instagram"></a>
          </li>
        </ul>
      </nav>
    </div>
  </header>