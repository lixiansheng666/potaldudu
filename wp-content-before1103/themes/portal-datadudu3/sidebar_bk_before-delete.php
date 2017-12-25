<!--<div class="col-lg-3 col-md-3 col-sm-3 blog-right">-->
<!--    <div class="categories">-->
<!--        <h2>公司文章分类</h2>-->
<!--        <ul>-->
<!--            <li><a href="#">--><?php //wp_list_categories('sort_column=name&optioncount=1&hierarchical=0'); ?><!--	</a></li>-->
<!--        </ul>-->
<!--    </div>-->
<!--    <div class="categories">-->
<!--        <h3>最近文章</h3>-->
<!--        <ul>-->
<!--            <li><a href="#">--><?php //wp_get_archives('type=postbypost&limit=5'); ?><!--</a></li>-->
<!--        </ul>-->
<!--    </div>-->
<!--    <div class="categories">-->
<!--        <h3>热门标签</h3>-->
<!--        <ul>-->
<!--            --><?php //wp_tag_cloud('smallest=12&largest=18&unit=px&number=20');?>
<!--        </ul>-->
<!--    </div>-->
<!--</div>-->
<?php

$category = get_category(get_query_var('cat'),false);
$page_object = get_queried_object();
$page_id     = get_queried_object_id();
//var_dump($page_id);

//var_dump($category);

//$parent = get_category($category->parent);
//$parent_cat_id=$parent->cat_ID;
if(isset($category->cat_ID)){
    $current_cat_id = $category->cat_ID;
} else {
    $current_cat_id = '-1';
}
//var_dump($current_cat_id);

function displayDropdownMenu($targetParentSlug,$iconRelatedURL)
{

$category = get_category(get_query_var('cat'), false);
$page_object = get_queried_object();
$page_id = get_queried_object_id();
//var_dump($page_id);

//var_dump($category);

//$parent = get_category($category->parent);
//$parent_cat_id=$parent->cat_ID;
if (isset($category->cat_ID)) {
    $current_cat_id = $category->cat_ID;
} else {
    $current_cat_id = '-1';
}

$targetCategory = get_category_by_slug($targetParentSlug);

//        var_dump($targetCategory);
?>


<dt class="level1" style="background-image: url( <?php echo get_template_directory_uri();echo $iconRelatedURL; ?>);">
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
    <li style="margin: 0px;"
        class="<?php if (in_category($cat->cat_ID) && $category->slug != $targetParentSlug) echo "open" ?>">
        <div class="link" style="padding: 5px 15px 5px 30px;">
            <p><?php echo $cat->name; ?></p><i class="fa fa-chevron-down"></i>
        </div>
        <ul class="submenu"
            style="margin: 0px;<?php if (in_category($cat->cat_ID) && $category->slug != $targetParentSlug) echo "display: block;" ?>">

            <?php
            }else{
            //            var_dump($cat->name);
            ?>
            <li style="margin: 0px;"
                class="<?php if (in_category($cat->cat_ID) && $category->slug != $targetParentSlug) echo "open" ?>">
                <div class="link" style="padding: 5px 15px 5px 30px;">
                    <p><?php echo $cat->name; ?></p><i class="fa fa-chevron-down"></i>
                </div>
                <ul class="submenu"
                    style="margin: 0px;<?php if (in_category($cat->cat_ID) && $category->slug != $targetParentSlug) echo "display: block;" ?>">
                    <?php
                    $childrenPostArgs = array('posts_per_page' => 6, 'category_name' => $cat->slug, 'order' => 'ASC',);
                    $rand_posts = get_posts($childrenPostArgs);
                    //            var_dump($rand_posts);
                    foreach ($rand_posts as $post1) {
//                var_dump($post1);
//                var_dump(get_post_permalink($post1->ID));
                        if (in_category($cat->cat_ID) && $post1->ID == $page_id) {
                            ?>
                            <li style="margin: 0px;background-color: #2aabd2;"><a title=""
                                                                                  href='<?php echo get_permalink($post1->ID); ?>'><?php echo $post1->post_title; ?></a>
                            </li>
                            <?php
                        } else {
                            ?>
                            <li style="margin: 0px;"><a title=""
                                                        href='<?php echo get_permalink($post1->ID); ?>'><?php echo $post1->post_title; ?></a>
                            </li>
                            <?php
                        }
                        ?>
                        <?php
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
                        setup_postdata( $post ); ?>
                        <dd class="">
                            <a title="" href="<?php echo the_permalink(); ?>"><p><?php the_title(); ?></p> </a>
                        </dd>
                    <?php endforeach;
                    wp_reset_postdata();
                }
                ?>

            </li>
        </ul>


    <!--
    <dt class="level1" style="background-image: url( <?php /*echo get_template_directory_uri(); echo $iconRelatedURL */?> );">
        <a title="<?php /*echo $targetCategory->name*/?>" href='<?php /*echo get_category_link($targetCategory->cat_ID) */?>'><p><?php /*echo $targetCategory->name*/?></p></a>
    </dt>
    <?php
/*    global $post;
    $args = array( 'posts_per_page' => 6,'category_name'=> $targetParentSlug, 'order'=> 'ASC',);
    $rand_posts = get_posts( $args );
    foreach ( $rand_posts as $post ) :
        setup_postdata( $post ); */?>
        <dd class="">
            <a title="" href="<?php /*echo the_permalink(); */?>"><p><?php /*the_title(); */?></p> </a>
        </dd>
    --><?php /*endforeach;
    wp_reset_postdata(); */?>

<?php

}

