<?php

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Custom Post Type - Callout Blocks

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Register Post Type
function create_callouts() {
	register_post_type('callouts',
		array (
			'labels' => array(
				'name' => __('Callout Blocks', 'gp'),
				'singular_name' => __('Callout Block', 'gp'),
				'all_items' => __('All Callout Blocks', 'gp'),
				'add_new' => __('Add New Callout Block', 'gp'),
				'add_new_item' => __('Add New Callout Block', 'gp'),
				'edit' => __('Edit Callout Block', 'gp'),
				'edit_item' => __('Edit Callout Block', 'gp'),
				'new_item' => __('New Callout Block', 'gp'),
				'view' => __('View Callout Block', 'gp'),
				'view_item' => __('View Callout Block', 'gp'),
				'search_items' => __('Search Callout Block', 'gp'),
				'not_found' => __('No Callout Block Found', 'gp'),
				'not_found_in_trash' => __('No Callout Block Found in Trash', 'gp'),
			),
			'public' => true,
			'publicly_queryable' => false,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => true,
			'query_var' => true,
			'exclude_from_search' => true,
			'menu_position' => 46,
			'supports' => array('title', 'editor', 'thumbnail')
			)
	);
}
add_action('init', 'create_callouts');
// END // Register Post Type

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Meta Boxes

// - - - - - - - - - - - - - - - - - - - - - - -

// Metabox Fields
$name_short =  "gp";
$callouts_metabox = array(
	'id' => 'gp_callouts_metabox',
	'title' => __('Callout Block Options', 'gp'),
	'page' => 'callouts',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(  
			"name" => __('The URL', 'gp'),
			"desc" => __('Insert the URL you wish to link to.', 'gp'),
			"id" => $name_short."_callout_link",
			"std" => "",
			"type" => "text"
		),
		array(  
			"name" => __('Button Text', 'gp'),
			"desc" => __('Insert text of the button.', 'gp'),
			"id" => $name_short."_callout_button",
			"std" => "",
			"type" => "text"
		)
	)
);
// END // Metabox Fields

// - - - - - - - - - - - - - - - - - - - - - - -

// Add Metabox
function add_callouts_metabox(){
	global $post, $callouts_metabox;
	add_meta_box($callouts_metabox['id'], $callouts_metabox['title'], "init_callouts_metabox", $callouts_metabox['page'], $callouts_metabox['context'], $callouts_metabox['priority']);
}
add_action("admin_menu", "add_callouts_metabox");
// END // Add Metabox

// - - - - - - - - - - - - - - - - - - - - - - -

// Init Metabox
function init_callouts_metabox(){
	global $post, $callouts_metabox;
	
	foreach ($callouts_metabox['fields'] as $value) {
		$metabox = get_post_meta($post->ID, $value['id'], true);
		switch ($value['type']) {
		
			// Text
			case 'text':	
			?>

			<div class="metabox" style="display:block;width:100%;padding:10px;">
            	<div class="text" style="float:left;width:20%;">
                    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                    <p class="description"><?php echo $value['desc']; ?></p>
                </div>
                <div style="float:left;width:75%;">
					<input id="<?php echo $value['id']; ?>" class="<?php echo $value['id']; ?>" type="text" size="120" name="<?php echo $value['id']; ?>" value="<?php if ( stripslashes(get_post_meta($post->ID, $value['id'] , true)) != "") { echo stripslashes(get_post_meta($post->ID, $value['id'] , true)); } else { echo $value['std']; } ?>" />
				</div>
                <br class="clear" />
			</div>
            
			<?php
			break;
			
			// Text
			case 'textarea':
			?>

			<div class="metabox" style="display:block;width:100%;padding:10px;">
            	<div class="text" style="float:left;width:20%;">
                    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                    <p class="description"><?php echo $value['desc']; ?></p>
                </div>
                <div style="float:left;width:75%;">
					<textarea id="<?php echo $value['id']; ?>" class="<?php echo $value['id']; ?>" type="text" size="120" name="<?php echo $value['id']; ?>"><?php if ( stripslashes(htmlspecialchars(get_post_meta($post->ID, $value['id'] , true))) != "") { echo stripslashes(htmlspecialchars(get_post_meta($post->ID, $value['id'] , true))); } else { echo $value['std']; } ?></textarea>
				</div>
                <br class="clear" />
			</div>
            
      		<?php
			break;
		
		}
	}
}
// END // Init Metabox

// - - - - - - - - - - - - - - - - - - - - - - -

// Save Metabox
function save_callouts_metabox($post_id) {
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return $post_id; }
	if (isset($_POST['gp_callout_link'])) { update_post_meta($post->ID, 'gp_callout_link', $_POST['gp_callout_link']);}
	if (isset($_POST['gp_callout_button'])) { update_post_meta($post->ID, 'gp_callout_button', $_POST['gp_callout_button']);}
}
add_action('save_post', 'save_callouts_metabox');
// END // Save Metabox

// - - - - - - - - - - - - - - - - - - - - - - -

// END // Meta Boxes

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Custom Columns
function edit_columns_callouts($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __('Callout Block Title', 'gp'),
		"author" => __('Author', 'gp'),
		"date" => __('Date', 'gp'),
	);
	return $columns;
}
add_filter("manage_edit-callouts_columns", "edit_columns_callouts");
// END // Custom Columns

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// END // Custom Post Type - Callout Blocks

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'gp_';

global $meta_boxes;

$meta_boxes = array();

