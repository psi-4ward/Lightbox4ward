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

class WidgetLightbox4wardCheckbox extends FormCheckBox {

	/**
	 * Add specific attributes
	 * @param string
	 * @param mixed
	 */
	public function __set($strKey, $varValue)
	{
		switch ($strKey)
		{
			case 'mandatory':
				$this->arrConfiguration['mandatory'] = $varValue ? true : false;
				break;

			case 'rgxp':
				break;

			default:
				parent::__set($strKey, $varValue);
				break;
		}
	}	
	
	/**
	 * Generate the widget and return it as string
	 * @return string
	 */
	public function generate()
	{
		$this->import('String');

		$embed = explode('%s', $this->embed);

		$label = $embed[0];
		$label .= '<a href="'.$this->Environment->request.'#mb_lightbox4wardContent'.$this->id.'" title="" '.((TL_MODE == 'BE') ? '' : ' onclick="lightbox4ward'.$this->id.'();return false;"').'>';
		$label .= specialchars($this->linkTitle);
		$label .= '</a>';
		$label .= $embed[1];
		
		$post = $this->generateSingeSrcJS('#mb_lightbox4wardContent'.$this->id,$this->lightbox4ward_size,$this->lightbox4ward_caption,$this->lightbox4ward_description);
		$post .= '<div id="mb_lightbox4wardContent'.$this->id.'" class="lightbox4wardContent" style="display:none;"><div class="lightbox4wardContentInside">';
		$post .= $this->getArticle($this->articleAlias,false,true);
		$post .= '</div></div>';
		

		$strOptions = '';

		$this->arrOptions = array(array('value'=>'yes','label'=>$label));
		
		
		foreach ($this->arrOptions as $i=>$arrOption)
		{
			$strOptions .= sprintf('<span><input type="checkbox" name="%s" id="opt_%s" class="checkbox" value="%s"%s%s /> <label id="lbl_%s" for="opt_%s">%s</label></span>',
									$this->strName . ((count($this->arrOptions) > 1) ? '[]' : ''),
									$this->strId.'_'.$i,
									$arrOption['value'],
									$this->isChecked($arrOption),
									$this->getAttributes(),
									$this->strId.'_'.$i,
									$this->strId.'_'.$i,
									$arrOption['label']);
		}

        return sprintf('<div id="ctrl_%s" class="lightbox4ward_checkbox checkbox_container%s"><input type="hidden" name="%s" value="" />%s</div>%s',
						$this->strId,
						(strlen($this->strClass) ? ' ' . $this->strClass : ''),
						$this->strName,
						$strOptions,
						$post) . $this->addSubmit();
		
		
	}		
	
	protected function generateSingeSrcJS($src,$size='',$caption='',$description=''){
		$src = str_replace('&#61;','=',$src); // Mediabox needs "=" instead of &#61; to explode the urls
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