?>
<div class="col-lg-2 col-md-4 col-sm-4 blog-right" style="padding-top: 30px;">

<div class="content">
<div class="menu">
    <dl>
        <?php

        displayDropdownMenu("account-management","/images/account2.png");
        displayDropdownMenu("product-use","/images/products.png");
        displayDropdownMenu("download","/images/download.png");
        displayDropdownMenu("releases","/images/version.png");
        displayDropdownMenu("platform-api","/images/products.png");
        ?>

        <dt class="level1" style="background-image: url( <?php echo get_template_directory_uri(); ?>/images/account2.png );">
            <a title="账户管理" href='<?php echo site_url() . '/category/faqs/account-management'; ?>'><p>账户管理</p></a>
        </dt>
        <?php
        global $post;
        $args = array( 'posts_per_page' => 6,'category_name'=> 'account-management', 'order'=> 'ASC',);
        $rand_posts = get_posts( $args );
        foreach ( $rand_posts as $post ) :
        setup_postdata( $post ); ?>
        <dd class="">
            <a title="" href="<?php echo the_permalink(); ?>"><p><?php the_title(); ?></p> </a>
        </dd>
        <?php endforeach;
        wp_reset_postdata(); ?>


        <dt class="level1"  style="background-image: url( <?php echo get_template_directory_uri(); ?>/images/products.png);">
            <a title="产品使用" href='<?php echo site_url() . '/category/faqs/product-use/'; ?>'><p>产品使用</p></a>
        </dt>
        <?php
        $target1 = get_category_by_slug( 'product-use' );
        $args = array('parent' => $target1->cat_ID,"child_of"=>$target1->cat_ID,'hide_empty'=>0,'order'=> 'ASC');
        $sub1=get_categories($args);
        ?>
        <ul id="accordion" class="accordion" style="margin: 0px;">
        <?php
        foreach($sub1 as $cat){
        $category_link = get_category_link($cat->cat_ID);
        if(cat_is_ancestor_of($cat->cat_ID,$current_cat_id))
        {
        ?>
            <li style="margin: 0px;" class="open">
                <?php
                }else{
                ?>
            <li style="margin: 0px;">
                <?php
                }
                ?>
                <div class="link" style="padding: 5px 15px 5px 30px;">
                    <p><?php echo $cat->name; ?></p><i class="fa fa-chevron-down"></i>
                </div>
                <ul class="submenu" style="margin: 0px;<?php if(cat_is_ancestor_of($cat->cat_ID,$current_cat_id)) echo "display: block;"?>">
                    <?php
                    $childCategories=get_categories(array('parent'=> $cat->cat_ID,"child_of"=>$target1->cat_ID,'hide_empty'=>0,'order'=> 'ASC'));
                    foreach($childCategories as $subcat){
                        $subCatLink = get_category_link($subcat->cat_ID);
                        if($current_cat_id==$subcat->cat_ID)
                        {
                    ?>
                    <li style="margin: 0px;background-color: #2aabd2;"><a href='<?php echo $subCatLink;?>'><?php echo $subcat->name; ?></a></li>
                    <?php
                    }else{
                    ?>
                    <li style="margin: 0px;"><a href='<?php echo $subCatLink;?>'><?php echo $subcat->name; ?></a></li>
                    <?php
                    }
                    }
                    ?>
                </ul>
                <?php
                }
                ?>

            </li>
        </ul>


        <dt class="level1" style="background-image: url( <?php echo get_template_directory_uri(); ?>/images/download.png);">
            <a title="说明书下载" href='<?php echo site_url() . '/category/manuals'; ?>'><p>说明书下载</p></a>
        </dt>
        <?php
        global $post;
        $args = array( 'posts_per_page' => 6,'category_name'=> 'manuals', 'order'=> 'ASC',);
        $rand_posts = get_posts( $args );
        foreach ( $rand_posts as $post ) :
            setup_postdata( $post ); ?>
            <dd class="">
                <a title="" href="<?php echo the_permalink(); ?>"><p><?php the_title(); ?></p> </a>
            </dd>
        <?php endforeach;
        wp_reset_postdata(); ?>

        <dt class="level1" style="background-image: url( <?php echo get_template_directory_uri(); ?>/images/version.png);">
            <a title="版本发布" href='<?php echo site_url() . '/category/releases'; ?>'><p>版本发布</p></a>
        </dt>
        <?php
        $target1 = get_category_by_slug( 'releases' );
        $args = array('parent' => $target1->cat_ID,"child_of"=>$target1->cat_ID,'hide_empty'=>0,'order'=> 'ASC');
        $sub1=get_categories($args);
        ?>
        <?php
        foreach($sub1 as $cat){
        $category_link = get_category_link($cat->cat_ID);
        ?>

        <dd class="">
            <a title="" href='<?php echo $category_link;?>'><p><?php echo $cat->name; ?></p></a>
        </dd>
            <?php
        }
        ?>
    </dl>



    <dt class="level1"  style="background-image: url( <?php echo get_template_directory_uri(); ?>/images/products.png);">
        <a title="UbiBot API 文档" href='<?php echo site_url() . '/category/platform-api/'; ?>'><p>UbiBot API 文档</p></a>
    </dt>
    <?php
    $target1 = get_category_by_slug( 'platform-api' );
    $args = array('parent' => $target1->cat_ID,"child_of"=>$target1->cat_ID,'hide_empty'=>0,'order'=> 'ASC');
    $sub1=get_categories($args);
