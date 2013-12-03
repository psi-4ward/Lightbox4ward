<?php
/**
 * @copyright 4ward.media 2013 <http://www.4wardmedia.de>
 * @author christoph wiechert <wio@psitrax.de>
 */

if(version_compare(VERSION, '3.2', '<')) return;


\Database\Updater::convertSingleField('tl_content', 'lightbox4ward_imageSRC');
\Database\Updater::convertSingleField('tl_content', 'lightbox4ward_flvSRC');
\Database\Updater::convertSingleField('tl_content', 'lightbox4ward_html5videoSRC');
\Database\Updater::convertSingleField('tl_content', 'lightbox4ward_mp3SRC');
\Database\Updater::convertSingleField('tl_form_field', 'lightbox4ward_imageSRC');

\Database\Updater::convertMultiField('tl_content', 'lightbox4ward_gallerySRC');
