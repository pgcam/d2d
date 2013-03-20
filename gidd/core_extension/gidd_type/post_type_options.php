<?php

//appname, title, callback, post_type, context, priority

//add tab script & style to head
___add( 'head', '__5nyUa' );
function ___head___5nyUa(){
	___tab( '__5nyUa' );
	___multiselect();
	wp_enqueue_style( 'gdpt-posttype', PARENTURL . 'gidd/core_extension/gidd_type/gidd_type.css', '', '1', 'screen, projection' );

}


//register metabox
___metabox( 'gidd_type', 'Post Type Options', 'gidd_type_metabox', 'gd_posttype' );
function gidd_type_metabox( $mb ){
		
//general
$pt 				= ___text( 'Post type', 'Max 20 characters, cannot container capital letters or spaces' );
$public				= ___checkbox( 'Public', '(optional) Whether a post type is intended to be used publicly either via the admin interface or by front-end users. Default: false' );
$excl_from_search	= ___checkbox( 'Exclude from search', '(importance) Whether to exclude posts with this post type from front end search results. Default: value of the opposite of the public argument. Note: If you want to show the posts&#39;s list that are associated to taxonomy&#39;s terms, you must set exclude_from_search to false (ie : for call site_domaine/?taxonomy_slug=term_slug or site_domaine/taxonomy_slug/term_slug). If you set to true, on the taxonomy page (ex: taxonomy.php) worpress will not find your posts and/or pagination will make 404 error...' );
$show_ui			= ___checkbox( 'Show UI', '(optional) Whether to generate a default UI for managing this post type in the admin. Default: value of public argument' );
$show_in_nav		= ___checkbox( 'Show in nav menus', '(optional) Whether post_type is available for selection in navigation menus. Default: value of public argument' );
$cap_type			= ___list( 'Capability type', array( 'post' => 'Post', 'page' => 'Page' ), '(optional) The string to use to build the read, edit, and delete capabilities. It seems that `map_meta_cap` needs to be set to true, to make this work. Default: post' );
$has_archive		= ___checkbox( 'has_archive', '(optional) Enables post type archives. Will use $post_type as archive slug by default. Default: false' );
$rewrite			= ___text( 'Rewrite', '(optional) Triggers the handling of rewrites for this post type. To prevent rewrites, set to false. Default: true and use $post_type as slug. Note: If registering a post type inside of a plugin, call flush_rewrite_rules() in your activation and deactivation hook ' );
$support			= ___list( 'Support', array('title' => 'Title', 'editor' => 'Editor', 'author' => 'Author', 'thumbnail' => 'Thumbnail', 'excerpt' => 'Excerpt', 'trackbacks' => 'Trackbacks', 'custom-fields' => 'Custom Fields', 'comments' => 'Comments', 'revisions' => 'Revisions', 'page-attributes' => 'Page attributes', 'post-formats' => 'Post formats' ), '(optional) An alias for calling add_post_type_support() directly.' );
$taxonomies			= ___text( 'Taxonomies', '(optional) An array of registered taxonomies like category or post_tag that will be used with this post type. This can be used in lieu of calling register_taxonomy_for_object_type() directly. Custom taxonomies still need to be registered with register_taxonomy(). Default: no taxonomies' );
$description		= ___text( 'Description', '(optional) A short descriptive summary of what the post type is. Default: blank' );


//label
$label 				= ___text( 'Label', '(optional) A plural descriptive name for the post type marked for translation.' );
$name				= ___text( 'Name', 'general name for the post type, usually plural. The same as, and overridden by $post_type_object->label ' );
$singular_name 		= ___text( 'Singular name', 'name for one object of this post type. Defaults to value of name ' ); 
$add_new			= ___text( 'Add new', 'the add new text. The default is Add New for both hierarchical and non-hierarchical types. When internationalizing this string, please use a gettext context matching your post type. Example: _x("Add New", "product");' );
$all_items			= ___text( 'All items', 'the all items text used in the menu. Default is the Name label' );
$add_new_item		= ___text( 'Add new item', 'the add new item text. Default is Add New Post/Add New Page' );
$edit_item			= ___text( 'Edit item', 'the all items text used in the menu. Default is the Name label' );
$new_item			= ___text( 'New item', 'the all items text used in the menu. Default is the Name label' );
$view_item			= ___text( 'View item', 'the view item text. Default is View Post/View Page' );
$search_items		= ___text( 'Search items', 'the search items text. Default is Search Posts/Search Pages' );
$not_found			= ___text( 'Not found', 'the not found text. Default is No posts found/No pages found ' );
$not_found_in_trash = ___text( 'Not found in trash', 'the not found in trash text. Default is No posts found in Trash/No pages found in Trash ' );
$parent_item_colon	= ___text( 'Parent item colon', "the parent text. This string isn&#39;t used on non-hierarchical types. In hierarchical ones the default is Parent Page" );
$menu_name			= ___text( 'Menu name', 'the menu name text. This string is the name to give menu items. Defaults to value of name' );


//advanced
$publicly_queryable = ___checkbox( 'Publicly queryable', '(optional) Whether queries can be performed on the front end as part of parse_request(). Default: value of public argument' );
$show_in_menu		= ___text( 'Show in menu', '(optional) Where to show the post type in the admin menu. show_ui must be true. Default: value of show_ui argument. ++ false ++ do not display in the admin menu, ++ true ++ display as a top level menu, ++ some string ++ If an existing top level page such as tools.php or edit.php?post_type=page, the post type will be placed as a sub menu of that. Note: When using &#39;some string&#39; to show as a submenu of a menu page created by a plugin, this item will become the first submenu item, and replace the location of the top level link. If this isn&#39;t desired, the plugin that creates the menu page needs to set the add_action priority for admin_menu to 9 or lower. ' );
$show_in_adminbar	= ___checkbox( 'Show in admin bar', '(optional) Whether to make this post type available in the WordPress admin bar. Default: value of the show_in_menu argument' );
$menu_position		= ___text( 'Menu position', '(optional) The position in the menu order the post type should appear. show_in_menu must be true. Default: null' );
$menu_icon			= ___text( 'Menu icon', '(optional) The url to the icon to be used for this menu.' );
$capabilities		= ___text( 'Capabilities', '(optional) An array of the capabilities for this post type. Default: capability_type is used to construct.' );
$map_meta_cap		= ___checkbox( 'Map meta cap', '(optional) Whether to use the internal default meta capability handling. Default: false' );
$hierarchical		= ___checkbox( 'Hierarchical', '(optional) Whether the post type is hierarchical (e.g. page). Allows Parent to be specified. Default: false' );
$register_meta_cb	= ___text( 'Register metabox cb', '(optional) Provide a callback function that will be called when setting up the meta boxes for the edit form.' );
$query_var			= ___checkbox( 'Query var', '(optional) Sets the query_var key for this post type. Default: true - set to $post_type ' );
$can_export			= ___checkbox( 'Can export', '(optional) Can this post_type be exported. Default: true' );


/** Tabbed Content **/
echo '<div class="gmb-content">';
echo '<ul class="gidd-tab">';		
echo '<li class="gd-tabitem"><a href="#" class="gd-tabitem-first">General</a></li>';
echo '<li class="gd-tabitem"><a href="#">Labels</a></li>';
echo '<li class="gd-tabitem"><a href="#">Advanced</a></li>';
echo '</ul>';

echo '<div class="clear"></div>';

echo '<div id="gdpt_wrap" class="gidd-tab-wrap">';
___space( 20 );

//GENERAL
echo '<div class="gdpt_general tabitem-content tabitem-content-first">';

echo '<div class="single-field">';
echo ___field( $pt, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $public, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $excl_from_search, $mb );
echo '</div>';
echo '<div class="clear"></div>';


echo '<div class="single-field">';
echo ___field( $show_ui, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $show_in_nav, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $cap_type, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $has_archive, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $rewrite, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $support, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $taxonomies, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $description, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '</div>';


//LABEL
echo '<div class="gdpt_labels tabitem-content">';

echo '<div class="single-field">';
echo ___field( $label, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $name, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $singular_name, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $add_new, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $all_items, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $add_new_item, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $edit_item, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $new_item, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $view_item, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $search_items, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $not_found, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $not_found_in_trash, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $parent_item_colon, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $menu_name, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $menu_position, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $menu_icon, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $capabilities, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $map_meta_cap, $mb );
echo '</div>';
echo '<div class="clear"></div>';


echo '</div>';


//ADVANCED
echo '<div class="gdpt_advanced tabitem-content">';

echo '<div class="single-field">';
echo ___field( $publicly_queryable, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $show_in_menu, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $show_in_adminbar, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $hierarchical, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $register_meta_cb, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $query_var, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '<div class="single-field">';
echo ___field( $can_export, $mb );
echo '</div>';
echo '<div class="clear"></div>';

echo '</div>';

echo '</div>'; //End of gdpt_wrap
echo '</div>'; //end of gmb-content

}



/* End of post_type_options.php */