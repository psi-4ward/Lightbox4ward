<?php

/**
 * Lightbox4ward
 *
 * A lightbox implementation for contao
 * based on mediaboxAdvanced from http://iaian7.com/webcode/mediaboxAdvanced
 *
 * @copyright  4ward.media 2012 <http://www.4wardmedia.de>
 * @author     Christoph Wiechert <christoph.wiechert@4wardmedia.de>
 * @package    lightbox4ward
 * @license    LGPL
 * @filesource
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'WidgetLightbox4ward'         => 'system/modules/lightbox4ward/WidgetLightbox4ward.php',
	'WidgetLightbox4wardCheckbox' => 'system/modules/lightbox4ward/WidgetLightbox4wardCheckbox.php',
	'ContentLightbox4ward'        => 'system/modules/lightbox4ward/ContentLightbox4ward.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_lightbox4ward_article'     => 'system/modules/lightbox4ward/templates',
	'ce_lightbox4ward_image'       => 'system/modules/lightbox4ward/templates',
	'moo_lightbox4ward'            => 'system/modules/lightbox4ward/templates',
	'widget_lightbox4ward_article' => 'system/modules/lightbox4ward/templates',
	'widget_lightbox4ward_image'   => 'system/modules/lightbox4ward/templates',
));
