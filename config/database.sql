--- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************


-- --------------------------------------------------------


-- 
-- Table `tl_content`
-- 

CREATE TABLE `tl_content` (
  `lightbox4ward_type` varchar(255) NOT NULL default '',
  `lightbox4ward_caption` varchar(255) NOT NULL default '',
  `lightbox4ward_description` varchar(255) NOT NULL default '',
  `lightbox4ward_imageSRC` varchar(255) NOT NULL default '',
  `lightbox4ward_flvSRC` varchar(255) NOT NULL default '',
  `lightbox4ward_mp3SRC` varchar(255) NOT NULL default '',  
  `lightbox4ward_closeOnEnd` char(1) NOT NULL default '',
  `lightbox4ward_article_id` int(10) unsigned NOT NULL default '0',
  `lightbox4ward_size` blob NULL,
  `lightbox4ward_gallerySRC` blob NULL,
  `lightbox4ward_externURL` varchar(255) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table `tl_form_field`
-- 

CREATE TABLE `tl_form_field` (
  `lightbox4ward_type` varchar(255) NOT NULL default '',
  `lightbox4ward_caption` varchar(255) NOT NULL default '',
  `lightbox4ward_description` varchar(255) NOT NULL default '',
  `lightbox4ward_imageSRC` varchar(255) NOT NULL default '',
  `lightbox4ward_size` blob NULL,
  `lightbox4ward_article_id` int(10) unsigned NOT NULL default '0',
  `lightbox4ward_externURL` varchar(255) NOT NULL default '',
  `imgSize` blob NULL,
  `alt` varchar(255) NOT NULL default '',
  `useImage` char(1) NOT NULL default '',
  `embed` varchar(255) NOT NULL default '',
  `linkTitle` varchar(255) NOT NULL default '',
  `caption` varchar(255) NOT NULL default '',
  `articleAlias` int(10) unsigned NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
