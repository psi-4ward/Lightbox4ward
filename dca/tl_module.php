<?php

/**
 * @copyright 4ward.media 2015 <http://www.4wardmedia.de>
 * @author Christoph Wiechert <wio@psitrax.de>
 */
 
$GLOBALS['TL_DCA']['tl_module']['palettes']['lightbox4ward_autoopen'] = '{title_legend},name,type;'
  .'{lightbox4ward_legend},lightbox4ward_ce,lightbox4ward_autoopen_session;'
  .'{protected_legend:hide},protected;'
  .'{expert_legend:hide},guests;';

$GLOBALS['TL_DCA']['tl_module']['fields']['lightbox4ward_autoopen_session'] = array
(
  'label'            => &$GLOBALS['TL_LANG']['tl_module']['lightbox4ward_autoopen_session'],
  'inputType'        => 'checkbox',
  'sql'              => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['lightbox4ward_ce'] = array
(
  'label'            => &$GLOBALS['TL_LANG']['tl_module']['lightbox4ward_ce'],
  'inputType'        => 'select',
  'options_callback' => function() { 
    $objs = \Database::getInstance()->execute('
      SELECT cte.id, cte.linkTitle, a.title AS article
      FROM tl_content AS cte
      LEFT JOIN tl_article AS a ON (a.id = cte.pid)
      WHERE cte.type = "lightbox4ward"
      ORDER BY cte.id
    ');
    $ret = array();
    while($objs->next()) $ret[$objs->id] = '[ID: '.$objs->id.'] '.$objs->linkTitle.' ('.$objs->article.')';
    return $ret;
  },
  'eval'             => array('tl_class' => 'long', 'mandatory' => true, 'choosen' => true),
  'sql'              => "int(9) unsigned NOT NULL default '0'"
);
