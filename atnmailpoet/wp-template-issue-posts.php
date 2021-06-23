<table class="xmailpoet_content-wrapperx" border="0" width="660" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:#ffffff;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;max-width:660px;">
    <tbody>    
        <?php if( $wp_posts ) :
            $posts = $wp_posts->posts;
            $posts_count = $wp_posts->post_count;
            $zebraCss = 0;

            foreach($posts as $key => $val) :
                ?>
                <tr>
                    <td class="mailpoet_content" align="center" style="border-collapse:collapse">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
                            <tbody>
                                <tr>
                                    <td style="border-collapse:collapse;padding-left:0;padding-right:0">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mailpoet_cols-one" style="border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;table-layout:fixed;margin-left:auto;margin-right:auto;padding-left:0;padding-right:0">
                                            <tbody>
                                                <tr>
                                                    <td class="mailpoet_text mailpoet_padded_vertical mailpoet_padded_side" valign="top" style="border-collapse:collapse;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;word-break:break-word;word-wrap:break-word">
                                                        <h3 data-post-id="7074" style="margin:0 0 6.6px;color:#333333;font-family:'Trebuchet MS','Lucida Grande','Lucida Sans Unicode','Lucida Sans',Tahoma,sans-serif;font-size:22px;line-height:35.2px;margin-bottom:0;text-align:left;padding:0;font-style:normal;font-weight:normal"><?php echo $val->post_title;?></h3>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="mailpoet_content-cols-two" align="left" style="border-collapse:collapse">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
                                <tbody>
                                    <tr>
                                        <td align="center" style="border-collapse:collapse;font-size:0">
                                        <!--[if mso]>
                                        <table border="0" width="100%" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                        <td width="330" valign="top">
                                        <![endif]-->
                                        <div style="display:inline-block; max-width:330px; vertical-align:top; width:100%;">
                                            <?php if ( ($zebraCss%2)==1 ) : ?>
                                                    <!-- left -->
                                                    <table width="330" class="mailpoet_cols-two" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse;width:100%;max-width:330px;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;table-layout:fixed;margin-left:auto;margin-right:auto;padding-left:0;padding-right:0">
                                                        <tbody>
                                                            <tr>
                                                                <td class="mailpoet_text mailpoet_padded_vertical mailpoet_padded_side" valign="top" style="border-collapse:collapse;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;word-break:break-word;word-wrap:break-word">
                                                                    <table style="border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0" width="100%" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="mailpoet_paragraph" style="border-collapse:collapse;color:#000000;font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;font-size:16px;line-height:25.6px;word-break:break-word;word-wrap:break-word;text-align:left">
                                                                                <?php echo substr(strip_tags($val->post_content),0, 250); ?> 
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <table style="border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0" width="100%" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="mailpoet_paragraph" style="border-collapse:collapse;color:#000000;font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;font-size:16px;line-height:25.6px;word-break:break-word;word-wrap:break-word;text-align:left">
                                                                                    <a href="<?php echo esc_url( get_permalink($val->ID) ); ?>" style="color:#21759B;text-decoration:underline">Read more</a>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                            <?php else: ?>    
                                                    <!-- right -->
                                                    <table width="330" class="mailpoet_cols-two" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse;width:100%;max-width:330px;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;table-layout:fixed;margin-left:auto;margin-right:auto;padding-left:0;padding-right:0">
                                                        <tbody>
                                                            <tr>
                                                                <td class="mailpoet_image mailpoet_padded_vertical mailpoet_padded_side" align="center" valign="top" style="border-collapse:collapse;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px">
                                                                    <?php if ( has_post_thumbnail( $val->ID ) ) {
                                                                        
                                                                        ?><a href="<?php echo esc_url( get_permalink($val->ID) ); ?>" style="color:#21759B;text-decoration:underline"><?php

                                                                        $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $val->ID ), 'large' );
                                                                        if ( ! empty( $large_image_url[0] ) ) {
                                                                            ?><img src="<?php echo esc_url( $large_image_url[0] );?>" alt="" width="100%" style="height:auto;max-width:100%;-ms-interpolation-mode:bicubic;border:0;display:block;outline:none;text-align:center" /> <?php
                                                                        }
                                                                        
                                                                        ?></a><?php

                                                                    } ?>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                            <?php endif; ?>
                                        </div>
                                        <!--[if mso]>
                                        </td>
                                        <td width="330" valign="top">
                                        <![endif]-->
                                        <div style="display:inline-block; max-width:330px; vertical-align:top; width:100%;">
                                            <?php if ( ($zebraCss%2)==1 ) : ?>
                                                <table width="330" class="mailpoet_cols-two" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse;width:100%;max-width:330px;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;table-layout:fixed;margin-left:auto;margin-right:auto;padding-left:0;padding-right:0">
                                                <tbody>
                                                    <tr>
                                                        <td class="mailpoet_image mailpoet_padded_vertical mailpoet_padded_side" align="center" valign="top" style="border-collapse:collapse;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px">
                                                            <?php if ( has_post_thumbnail( $val->ID ) ) {
                                                                
                                                                ?><a href="<?php echo esc_url( get_permalink($val->ID) ); ?>" style="color:#21759B;text-decoration:underline"><?php

                                                                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $val->ID ), 'large' );
                                                                if ( ! empty( $large_image_url[0] ) ) {
                                                                    ?><img src="<?php echo esc_url( $large_image_url[0] );?>" alt="" width="100%" style="height:auto;max-width:100%;-ms-interpolation-mode:bicubic;border:0;display:block;outline:none;text-align:center" /> <?php
                                                                }
                                                                
                                                                ?></a><?php

                                                            } ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <?php else: ?>    
                                                <table width="330" class="mailpoet_cols-two" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse;width:100%;max-width:330px;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;table-layout:fixed;margin-left:auto;margin-right:auto;padding-left:0;padding-right:0">
                                                        <tbody>
                                                            <tr>
                                                                <td class="mailpoet_text mailpoet_padded_vertical mailpoet_padded_side" valign="top" style="border-collapse:collapse;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;word-break:break-word;word-wrap:break-word">
                                                                    <table style="border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0" width="100%" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="mailpoet_paragraph" style="border-collapse:collapse;color:#000000;font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;font-size:16px;line-height:25.6px;word-break:break-word;word-wrap:break-word;text-align:left">
                                                                                <?php echo substr(strip_tags($val->post_content),0, 250); ?>... 
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <table style="border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0" width="100%" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="mailpoet_paragraph" style="border-collapse:collapse;color:#000000;font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;font-size:16px;line-height:25.6px;word-break:break-word;word-wrap:break-word;text-align:left">
                                                                                    <a href="<?php echo esc_url( get_permalink($val->ID) ); ?>" style="color:#21759B;text-decoration:underline">Read more</a>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                            <?php endif; ?> 
                                        </div>
                                        <!--[if mso]>
                                        </td>
                                        </tr>
                                        </tbody>
                                        </table>
                                        <![endif]-->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                </tr>
                <tr>
                <td class="mailpoet_content" align="center" style="border-collapse:collapse">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
                        <tbody>
                            <tr>
                                <td style="border-collapse:collapse;padding-left:0;padding-right:0">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mailpoet_cols-one" style="border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0;table-layout:fixed;margin-left:auto;margin-right:auto;padding-left:0;padding-right:0">
                                        <tbody>
                                            <tr>
                                                <td class="mailpoet_divider" valign="top" style="border-collapse:collapse;padding:13px 20px 13px 20px">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0;mso-table-lspace:0;mso-table-rspace:0">
                                                        <tbody>
                                                            <tr>
                                                                <td class="mailpoet_divider-cell" style="border-collapse:collapse;border-top-width:2px;border-top-style:solid;border-top-color:#21759b">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
                <?php $zebraCss++; ?>
            <?php endforeach; ?>

        <?php else: ?>
            <tr> 
                <td align="left"> 
                    <h2>There are no Posts</h2> 
                </td> 
            </tr> 
        <?php endif; ?>
    </tbody>
</table> 
