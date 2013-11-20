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
		if ($this->useImage && !empty($this->singleSRC) && ($objDbfsFile = \FilesModel::findByUuid($this->singleSRC)) && is_file(TL_ROOT . '/' . $this->singleSRC))
		{
			$objTpl = new \FrontendTemplate('widget_lightbox4ward_image');

			$objFile = new File($objDbfsFile->path);
			if ($objFile->isGdImage)
			{
				$size = deserialize($this->size);
				$src = \Image::get($this->urlEncode($objDbfsFile->path), $size[0], $size[1], $size[2]);

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
			$objTpl = new \FrontendTemplate('widget_lightbox4ward_article');
		}

		$objTpl->href = '';
		$objTpl->embed_pre = $embed[0];
		$objTpl->embed_post = $embed[1];
		$objTpl->link = $this->linkTitle;
		$objTpl->title = specialchars($this->linkTitle);
		$objTpl->target = (TL_MODE == 'BE') ? '' : ' onclick="lightbox4ward'.$this->id.'();return false;"';
		
		switch($this->lightbox4ward_type){
			case 'Image':
				$objFile = \FilesModel::findByUuid($this->lightbox4ward_imageSRC);
				if($objFile)
				{
					$this->lightbox4ward_imageSRC = $objFile->path;
				}
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

