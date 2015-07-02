<?php

/**
 * lightbox4ward
 *
 * A lightbox implementation for contao
 * based on fancybox from http://fancyapps.com/fancybox
 *
 * @link       https://github.com/psi-4ward/lightbox4ward
 * @copyright  4ward.media 2014 <http://www.4wardmedia.de>
 * @author     Christoph Wiechert <wio@psitrax.de>
 * @package    lightbox4ward
 * @license    LGPL
 * @filesource
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'ContentLightbox4ward'        => 'system/modules/lightbox4ward/ContentLightbox4ward.php',
	'ModuleLightbox4wardAutoopen' => 'system/modules/lightbox4ward/ModuleLightbox4wardAutoopen.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_lightbox4ward'	      => 'system/modules/lightbox4ward/templates',
	'mod_lightbox4ward_autoopen'  => 'system/modules/lightbox4ward/templates',
	'j_lightbox4ward'             => 'system/modules/lightbox4ward/templates',
));
