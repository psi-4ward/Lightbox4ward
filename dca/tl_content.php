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



// Palette
$GLOBALS['TL_DCA']['tl_content']['palettes']['lightbox4ward'] = '{type_legend},type,headline;{lightbox4ward_link_legend},linkTitle,embed;{imglink_legend},useImage;{lightbox4ward_content_legend},lightbox4ward_type;{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] 			= 'lightbox4ward_type';
$GLOBALS['TL_DCA']['tl_content']['palettes']['lightbox4wardImage'] 		= '{type_legend},type,headline;{lightbox4ward_link_legend},linkTitle,embed;{imglink_legend},useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_caption,lightbox4ward_description,lightbox4ward_singleSRC;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_content']['palettes']['lightbox4wardMedia'] 		= '{type_legend},type,headline;{lightbox4ward_link_legend},linkTitle,embed;{imglink_legend},useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_caption,lightbox4ward_description,playerSRC,playerSize,autoplay,lightbox4ward_closeOnEnd;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_content']['palettes']['lightbox4wardGallery'] 	= '{type_legend},type,headline;{lightbox4ward_link_legend},linkTitle,embed;{imglink_legend},useImage;{lightbox4ward_content_legend},lightbox4ward_type;multiSRC,sortBy;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_content']['palettes']['lightbox4wardArticle'] 	= '{type_legend},type,headline;{lightbox4ward_link_legend},linkTitle,embed;{imglink_legend},useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_caption,lightbox4ward_description,lightbox4ward_size,articleAlias;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_content']['palettes']['lightbox4wardExtern'] 	= '{type_legend},type,headline;{lightbox4ward_link_legend},linkTitle,embed;{imglink_legend},useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_caption,lightbox4ward_description,lightbox4ward_size,lightbox4ward_externURL;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';


// Fields
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_type'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_type'],
	'exclude'                 => true,
	'inputType'               => 'radio',
	'options'				  => array(
									'Image' 		=> &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['image'],
									'Media' 	=> &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['media'],
									'Gallery'	=> &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['gallery'],
									'Article'	=> &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['article'] ,
									'Extern'	=> &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_types']['extern']
								),
	'eval'                    => array('mandatory'=>true, 'submitOnChange'=>true),
	'sql'					  => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_singleSRC'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_singleSRC'],
	'exclude'                 => true,
	'inputType'               => 'fileTree',
	'eval'                    => array('filesOnly'=>true, 'fieldType'=>'radio', 'mandatory'=>true, 'tl_class'=>'clr', 'extensions'=>ce_lightbox4ward::$extensions),
	'sql'                     => "binary(16) NULL"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_caption'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_caption'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>255, 'tl_class'=>'long'),
	'sql' 					  => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_size'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_size'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'save_callback'			  => array(array('ce_lightbox4ward','normalizeSize')),
	'eval'                    => array('maxlength'=>100, 'multiple'=>true,'size'=>2, 'tl_class'=>'w50'),
	'sql'					  => 'blob NULL'
);
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_externURL'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_externURL'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'explanation'			  => 'lightbox4ward_externURL',
	'eval'                    => array('mandatory'=>true, 'helpwizard'=>true, 'tl_class'=>'long clr'),
	'sql' 					  => "varchar(255) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_closeOnEnd'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_closeOnEnd'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'w50'),
	'sql' 					  => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_content']['fields']['lightbox4ward_gallerySliderLink'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_gallerySliderLink'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'clr long'),
	'sql' 					  => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['multiSRC']['load_callback'][] = array('ce_lightbox4ward', 'setGallyFlag');
$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = array('ce_lightbox4ward', 'adjustDCA');

class ce_lightbox4ward
{

	public static $extensions = 'jpg,png,jpeg,tif,mp4,move,ogv,gif,webm,mp3';


    public function adjustDCA($dc)
    {
        $CE = \ContentModel::findByPk($dc->id);
        if(!$CE || $CE->type !== 'lightbox4ward') return;

        if($CE->lightbox4ward_type == 'Gallery') {
            $GLOBALS['TL_DCA']['tl_content']['subpalettes']['useImage'] .= ',lightbox4ward_gallerySliderLink';
        }
    }

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


	public function setGallyFlag($varValue, $dc)
	{
		if($dc->activeRecord)
		{
			if($dc->activeRecord->type == 'lightbox4ward')
			{
				$GLOBALS['TL_DCA'][$dc->table]['fields'][$dc->field]['eval']['isGallery'] = true;
				$GLOBALS['TL_DCA'][$dc->table]['fields'][$dc->field]['eval']['extensions'] = self::$extensions;
			}
		}

		return $varValue;
	}
}
