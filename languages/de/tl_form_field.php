<?php
if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
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
 * @copyright  4ward.media 2010
 * @author     Christoph Wiechert <christoph.wiechert@4wardmedia.de>
 * @package    lightbox4ward
 * @license    LGPL 
 * @filesource
 */

$GLOBALS['TL_LANG']['FFL']['lightbox4ward'] = array('Lightbox4ward','Stellt einen Link oder einen Artikel als Lightbox-Element dar.');
$GLOBALS['TL_LANG']['FFL']['lightbox4ward_checkbox'] = array('Lightbox4ward Checkbox','Stellt einen Artikel als Lightbox-Element neben einer Checkbox dar.');

$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_link_legend'] = 'Lightbox4ward - Link';
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_content_legend'] = 'Lightbox4ward - Inhalt';

$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_type']['0'] = "Inhaltstyp";
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_type']['1'] = "Die Art des Inhaltes, welcher in der Lightbox dargestellt werden soll.";

$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_caption']['0'] = "Lightbox-Titel";
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_caption']['1'] = "Der Titel steht hervorgehoben in der Lightbox unter dem Inhalt.";
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_description']['0'] = "Beschreibung";
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_description']['1'] = "Die Beschreibung wird in der Lightbox unter dem Inhalt angezeigt.";
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_size']['0'] = "Lightbox-Größe";
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_size']['1'] = "Hier können Sie die Breite und Höhe der Lightbox in Pixeln festlegen.";
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_imageSRC']['0'] = "Bild";
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_imageSRC']['1'] = "Dieses Bild wird in der Lightbox dargestellt.";
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_externURL']['0'] = "Lightbox-URL";
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_externURL']['1'] = "Die URL zum entfernten Objekt. Dies kann ein Bild, ein social-vido-link oder eine normale Website sein.";


$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_types']['image'] = 'Bild';
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_types']['text'] = 'Text';
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_types']['article'] = 'Artikel';
$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_types']['extern'] = 'Externe Seite';

/**
 * ExternURL Explanation
 */
$GLOBALS['TL_LANG']['XPL']['lightbox4ward_externURL'] = array
(
	array('Bild', 'Die URL auf ein Bild wird wie ein Bild der lokalen Website angezeigt.'),
	array('Soicial Video', 'Lightbox4ward unterstüzt die Einbindung externer Videoquellen wie Facebook,Google,Youtube und viele andere. <a href="http://iaian7.com/webcode/mediaboxAdvanced#examples" onclick="window.open(this.href); return false;">Weitere Informationen</a>.'),
);


?>
