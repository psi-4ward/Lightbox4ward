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

class ContentLightbox4ward extends \ContentElement {
	

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
		if ($this->useImage && !empty($this->singleSRC) && ($objDbfsFile = \FilesModel::findByUuid($this->singleSRC)) && is_file(TL_ROOT . '/' . $objDbfsFile->path))
		{
			$this->strTemplate = 'ce_lightbox4ward_image';
			$this->Template = new \FrontendTemplate($this->strTemplate);

			$objFile = new \File($objDbfsFile->path);

			if ($objFile->isGdImage)
			{
				$size = deserialize($this->size);
				$src = \Image::get($this->urlEncode($objDbfsFile->path), $size[0], $size[1], $size[2]);

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
		$this->Template->lbSize = deserialize($this->lightbox4ward_size);
		
		switch($this->lightbox4ward_type){
			case 'Image':
				$objFile = \FilesModel::findByUuid($this->lightbox4ward_imageSRC);
				if($objFile)
				{
					$this->lightbox4ward_imageSRC = $objFile->path;
				}
				$this->Template->js = $this->generateSingeSrcJS($this->lightbox4ward_imageSRC,'',$this->lightbox4ward_caption,$this->lightbox4ward_description);
				$this->Template->href = $this->lightbox4ward_imageSRC;
			break;
			
			case 'Gallery':
				$this->Template->js = $this->generateGalleryJS($this->lightbox4ward_gallerySRC);
				$this->Template->href = '#';
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
				$objFile = \FilesModel::findByUuid($this->lightbox4ward_flvSRC);
				if($objFile)
				{
					$this->lightbox4ward_flvSRC = $objFile->path;
				}
				$this->Template->js = $this->generateSingeSrcJS(TL_PATH.'/'.$this->lightbox4ward_flvSRC,$this->lightbox4ward_size,$this->lightbox4ward_caption,$this->lightbox4ward_description);
				$this->Template->href = $this->lightbox4ward_flvSRC;
			break;
			
			case 'Audio':
				$objFile = \FilesModel::findByUuid($this->lightbox4ward_mp3SRC);
				if($objFile)
				{
					$this->lightbox4ward_mp3SRC = $objFile->path;
				}
				$this->Template->js = $this->generateSingeSrcJS($this->lightbox4ward_mp3SRC,$this->lightbox4ward_size,$this->lightbox4ward_caption,$this->lightbox4ward_description);
				$this->Template->href = $this->lightbox4ward_mp3SRC;
			break;

			case 'Html5Video':
				$size = deserialize($this->lightbox4ward_size);
				if(!$size) $size = array(800,600);
				$this->Template->embed_post .= '<div id="mb_lightbox4wardContent'.$this->id.'" style="display:none;">';
				$this->Template->embed_post .= '<video preload="none" controls="controls" width="'.$size[0].'" height="'.$size[1].'">';
				$arrFiles = deserialize($this->lightbox4ward_html5videoSRC, true);
				foreach($arrFiles as $intFile)
				{
					$objFile = \FilesModel::findByUuid($intFile);
					if(!$objFile) continue;
					$this->Template->embed_post .= '<source type="video/'.$objFile->extension.'" src="'.$objFile->path.'">';
					$arrVideoSrc[$objFile->extension] = $objFile->path;
				}
				$this->Template->embed_post .= '</video>';
				$this->Template->embed_post .= '</div>';

				$this->Template->js = $this->generateHtml5VideoSrcJS('#mb_lightbox4wardContent'.$this->id,$this->lightbox4ward_size,$this->lightbox4ward_caption,$this->lightbox4ward_description, $arrVideoSrc);
				$this->Template->href = $arrVideoSrc['mp4'];
			break;
		}

		// remove href in BE
		$this->Template->href = 'javascript:false';

	}


	protected function generateHtml5VideoSrcJS($src, $size='', $caption='', $description='', $arrVideoSrc)
	{
		if(TL_MODE == 'BE') return;

		$caption = str_replace("'","\\'",$caption); // ' have to be escaped
		$description = str_replace("'","\\'",$description);
		if(strlen($size)>1){
			$size = deserialize($size);
			$size = $size[0].' '.$size[1];
		} 
		
		return 	 '<script type="text/javascript">'."\n"
					."function lightbox4ward{$this->id}(){"
						.'if(document.body.hasClass("mobile")){'
							.'window.open("'.$arrVideoSrc['mp4'].'"); return;'
						.'}'
						.'Mediabox.open([['
							."'$src',"
							."'$caption".(strlen($description)>1 ? '::'.$description : '')."'"
							.((strlen($size)>1) ? ",'$size'" : '')
						.']],0,Mediabox.customOptions);'
						.'(function(){try{'
							.'document.getElement("#mbContainer video").play();'
							.(($this->lightbox4ward_closeOnEnd == '1') ? 'document.getElement("#mbContainer video").addEventListener("ended",function(){Mediabox.close();});' : '')
						.'} catch(e){}}).delay(Mediabox.customOptions.resizeDuration);'
					.'}'."\n"
				.'</script>';
	}
	

	protected function generateSingeSrcJS($src, $size='', $caption='', $description='')
	{
		if(TL_MODE == 'BE') return;

		$src = str_replace('&#61;','=',$src); // Mediabox needs "=" instead of &#61; to explode the urls
		$caption = str_replace("'","\\'",$caption); // ' have to be escaped
		$description = str_replace("'","\\'",$description);
		if(strlen($size)>1){
			$size = deserialize($size);
			$size = $size[0].' '.$size[1];
		} 
		
		return 	 '<script type="text/javascript">'."\n"
					."function lightbox4ward{$this->id}(){"
						.'Mediabox.open([['
							."'$src',"
							."'$caption".(strlen($description)>1 ? '::'.$description : '')."'"
							.((strlen($size)>1) ? ",'$size'" : '')
						.']],0,Mediabox.customOptions);'
						.(($this->lightbox4ward_closeOnEnd == '1') ? 'NBcloseOnExit=true;' : 'NBcloseOnExit=false;')
					.'}'."\n"
				.'</script>';
	}
	
	
	protected function generateGalleryJS($src)
	{
		if(TL_MODE == 'BE') return;

		$src = deserialize($src);
		$images = array();
		$auxDate = array();

		// Get the file entries from the database
		$objFiles = \FilesModel::findMultipleByUuids($src);

		// Get all images
		while($objFiles->next())
		{
			// Continue if the files has been processed or does not exist
			if(isset($images[$objFiles->path]) || !file_exists(TL_ROOT.'/'.$objFiles->path))
			{
				continue;
			}

			// Single files
			if($objFiles->type == 'file')
			{
				$objFile = new \File($objFiles->path, true);

				if(!$objFile->isGdImage)
				{
					continue;
				}

				$arrMeta = $this->getMetaData($objFiles->meta, $objPage->language);

				// Use the file name as title if none is given
				if($arrMeta['title'] == '')
				{
					$arrMeta['title'] = specialchars(str_replace('_', ' ', $objFile->filename));
				}

				// Add the image
				$images[$objFiles->path] = array
				(
					'id'        => $objFiles->id,
					'uuid'      => $objFiles->uuid,
					'name'      => $objFile->basename,
					'singleSRC' => $objFiles->path,
					'alt'       => $arrMeta['title'],
					'imageUrl'  => $arrMeta['link'],
					'caption'   => $arrMeta['caption']
				);

				$auxDate[] = $objFile->mtime;
			}

			// Folders
			else
			{
				$objSubfiles = \FilesModel::findByPid($objFiles->uuid);

				if($objSubfiles === null)
				{
					continue;
				}

				while($objSubfiles->next())
				{
					// Skip subfolders
					if($objSubfiles->type == 'folder')
					{
						continue;
					}

					$objFile = new \File($objSubfiles->path, true);

					if(!$objFile->isGdImage)
					{
						continue;
					}

					$arrMeta = $this->getMetaData($objSubfiles->meta, $objPage->language);

					// Use the file name as title if none is given
					if($arrMeta['title'] == '')
					{
						$arrMeta['title'] = specialchars(str_replace('_', ' ', $objFile->filename));
					}

					// Add the image
					$images[$objSubfiles->path] = array
					(
						'id'        => $objSubfiles->id,
						'uuid'      => $objSubfiles->uuid,
						'name'      => $objFile->basename,
						'singleSRC' => $objSubfiles->path,
						'alt'       => $arrMeta['title'],
						'imageUrl'  => $arrMeta['link'],
						'caption'   => $arrMeta['caption']
					);

					$auxDate[] = $objFile->mtime;
				}
			}
		}

		// Sort array
		switch($this->sortBy)
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

			case 'meta': // Backwards compatibility
			case 'custom':
				if($this->orderSRC != '')
				{
					$tmp = deserialize($this->orderSRC);

					if(!empty($tmp) && is_array($tmp))
					{
						// Remove all values
						$arrOrder = array_map(function (){ }, array_flip($tmp));

						// Move the matching elements to their position in $arrOrder
						foreach($images as $k => $v)
						{
							if(array_key_exists($v['uuid'], $arrOrder))
							{
								$arrOrder[$v['uuid']] = $v;
								unset($images[$k]);
							}
						}

						// Append the left-over images at the end
						if(!empty($images))
						{
							$arrOrder = array_merge($arrOrder, array_values($images));
						}

						// Remove empty (unreplaced) entries
						$images = array_values(array_filter($arrOrder));
						unset($arrOrder);
					}
				}
				break;

			case 'random':
				shuffle($images);
				break;
		}

		$images = array_values($images);

		$str = "";
		foreach($images AS $meta){
			$str .= "['{$meta["singleSRC"]}','";
			$str .= $meta['alt'];
			$str .= "',''],";
		}
		$str = substr($str,0,-1);
		
		return 	 '<script type="text/javascript">'."\n"
					."function lightbox4ward{$this->id}(){"
						.'Mediabox.open('
							."["
							.$str
							."],0,Mediabox.customOptions"
						.');'
					.'}'."\n"
				.'</script>';
	}
}

