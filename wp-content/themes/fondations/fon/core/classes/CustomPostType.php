<?php
/* http://wp.tutsplus.com/tutorials/creative-coding/custom-post-type-helper-class/ */
/* PHP 5.3+ required */

require_once(CLASSES_PATH.'/FonBaseClass.php');

class Custom_Post_Type extends Fon_Base_Class
{
    public $post_type_name;
    public $post_type_args;
    public $post_type_labels;

    /* Class constructor */
    public function __construct($name, $args = array(), $labels = array())
    {
        // Set some important variables
        $this->post_type_name     = strtolower(str_replace(' ', '_', $name ));
        $this->post_type_args     = $args;
        $this->post_type_labels   = $labels;

        // Add action to register the post type, if the post type does not already exist
        if(!post_type_exists($this->post_type_name))
        {
          add_action('init', array(&$this, 'register_post_type'));
        }

        // Listen for the save post hook
        $this->save();
    }

    /* Method which registers the post type */
    public function register_post_type()
    {
        //Capitilize the words and make it plural
        $name   = ucwords(str_replace('_', ' ', $this->post_type_name));
        $plural = $name . 's';

        // We set the default labels based on the post type name and plural. We overwrite them with the given labels.
        $labels = array_merge(

            // Default
            array(
                'name'                => _x($plural, 'post type general name'),
                'singular_name'       => _x($name, 'post type singular name'),
                'add_new'             => _x('Add New', strtolower($name)),
                'add_new_item'        => __('Add New ' . $name),
                'edit_item'           => __('Edit ' . $name),
                'new_item'            => __('New ' . $name),
                'all_items'           => __('All ' . $plural),
                'view_item'           => __('View ' . $name),
                'search_items'        => __('Search ' . $plural),
                'not_found'           => __('No ' . strtolower($plural) . ' found'),
                'not_found_in_trash'  => __('No ' . strtolower($plural) . ' found in Trash'),
                'parent_item_colon'   => '',
                'menu_name'           => $plural
            ),

            // Given labels
            $this->post_type_labels

        );

        // Same principle as the labels. We set some defaults and overwrite them with the given arguments.
        $args = array_merge(

            // Default
            array(
                'label'               => $plural,
                'labels'              => $labels,
                'public'              => true,
                'show_ui'             => true,
                'supports'            => array('title', 'editor', 'thumbnail'),
                'has_archive'         => true,
                'rewrite'             => array( 'slug' => $this->post_type_name . 's'),
                'show_in_nav_menus'   => true,
                '_builtin'            => false,
            ),

            // Given args
            $this->post_type_args

        );

        // Register the post type
        register_post_type($this->post_type_name, $args);
    }


    /* Method to attach the taxonomy to the post type */
    public function add_taxonomy($name, $args = array(), $labels = array())
    {
        if(!empty($name))
        {
            // We need to know the post type name, so the new taxonomy can be attached to it.
            $post_type_name = $this->post_type_name;

            // Taxonomy properties
            $taxonomy_name    = strtolower(str_replace(' ', '_', $name));
            $taxonomy_labels  = $labels;
            $taxonomy_args    = $args;

            if(!taxonomy_exists($taxonomy_name))
            {
                /* Create taxonomy and attach it to the object type (post type) */
                if( isset( $taxonomy_labels['singular_name'] ) && ! empty( $taxonomy_labels['singular_name'] ) ) {
                    $name = $taxonomy_labels['singular_name'];
                } else {
                    // Capitilize the words and make it plural
                    $name = ucwords( str_replace( '_', ' ', $name ) );
                }
                $plural = ( isset( $taxonomy_labels['name'] ) && ! empty( $taxonomy_labels['name'] ) ) ? $taxonomy_labels['name'] : $name . 's';

                // Default labels, overwrite them with the given labels.
                $labels = array_merge(

                    // Default
                    array(
                        'name'              => _x( $plural, 'taxonomy general name' ),
                        'singular_name'     => _x( $name, 'taxonomy singular name' ),
                        'search_items'      => __( 'Search' ) . ' ' . $plural,
                        'all_items'         => __( 'All' ) . ' ' . $plural,
                        'parent_item'       => __( 'Parent' ) . ' ' . $name,
                        'parent_item_colon' => __( 'Parent' ) . ' ' . $name . ':',
                        'edit_item'         => __( 'Edit' ) . ' ' . $name,
                        'update_item'       => __( 'Update' ) . ' ' . $name,
                        'add_new_item'      => __( 'Add New' ) . ' ' . $name,
                        'new_item_name'     => __( 'New' ) . ' ' . $name . ' ' . __('Name' ),
                        'menu_name'         => __( $plural ),
                    ),

                    // Given labels
                    $taxonomy_labels

                );

                // Default arguments, overwritten with the given arguments
                $args = array_merge(

                    // Default
                    array(
                        // 'label'              => $plural,
                        'labels'             => $labels,
                        'public'             => true,
                        'show_ui'            => true,
                        'hierarchical'       => true,
                        'show_in_nav_menus'  => false,
                        'show_admin_column'  => true,
                        '_builtin'           => false,
                    ),

                    // Given
                    $taxonomy_args

                );

                // Add the taxonomy to the post type
                add_action('init',
                    function() use($taxonomy_name, $post_type_name, $args)
                    {
                      register_taxonomy($taxonomy_name, $post_type_name, $args);
                    }
                );

            }
            else
            {
                /* The taxonomy already exists. We are going to attach the existing taxonomy to the object type (post type) */
                add_action('init',
                    function() use($taxonomy_name, $post_type_name)
                    {
                        register_taxonomy_for_object_type($taxonomy_name, $post_type_name);
                    }
                );
            }

        }



    }


