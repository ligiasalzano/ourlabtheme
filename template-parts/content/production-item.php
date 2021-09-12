<?php /** @var $post WP_Post */ ?>
<?php $production_meta_data = get_post_meta( $post->ID ); ?>
<p class="production-item">
    <?php
    echo "{$production_meta_data['author_id'][0]} ";
    the_title();
    echo ". ";
    echo $production_meta_data['journal_id'][0] ? "<strong>{$production_meta_data['journal_id'][0]}</strong>. " : "";
    echo $production_meta_data['more_info'][0] ? "{$production_meta_data['more_info'][0]}. " : "";
    echo $production_meta_data['prod_year'][0] ? "{$production_meta_data['prod_year'][0]}. " : "";
	echo $production_meta_data['doi_id'][0] ? "<a href='{$production_meta_data['doi_id'][0]}' target='_blank' class='small'>DOI</a> " : "";

    $theFILE = get_post_meta($post->ID,'wp_custom_attachment',true);
    if (is_array( $theFILE ) && isset( $theFILE[0]['url'] ) ) {
        $url = $theFILE[0]['url'];
        ?>
        <a href="<?php echo $url; ?>" target="_blank"><img src="<?php echo get_template_directory_uri() . '/images/pdf_icon.png' ?>" alt="PDF"></a>
        <?php
    }
    ?>
</p>