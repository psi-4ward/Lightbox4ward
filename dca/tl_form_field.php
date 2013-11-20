<?php

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

$this->loadLanguageFile('tl_content');


$GLOBALS['TL_DCA']['tl_form_field']['palettes']['lightbox4ward'] = '{type_legend},type;{lightbox4ward_link_legend},linkTitle,embed;useImage;{lightbox4ward_content_legend},lightbox4ward_type';
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['lightbox4ward_checkbox'] = '{type_legend},type,name,label;{lightbox4ward_link_legend},linkTitle,embed;{fconfig_legend},mandatory;{lightbox4ward_content_legend},lightbox4ward_caption,lightbox4ward_description,lightbox4ward_size,articleAlias';

$GLOBALS['TL_DCA']['tl_form_field']['palettes']['__selector__'][] 				= 'lightbox4ward_type';
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['__selector__'][] 				= 'useImage';

$GLOBALS['TL_DCA']['tl_form_field']['palettes']['lightbox4wardImage'] 		= '{type_legend},type;{lightbox4ward_link_legend},linkTitle,label,embed;useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_caption,lightbox4ward_description,lightbox4ward_imageSRC';
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['lightbox4wardText'] 		= '{type_legend},type;{lightbox4ward_link_legend},linkTitle,label,embed;useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_caption,lightbox4ward_description,lightbox4ward_size;text';
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['lightbox4wardExtern'] 		= '{type_legend},type;{lightbox4ward_link_legend},linkTitle,label,embed;useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_caption,lightbox4ward_description,lightbox4ward_size,lightbox4ward_externURL';
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['lightbox4wardArticle'] 	= '{type_legend},type;{lightbox4ward_link_legend},linkTitle,label,embed;useImage;{lightbox4ward_content_legend},lightbox4ward_type;lightbox4ward_caption,lightbox4ward_description,lightbox4ward_size,articleAlias';

$GLOBALS['TL_DCA']['tl_form_field']['subpalettes']['useImage'] 				= 'singleSRC,alt,imgSize,caption';


// Fields
$GLOBALS['TL_DCA']['tl_form_field']['fields']['lightbox4ward_type'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_type'],
		'exclude'                 => true,
		'inputType'               => 'radio',
		'options'				  => array(
										'Image' 	=> &$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_types']['image'],
										'Text'		=> &$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_types']['text'],
										'Article'	=> &$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_types']['article'] ,
										'Extern'	=> &$GLOBALS['TL_LANG']['tl_form_field']['lightbox4ward_types']['extern'] 
									),
		'eval'                    => array('mandatory'=>true,'submitOnChange'=>true),
		'sql'					  => "varchar(255) NOT NULL default ''"
	);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['lightbox4ward_caption'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_caption'],
		'exclude'                 => true,
		'inputType'               => 'text',
		'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
		'sql'					  => "varchar(255) NOT NULL default ''"
	);
	
$GLOBALS['TL_DCA']['tl_form_field']['fields']['lightbox4ward_description'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_description'],
		'exclude'                 => true,
		'inputType'               => 'text',
		'eval'                    => array('maxlength'=>255, 'tl_class'=>''),
		'sql'					  => "varchar(255) NOT NULL default ''"
	);
	
$GLOBALS['TL_DCA']['tl_form_field']['fields']['lightbox4ward_size'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_size'],
		'exclude'                 => true,
		'inputType'               => 'text',
		'save_callback'			  => array(array('tl_form_field_lightbox4ward','normalizeSize')),	
		'eval'                    => array('maxlength'=>100, 'multiple'=>true,'size'=>2, 'tl_class'=>''),
		'sql'					  => "blob NULL"
	);	

$GLOBALS['TL_DCA']['tl_form_field']['fields']['lightbox4ward_imageSRC'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_imageSRC'],
		'exclude'                 => true,
		'inputType'               => 'fileTree',
		'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=> true, 'extensions'=>'jpg,png,jpeg,tif,bmp,gif', 'mandatory'=>true, 'tl_class'=>'clr'),
		'sql'					  => "binary(16) NULL"
	);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['lightbox4ward_externURL'] = array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_content']['lightbox4ward_externURL'],
		'exclude'                 => true,
		'inputType'               => 'text',
		'explanation'			  => 'lightbox4ward_externURL',
		'eval'                    => array('mandatory'=>true,'helpwizard'=>true, 'tl_class'=>'long clr'),
		'sql'					  => "varchar(255) NOT NULL default ''"
	);	