    /* Attaches meta boxes to the post type */
    public function add_meta_box($title, $fields = array(), $context = 'normal', $priority = 'default')
    {
        if(!empty($title))
        {
            // We need to know the Post Type name again
            $post_type_name = $this->post_type_name;

            // Meta variables
            $box_id       = strtolower(str_replace(' ', '_', $title));
            $box_title    = ucwords(str_replace('_', ' ', $title));
            $box_context  = $context;
            $box_priority = $priority;

            // Make the fields global
            global $custom_fields;
            $custom_fields[$title] = $fields;

            add_action('admin_init',
                function() use($box_id, $box_title, $post_type_name, $box_context, $box_priority, $fields)
                {
                    add_meta_box(
                        $box_id,
                        $box_title,
                        function($post, $data)
                        {
                            global $post;

                            // Nonce field for some validation
                            wp_nonce_field(plugin_basename(__FILE__), 'custom_post_type');

                            // Get all inputs from $data
                            $custom_fields = $data['args'][0];

                            // Get the saved values
                            $meta = get_post_custom($post->ID);

                            // Check the array and loop through it
                            if(!empty($custom_fields))
                            {
                                /* Loop through $custom_fields */
                                foreach($custom_fields as $label => $type)
                                {
                                    $field_id_name  = strtolower(str_replace(' ', '_', $data['id'])) . '_' . strtolower(str_replace(' ', '_', $label));

                                    echo '<label for="'.$field_id_name.'">'.$label.'</label><input type="text" name="custom_meta['.$field_id_name.']"id="'.$field_id_name.'"value="'.$meta[$field_id_name][0].'" />';
                                }
                            }

                        },
                        $post_type_name,
                        $box_context,
                        $box_priority,
                        array( $fields )
                    );
                }
            );
        }
    }

    /* Listens for when the post type being saved */
    public function save()
    {
        // Need the post type name again
        $post_type_name = $this->post_type_name;

        add_action('save_post',
            function() use($post_type_name)
            {
                // Deny the WordPress autosave function
                if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

                if (isset($_POST['custom_post_type']))
                {
                    if (!wp_verify_nonce($_POST['custom_post_type'], plugin_basename(__FILE__))) return;
                }

                global $post;

                if(isset($_POST) && isset($post->ID) && get_post_type($post->ID) == $post_type_name)
                {
                    global $custom_fields;

                    if($custom_fields && is_array($custom_fields)) {
                        // Loop through each meta box
                        foreach($custom_fields as $title => $fields)
                        {
                            // Loop through all fields
                            foreach($fields as $label => $type)
                            {
                                $field_id_name  = strtolower(str_replace(' ', '_', $title)) . '_' . strtolower(str_replace(' ', '_', $label));

                                update_post_meta($post->ID, $field_id_name, $_POST['custom_meta'][$field_id_name] );
                            }

                        }
                    }
                }
            }
        );
    }

}

/* Usage */

/*
$book = new Custom_Post_Type( 'Book' );
$book->add_taxonomy( 'category' );
$book->add_taxonomy( 'author' );

$book->add_meta_box(
  'Book Info',
  array(
    'Year' => 'text',
    'Genre' => 'text'
  )
);

$book->add_meta_box(
  'Author Info',
  array(
    'Name' => 'text',
    'Nationality' => 'text',
    'Birthday' => 'text'
  )
);
*/