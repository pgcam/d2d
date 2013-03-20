<?php

function gidd_measure( $layout, $measure ){

	switch ( $layout ){
	
		case 'Col2l'	:	
								if ( $measure == "em" )
									return EM2CL;
								elseif ( $measure == "percent" )
									return PERCENT2CL;
								else
									return PX2CL;
								
								break;
								
								
		case 'Col1f'	:	
								if ( $measure == "em" )
									return EM1CF;
								elseif ( $measure == "percent" )
									return PERCENT1CF;
								else
									return PX1CF;
								
								break;
								
		
		case 'Col3h'	:	
								if ( $measure == "em" )
									return EM3CH;
								elseif ( $measure == "percent" )
									return PERCENT3CH;
								else
									return PX3CH;
								
								break;
								
								
		case 'Col3b'	:	
								if ( $measure == "em" )
									return EM3CB;
								elseif ( $measure == "percent" )
									return PERCENT3CB;
								else
									return PX3CB;
								
								break;
								
								
		case 'Pf2cl'	:		
								return PF2CL;
								break;
		
		case 'Pf2cr'	:		
								return PF2CR;
								break;
		
								
		default			:	
								if ( $measure == "em" )
									return EM2CR;
								elseif ( $measure == "percent" )
									return PERCENT2CR;
								else
									return PX2CR;
								
								break;
								
	}

}

function ___gidd( $name, $layout = "Pf2cr", $measure = "pixel", $jquery = "wp" ){

	$data = ___data();	
	
	if ( is_multisite() ){
		
		$id = get_current_blog_id();
		$name = "$name" . "_" . $id;
		$data->name = "$name";	
	
	}else{	
		$data->name = "$name";		
	}
	
	//allow theme to change the layout
	$layout  = ___apply( 'layout', $layout, $name );
	$measure = ___apply( 'measure', $measure, $name );
	
	$data->layout = "$layout";		
	$data->path = gidd_measure( $layout, $measure );
	$data->jquery = "$jquery";
	
	___html( $data ); //render the template
	
	


}


/* End of gidd.php */