//    var_dump($sub1);


    ?>
    <ul id="accordion" class="accordion" style="margin: 0px;">

        <?php
        foreach($sub1 as $cat){

        if($cat->count==0)
        {

//            var_dump($cat->name);
        ?>
            <li style="margin: 0px;" class="<?php if(in_category($cat->cat_ID)&&$category->slug!="platform-api") echo "open"?>">
            <div class="link" style="padding: 5px 15px 5px 30px;">
                <p><?php echo $cat->name; ?></p><i class="fa fa-chevron-down"></i>
            </div>
                <ul class="submenu" style="margin: 0px;<?php if(in_category($cat->cat_ID)&&$category->slug!="platform-api") echo "display: block;"?>">

        <?php
        }else{
//            var_dump($cat->name);
        ?>
            <li style="margin: 0px;" class="<?php if(in_category($cat->cat_ID)&&$category->slug!="platform-api") echo "open"?>">
        <div class="link" style="padding: 5px 15px 5px 30px;">
                <p><?php echo $cat->name; ?></p><i class="fa fa-chevron-down"></i>
        </div>
                <ul class="submenu" style="margin: 0px;<?php if(in_category($cat->cat_ID)&&$category->slug!="platform-api") echo "display: block;"?>">
        <?php
            $childrenPostArgs = array( 'posts_per_page' => 6,'category_name'=> $cat->slug, 'order'=> 'ASC',);
            $rand_posts = get_posts( $childrenPostArgs );
//            var_dump($rand_posts);
            foreach($rand_posts as $post1)
            {
//                var_dump($post1);
//                var_dump(get_post_permalink($post1->ID));
                if(in_category($cat->cat_ID)&&$post1->ID==$page_id) {
                    ?>
                    <li style="margin: 0px;background-color: #2aabd2;" ><a title="" href='<?php echo get_permalink($post1->ID); ?>'><?php echo $post1->post_title; ?></a></li>
                    <?php
                }else{
                    ?>
                    <li style="margin: 0px;"><a title="" href='<?php echo get_permalink($post1->ID); ?>'><?php echo $post1->post_title; ?></a></li>
                    <?php
                }
        ?>
        <?php
            }
        }
        ?>
                    </ul>
            <?php
            }
            ?>

      </li>
    </ul>

</div>
</div>

</div>
