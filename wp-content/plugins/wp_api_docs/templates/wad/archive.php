<?php
/* Template Name: WP API Docs Archive */
Wad_API::get_header();

global $wad_templates;

echo $wad_templates->archive_page();

Wad_API::get_footer();
?>