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
 * @copyright  4ward.media 2010
 * @author     Christoph Wiechert <christoph.wiechert@4wardmedia.de>
 * @package    lightbox4ward
 * @license    LGPL 
 * @filesource
 */

class WidgetLightbox4ward extends Widget {

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'form_lightbox4ward';


	public function __construct($arrAttributes=false)
	{
		parent::__construct($arrAttributes);
		
		if(strlen($this->label)) {
			$this->strTemplate = 'form_widget';
		} else {
			$this->strTemplate = 'form_explanation';
		}
	}
	
	/**
	 * Do not validate
	 */
	public function validate()
	{
		return;
	}


	/**
	 * Generate the widget and return it as string
	 * @return string
	 */
	public function generate()
	{
		$this->import('String');

		$embed = explode('%s', $this->embed);

		// Use an image instead of the title
		if ($this->useImage && strlen($this->singleSRC) && is_file(TL_ROOT . '/' . $this->singleSRC))
		{
			$objTpl = new FrontendTemplate('widget_lightbox4ward_image');

			$objFile = new File($this->singleSRC);
			if ($objFile->isGdImage)
			{
				$size = deserialize($this->size);
				$src = $this->getImage($this->urlEncode($this->singleSRC), $size[0], $size[1]);

				if (($imgSize = @getimagesize(TL_ROOT . '/' . $src)) !== false)
				{
					$objTpl->imgSize = ' ' . $imgSize[3];
				}

				$objTpl->imgWidth = $size[0];
				$objTpl->imgHeight = $size[1];
				$objTpl->src = $src;
				$objTpl->alt = specialchars($this->alt);
				$objTpl->title = specialchars($this->linkTitle);
				$objTpl->caption = $this->caption;
			}
		} else {
			$objTpl = new FrontendTemplate('widget_lightbox4ward_article');
		}

		$objTpl->href = '';
		$objTpl->embed_pre = $embed[0];
		$objTpl->embed_post = $embed[1];
		$objTpl->link = $this->linkTitle;
		$objTpl->title = specialchars($this->linkTitle);
		$objTpl->target = (TL_MODE == 'BE') ? '' : ' onclick="lightbox4ward'.$this->id.'();return false;"';
		
		switch($this->lightbox4ward_type){
			case 'Image':
				$objTpl->js = $this->generateSingeSrcJS($this->lightbox4ward_imageSRC,'',$this->lightbox4ward_caption,$this->lightbox4ward_description);
				$objTpl->href = $this->lightbox4ward_imageSRC;
			break;
			
			case 'Text':
				$objTpl->js = $this->generateSingeSrcJS('#mb_lightbox4wardWidget'.$this->id,$this->lightbox4ward_size,$this->lightbox4ward_caption,$this->lightbox4ward_description);
				$objTpl->href = $this->Environment->request.'#mb_lightbox4wardWidget'.$this->id;
				
				$objTpl->embed_post .= '<div id="mb_lightbox4wardWidget'.$this->id.'" class="lightbox4wardContent" style="display:none;"><div class="lightbox4wardContentInside">';
				$objTpl->embed_post .= $this->text;
				$objTpl->embed_post .= '</div></div>';
			break;
			
			case 'Extern':
				$objTpl->js =$this->generateSingeSrcJS($this->lightbox4ward_externURL,$this->lightbox4ward_size,$this->lightbox4ward_caption,$this->lightbox4ward_description);
				$objTpl->href = $this->lightbox4ward_externURL;
			break;
			
			case 'Article':
				$objTpl->js =$this->generateSingeSrcJS('#mb_lightbox4wardContent'.$this->id,$this->lightbox4ward_size,$this->lightbox4ward_caption,$this->lightbox4ward_description);
				$objTpl->href = $this->Environment->request.'#mb_lightbox4wardContent'.$this->id;
				
				$objTpl->embed_post .= '<div id="mb_lightbox4wardContent'.$this->id.'" class="lightbox4wardContent" style="display:none;"><div class="lightbox4wardContentInside">';
				$objTpl->embed_post .= $this->getArticle($this->articleAlias,false,true);
				$objTpl->embed_post .= '</div></div>';
			break;
			
		}
		
		return $objTpl->parse();
		
	}		
	
	protected function generateSingeSrcJS($src,$size='',$caption='',$description=''){
		$src = str_replace('=','=',$src); // Mediabox needs "=" instead of = to explode the urls
		$caption = str_replace("'","\\'",$caption); // ' have to be escaped
		$description = str_replace("'","\\'",$description);
		if(strlen($size)>1){
			$size = unserialize($size);
		} else {
			$size[0] = $size[1] = '';
		}
		return 	 '<script type="text/javascript"><!--//--><![CDATA[//><!--'."\n"
					."function lightbox4ward{$this->id}(){"
						.'Mediabox.open([['
							."'$src',"
							."'$caption".(strlen($description)>1 ? '::'.$description : '')."',"
							."'$size[0] $size[1]'"
						.']],0,Mediabox.customOptions);'
					.'}'."\n"
				.'//--><!]]></script>';
	}	
	
}

?>