// 1st meta box
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'standard',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => 'Standard Fields',

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'post', 'page' ),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',

	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		// TEXT
		array(
			// Field name - Will be used as label
			'name'  => 'Text',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}text",
			// Field description (optional)
			'desc'  => 'Text description',
			'type'  => 'text',
			// Default value (optional)
			'std'   => 'Default text value',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => true,
		),
		// CHECKBOX
		array(
			'name' => 'Checkbox',
			'id'   => "{$prefix}checkbox",
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 1,
		),
		// RADIO BUTTONS
		array(
			'name'    => 'Radio',
			'id'      => "{$prefix}radio",
			'type'    => 'radio',
			// Array of 'value' => 'Label' pairs for radio options.
			// Note: the 'value' is stored in meta field, not the 'Label'
			'options' => array(
				'value1' => 'Label1',
				'value2' => 'Label2',
			),
		),
		// SELECT BOX
		array(
			'name'     => 'Select',
			'id'       => "{$prefix}select",
			'type'     => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'value1' => 'Label1',
				'value2' => 'Label2',
			),
			// Select multiple values, optional. Default is false.
			'multiple' => false,
		),
		// HIDDEN
		array(
			'id'   => "{$prefix}hidden",
			'type' => 'hidden',
			// Hidden field must have predefined value
			'std'  => 'Hidden value',
		),
		// PASSWORD
		array(
			'name' => 'Password',
			'id'   => "{$prefix}password",
			'type' => 'password',
		),
		// TEXTAREA
		array(
			'name' => 'Textarea',
			'desc' => 'Textarea description',
			'id'   => "{$prefix}textarea",
			'type' => 'textarea',
			'cols' => '20',
			'rows' => '3',
		),
	),
	'validation' => array(
		'rules' => array(
			"{$prefix}password" => array(
				'required'  => true,
				'minlength' => 7,
			),
		),
		// optional override of default jquery.validate messages
		'messages' => array(
			"{$prefix}password" => array(
				'required'  => 'Password is required',
				'minlength' => 'Password must be at least 7 characters',
			),
		)
	)
);

// 2nd meta box
$meta_boxes[] = array(
	'title' => 'Advanced Fields',

	'fields' => array(
		// NUMBER
		array(
			'name' => 'Number',
			'id'   => "{$prefix}number",
			'type' => 'number',

			'min'  => 0,
			'step' => 5,
		),
		// DATE
		array(
			'name' => 'Date picker',
			'id'   => "{$prefix}date",
			'type' => 'date',

			// jQuery date picker options. See here http://jqueryui.com/demos/datepicker
			'js_options' => array(
				'appendText'      => '(yyyy-mm-dd)',
				'dateFormat'      => 'yy-mm-dd',
				'changeMonth'     => true,
				'changeYear'      => true,
				'showButtonPanel' => true,
			),
		),
		// DATETIME
		array(
			'name' => 'Datetime picker',
			'id'   => $prefix . 'datetime',
			'type' => 'datetime',

			// jQuery datetime picker options. See here http://trentrichardson.com/examples/timepicker/
			'js_options' => array(
				'stepMinute'     => 15,
				'showTimepicker' => true,
			),
		),
		// TIME
		array(
			'name' => 'Time picker',
			'id'   => $prefix . 'time',
			'type' => 'time',

			// jQuery datetime picker options. See here http://trentrichardson.com/examples/timepicker/
			'js_options' => array(
				'stepMinute' => 5,
				'showSecond' => true,
				'stepSecond' => 10,
			),
		),
		// COLOR
		array(
			'name' => 'Color picker',
			'id'   => "{$prefix}color",
			'type' => 'color',
		),
		// CHECKBOX LIST
		array(
			'name' => 'Checkbox list',
			'id'   => "{$prefix}checkbox_list",
			'type' => 'checkbox_list',
			// Options of checkboxes, in format 'value' => 'Label'
			'options' => array(
				'value1' => 'Label1',
				'value2' => 'Label2',
			),
		),
		// TAXONOMY
		array(
			'name'    => 'Taxonomy',
			'id'      => "{$prefix}taxonomy",
			'type'    => 'taxonomy',
			'options' => array(
				// Taxonomy name
				'taxonomy' => 'category',
				// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree' or 'select'. Optional
				'type' => 'select_tree',
				// Additional arguments for get_terms() function. Optional
				'args' => array()
			),
		),
		// WYSIWYG/RICH TEXT EDITOR
		array(
			'name' => 'WYSIWYG / Rich Text Editor',
			'id'   => "{$prefix}wysiwyg",
			'type' => 'wysiwyg',
			'std'  => 'WYSIWYG default value',

			// Editor settings, see wp_editor() function: look4wp.com/wp_editor
			'options' => array(
				'textarea_rows' => 4,
				'teeny'         => true,
				'media_buttons' => false,
			),
		),
		// FILE UPLOAD
		array(
			'name' => 'File Upload',
			'id'   => "{$prefix}file",
			'type' => 'file',
		),
		// IMAGE UPLOAD
		array(
			'name' => 'Image Upload',
			'id'   => "{$prefix}image",
			'type' => 'image',
		),
		// THICKBOX IMAGE UPLOAD (WP 3.3+)
		array(
			'name' => 'Thichbox Image Upload',
			'id'   => "{$prefix}thickbox",
			'type' => 'thickbox_image',
		),
		// PLUPLOAD IMAGE UPLOAD (WP 3.3+)
		array(
			'name'             => 'Plupload Image Upload',
			'id'               => "{$prefix}plupload",
			'type'             => 'plupload_image',
			'max_file_uploads' => 4,
		),
	)
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function gp_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'gp_register_meta_boxes' );

?>