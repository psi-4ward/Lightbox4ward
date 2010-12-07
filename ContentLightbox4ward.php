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

class ContentLightbox4ward extends ContentElement {
	

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_lightbox4ward_article';


	/**
	 * Generate content element
	 */
	protected function compile()
	{
		$this->import('String');

		$embed = explode('%s', $this->embed);

		// Use an image instead of the title
		if ($this->useImage && strlen($this->singleSRC) && is_file(TL_ROOT . '/' . $this->singleSRC))
		{
			$this->strTemplate = 'ce_lightbox4ward_image';
			$this->Template = new FrontendTemplate($this->strTemplate);

			$objFile = new File($this->singleSRC);

			if ($objFile->isGdImage)
			{
				$size = deserialize($this->size);
				$src = $this->getImage($this->urlEncode($this->singleSRC), $size[0], $size[1]);

				if (($imgSize = @getimagesize(TL_ROOT . '/' . $src)) !== false)
				{
					$this->Template->imgSize = ' ' . $imgSize[3];
				}

				$this->Template->imgWidth = $size[0];
				$this->Template->imgHeight = $size[1];
				$this->Template->src = $src;
				$this->Template->alt = specialchars($this->alt);
				$this->Template->title = specialchars($this->linkTitle);
				$this->Template->caption = $this->caption;
			}
		}

		$this->Template->href = '';
		$this->Template->embed_pre = $embed[0];
		$this->Template->embed_post = $embed[1];
		$this->Template->link = $this->linkTitle;
		$this->Template->title = specialchars($this->linkTitle);
		$this->Template->target = (TL_MODE == 'BE') ? '' : ' onclick="lightbox4ward'.$this->id.'();return false;"';
		$this->Template->lbType = $this->lightbox4ward_type;
		$this->Template->lbSize = unserialize($this->lightbox4ward_size);
		
		switch($this->lightbox4ward_type){
			case 'Image':
				$this->Template->js = $this->generateSingeSrcJS($this->lightbox4ward_imageSRC,'',$this->lightbox4ward_caption,$this->lightbox4ward_description);
				$this->Template->href = $this->lightbox4ward_imageSRC;
			break;
			
			case 'Gallery':
				$this->Template->js = $this->generateGalleryJS($this->lightbox4ward_gallerySRC);
				$src = unserialize($this->lightbox4ward_gallerySRC);
				$this->Template->href = $src[0];
			break;
			
			case 'Extern':
				$this->Template->js = $this->generateSingeSrcJS($this->lightbox4ward_externURL,$this->lightbox4ward_size,$this->lightbox4ward_caption,$this->lightbox4ward_description);
				$this->Template->href = $this->lightbox4ward_externURL;
			break;
			
			case 'Article':
				$this->Template->js = $this->generateSingeSrcJS('#mb_lightbox4wardContent'.$this->id,$this->lightbox4ward_size,$this->lightbox4ward_caption,$this->lightbox4ward_description);
				$this->Template->href = $this->Environment->request.'#mb_lightbox4wardContent'.$this->id;
				
				$this->Template->embed_post .= '<div id="mb_lightbox4wardContent'.$this->id.'" class="lightbox4wardContent" style="display:none;"><div class="lightbox4wardContentInside">';
				$this->Template->embed_post .= $this->getArticle($this->articleAlias,false,true);
				$this->Template->embed_post .= '</div></div>';
			break;
			
			case 'FLV':
				$this->Template->js = $this->generateSingeSrcJS(TL_PATH.'/'.$this->lightbox4ward_flvSRC,$this->lightbox4ward_size,$this->lightbox4ward_caption,$this->lightbox4ward_description);
				$this->Template->href = $this->lightbox4ward_flvSRC;
			break;
			
		}
		
	}	

