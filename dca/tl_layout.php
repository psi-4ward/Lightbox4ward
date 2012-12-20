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


// Callback for checking conflict with moo_mediabox
$GLOBALS['TL_DCA']['tl_layout']['fields']['mootools']['save_callback'][] = array('Lightbox4ward','onSubmit');

class Lightbox4ward extends System {
	public function onSubmit($varValue, DataContainer $dc){
		$arr = unserialize($varValue);
 		if(is_array($arr) && in_array('moo_mediabox',$arr) && in_array('moo_lightbox4ward',$arr)){
 			throw new Exception($GLOBALS['TL_LANG']['tl_layout']['lightbox4ward_error']);
 		}
 		return $varValue;
	}
}
