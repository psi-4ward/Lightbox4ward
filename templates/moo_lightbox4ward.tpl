<?php

/*******************/
/** Configuration **/
/*******************/


/* Customize Style
 * You can also set this to blank and include the style in any other way.
 * Probalby with the TL-Style-Editor
*/
// $GLOBALS['TL_CSS']['lightbox4ward_css'] = 'system/modules/lightbox4ward/html/css/mediaboxAdvWhite.css|screen';
// $GLOBALS['TL_CSS']['lightbox4ward_css'] = 'system/modules/lightbox4ward/html/css/mediaboxAdvBlack.css|screen';


/* Mediabox Configs */
$GLOBALS['Lightbox4ward']['options']['overlayOpacity'] = 0.8;
$GLOBALS['Lightbox4ward']['options']['resizeDuration'] = 800;
$GLOBALS['Lightbox4ward']['options']['initialWidth'] = 180;
$GLOBALS['Lightbox4ward']['options']['initialHeight'] = 100;
$GLOBALS['Lightbox4ward']['options']['resizeTransition'] = 'Fx.Transitions.Quart.easeInOut';





/****************/
/** CONFIG END **/
/****************/

// Add mediabox default style sheet 
if(!isset($GLOBALS['TL_CSS']['lightbox4ward_css'])) $GLOBALS['TL_CSS']['lightbox4ward_css'] = 'system/modules/lightbox4ward/html/css/4wardmedia.css|screen';

// Compile Options
(preg_match('~(http[s]?://[^/]+).*~',$this->Environment->base,$erg)) ? $host = $erg[1] : $host=''; 
$lightbox4wardOptions = 'hostName:"'.$host.'",';
if(isset($GLOBALS['Lightbox4ward']['options']) && is_array($GLOBALS['Lightbox4ward']['options']) && count($GLOBALS['Lightbox4ward']['options']) > 0){
	foreach($GLOBALS['Lightbox4ward']['options'] as $option => $value){
		$lightbox4wardOptions .= $option.':'.$value.',';
	}
}
$lightbox4wardOptions = substr($lightbox4wardOptions,0,-1); 
?>

<script type="text/javascript" src="system/modules/lightbox4ward/html/mediaboxAdv_lightbox4ward.js"></script>

<script type="text/javascript">
<!--//--><![CDATA[//><!--
	Mediabox.customOptions = {<?php echo $lightbox4wardOptions; ?>};
	Mediabox.scanPage = function() {
		var links = $$("a").filter(function(el) {
			return el.rel && el.rel.test(/^(lightbox|mediabox)/i);
		});
		$$(links).mediabox(Mediabox.customOptions, null, function(el) {
			var rel0 = this.rel.replace(/[[]|]/gi," ");
			var relsize = rel0.split(" ");
			return (this == el) || ((this.rel.length > 8) && el.rel.match(relsize[1]));
		});
	};
	window.addEvent("domready", Mediabox.scanPage);
	
 //--><!]]>
</script>