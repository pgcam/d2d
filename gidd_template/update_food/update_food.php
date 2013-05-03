<?php
___add( 'col1', 'update_food' );
function ___col1_update_food(){

	echo '<h2>Update food item</h2>';
	echo ___space( 20 );
		
	___form( basename(__FILE__), site_url('/update_menu/'), 'update_food_fields' );

}


function update_food_fields( $id ){


	$fid = $_GET['id'];
	$rid = $_GET['rid'];
	
	

	$food_id    	= ___text("Food ID", "Put the food id.");
	$food_group 	= ___text( 'Food Title', 'Put the food title here.' );
	
	$submenu_items  = get_food_submenu( $rid, 'id' );
	$sub_menu		= ___select( 'Sub menu', $submenu_items, 'Select a sub menu for this food' );
	
	
	$desc			= ___textarea( 'Description', 'Description for the food.' );
	$food_price 	= ___text( 'Food Price', 'put the price here' );
	$food_price2	= ___text( 'Food Price 2', 'put the second price here' );
	$food_price3	= ___text( 'Food Price 3', 'put the thrid price here' );
	$sub			= ___submit( 'updatefood', 'Update' );
	
	//set value	
	$post = get_post( $fid );
	$food_id->value = get_post_meta( $fid, 'food_id', true );
	$food_group->value = $post->post_title;
	$desc->value = $post->post_content;
	$food_price->value = get_post_meta( $fid, 'food_price', true );
	$food_price2->value = get_post_meta( $fid, 'food_price2', true );
	$food_price3->value = get_post_meta( $fid, 'food_price3', true );
	
	
	//photo
	echo '<div id="res-logo">';
	echo ( '<span class="food_photo">Photo</span>' );
	___editor( 'food_photo', $id, array(), get_post_meta( $fid, 'food_photo', true ) );
	echo '</div>';
	echo ___clearBoth();
	echo ___space(20);
	
	
	//get object term id
	$tid = "";
	$sm = wp_get_object_terms( $fid, 'submenu' );
	foreach ( $sm as $term ){
		$tid = $term->term_id;
	}
	
	//set the value so that it display current term in the submenu list
	$sub_menu->value = $tid;
	
	
	echo ___field( $sub_menu, $id );
	echo ___clearBoth();
	echo ___space(20);
	
	echo ___field( $food_id, $id);
	echo ___clearBoth();
	echo ___space(20);
	
	echo ___field( $food_group, $id );	
	echo ___clearBoth();
	echo ___space(20);
	
	echo ___field( $desc, $id );
	echo ___clearBoth();
	echo ___space(20);
	
	echo ___field( $food_price, $id );
	echo ___clearBoth();
	echo ___space(20);
	
	echo ___field( $food_price2, $id );
	echo ___clearBoth();
	echo ___space(20);
	
	echo ___field( $food_price3, $id );
	echo ___clearBoth();
	echo ___space(20);
	
	//get food attribute
	$attrs = get_post_meta( $fid, 'food_attribute', true );
	$arr_title = array();
	$arr_control = array();
	$arr_value = array();
	
	//set values
	foreach( $attrs as $attr ){
		foreach ( $attr as $control => $group ){
			$arr_control[] = $control;
			foreach( $group as $title => $values ){
				$arr_title[] = $title;
				$arr_value[] = $values;
			}
		}						
	}						
?>
	
	<div class="attrwrap">
	<table border=0>
		<tr>
			<td>
			
				<div class="groupA">
					<h3>Attribute A</h3>
					
					
					<span>Title </span><input class="grouptitle" name="groupATitle" type="text" value="<?php echo $arr_title[0]; ?>" />
					
					<span>Type </span>
					<select name="groupAControl">
						<option value="check" <?php if( $arr_control[0] == "check" ) echo 'selected'; ?> >Multiple Options</option>
						<option value="radio" <?php if( $arr_control[0] == "radio" ) echo 'selected'; ?>>Single Option</option>
					</select>
					<br />
					<a id="a" href="#" class="newattr">New Attribute</a>
						<?php if ( count( $arr_value[0] ) == 0 ){  ?>
						<p class="attribute">
							<input type="text" value="" name="attribute_a[]" />
							<a class="trash" href="#"></a>
						</p>
						<?php
						}else{
						
							foreach ($arr_value[0] as $v){
								echo '<p class="attribute"><input type="text" value="'. $v .'" name="attribute_a[]" /><a class="trash" href="#"></a><div class="clearBoth"></div></p>';
							}
							
						}
						?>
					
				</div>
			
			</td>
			
			
			<td>
			
				<div class="groupB">
					<h3>Attribute B</h3>
					<span>Title </span><input class="grouptitle" name="groupBTitle" type="text" value="<?php echo $arr_title[1] ?>" />
					<span>Type </span>
					<select name="groupBControl">
						<option value="check" <?php if( $arr_control[1] == "check" ) echo 'selected'; ?>>Multiple Options</option>
						<option value="radio" <?php if( $arr_control[1] == "radio" ) echo 'selected'; ?>>Single Option</option>
					</select>
					<br />
					<a id="b" href="#" class="newattr">New Attribute</a>
						<?php if ( count( $arr_value[1] ) == 0 ){  ?>
						<p class="attribute">
							<input type="text" value="" name="attribute_b[]" />
							<a class="trash" href="#"></a>
						</p>
						<?php
						}else{
						
							foreach ($arr_value[1] as $v){
								echo '<p class="attribute"><input type="text" value="'. $v .'" name="attribute_b[]" /><a class="trash" href="#"></a><div class="clearBoth"></div></p>';
							}
							
						}
						?>
					
				</div>
			
			</td>
			
			<td>
			
				<div class="groupC">
					<h3>Attribute C</h3>
					<span>Title </span><input class="grouptitle" name="groupCTitle" type="text" value="<?php echo $arr_title[2]; ?>" />
					<span>Type </span>
					<select name="groupCControl">
						<option value="check" <?php if( $arr_control[2] == "check" ) echo 'selected'; ?>>Multiple Options</option>
						<option value="radio" <?php if( $arr_control[2] == "radio" ) echo 'selected'; ?>>Single Option</option>
					</select>
					<br />
					<a id="c" href="#" class="newattr">New Attribute</a>
						<?php if ( count( $arr_value[2] ) == 0 ){  ?>
						<p class="attribute">
							<input type="text" value="" name="attribute_c[]" />
							<a class="trash" href="#"></a>
						</p>
						<?php
						}else{
						
							foreach ($arr_value[2] as $v){
								echo '<p class="attribute"><input type="text" value="'. $v .'" name="attribute_c[]" /><a class="trash" href="#"></a><div class="clearBoth"></div></p>';
							}
							
						}
						?>
					
				</div>
			
			</td>
			
			<td>
			
				<div class="groupD">
					<h3>Attribute D</h3>
					<span>Title </span><input class="grouptitle" name="groupDTitle" type="text" value="<?php echo $arr_title[3]; ?>" />
					<span>Type </span>
					<select name="groupDControl">
						<option value="check" <?php if( $arr_control[3] == "check" ) echo 'selected'; ?>>Multiple Options</option>
						<option value="radio" <?php if( $arr_control[3] == "radio" ) echo 'selected'; ?>>Single Option</option>
					</select>
					<br />
					<a id="d" href="#" class="newattr">New Attribute</a>
					
						<?php if ( count( $arr_value[3] ) == 0 ){  ?>
						<p class="attribute">
							<input type="text" value="" name="attribute_d[]" />
							<a class="trash" href="#"></a>
						</p>
						<?php
						}else{
						
							foreach ($arr_value[3] as $v){
								echo '<p class="attribute"><input type="text" value="'. $v .'" name="attribute_d[]" /><a class="trash" href="#"></a></p>';
							}
							
						}
						?>					
				</div>
			
			</td>
		</tr>
		
	</table>
	<div class="clearBoth"></div>
	</div>	
	
<?php	
	/*echo '<br /><br />';
	echo '<h2>Extra/Add-on food if available</h2>';
	echo ___space( 20 );
	addon_food_fields( $id );*/	
	
	echo '<input type="hidden" name="food_id" value="'. $fid .'" />';
	echo '<input type="hidden" name="restoo_id" value="'. $rid .'" />';
	echo ___field( $sub );
	

}









/** end of update_food.php */ 