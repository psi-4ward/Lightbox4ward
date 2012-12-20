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


class WidgetLightbox4wardCheckbox extends FormCheckBox
{

	public function __construct($arrAttributes=false)
	{
		parent::__construct($arrAttributes);

		$embed = explode('%s', $this->embed);

		$label = $embed[0];
		$label .= '<a href="'.$this->Environment->request.'#mb_lightbox4wardContent'.$this->id.'" title="" '.((TL_MODE == 'BE') ? '' : ' onclick="lightbox4ward'.$this->id.'();return false;"').'>';
		$label .= specialchars($this->linkTitle);
		$label .= '</a>';
		$label .= $embed[1];

		$this->arrOptions = array(array('value'=>'yes','label'=>$label));
	}

	/**
	 * Generate the widget and return it as string
	 * @return string
	 */
	public function generate()
	{
		// The "required" attribute only makes sense for single checkboxes
		if ($this->mandatory)
		{
				$this->arrAttributes['required'] = 'required';
		}

		$this->import('String');

		$post = $this->generateSingeSrcJS('#mb_lightbox4wardContent'.$this->id,$this->lightbox4ward_size,$this->lightbox4ward_caption,$this->lightbox4ward_description);
		$post .= '<div id="mb_lightbox4wardContent'.$this->id.'" class="lightbox4wardContent" style="display:none;"><div class="lightbox4wardContentInside">';
		$post .= $this->getArticle($this->articleAlias,false,true);
		$post .= '</div></div>';
		

		$strOptions = '';

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

		if ($this->strLabel != '')
		{
        	return sprintf('<fieldset id="ctrl_%s" class="lightbox4ward_checkbox checkbox_container%s"><legend>%s%s%s</legend>%s<input type="hidden" name="%s" value=""%s%s</fieldset>',
	        				$this->strId,
							(($this->strClass != '') ? ' ' . $this->strClass : ''),
							($this->required ? '<span class="invisible">'.$GLOBALS['TL_LANG']['MSC']['mandatory'].'</span> ' : ''),
							$this->strLabel,
							($this->required ? '<span class="mandatory">*</span>' : ''),
							$this->strError,
							$this->strName,
							$this->strTagEnding,
							$strOptions) . $this->addSubmit().$post;
		}
		else
		{
	        return sprintf('<fieldset id="ctrl_%s" class="lightbox4ward_checkbox checkbox_container%s">%s<input type="hidden" name="%s" value=""%s%s</fieldset>',
    	    				$this->strId,
							(($this->strClass != '') ? ' ' . $this->strClass : ''),
							$this->strError,
							$this->strName,
							$this->strTagEnding,
							$strOptions) . $this->addSubmit().$post;
		}
		
		
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