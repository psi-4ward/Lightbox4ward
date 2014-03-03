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


// Palettes
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{lightbox4ward_legend},lightbox4ward_openCloseEffect,lightbox4ward_openCloseSpeed,lightbox4ward_nextPrevEffect,lightbox4ward_nextPrevSpeed,lightbox4ward_galleryNav,lightbox4ward_title,lightbox4ward_count';

// Fields

$GLOBALS['TL_DCA']['tl_settings']['fields']['lightbox4ward_openCloseMethod'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_settings']['lightbox4ward_openCloseMethod'],
	'inputType'		=> 'select',
	'default'		=> 'zoom',
	'options'		=> array('zoom', 'change'),
	'eval'			=> array('mandatory'=>true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['lightbox4ward_nextPrevMethod'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_settings']['lightbox4ward_nextPrevMethod'],
	'inputType'		=> 'select',
	'default'		=> 'change',
	'options'		=> array('zoom', 'change'),
	'eval'			=> array('mandatory'=>true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['lightbox4ward_openCloseEffect'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_settings']['lightbox4ward_openCloseEffect'],
	'inputType'		=> 'select',
	'default'		=> 'elastic',
	'options'		=> array('elastic', 'fade'),
	'eval'			=> array('mandatory'=>true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['lightbox4ward_nextPrevEffect'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_settings']['lightbox4ward_nextPrevEffect'],
	'inputType'		=> 'select',
	'default'		=> 'elastic',
	'options'		=> array('elastic', 'fade'),
	'eval'			=> array('mandatory'=>true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['lightbox4ward_openCloseSpeed'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_settings']['lightbox4ward_openCloseSpeed'],
	'inputType'		=> 'text',
	'default'		=> '250',
	'eval'			=> array('mandatory'=>true, 'tl_class'=>'w50', 'rgxp'=>'digit')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['lightbox4ward_nextPrevSpeed'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_settings']['lightbox4ward_nextPrevSpeed'],
	'inputType'		=> 'text',
	'default'		=> '250',
	'eval'			=> array('mandatory'=>true, 'tl_class'=>'w50', 'rgxp'=>'digit')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['lightbox4ward_galleryNav'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_settings']['lightbox4ward_galleryNav'],
	'inputType'		=> 'select',
	'default'		=> 'dots',
	'options'		=> array('dots', 'thumbs', 'none'),
	'eval'			=> array('mandatory'=>true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['lightbox4ward_title'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_settings']['lightbox4ward_title'],
	'inputType'		=> 'select',
	'default'		=> 'float',
	'options'		=> array('float', 'inside', 'outside', 'over'),
	'eval'			=> array('mandatory'=>true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['lightbox4ward_count'] = array
(
	'label'			=> &$GLOBALS['TL_LANG']['tl_settings']['lightbox4ward_count'],
	'inputType'		=> 'checkbox',
	'eval'			=> array('mandatory'=>true, 'tl_class'=>'w50')
);