$GLOBALS['TL_DCA']['tl_form_field']['fields']['alt'] = array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_content']['alt'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'long'),
			'sql'					  => "varchar(255) NOT NULL default ''"
		);
$GLOBALS['TL_DCA']['tl_form_field']['fields']['caption'] = array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_content']['caption'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
			'sql'					  => "varchar(255) NOT NULL default ''"
		);
$GLOBALS['TL_DCA']['tl_form_field']['fields']['linkTitle'] = array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_content']['linkTitle'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
			'sql'					  => "varchar(255) NOT NULL default ''"
		);
$GLOBALS['TL_DCA']['tl_form_field']['fields']['embed'] = array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_content']['embed'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'long clr'),
			'sql'					  => "varchar(255) NOT NULL default ''"
		);
$GLOBALS['TL_DCA']['tl_form_field']['fields']['useImage'] = array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_content']['useImage'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true),
			'sql'					  => "char(1) NOT NULL default ''"
		);
$GLOBALS['TL_DCA']['tl_form_field']['fields']['articleAlias'] = array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_content']['articleAlias'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options_callback'        => array('tl_form_field_lightbox4ward', 'getArticleAlias'),
			'eval'                    => array('mandatory'=>true, 'submitOnChange'=>true),
			'sql'					  => "int(10) unsigned NOT NULL default '0'"

		);
$GLOBALS['TL_DCA']['tl_form_field']['fields']['imgSize'] = array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_content']['size'],
			'exclude'                 => true,
			'inputType'               => 'imageSize',
			'options'                 => array('crop', 'proportional', 'box'),
			'reference'               => &$GLOBALS['TL_LANG']['MSC'],
			'eval'                    => array('rgxp'=>'digit', 'nospace'=>true, 'tl_class'=>'w50'),
			'sql'					  => "blob NULL"
		);
		
		
		
		
class tl_form_field_lightbox4ward extends Backend {

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}	
	
	/**
	 * Get all articles and return them as array (article alias)
	 * @param object
	 * @return array
	 */
	public function getArticleAlias()
	{
		$arrPids = array();
		$arrAlias = array();

		if (!$this->User->isAdmin)
		{
			foreach ($this->User->pagemounts as $id)
			{
				$arrPids[] = $id;
				$arrPids = array_merge($arrPids, $this->Database->getChildRecords($id, 'tl_page', true));
			}

			if (empty($arrPids))
			{
				return $arrAlias;
			}

			$objAlias = $this->Database->prepare("SELECT a.id, a.title, a.inColumn, p.title AS parent FROM tl_article a LEFT JOIN tl_page p ON p.id=a.pid WHERE a.pid IN(". implode(',', array_map('intval', array_unique($arrPids))) .") ORDER BY parent, a.sorting")
									   ->execute();
		}
		else
		{
			$objAlias = $this->Database->prepare("SELECT a.id, a.title, a.inColumn, p.title AS parent FROM tl_article a LEFT JOIN tl_page p ON p.id=a.pid ORDER BY parent, a.sorting")
									   ->execute();
		}

		if ($objAlias->numRows)
		{
			$this->loadLanguageFile('tl_article');

			while ($objAlias->next())
			{
				$arrAlias[$objAlias->parent][$objAlias->id] = $objAlias->title . ' (' . (strlen($GLOBALS['TL_LANG']['tl_article'][$objAlias->inColumn]) ? $GLOBALS['TL_LANG']['tl_article'][$objAlias->inColumn] : $objAlias->inColumn) . ', ID ' . $objAlias->id . ')';
			}
		}

		return $arrAlias;
	}


	/**
	 * Size callback
	 * strips any non-numeric character expect of trailing %
	 * @param str $val serialized value
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