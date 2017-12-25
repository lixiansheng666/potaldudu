<?php
/* Template Name: WP Search Docs File */
Wad_API::get_header();

global $wad_templates;

echo $wad_templates->search_page();

Wad_API::get_footer();
?>