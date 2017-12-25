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



?>
<div class="col-lg-2 col-md-4 col-sm-4 blog-right" style="padding-top: 30px;">

<div class="content">
<div class="menu">
    <dl>
        <?php

        displayDropdownMenu("account-management","/images/account2.png",0);
        displayDropdownMenu("product-use","/images/products.png",3);
        displayDropdownMenu("manuals","/images/download.png",0);
        displayDropdownMenu("releases","/images/version.png",1);
        displayDropdownMenu("platform-api","/images/apidoc.png",2);
        ?>
        </dl>

</div>
</div>

</div>
