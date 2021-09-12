<?php
//Register People Post Type
function people(){
    $labels = [
        'name'          => __('People'),
        'singular_name' => __('Person'),
    ];
    $args = [
        'labels'        => $labels,
        'public'        => true,
        'hierarchical'  => false,
        'has_archive'   => true,
        'show_in_menu'  => true,
        'menu_position' => 20,
        'menu_icon'     => 'dashicons-admin-users',
        'supports'      => ['title', 'thumbnail'],
        'description'   => 'Laboratory People',
        'rewrite'         => [
                'slug' => 'people'
        ]
    ];
    register_post_type('people', $args );
}
add_action('init', 'people', 0);

//People Taxonomy
function taxonomy_people(){
    $labels = array(
        'name' => _x( 'Categories Lab', 'taxonomy general name' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Categories' ),
        'all_items'         => __( 'All Categories' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'Category' ),
    );
    $args = array(
        'hierarchical'      => false,
        'label'             => __( 'Category' ),
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_tag_cloud' => true,
        'query_var'         => true
    );
    register_taxonomy( 'people', 'people', $args );
}
add_action('init', 'taxonomy_people');

//Keywords People
function keywords_people(){
    $labels = array(
        'name' => _x( 'Keywords', 'taxonomy general name' ),
        'singular_name'     => _x( 'Keyword', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Keywords' ),
        'all_items'         => __( 'All Keywords' ),
        'parent_item'       => __( 'Parent Keyword' ),
        'parent_item_colon' => __( 'Parent Keyword:' ),
        'edit_item'         => __( 'Edit Keyword' ),
        'update_item'       => __( 'Update Keyword' ),
        'add_new_item'      => __( 'Add New Keyword' ),
        'new_item_name'     => __( 'New Keyword Name' ),
        'menu_name'         => __( 'Keywords' ),
    );
    $args = array(
        'hierarchical'      => false,
        'label'             => __( 'Keywords' ),
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_tag_cloud' => true,
        'query_var'         => true
    );
    register_taxonomy( 'keywords', 'people', $args );
}
add_action('init', 'keywords_people');

//People Meta Box
function data_people( $post ) {
    $people_meta_data = get_post_meta( $post->ID );
    ?>
    <div class="people-metabox">
        <div class="people-metabox-item">
            <label for="bio-input">Bio:</label><br>
            <textarea id="bio-input" name="bio_id" class="people-metabox-input" rows="7" cols="60"><?php echo $people_meta_data['bio_id'][0]; ?></textarea>
        </div>
        <div class="people-metabox-item">
            <label for="project-input">Project:</label><br>
            <textarea id="project-input" name="project_id" class="people-metabox-input" rows="5" cols="60"><?php echo $people_meta_data['project_id'][0]; ?></textarea>
        </div>
        <div class="people-metabox-item">
            <label for="grants-funding-input">Grants and funding:</label><br>
            <textarea id="grants-funding-input" name="grants_funding" class="people-metabox-input" rows="5" cols="60"><?php echo $people_meta_data['grants_funding'][0]; ?></textarea>
        </div>
    </div>
    <?php
}
function register_meta_boxes_people() {
    add_meta_box('data_people', 'About', 'data_people', 'people', 'normal', 'low');
}
add_action('add_meta_boxes', 'register_meta_boxes_people');

function meta_info_people( $post_id ){
    if( isset($_POST['bio_id']) ) {
        update_post_meta($post_id, 'bio_id', sanitize_textarea_field($_POST['bio_id']));
    }
    if( isset($_POST['project_id']) ) {
        update_post_meta($post_id, 'project_id', sanitize_textarea_field($_POST['project_id']));
    }
    if( isset($_POST['grants_funding']) ) {
        update_post_meta($post_id, 'grants_funding', sanitize_textarea_field($_POST['grants_funding']));
    }
}
add_action('save_post', 'meta_info_people' );

//People Links Meta Box
function data_people_links( $post ) {
    $people_meta_data_links = get_post_meta( $post->ID );
    ?>
    <div class="people-metabox">
        <div class="people-metabox-item">
            <label for="email-input">E-mail:</label>
            <input id="email-input" class="people-metabox-input" type="text"
                   name="email_id" value="<?php echo $people_meta_data_links['email_id'][0]; ?>" >
        </div>
        <div class="people-metabox-item">
            <label for="site-input">Site:</label>
            <input id="site-input" class="people-metabox-input" type="text"
                   name="site_id" value="<?php echo $people_meta_data_links['site_id'][0]; ?>" >
        </div>
        <div class="people-metabox-item">
            <label for="site2-input">Site 2:</label>
            <input id="site2-input" class="people-metabox-input" type="text"
                   name="site2_id" value="<?php echo $people_meta_data_links['site2_id'][0]; ?>" >
        </div>
        <div class="people-metabox-item">
            <label for="lattes-input">Lattes:</label>
            <input id="lattes-input" class="people-metabox-input" type="text"
                   name="lattes_id" value="<?php echo $people_meta_data_links['lattes_id'][0]; ?>" >
        </div>
        <div class="people-metabox-item">
            <label for="google-input">Google Citation:</label>
            <input id="google-input" class="people-metabox-input" type="text"
                   name="google_id" value="<?php echo $people_meta_data_links['google_id'][0]; ?>" >
        </div>
    </div>
    <?php
}
function register_meta_boxes_people_links() {
    add_meta_box('data_people_links', 'Contacts', 'data_people_links', 'people', 'normal', 'low');
}
add_action('add_meta_boxes', 'register_meta_boxes_people_links');

function meta_links_people( $post_id ){
    if( isset($_POST['email_id']) ) {
        update_post_meta($post_id, 'email_id', sanitize_text_field($_POST['email_id']));
    }
    if( isset($_POST['site_id']) ) {
        update_post_meta($post_id, 'site_id', sanitize_text_field($_POST['site_id']));
    }
    if( isset($_POST['site2_id']) ) {
        update_post_meta($post_id, 'site2_id', sanitize_text_field($_POST['site2_id']));
    }
    if( isset($_POST['lattes_id']) ) {
        update_post_meta($post_id, 'lattes_id', sanitize_text_field($_POST['lattes_id']));
    }
    if( isset($_POST['google_id']) ) {
        update_post_meta($post_id, 'google_id', sanitize_text_field($_POST['google_id']));
    }
}
add_action('save_post', 'meta_links_people' );

//People Historic Meta Box
function data_people_hist( $post ) {
    $people_meta_data_hist = get_post_meta( $post->ID );
    ?>
    <div class="people-metabox">
        <div class="people-historical">
            <label for="hist-input">Concluded research:</label><br>
            <textarea id="hist-input" name="hist_id" class="people-hist-input" rows="5" cols="60"><?php echo $people_meta_data_hist['hist_id'][0]; ?></textarea>
        </div>
    </div>
    <?php
}
function register_meta_boxes_people_hist() {
    add_meta_box('data_people_hist', 'Historical', 'data_people_hist', 'people', 'normal', 'low');
}
add_action('add_meta_boxes', 'register_meta_boxes_people_hist');

function meta_hist_people( $post_id ){
    if( isset($_POST['hist_id']) ) {
        update_post_meta($post_id, 'hist_id', sanitize_textarea_field($_POST['hist_id']));
    }
}
add_action('save_post', 'meta_hist_people' );