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


// Palette
$GLOBALS['TL_DCA']['tl_content']['palettes']['ce_lightbox4ward'] = '{type_legend},type,headline;{lightbox4ward_link_legend},linkTitle,embed;useImage;{lightbox4ward_content_legend},lightbox4ward_type;{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] 				= 'lightbox4ward_type';
$GLOBALS['TL_DCA']['tl_content']['palettes']['ce_lightbox4wardImage'] 		= '{type_legend},type,headline;{lightbox4ward_link_legend},linkTitle,embed;{imglink_legend:hide},useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_caption,lightbox4ward_description,lightbox4ward_imageSRC;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_content']['palettes']['ce_lightbox4wardGallery'] 	= '{type_legend},type,headline;{lightbox4ward_link_legend},linkTitle,embed;{imglink_legend:hide},useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_gallerySRC;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
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
		'eval'                    => array('mandatory'=>true,'submitOnChange'=>true),
		'sql'					  => "varchar(255) NOT NULL default ''"
	);

$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_caption'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_caption'],
		'exclude'                 => true,
		'inputType'               => 'text',
		'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
		'sql' 					  => "varchar(255) NOT NULL default ''"
	);
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_description'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_description'],
		'exclude'                 => true,
		'inputType'               => 'text',
		'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
		'sql' 					  => "varchar(255) NOT NULL default ''"
	);
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_size'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_size'],
		'exclude'                 => true,
		'inputType'               => 'text',
		'save_callback'			  => array(array('ce_lightbox4ward','normalizeSize')),
		'eval'                    => array('maxlength'=>100, 'multiple'=>true,'size'=>2, 'tl_class'=>'w50'),
		'sql'					  => "blob NULL"
	);
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_imageSRC'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_imageSRC'],
		'exclude'                 => true,
		'inputType'               => 'fileTree',
		'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=> true, 'extensions'=>'jpg,png,jpeg,tif,bmp,gif', 'mandatory'=>true, 'tl_class'=>'clr'),
		'sql'					  => "binary(16) NULL"
	);	
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_gallerySRC'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_gallerySRC'],
		'exclude'                 => true,
		'inputType'               => 'fileTree',
		'eval'                    => array('fieldType'=>'checkbox', 'files'=>true, 'multiple'=>true, 'orderField'=>'orderSRC', 'extensions'=>'jpg,png,jpeg,tif,bmp,gif,flv,mov,mp4,ogv,webm', 'mandatory'=>true, 'tl_class'=>'clr'),
		'sql'					  => "blob NULL"
	);	
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_externURL'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_externURL'],
		'exclude'                 => true,
		'inputType'               => 'text',
		'explanation'			  => 'lightbox4ward_externURL',
		'eval'                    => array('mandatory'=>true,'helpwizard'=>true, 'tl_class'=>'long clr'),
		'sql'					  => "varchar(255) NOT NULL default ''"
	);		
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_flvSRC'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_flvSRC'],
		'exclude'                 => true,
		'inputType'               => 'fileTree',
		'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=> true, 'extensions'=>'flv,mov,swf,mp4,f4v,m4v', 'mandatory'=>true, 'tl_class'=>'clr'),
		'sql'					  => "binary(16) NULL"
	);
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_html5videoSRC'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_html5videoSRC'],
		'exclude'                 => true,
		'inputType'               => 'fileTree',
		'eval'                    => array('fieldType'=>'checkbox', 'multiple'=>true, 'files'=>true, 'filesOnly'=> true, 'extensions'=>'flv,mp4,webm,ogv', 'mandatory'=>true, 'tl_class'=>'clr'),
		'sql'					  => "blob NULL"
	);
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_mp3SRC'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_mp3SRC'],
		'exclude'                 => true,
		'inputType'               => 'fileTree',
		'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=> true, 'extensions'=>'mp3,aac', 'mandatory'=>true, 'tl_class'=>'clr'),
		'sql'					  => "binary(16) NULL"
	);		
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_closeOnEnd'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_closeOnEnd'],
		'exclude'                 => true,
		'inputType'               => 'checkbox',
		'eval'                    => array('tl_class'=>'w50'),
		'sql'					  => "char(1) NOT NULL default ''"
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