	protected function generateSingeSrcJS($src,$size='',$caption='',$description=''){
		$src = str_replace('&#61;','=',$src); // Mediabox needs "=" instead of &#61; to explode the urls
		$caption = str_replace("'","\\'",$caption); // ' have to be escaped
		$description = str_replace("'","\\'",$description);
		if(strlen($size)>1){
			$size = unserialize($size);
			$size = $size[0].' '.$size[1];
		} 
		
		return 	 '<script type="text/javascript"><!--//--><![CDATA[//><!--'."\n"
					."function lightbox4ward{$this->id}(){"
						.'Mediabox.open([['
							."'$src',"
							."'$caption".(strlen($description)>1 ? '::'.$description : '')."'"
							.((strlen($size)>1) ? ",'$size'" : '')
						.']],0,Mediabox.customOptions);'
						.(($this->lightbox4ward_closeOnEnd == '1') ? 'NBcloseOnExit=true;' : 'NBcloseOnExit=false;')
					.'}'."\n"
				.'//--><!]]></script>';
	}
	
	
	protected function generateGalleryJS($src){
		$src = unserialize($src);
		$images = array();
		$auxDate = array();

		// Get all images
		foreach ($src as $file)
		{
			if (isset($images[$file]) || !file_exists(TL_ROOT . '/' . $file))
			{
				continue;
			}

			// Single files
			if (is_file(TL_ROOT . '/' . $file))
			{
				$objFile = new File($file);
				$this->parseMetaFile(dirname($file));

				if ($objFile->isGdImage)
				{
					$images[$file] = array
					(
						'name' => $objFile->basename,
						'src' => $this->Environment->path.'/'.$file,
						'alt' => (strlen($this->arrMeta[$objFile->basename][0]) ? $this->arrMeta[$objFile->basename][0] : ucfirst(str_replace('_', ' ', preg_replace('/^[0-9]+_/', '', $objFile->filename)))),
						'link' => (strlen($this->arrMeta[$objFile->basename][1]) ? $this->arrMeta[$objFile->basename][1] : ''),
						'caption' => (strlen($this->arrMeta[$objFile->basename][2]) ? $this->arrMeta[$objFile->basename][2] : '')
					);

					$auxDate[] = $objFile->mtime;
				} else {
					$images[$file] = array (
						'name' => $objFile->basename,
						'src'  => $this->Environment->path.'/'.$file,
						'alt' => (strlen($this->arrMeta[$objFile->basename][0]) ? $this->arrMeta[$objFile->basename][0] : ucfirst(str_replace('_', ' ', preg_replace('/^[0-9]+_/', '', $objFile->filename)))),
						'link' => (strlen($this->arrMeta[$objFile->basename][1]) ? $this->arrMeta[$objFile->basename][1] : ''),
						'caption' => (strlen($this->arrMeta[$objFile->basename][2]) ? $this->arrMeta[$objFile->basename][2] : '')
					);
				}

				continue;
			}

			$subfiles = scan(TL_ROOT . '/' . $file);
			$this->parseMetaFile($file);

			// Folders
			foreach ($subfiles as $subfile)
			{
				if (is_dir(TL_ROOT . '/' . $file . '/' . $subfile))
				{
					continue;
				}

				$objFile = new File($file . '/' . $subfile);

				if ($objFile->isGdImage)
				{
					$images[$file . '/' . $subfile] = array
					(
						'name' => $objFile->basename,
						'src' => $this->Environment->path.'/'.$file . '/' . $subfile,
						'alt' => (strlen($this->arrMeta[$subfile][0]) ? $this->arrMeta[$subfile][0] : ucfirst(str_replace('_', ' ', preg_replace('/^[0-9]+_/', '', $objFile->filename)))),
						'link' => (strlen($this->arrMeta[$subfile][1]) ? $this->arrMeta[$subfile][1] : ''),
						'caption' => (strlen($this->arrMeta[$subfile][2]) ? $this->arrMeta[$subfile][2] : '')
					);

					$auxDate[] = $objFile->mtime;
				}
			}
		}

		// Sort array
		switch ($this->sortBy)
		{
			default:
			case 'name_asc':
				uksort($images, 'basename_natcasecmp');
				break;

			case 'name_desc':
				uksort($images, 'basename_natcasercmp');
				break;

			case 'date_asc':
				array_multisort($images, SORT_NUMERIC, $auxDate, SORT_ASC);
				break;

			case 'date_desc':
				array_multisort($images, SORT_NUMERIC, $auxDate, SORT_DESC);
				break;

			case 'meta':
				$arrImages = array();
				foreach ($this->arrAux as $k)
				{
					if (strlen($k))
					{
						$arrImages[] = $images[$k];
					}
				}
				$images = $arrImages;
				break;
		}
		
		
		$str = "";
		foreach($images AS $meta){
			$str .= "['{$meta["src"]}','";
			$str .= $meta['alt'];
			$str .= "',''],";
		}
		$str = substr($str,0,-1);
		
		return 	 '<script type="text/javascript"><!--//--><![CDATA[//><!--'."\n"
					."function lightbox4ward{$this->id}(){"
						.'Mediabox.open('
							."["
							.$str
							."],0,Mediabox.customOptions"
						.');'
					.'}'."\n"
				.'//--><!]]></script>';
	}
}

?>