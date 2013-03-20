<?php
/*** DEFINE CONSTANTS ***/
define("GIDDLAYOUT", PARENTURL . 'gidd/core_extension/gidd_layout/' );

define("PX1CF", GIDDLAYOUT . "style/px-1cf.css" );
define("PX2CR", GIDDLAYOUT . "style/px-2cr.css" );
define("PX2CL", GIDDLAYOUT . "style/px-2cl.css" );
define("PX3CB", GIDDLAYOUT . "style/px-3cb.css" );
define("PX3CH", GIDDLAYOUT . "style/px-3ch.css" );

define("EM1CF", GIDDLAYOUT . "style/em-1cf.css" );
define("EM2CR", GIDDLAYOUT . "style/em-2cr.css" );
define("EM2CL", GIDDLAYOUT . "style/em-2cl.css" );
define("EM3CB", GIDDLAYOUT . "style/em-3cb.css" );
define("EM3CH", GIDDLAYOUT . "style/em-3ch.css" );

define("PERCENT1CF", GIDDLAYOUT . "style/percent-1cf.css" );
define("PERCENT2CR", GIDDLAYOUT . "style/percent-2cr.css" );
define("PERCENT2CL", GIDDLAYOUT . "style/percent-2cl.css" );
define("PERCENT3CB", GIDDLAYOUT . "style/percent-3cb.css" );
define("PERCENT3CH", GIDDLAYOUT . "style/percent-3ch.css" );

define("PF2CL", GIDDLAYOUT . "style/pf-2cl.css" );
define("PF2CR", GIDDLAYOUT . "style/pf-2cr.css" );

/*** SHOW-LAYOUT HELPER ***/
function gidd_add_layout_style( $layout, $path, $media = "screen" ) {
	
	$path = empty( $path ) ? PX2CR : $path;
	
	$style  = '<link rel="stylesheet" href="' . $path;
	$style .= '" type="text/css" media="' . $media .'"/>';
	
	//add ie hack
	$layout = empty( $layout ) ? "Col2r" : $layout;
	switch ( $layout ){
	
		case 'Pf2cl'	:	$style .= '<!--[if lt IE 7]>';
								$style .= '<style media="screen" type="text/css">';
								$style .= '.ns-container {';
								$style .= 'width:expression(document.body.clientWidth < 782? "780px" : document.body.clientWidth > 1262? "1260px" : "auto");';
								$style .= '}.col2{margin-left: -230px;}';
								$style .= '</style>';
								$style .= '<![endif]-->';
								break;
							
		case 'Pf2cr'	:	$style .= '<!--[if lt IE 7]>';
								$style .= '<style media="screen" type="text/css">';
								$style .= '.ns-container {';
								$style .= 'width:expression(document.body.clientWidth < 782? "780px" : document.body.clientWidth > 1262? "1260px" : "auto");';
								$style .= '}.col2{margin-left: -230px;}';
								$style .= '</style>';
								$style .= '<![endif]-->';
								break;
							
		case 'Col1f'	:	break;
		
		//default to mathrew layout style
		default			:	$style .= '<!--[if lt IE 7]>';
								$style .= '<style media="screen" type="text/css">';
								$style .= '.col1 {';
								$style .= 'width:100%;';
								$style .= '}';
								$style .= '</style>';
								$style .= '<![endif]-->';
								break;
							
	}
	
	echo $style;
}



/* End of template helper.php */