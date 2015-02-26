<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

	$context = Timber::get_context();	
	$templates = array('404.twig');
	$context['html_title'] = $context['site']->title." | 404";
	Timber::render($templates, $context);