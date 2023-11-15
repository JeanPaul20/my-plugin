<?php

namespace My_Plugin\Init\Classes;

class My_Plugin_Config {
    private $config;

    private $capability = 'manage_options';

    public function __construct() {
        $this->generate_config('post_type', 'DefaultPostType', 'DefaultPostTypes');
    }

    private function generate_config($type, $name_singular, $name_plural) {
        if ($type === 'post_type') {
            $labels = $this->generate_post_type_labels($name_singular, $name_plural);
            $args = $this->generate_post_type_args($labels);
        } elseif ($type === 'taxonomy') {
            $labels = $this->generate_taxonomy_labels($name_singular, $name_plural);
        } else {
            // Handle error or invalid type
        }
    
        return [
            'labels' => $labels,
            'args'   => $args,
        ];
    }

    public function register_my_custom_taxonomy($taxonomy_singular, $taxonomy_plural, $object_type, $args = []) {
        $labels = $this->generate_taxonomy_labels($taxonomy_singular, $taxonomy_plural);
        $default_args = [
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => sanitize_title($taxonomy_plural)],
        ];
        $args = array_merge($default_args, $args);
    
        register_taxonomy($taxonomy_singular, $object_type, $args);
    }
    


    /**
     * Creates a menu page in the WordPress admin menu.
     *
     * @param string $menu_title The title of the menu page.
     * @param string $menu_slug The slug for the menu page.
     * @param callable $callable_function The function to be called when the menu page is accessed.
     * @param string $icon_url The URL to the icon to be displayed for the menu page.
     * @param int $position The position of the menu page in the admin menu.
     * @throws Exception if there is an error creating the menu page.
     * @return void
     */
    public function create_menu_page($menu_title, $menu_slug, $callable_function, $icon_url, $position) {
        $page_title = $menu_title;
        $menu_args = $this->generate_menu_page_args(
            $page_title,
            $menu_title,
            $this->capability,
            $menu_slug,
            $callable_function,
            $icon_url,
            $position
        );
      
        add_menu_page(...$menu_args);
      }

      /**
       * Creates a submenu page for the given parent slug, menu title, menu slug, callable function, and position.
       *
       * @param string $parent_slug The slug of the parent menu page.
       * @param string $menu_title The title of the submenu page.
       * @param string $menu_slug The slug of the submenu page.
       * @param callable|null $callable_function (Optional) The callable function to display the submenu page.
       * @param int|null $position (Optional) The position of the submenu page in the menu.
       * @throws Some_Exception_Class Description of any exceptions that may occur.
       * @return void
       */
      public function create_submenu_page($parent_slug, $menu_title, $menu_slug, $callable_function = null, $position = null) {
        $page_title = $menu_title;
        $submenu_args = $this->generate_submenu_page_args(
            $parent_slug,
            $page_title,
            $menu_title,
            $this->capability,
            $menu_slug,
            $callable_function,
            $position
        );
      
        add_submenu_page(...$submenu_args);
      }


      
    /**
     * Generates taxonomy labels.
     *
     * @param string $taxonomy_singular The singular name of the taxonomy.
     * @param string $taxonomy_plural The plural name of the taxonomy.
     * @return array The generated taxonomy labels.
     */
    private function generate_taxonomy_labels($taxonomy_singular, $taxonomy_plural) {
        $textdomain = 'easy-multilingual-wp';
    
        return [
            'name'                       => _x($taxonomy_plural, 'Taxonomy General Name', $textdomain),
            'singular_name'              => _x($taxonomy_singular, 'Taxonomy Singular Name', $textdomain),
            'menu_name'                  => __($taxonomy_plural, $textdomain),
            'all_items'                  => __('All ' . $taxonomy_plural, $textdomain),
            'parent_item'                => __('Parent ' . $taxonomy_singular, $textdomain),
            'parent_item_colon'          => __('Parent ' . $taxonomy_singular . ':', $textdomain),
            'new_item_name'              => __('New ' . $taxonomy_singular . ' Name', $textdomain),
            'add_new_item'               => __('Add New ' . $taxonomy_singular, $textdomain),
            'edit_item'                  => __('Edit ' . $taxonomy_singular, $textdomain),
            'update_item'                => __('Update ' . $taxonomy_singular, $textdomain),
            'view_item'                  => __('View ' . $taxonomy_singular, $textdomain),
            'separate_items_with_commas' => __('Separate ' . $taxonomy_plural . ' with commas', $textdomain),
            'add_or_remove_items'        => __('Add or remove ' . $taxonomy_plural, $textdomain),
            'choose_from_most_used'      => __('Choose from the most used ' . $taxonomy_plural, $textdomain),
            'popular_items'              => __('Popular ' . $taxonomy_plural, $textdomain),
            'search_items'               => __('Search ' . $taxonomy_plural, $textdomain),
            'not_found'                  => __('No ' . $taxonomy_plural . ' found', $textdomain),
            'no_terms'                   => __('No ' . $taxonomy_plural, $textdomain),
            'items_list'                 => __('' . $taxonomy_plural . ' list', $textdomain),
            'items_list_navigation'      => __('' . $taxonomy_plural . ' list navigation', $textdomain),
        ];
    }
   

    
    private function generate_post_type_labels($post_type_singular, $post_type_plural) {
        $textdomain = 'easy-multilingual-wp';
    
        return [
            'name'                  => _x($post_type_plural, 'Post Type General Name', $textdomain),
            'singular_name'         => _x($post_type_singular, 'Post Type Singular Name', $textdomain),
            'menu_name'             => __($post_type_plural, $textdomain),
            'name_admin_bar'        => __($post_type_singular, $textdomain),
            'archives'              => __('' . $post_type_singular . ' Archives', $textdomain),
            'attributes'            => __('' . $post_type_singular . ' Attributes', $textdomain),
            'parent_item_colon'     => __('Parent ' . $post_type_singular . ':', $textdomain),
            'all_items'             => __('All ' . $post_type_plural, $textdomain),
            'add_new_item'          => __('Add New ' . $post_type_singular, $textdomain),
            'add_new'               => __('Add New', $textdomain),
            'new_item'              => __('New ' . $post_type_singular, $textdomain),
            'edit_item'             => __('Edit ' . $post_type_singular, $textdomain),
            'update_item'           => __('Update ' . $post_type_singular, $textdomain),
            'view_item'             => __('View ' . $post_type_singular, $textdomain),
            'view_items'            => __('View ' . $post_type_plural, $textdomain),
            'search_items'          => __('Search ' . $post_type_plural, $textdomain),
            'not_found'             => __('No ' . $post_type_plural . ' found', $textdomain),
            'not_found_in_trash'    => __('No ' . $post_type_plural . ' found in Trash', $textdomain),
            'featured_image'        => __('Featured Image', $textdomain),
            'set_featured_image'    => __('Set featured image', $textdomain),
            'remove_featured_image' => __('Remove featured image', $textdomain),
            'use_featured_image'    => __('Use as featured image', $textdomain),
            'insert_into_item'      => __('Insert into ' . $post_type_singular, $textdomain),
            'uploaded_to_this_item' => __('Uploaded to this ' . $post_type_singular, $textdomain),
            'items_list'            => __('' . $post_type_plural . ' list', $textdomain),
            'items_list_navigation' => __('' . $post_type_plural . ' list navigation', $textdomain),
            'filter_items_list'     => __('Filter ' . $post_type_plural . ' list', $textdomain),
        ];
    }
    
    private function generate_post_type_args($labels) {
        return [
            'labels'             => $labels,
            'description'        => __('Description of the post type.', 'easy-multilingual-wp'),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => ['slug' => strtolower($labels['singular_name'])],
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => ['title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'],
            // Add other necessary arguments as needed
        ];
    }
    
    /**
     * Generates the arguments for a menu page.
     *
     * @param string $menu_title The title of the menu page.
     * @param string $menu_slug The slug of the menu page.
     * @param callable|null $callable_function The function to be called when the menu page is accessed.
     * @param string $icon_url The URL of the icon to be displayed for the menu page.
     * @param int|null $position The position of the menu page in the menu.
     * @return array The generated menu page arguments.
     * 
     * @dev Usage: Generates the arguments for a menu page.
     * 
     * $menu_args = $this->generate_menu_page_args(
     * 'My Plugin', 
     * 'my-plugin-menu-slug', 
     * 'my_plugin_main_page_callback');
     * 
     * add_menu_page(...$menu_args);
     */
    private function generate_menu_page_args($menu_title, $menu_slug, $callable_function = null, $icon_url = null, $position = null) {
       // $function = 'submenu_' . strtolower($title) . '_callback';
        return [
            'page_title'        => esc_html__($menu_title, 'easy-multilingual-wp'),
            'menu_title'        => esc_html__($menu_title, 'easy-multilingual-wp'),
            'capability'        => $this->capability,
            'menu_slug'         => $menu_slug,
            'callable_function' => $callable_function,
            'icon_url'          => $icon_url,
            'position'          => $position
        ];
    }
    
    /**
     * Generate submenu page args.
     *
     * @param mixed $parent_slug The parent slug.
     * @param mixed $menu_title The menu title.
     * @param mixed $menu_slug The menu slug.
     * @param mixed $callable_function The callable function. Default null.
     * @return array The submenu page args.
     * 
     * @dev Usage: Generates the arguments for a submenu page.
     * 
     * $submenu_args = $this->generate_submenu_page_args(
     * 'my-plugin-menu-slug', 
     * 'Submenu', 
     * 'my-plugin-submenu-slug', 
     * 'my_plugin_submenu_callback');
     * 
     * add_submenu_page(...$submenu_args);
     */
    private function generate_submenu_page_args($parent_slug, $menu_title, $menu_slug, $callable_function = null, $position = null) {
        return [
            'parent_slug'       => $parent_slug,
            'page_title'        => esc_html__($menu_title, 'easy-multilingual-wp'),
            'menu_title'        => esc_html__($menu_title, 'easy-multilingual-wp'),
            'capability'        => $this->capability,
            'menu_slug'         => $menu_slug,
            'callable_function' => $callable_function,
            'position'          => $position

        ];
    }
    

    private function generate_meta_box_args($title, $screens, $context = 'advanced', $priority = 'high', $callback_args = null, $single = true) {
        
        $set_title = strtolower(str_replace(' ', '_', $title));
       
        $id = $set_title;
        $meta_key = $set_title.'_key';
        $action = $set_title.'_action';
        $nonce_name = $set_title. '_nonce_name';	
        $nonce_field = $set_title . '_nonce_field';
        $callback_args = 'easy_multilingual_wp_meta_box_' . $set_title . '_callback';

        return [
            'id'            => $id,
            'title'         => esc_html__($title, 'easy-multilingual-wp'),
            'callback'      => 'render_content', // Assuming 'render_content' is a standard callback for all meta boxes
            'screens'       => $screens,
            'context'       => $context,
            'priority'      => $priority,
            'callback_args' => $callback_args,
            'meta_key'      => $meta_key,
            'single'        => $single,
            'action'        => $action,
            'nonce_name'    => $nonce_name,
            'nonce_field'   => $nonce_field
        ];
    }
    

    
   
    public function call_generate_meta_box_args($id, $title, $screens = ['post', 'page'], $context = 'advanced', $priority = 'high', $meta_key, $action, $nonce_name, $callback_args = null, $single = true) {
        if (!in_array('nav-menus', $screens)) {
            $screens[] = 'nav-menus';
        }
        return $this->generate_meta_box_args($id, $title, $screens, $context, $priority, $meta_key, $action, $nonce_name, $callback_args, $single);
    }
    
    public function render_content($post) {
        $args = $this->call_generate_meta_box_args(
            'my_meta_box',
            'My Meta Box',
            ['post', 'page', 'nav-menus'],
            'advanced',
            'high',
            'my_meta_key',
            'my_action',
            'my_nonce_name'
        );
        
        // Retrieve the nonce value from the generated arguments
        $nonce_value = $args['nonce_value'];
        $nonce_value = wp_create_nonce($args['nonce_field']);
        
        // Render the nonce field in the form
        echo '<input type="hidden" name="' . $args['nonce_field'] . '" value="' . $nonce_value . '" />';
        
        // Additional form fields and content can be added here
    }
    
    public function process_meta_box($post_id) {
        // Verify the nonce
        if (!isset($_POST['my_meta_box_nonce']) || !wp_verify_nonce($_POST['my_meta_box_nonce'], 'my_meta_box_nonce')) {
            return;
        }
        
        // Process the submitted form data
        // ...
    }
}