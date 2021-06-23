<table cellpadding="0" cellspacing="0">
<?php if( $wp_posts ){
    $posts = $wp_posts->posts;
    $posts_count = $wp_posts->post_count;
    foreach($posts as $key => $val){
?>
        <tr>
            <td class="pattern" width="600">
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td valign="top" style="word-break:break-word;word-wrap:break-word;border-collapse:collapse;padding-bottom:20px;padding-right:20px">
                            <h2 style="text-align:left;padding:0;font-style:normal;font-weight:normal;margin:0 0 7.2px;color:#222222;font-family:\'Trebuchet MS\',\'Lucida Grande\',\'Lucida Sans Unicode\',\'Lucida Sans\',Tahoma,sans-serif;font-size:24px;line-height:38.4px"><?php echo $val->post_title;?></h2>
                        </td>
                    </tr>
                    <tr>
                        <td class="hero">
                            <?php if ( has_post_thumbnail( $val->ID ) ) {
                                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $val->ID ), 'large' );
                                if ( ! empty( $large_image_url[0] ) ) {
                                    ?><img src="<?php echo esc_url( $large_image_url[0] );?>" alt="" width="100%" style="display: block; border: 0;" /><?php
                                }
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            <p></p>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" style="word-break:break-word;word-wrap:break-word;text-align:left;border-collapse:collapse;color:#000000;font-family:Arial,\'Helvetica Neue\',Helvetica,sans-serif;font-size:16px;line-height:25.6px">
                            <?php echo  substr(strip_tags($val->post_content),0, 250); ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <a href="<?php echo esc_url( get_permalink($val->ID) );?>">Read More</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="pattern" width="100%"><p></p></td>
        </tr>
        <tr>
            <td class="pattern" width="100%"><hr style="border: 1px solid black;margin-bottom: 20px;"/></td>
        </tr>
    <?php } ?>

<?php } else { ?>
<tr>
    <td align="left">
        <h2>There are no Posts</h2>
    </td>
</tr>
<?php } ?>

</table>