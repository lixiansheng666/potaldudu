<?php



function displayDropdownMenu($targetParentSlug,$displayLevel)
{
$category = get_category(get_query_var('cat'), false);
$page_object = get_queried_object();
$page_id = get_queried_object_id();

if (isset($category->cat_ID)) {
    $current_cat_id = $category->cat_ID;
} else {
    $current_cat_id = '-1';
}
$targetCategory = get_category_by_slug($targetParentSlug);
?>
<dt class="level1" style="background-image: url( <?php echo z_taxonomy_image_url($targetCategory->cat_ID); ?>);background-size:6%;">
    <a title="<?php echo $targetCategory->name?>" href='<?php echo get_category_link($targetCategory->cat_ID); ?>'><p><?php echo $targetCategory->name?></p></a>
</dt>
<?php
$target1 = get_category_by_slug($targetParentSlug);
$args = array('parent' => $target1->cat_ID, "child_of" => $target1->cat_ID, 'hide_empty' => 0, 'order' => 'ASC');
$sub1 = get_categories($args);
//    var_dump($sub1);
?>
<ul id="accordion" class="accordion" style="margin: 0px;">
    <?php
    if(count($sub1)>0)
    {
    foreach ($sub1 as $cat){
    if ($cat->count == 0)
    {
    //            var_dump($cat->name);
    ?>
    <li style="margin: 0px;" class="<?php if (in_category($cat->cat_ID) && $category->slug != $targetParentSlug) echo "open" ?>">
        <div class="link" style="padding: 5px 15px 5px 30px;">
            <p><?php echo $cat->name; ?></p><i class="fa fa-chevron-down"></i>
        </div>
        <ul class="submenu" style="margin: 0px;<?php if (in_category($cat->cat_ID) && $category->slug != $targetParentSlug) echo "display: block;" ?>">

            <?php
            }
            else{
            //                var_dump($cat);
            ?>
            <?php if($displayLevel != 1 && $displayLevel != 3) { ?>
            <li style="margin: 0px;" class="<?php if ($cat->cat_ID == $page_id || in_category($cat->cat_ID) && $page_id != 94) {echo "open";} ?>">
                <div class="link" style="padding: 5px 15px 5px 30px;">
                    <p><?php echo $cat->name; ?></p><i class="fa fa-chevron-down"></i>
                </div>
                <ul class="submenu" style="margin: 0px;<?php if ($cat->parent != $page_id && in_category($cat->cat_ID)) echo "display: block;" ?>">
                    <?php }elseif($displayLevel == 1){ ?>
                    <li style="margin: 0px;" >
                        <?php if($cat->cat_ID == $page_id){ ?>
                            <div class="link" style="padding: 5px 15px 5px 30px;background-color: #d5efff;">
                                <a title="<?php echo $cat->name; ?>" href="<?php echo get_category_link($cat->cat_ID); ?>" ><p><?php echo $cat->name; ?></p></a>
                            </div>
                        <?php }elseif($cat->cat_ID != $page_id && in_category($cat->cat_ID) && is_single($page_id)){ ?>
                            <div class="link" style="padding: 5px 15px 5px 30px;background-color: #d5efff;">
                                <a title="<?php echo $cat->name; ?>" href="<?php echo get_category_link($cat->cat_ID); ?>" ><p><?php echo $cat->name; ?></p></a>
                            </div>
                        <?php }else{ ?>
                            <div class="link" style="padding: 5px 15px 5px 30px;">
                                <a title="<?php echo $cat->name; ?>" href="<?php echo get_category_link($cat->cat_ID); ?>" ><p><?php echo $cat->name; ?></p></a>
                            </div>
                        <?php } ?>

                        <ul class="submenu" style="margin: 0px;">
                            <?php } ?>
                            <?php
                            if( $displayLevel != 3 && $displayLevel != 1){
                                $childrenPostArgs = array('posts_per_page' => 14, 'category_name' => $cat->slug, 'order' => 'ASC',);
                                $rand_posts = get_posts($childrenPostArgs);
                                //            var_dump($rand_posts);
                                foreach ($rand_posts as $post1) {
//                var_dump($post1);
//                var_dump(get_post_permalink($post1->ID));
                                    if (in_category($cat->cat_ID) && $post1->ID == $page_id) {
                                        ?>
                                        <li style = "margin: 0px;background-color: #d5efff;" ><a title="<?php echo $post1->post_title; ?>" href = '<?php echo get_permalink($post1->ID); ?>' >—&nbsp;<?php echo $post1->post_title; ?></a>
                                        </li>
                                        <?php
                                    } else {
                                        ?>
                                        <li style = "margin: 0px;" > <a title="<?php echo $post1->post_title; ?>" href = '<?php echo get_permalink($post1->ID); ?>' >—&nbsp;<?php echo $post1->post_title; ?></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                }
                            }elseif($displayLevel == 3){ ?>
                            <li style="margin: 0px;" class="<?php if (in_category($cat->cat_ID) && $page_id != $targetCategory->parent && $page_id != $targetCategory->cat_ID) echo "open" ?>">
                                <div class="link" style="padding: 5px 15px 5px 30px;">
                                    <p><?php echo $cat->name; ?></p><i class="fa fa-chevron-down"></i>
                                </div>
                                <ul class="submenu" style="margin: 0px;<?php if (in_category($cat->cat_ID) && $page_id != $targetCategory->parent && $page_id != $targetCategory->cat_ID) echo "display: block;" ?>">
                                    <?php //level3,分类下拉菜单还是分类
                                    $args = array('parent' => $cat->cat_ID, 'hide_empty' => 0, 'order' => 'ASC');
                                    $sub2 = get_categories($args);
                                    //           var_dump($sub2);
                                    foreach ($sub2 as $cat2){ ?>
                                        <?php if (in_category($cat2->cat_ID) && $page_id != $targetCategory->parent  && $page_id != $targetCategory->cat_ID && $page_id != $cat2->parent){ ?>
                                            <li style ="margin: 0px;background-color: #d5efff;">
                                                <a title = "<?php echo $cat2->name; ?>" href = '<?php echo get_category_link($cat2->cat_ID); ?>' >—&nbsp;<?php echo $cat2->name; ?></a>
                                            </li>
                                        <?php }else{ ?>
                                            <li style ="margin: 0px;"><a title = "<?php echo $cat2->name; ?>" href = '<?php echo get_category_link($cat2->cat_ID); ?>' >—&nbsp;<?php echo $cat2->name; ?></a></li>
                                        <?php } ?>
                                        <?php
                                        ///////
                                    }
                                    }
                                    }
                                    ?>
                                </ul>
                                <?php
                                }
                                }else{
            global $post;
            $args = array( 'posts_per_page' => 6,'category_name'=> $targetParentSlug, 'order'=> 'ASC',);
            $rand_posts = get_posts( $args );
            foreach ( $rand_posts as $post ) :
                setup_postdata( $post );
//                 var_dump(($post->ID));
//                  var_dump($page_id);?>
				<?php   if ($post->ID == $page_id) { ?>
		<dd><a title="<?php the_title(); ?>" href="<?php echo the_permalink(); ?>" style="background-color:#d5efff;"><p><?php the_title(); ?></p></a></dd>
				<?php }else{ ?>
		<dd><a title="<?php the_title(); ?>" href="<?php echo the_permalink(); ?>"><p><?php the_title(); ?></p></a></dd>
				<?php } ?>
		</dd>
		<?php endforeach;

        wp_reset_postdata();
    }
                                ?>
                            </li>
                        </ul>
                        <?php } ?>

<?php
$category = get_category(get_query_var('cat'),false);
$page_object = get_queried_object();
$page_id     = get_queried_object_id();
if(isset($category->cat_ID)){
    $current_cat_id = $category->cat_ID;
} else {
    $current_cat_id = '-1';
}
?>
<div class="col-lg-2 col-md-4 col-sm-4 blog-right" style="padding-top: 30px;">
<div class="content">
<div class="menu">
    <dl>
        <?php
        displayDropdownMenu("account-management",0);
        displayDropdownMenu("product-use",3);
        displayDropdownMenu("manuals",0);
        displayDropdownMenu("releases",1);
        displayDropdownMenu("platform-api",2);
        displayDropdownMenu("device-api",0);
        ?>
        </dl>
</div>
</div>
</div>
