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


// Callback for checking conflict with moo_mediabox
$GLOBALS['TL_DCA']['tl_layout']['fields']['jquery']['save_callback'][] = array('lightbox4ward','onSubmit');

class lightbox4ward
{
	public function onSubmit($varValue)
	{
		$arr = unserialize($varValue);
 		if(is_array($arr) && in_array('j_colorbox',$arr) && in_array('j_lightbox4ward',$arr))
		{
 			throw new Exception($GLOBALS['TL_LANG']['tl_layout']['lightbox4ward_error']);
 		}
 		return $varValue;
	}
}
