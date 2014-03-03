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


$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_link_legend'] = 'Lightbox4ward - Link';

$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_content_legend'] = 'Lightbox4ward - Inhalt';

$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_type']['0'] = "Inhaltstyp";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_type']['1'] = "Die Art des Inhaltes, welcher in der Lightbox dargestellt werden soll.";

$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_caption']['0'] = "Lightbox-Titel";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_caption']['1'] = "Der Titel steht hervorgehoben in der Lightbox unter dem Inhalt. Wenn Sie dieses Feld leer lassen, wird der Bildtitel aus der Dateiverwaltung eingefügt.";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_size']['0'] = "Lightbox-Größe";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_size']['1'] = "Hier können Sie die Breite und Höhe der Lightbox in Pixeln festlegen.";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_singleSRC']['0'] = "Bild";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_singleSRC']['1'] = "Dieses Bild wird in der Lightbox dargestellt.";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_gallerySRC']['0'] = "Galeriebilder";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_gallerySRC']['1'] = "Wählen Sie hier die Bilder für die Galerie aus.";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_externURL']['0'] = "Lightbox-URL";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_externURL']['1'] = "Die URL zum entfernten Objekt. Dies kann ein Bild, ein social-vido-link oder eine normale Website sein.";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_flvSRC']['0'] = "FLV/MOV/SWF/MP4/F4V Video";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_flvSRC']['1'] = "Wählen Sie hier das FLV,MOV,MP4,F4V oder SWF Video aus.";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_html5videoSRC']['0'] = "HTML5 Video Dateien";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_html5videoSRC']['1'] = "Wählen Sie hier die MP4,WebM und OGV Datei des Videos aus um die größtmögliche Browserunterstützung zu erhalten.";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_closeOnEnd']['0'] = "Am Ende des Videos die Lightbox schließen";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_closeOnEnd']['1'] = "Schließt die Lightbox wenn das Video durchgelaufen ist.";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_mp3SRC']['0'] = "MP3/AAC Audio";
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_mp3SRC']['1'] = "Wählen Sie hier das Audio File aus.";

$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['image'] = 'Bild';
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['gallery'] = 'Galerie';
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['media'] = 'Media';
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['article'] = 'Artikel';
$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['extern'] = 'Externe Seite';

/**
 * ExternURL Explanation
 */
$GLOBALS['TL_LANG']['XPL']['lightbox4ward_externURL'] = array
(
	array('Bild', 'Die URL auf ein Bild wird wie ein Bild der lokalen Website angezeigt.'),
	array('Soicial Video', 'Lightbox4ward unterstüzt die Einbindung externer Videoquellen wie Facebook,Google,Youtube und viele andere. <a href="http://iaian7.com/webcode/mediaboxAdvanced#examples" onclick="window.open(this.href); return false;">Weitere Informationen</a>.'),
);
