<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005-2009 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  4ward.media 2009
 * @author     Christoph Wiechert <christoph.wiechert@4wardmedia.de>
 * @package    lightbox.4ward
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
?>