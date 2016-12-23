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



class ContentLightbox4ward extends \ContentElement {

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_lightbox4ward';


	/**
	 * Generate content element
	 */
	protected function compile()
	{

		$files = array();
		$optsStr = '';
		$inlineContent = '';

		if($this->useImage)
		{
			$objFile = \FilesModel::findByUuid($this->singleSRC);
			if($objFile) {
				$this->singleSRC = $objFile->path;
				$this->addImageToTemplate($this->Template, $this->arrData);
			}
		}
		else
		{
			$embed = explode('%s', $this->embed);
			$this->Template->embed_pre = $embed[0];
			$this->Template->embed_post = $embed[1];
		}
		$this->Template->href = '#';
		$this->Template->attributes = 'onclick="lightbox4ward'.$this->id.'(this);return false;"';

		$title = $this->lightbox4ward_caption;

		switch($this->lightbox4ward_type)
		{
			case 'Media':
				if($this->autoplay) {
					$autoplay = true;
					$this->objModel->autoplay = false;
				}
				$ceMedia = new \ContentMedia($this->objModel);
				$inlineContent = '<div id="lightbox4ward'.$this->id.'" style="display:none">' . $ceMedia->generate() . '</div>';
				$files = array(
					'title' => $title,
					'href'  => '#lightbox4ward'.$this->id
				);
				$afterShowStr = '';
				if($autoplay)
				{
					$afterShowStr .= ' $(this.wrap[0]).find("video")[0].play();';
				}
				if($this->lightbox4ward_closeOnEnd)
				{
					$afterShowStr .= ' $(this.wrap[0]).find("video")[0].addEventListener("ended", function() { $.fancybox.close() });';
				}
				if($afterShowStr)
				{
					$optsStr .= ', afterShow: function(){ '.$afterShowStr.' }';
				}
			break;

			case 'Image':
				$file = \FilesModel::findByUuid($this->lightbox4ward_singleSRC);
				if(!$file)
				{
					$files = array();
				}
				else
				{
					if(!$title)
					{
						$meta = deserialize($file->meta, true);
						$title = $meta[$GLOBALS['objPage']->language]['title'];
					}
					$files = array(
						'title' => $title,
						'href'  => $file->path
					);
				}
			break;

			case 'Gallery':
				$files = $this->getFilesFromMultiSRC($this->multiSRC, $this->sortBy, $this->orderSRC);
				$files = array_map(function ($file)
				{
					return array(
						'title' => $file['alt'],
						'href'  => $file['singleSRC']
					);
				}, $files);

                if($this->lightbox4ward_gallerySliderLink) {
                    $arrThumbs = $files;
                    $size = deserialize($this->size);
                    if($size[0] || $size[1]) {
                        foreach($arrThumbs as $k => $v) {
                            $arrThumbs[$k]['href'] = \Image::get($v['href'], $size[0], $size[1], $size[2]);
                        }
                    }
                    $this->Template->gallerySlides = $arrThumbs;
                }
			break;

			case 'Article':
				$inlineContent = '<div id="lightbox4ward'.$this->id.'" style="display:none" class="inlineContent">'.$this->getArticle($this->articleAlias, false, true).'</div>';
				$files = array(
					'title' => $title,
					'href'  => '#lightbox4ward'.$this->id
				);
				$size = deserialize($this->lightbox4ward_size, true);
				if($size && ($size[0] > 0 || $size[1] > 0))
				{
					$optsStr .= ',autoSize:false';
					if($size[0] > 0) $optsStr .= ',width:'.$size[0];
					if($size[0] > 0) $optsStr .= ',height:'.$size[1];
				}
			break;

			case 'Extern':
				$files = array(
					'title' => $title,
					'href'  => utf8_decode_entities($this->lightbox4ward_externURL),
					'type'	=> 'iframe'
				);
				$size = deserialize($this->lightbox4ward_size, true);
				if($size && ($size[0] || $size[1]))
				{
                    if(!is_numeric($size[0])) $size[0] = '"'.$size[0].'"';
                    if(!is_numeric($size[1])) $size[1] = '"'.$size[1].'"';

					$optsStr .= ',autoSize:false';
					if($size[0] > 0) $optsStr .= ',width:'.$size[0];
					if($size[0] > 0) $optsStr .= ',height:'.$size[1];
				}

				break;
		}

		$this->Template->javascript = '<script type="text/javascript">function lightbox4ward'.$this->id.'(curr, opts){ jQuery.fancybox('.json_encode($files).',  jQuery.extend({orig: jQuery(curr) '.$optsStr.'}, opts || {})); } </script>';
		$this->Template->content = $inlineContent;
	}


	/**
	 * Get array with files and its meta data from a multiSRC
	 *
	 * @param $multiSRC
	 * @param string $sortBy
	 * @param $orderSRC
	 * @return array
	 */
	protected function getFilesFromMultiSRC($multiSRC, $sortBy='', $orderSRC)
	{
		$multiSRC = deserialize($multiSRC);

		// Return if there are no files
		if(!is_array($multiSRC) || empty($multiSRC))
		{
			return array();
		}

		// Get the file entries from the database
		$objFiles = \FilesModel::findMultipleByUuids($multiSRC);
		if(!$objFiles) return array();

		$images = array();
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

				$arrMeta = $this->getMetaData($objFiles->meta, $GLOBALS['objPage']->language);

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

					$arrMeta = $this->getMetaData($objSubfiles->meta, $GLOBALS['objPage']->language);

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
		switch($sortBy)
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
				if($orderSRC != '')
				{
					$tmp = deserialize($orderSRC);

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

		return array_values($images);
	}

}

