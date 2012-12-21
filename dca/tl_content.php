<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

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
 * @copyright  4ward.media 2009
 * @author     Christoph Wiechert <christoph.wiechert@4wardmedia.de>
 * @package    lightbox.4ward
 * @license    LGPL 
 * @filesource
 */


// Palette
$GLOBALS['TL_DCA']['tl_content']['palettes']['ce_lightbox4ward'] = '{type_legend},type,headline;{lightbox4ward_link_legend},linkTitle,embed;useImage;{lightbox4ward_content_legend},lightbox4ward_type;{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] 				= 'lightbox4ward_type';
$GLOBALS['TL_DCA']['tl_content']['palettes']['ce_lightbox4wardImage'] 		= '{type_legend},type,headline;{lightbox4ward_link_legend},linkTitle,embed;{imglink_legend:hide},useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_caption,lightbox4ward_description,lightbox4ward_imageSRC;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_content']['palettes']['ce_lightbox4wardGallery'] 	= '{type_legend},type,headline;{lightbox4ward_link_legend},linkTitle,embed;{imglink_legend:hide},useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_gallerySRC,sortBy;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_content']['palettes']['ce_lightbox4wardExtern'] 		= '{type_legend},type,headline;{lightbox4ward_link_legend},linkTitle,embed;{imglink_legend:hide},useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_caption,lightbox4ward_description,lightbox4ward_size,lightbox4ward_externURL;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_content']['palettes']['ce_lightbox4wardArticle'] 	= '{type_legend},type,headline;{lightbox4ward_link_legend},linkTitle,embed;{imglink_legend:hide},useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_caption,lightbox4ward_description,lightbox4ward_size,articleAlias;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_content']['palettes']['ce_lightbox4wardFLV'] 		= '{type_legend},type,headline;{lightbox4ward_link_legend},linkTitle,embed;{imglink_legend:hide},useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_caption,lightbox4ward_description,lightbox4ward_size,lightbox4ward_closeOnEnd,lightbox4ward_flvSRC;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_content']['palettes']['ce_lightbox4wardHtml5Video'] 	= '{type_legend},type,headline;{lightbox4ward_link_legend},linkTitle,embed;{imglink_legend:hide},useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_caption,lightbox4ward_description,lightbox4ward_size,lightbox4ward_closeOnEnd,lightbox4ward_html5videoSRC;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_content']['palettes']['ce_lightbox4wardAudio'] 		= '{type_legend},type,headline;{lightbox4ward_link_legend},linkTitle,embed;{imglink_legend:hide},useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_caption,lightbox4ward_description,lightbox4ward_size,lightbox4ward_closeOnEnd,lightbox4ward_mp3SRC;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';


// Fields
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_type'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_type'],
		'exclude'                 => true,
		'inputType'               => 'radio',
		'options'				  => array(
										'Image' 	=> &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['image'],
										'Gallery'	=> &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['gallery'],
										'Html5Video'=> &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['Html5Video'] ,
										'FLV'		=> &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['video'] ,
										'Audio'		=> &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['audio'] ,
										'Article'	=> &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['article'] ,
										'Extern'	=> &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['extern'] 
									),
		'eval'                    => array('mandatory'=>true,'submitOnChange'=>true)
	);

$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_caption'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_caption'],
		'exclude'                 => true,
		'inputType'               => 'text',
		'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
	);
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_description'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_description'],
		'exclude'                 => true,
		'inputType'               => 'text',
		'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
	);
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_size'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_size'],
		'exclude'                 => true,
		'inputType'               => 'text',
		'save_callback'			  => array(array('ce_lightbox4ward','normalizeSize')),
		'eval'                    => array('maxlength'=>100, 'multiple'=>true,'size'=>2, 'tl_class'=>'w50')
	);
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_imageSRC'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_imageSRC'],
		'exclude'                 => true,
		'inputType'               => 'fileTree',
		'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=> true, 'extensions'=>'jpg,png,jpeg,tif,bmp,gif', 'mandatory'=>true, 'tl_class'=>'clr')
	);	
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_gallerySRC'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_gallerySRC'],
		'exclude'                 => true,
		'inputType'               => 'fileTree',
		'eval'                    => array('fieldType'=>'checkbox', 'files'=>true, 'extensions'=>'jpg,png,jpeg,tif,bmp,gif,flv,mov,mp4', 'mandatory'=>true, 'tl_class'=>'clr')
	);	
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_externURL'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_externURL'],
		'exclude'                 => true,
		'inputType'               => 'text',
		'explanation'			  => 'lightbox4ward_externURL',
		'eval'                    => array('mandatory'=>true,'helpwizard'=>true, 'tl_class'=>'long clr')
	);		
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_flvSRC'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_flvSRC'],
		'exclude'                 => true,
		'inputType'               => 'fileTree',
		'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=> true, 'extensions'=>'flv,mov,swf,mp4,f4v,m4v', 'mandatory'=>true, 'tl_class'=>'clr')
	);
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_html5videoSRC'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_html5videoSRC'],
		'exclude'                 => true,
		'inputType'               => 'fileTree',
		'eval'                    => array('fieldType'=>'checkbox', 'files'=>true, 'filesOnly'=> true, 'extensions'=>'flv,mp4,webm,ogv', 'mandatory'=>true, 'tl_class'=>'clr')
	);
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_mp3SRC'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_mp3SRC'],
		'exclude'                 => true,
		'inputType'               => 'fileTree',
		'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=> true, 'extensions'=>'mp3,aac', 'mandatory'=>true, 'tl_class'=>'clr')
	);		
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_closeOnEnd'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_closeOnEnd'],
		'exclude'                 => true,
		'inputType'               => 'checkbox',
		'eval'                    => array('tl_class'=>'w50')
	);	

class ce_lightbox4ward extends System
{
	
	/**
	 * Size callback
	 * strips any non-numeric character expect of trailing %
	 * @param string $val serialized value
	 * @return string
	 */
	public function normalizeSize($val)
	{
		$val = unserialize($val);
		
		foreach($val as $k=>$v)
		{
			if(!preg_match("~^\d+%?$~",$v))
				$val[$k] = (int)$v;
		}

		return serialize($val);
	}
	
}

?>
