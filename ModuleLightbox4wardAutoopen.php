<?php

/**
 * @copyright 4ward.media 2015 <http://www.4wardmedia.de>
 * @author Christoph Wiechert <wio@psitrax.de>
 */
 
class ModuleLightbox4wardAutoopen extends Module
{

  protected $strTemplate = 'mod_lightbox4ward_autoopen';


  protected function compile()
  {
    $objCte = \ContentModel::findById($this->lightbox4ward_ce);
    if(!$objCte) {
      \System::log('Could not find Lightbox4ward Contentelement ID:'.$this->lightbox4ward_ce, 'ModuleLightbox4wardAutoopen::compile()', 'ERROR');
      return; 
    }

    $cte = new \ContentLightbox4ward($objCte);
    $cte->generate();
 
    $this->Template->id = $this->id;
    $this->Template->content = $cte->Template->content;
    $this->Template->sessionCookie = $this->lightbox4ward_autoopen_session;
    $this->Template->js = str_replace
    (
      array('<script type="text/javascript">','</script>'),
      '',
      $cte->Template->javascript
    );
  }
}
