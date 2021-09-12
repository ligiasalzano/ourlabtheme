<?php
add_action('init', 'post_type_production');
function post_type_production(){
    $labels = array(
        'name'          => __('Publications'),
        'singular_name' => __('Publication'),
        'add_new'       => __('Add Publication', 'New Publication'),
        'add_new_item'  => __('New Publication'),
        'edit_item'     => __('Edit Publication'),
        'new_item'      => __('New Publication'),
        'view_item'     => __('View New Publication')
    );
    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'hierarchical'  => false,
        'show_in_menu'  => true,
        'menu_position' => 21,
        'menu_icon'     => 'dashicons-analytics',
        'supports'      => array('title')
    );
    register_post_type('production', $args );
}

add_action('init', 'taxonomy_production');
function taxonomy_production(){
    $labels = array(
        'name' => _x( 'Publications Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Publication Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Categories' ),
        'all_items'         => __( 'All Categories' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'Publication Category' ),
    );
    $args = array(
        'hierarchical'      => false,
        'label'             => __( 'Category' ),
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_tag_cloud' => true,
        'query_var'         => true,
        'rewrite'           => array(
            'slug'          => 'publications/categories',
            'with_front'    => false,
        ),
    );
    register_taxonomy( 'production_category', 'production', $args );
}

add_action('add_meta_boxes', 'register_meta_boxes_production');
function data_production( $post ) {
    $production_meta_data = get_post_meta( $post->ID );
    ?>
    <div class="production-metabox">
        <div class="production-metabox-item">
            <label for="author-input">Authors:</label>
            <input id="author-input" class="production-metabox-input" type="text"
                   name="author_id" value="<?php echo $production_meta_data['author_id'][0]; ?>" >
        </div>
        <div class="production-metabox-item">
            <label for="journal-input">Journal:</label>
            <input id="journal-input" class="production-metabox-input" type="text"
                   name="journal_id" value="<?php echo $production_meta_data['journal_id'][0]; ?>" >
        </div>
        <div class="production-metabox-item">
            <label for="more-info-input">Others informations:</label>
            <input id="more-info-input" class="production-metabox-input" type="text"
                   name="more_info" value="<?php echo $production_meta_data['more_info'][0]; ?>" >
        </div>
        <div class="production-metabox-item">
            <label for="prod-year-input">Year:</label>
            <input id="prod-year-input" class="production-metabox-input" type="text"
                   name="prod_year" value="<?php echo $production_meta_data['prod_year'][0]; ?>" >
        </div>
        <div class="production-metabox-item">
            <label for="doi-input">DOI:</label>
            <input id="doi-input" class="production-metabox-input" type="text"
                   name="doi_id" value="<?php echo $production_meta_data['doi_id'][0]; ?>" >
        </div>
    </div>
    <?php
}
function register_meta_boxes_production() {
    add_meta_box('data_production', 'Publication Info', 'data_production', 'production', 'normal', 'low');
}
add_action('save_post', 'meta_info_production' );
function meta_info_production( $post_id ){
    if( isset($_POST['author_id']) ) {
        update_post_meta($post_id, 'author_id', sanitize_text_field($_POST['author_id']));
    }
    if( isset($_POST['journal_id']) ) {
        update_post_meta($post_id, 'journal_id', sanitize_text_field($_POST['journal_id']));
    }
    if( isset($_POST['more_info']) ) {
        update_post_meta($post_id, 'more_info', sanitize_text_field($_POST['more_info']));
    }
    if( isset($_POST['prod_year']) ) {
        update_post_meta($post_id, 'prod_year', sanitize_text_field($_POST['prod_year']));
    }
    if( isset($_POST['doi_id']) ) {
        update_post_meta($post_id, 'doi_id', sanitize_text_field($_POST['doi_id']));
    }
}

// Upload File
//Modifying the default post editor form
add_action('post_edit_form_tag', 'update_edit_form');
function update_edit_form() {
    echo ' enctype="multipart/form-data"';
} // end update_edit_form

//Adding the upload meta box (custom field) to the post editor
add_action('add_meta_boxes', 'the_upload_metabox');

function the_upload_metabox() {
    // Define the custom attachment for posts
    add_meta_box(
        'wp_custom_attachment',
        'Upload File',
        'wp_custom_file_attachment',
        'production'
    );
}

// The custom file attachment function
function wp_custom_file_attachment() {

    global $post;
    $theFILE=  get_post_meta($post->ID,'wp_custom_attachment',true);
    wp_nonce_field(plugin_basename(__FILE__), 'wp_custom_attachment_nonce');
    $html = '<p class="description">';
    if (is_array( $theFILE ) && isset( $theFILE[0]['url'] ) ) {
        // Se for verdadeiro, criamos uma variável e assinalamos o valor do campo a ela
        $url = $theFILE[0]['url'];
        $html.="Uploaded File: " . basename($url);
    } else{
        // Senão, ela fica vazia
        $url = '';
        $html.=" ";
    }
    $html .= '</p>';
    $html .= '<input id="wp_custom_attachment" title="select file" multiple="multiple" name="wp_custom_attachment[]" size="25" type="file" value="" />';
    echo $html;
}

//Saving the uploaded file data
add_action('save_post', 'save_custom_meta_data');
// Saving the uploaded file details
function save_custom_meta_data($id) {
    /* --- security verification --- */
    if(isset($_POST['wp_custom_attachment_nonce'])){
        if(!wp_verify_nonce($_POST['wp_custom_attachment_nonce'], plugin_basename(__FILE__))) {
            return $id;
        }
    }

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $id;
    }

    if(isset($_POST['production'])){
        if('page' == $_POST['production']) {
            if(!current_user_can('edit_page', $id)) {
                return $id;
            }
        } else {
            if(!current_user_can('edit_page', $id)) {
                return $id;
            }
        }
    }
    /* - end security verification - */

    // Make sure the file array isn't empty
    if(!empty($_FILES['wp_custom_attachment']['name'])) {
        // Get the file type of the upload
        $flag=0;
        for($i=0;$i<count($_FILES['wp_custom_attachment']['name']);$i++){
            if(!empty($_FILES['wp_custom_attachment']['name'][$i])){
                $flag=1;
                // Use the WordPress API to upload the multiple files
                $upload[] = wp_upload_bits($_FILES['wp_custom_attachment']['name'][$i], null, file_get_contents($_FILES['wp_custom_attachment']['tmp_name'][$i]));
            }
        }
        if($flag==1)
            update_post_meta($id, 'wp_custom_attachment', $upload);

    }

    return $id;
}