<?php
/* Template Name: WP API Docs File */
Wad_API::get_header();

global $wad_templates;

echo $wad_templates->single_page();

Wad_API::get_footer();
?>