<table cellpadding="0" cellspacing="0">
    <?php if( $gallery_posts ){
        foreach($gallery_posts as $key => $val){ ?>
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="left" style="font-family: arial,sans-serif; color: #333;">
                                <h2><?php echo $val['data']->post_title;?></h2>
                            </td>
                        </tr>
                        <tr>
                            <?php if(isset($val['images']) ){
                                if( isset($val['images']['gallery']) ){
                                    foreach($val['images']['gallery'] as $k => $v){ ?>
                                        <tr>
                                            <td class="col" style="padding: 0 5px;">
                                                <img src="<?php echo $v['src'];?>'" alt="images" width="300" height="250" style="max-width: 100%;display: block; border: 0;margin-bottom:10px;" />
                                            </td>
                                        </tr>
                                    <?php }//foreach
                                }//if( isset($val['images']['gallery']) )
                            }//if(isset($val['images']) )
                            ?>
                        </tr>
                        <tr>
                        <td >
                                <a href="<?php echo esc_url( get_permalink($val['data']->ID) );?>">View this Gallery</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="pattern" width="600"><p></p></td>
                        </tr>
                        <tr>
                            <td class="pattern" width="100%"><hr style="border: 1px solid black;margin-bottom: 20px;"/></td>
                        </tr>
                    </table>
                </td>
            </tr>
       <?php  }//foeach posts
    }//if posts ?>
</table>