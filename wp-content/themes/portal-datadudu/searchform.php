

<form action="<?php echo home_url( '/' ); ?>" method="get" class="form-horizontal" id="searchform"  role="search" style="display: block;">
    <div class="col-lg-2 col-md-1 col-sm-1"></div>
    <div class="col-lg-5 col-md-5 col-sm-5" style="padding: 22px 30px;color: #fff;">
        <?php



        //关联左侧菜单栏，显示分类，函数
        function displaySiderbarMenuWords($targetParentSlug,$displayLevel){
            $category = get_category(get_query_var('cat'), false);
            $page_object = get_queried_object();
            $page_id = get_queried_object_id();

            if (isset($category->cat_ID)) {
                $current_cat_id = $category->cat_ID;
            } else {
                $current_cat_id = '-1';
            }
            $targetCategory = get_category_by_slug($targetParentSlug);
//		var_dump($targetCategory);
            if($page_id == $targetCategory->parent && in_category($targetCategory->cat_ID)){?>
                <a href="<?php echo get_category_link($targetCategory->parent); ?>" style="color: #fff;"><?php echo get_cat_name($targetCategory->parent);?></a>
            <?php }
            if($displayLevel == 0){
                if($page_id == $targetCategory->cat_ID){
                    if(!empty($targetCategory->parent)){
                        ?>
                        <a href="<?php echo get_category_link($targetCategory->parent); ?>" style="color: #fff;"><?php echo get_cat_name($targetCategory->parent);?></a>&nbsp;>&nbsp;
                    <?php	} ?>
                    <a href="<?php echo get_category_link($targetCategory->cat_ID); ?>" style="color: #fff;"><?php echo $targetCategory->name;?></a>
                <?php }elseif($page_id != $targetCategory->cat_ID && in_category($targetCategory->cat_ID)){
                    if(!empty($targetCategory->parent)){ ?>
                        <a href="<?php echo get_category_link($targetCategory->parent); ?>" style="color: #fff;"><?php echo get_cat_name($targetCategory->parent);?></a>&nbsp;>&nbsp;
                    <?php }
                    $cat = get_the_category($page_id);
                    foreach($cat as $cat2){ ?>
                        <a href="<?php echo get_category_link($cat2->cat_ID); ?>" style="color: #fff;"><?php echo $cat2->name;?></a>&nbsp;>&nbsp;
                    <?php } ?>
                    <a href="<?php the_permalink(); ?>" style="color:#fff;"><?php echo the_title(); ?></a>
                <?php }
            }elseif($displayLevel == 1){
                if($page_id == $targetCategory->cat_ID){ ?>
                    <a href="<?php echo get_category_link($targetCategory->cat_ID); ?>" style="color:#fff;"><?php echo $targetCategory->name;?></a>
                <?php }elseif($page_id != $targetCategory->cat_ID && in_category($targetCategory->cat_ID)){ ?>
                    <a href="<?php echo get_category_link($targetCategory->cat_ID); ?>" style="color:#fff;"><?php echo $targetCategory->name;?></a>&nbsp;>&nbsp;
                    <?php $cat_name = get_cat_name($page_id);?>
                    <a href="<?php echo get_category_link($page_id); ?>" style="color:#fff;"><?php echo $cat_name;?></a>
                    <?php if(is_single($page_id)){
                        $cat = get_the_category($page_id);?>
                        <a href="<?php echo get_category_link($cat[0]->cat_ID); ?>" style="color:#fff;"><?php echo $cat[0]->name;?></a>&nbsp;>&nbsp;
                        <a href="<?php the_permalink(); ?>" style="color:#fff;"><?php echo the_title(); ?></a>
                        <?php
                    }
                }
            }elseif($displayLevel == 2){
                if($page_id == $targetCategory->cat_ID){ ?>
                    <a href="<?php echo get_category_link($targetCategory->cat_ID); ?>" style="color:#fff;"><?php echo $targetCategory->name;?></a>
                <?php }elseif($page_id != $targetCategory->cat_ID && in_category($targetCategory->cat_ID)){ ?>
                    <?php if(is_single($page_id)){
                        $cat = get_the_category($page_id);?>
                        <a href="<?php echo get_category_link($targetCategory->cat_ID); ?>" style="color:#fff;"><?php echo $targetCategory->name;?></a>&nbsp;>&nbsp;
                        <a href="<?php echo get_category_link($cat[0]->cat_ID); ?>" style="color:#fff;"><?php echo $cat[0]->name;?></a>&nbsp;>&nbsp;
                        <a href="<?php the_permalink(); ?>" style="color:#fff;"><?php echo the_title(); ?></a>
                        <?php
                    }elseif(!is_single($page_id) && in_category($targetCategory->cat_ID)){  ?>
                        <a href="<?php echo get_category_link($targetCategory->cat_ID); ?>" style="color:#fff;"><?php echo $targetCategory->name;?></a>&nbsp;>&nbsp;
                        <a href="<?php echo get_category_link($page_id); ?>" style="color:#fff;"><?php echo get_cat_name($page_id); ?></a>
                    <?php }
                }
            }elseif($displayLevel == 3){
                if($page_id == $targetCategory->cat_ID){ ?>
                    <a href="<?php echo get_category_link($targetCategory->parent); ?>" style="color: #fff;"><?php echo get_cat_name($targetCategory->parent);?></a>&nbsp;>&nbsp;
                    <a href="<?php echo get_category_link($targetCategory->cat_ID); ?>" style="color:#fff;"><?php echo $targetCategory->name;?></a>
                <?php }elseif($page_id != $targetCategory->cat_ID && in_category($targetCategory->cat_ID)){
//              $catID = get_query_var('cat');
                    $thisCat = get_category($page_id);
                    if(isset($thisCat) && $thisCat->parent != 0){ ?>
                        <a href="<?php echo get_category_link($targetCategory->parent); ?>" style="color: #fff;"><?php echo get_cat_name($targetCategory->parent);?></a>&nbsp;>&nbsp;
                        <a href="<?php echo get_category_link($targetCategory->cat_ID); ?>" style="color:#fff;"><?php echo $targetCategory->name;?></a>&nbsp;>&nbsp;
                        <?php $parentCat = get_category($thisCat->parent); ?>
                        <a href="<?php echo get_category_link($parentCat->cat_ID); ?>" style="color:#fff;"><?php echo $parentCat->name;?></a>&nbsp;>&nbsp;
                        <a href="<?php echo get_category_link($page_id); ?>" style="color:#fff;"><?php echo get_cat_name($page_id);?></a>
                    <?php }
                    if(is_single($page_id)){
                        ?>
                        <a href="<?php echo get_category_link($targetCategory->parent); ?>" style="color: #fff;"><?php echo get_cat_name($targetCategory->parent);?></a>&nbsp;>&nbsp;
                        <a href="<?php echo get_category_link($targetCategory->cat_ID); ?>" style="color:#fff;"><?php echo $targetCategory->name;?></a>&nbsp;>&nbsp;
                        <?php $cat = get_the_category($page_id);
//               var_dump($cat);
                        foreach($cat as $cat2){
                            if($cat2->parent != 0 && $cat2->parent != 73){ ?>
                                <a href="<?php echo get_category_link($cat2->cat_ID); ?>" style="color:#fff;"><?php echo $cat2->name;?></a>&nbsp;>&nbsp;
                            <?php }
                        }
                        ?>
                        <a href="<?php the_permalink(); ?>" style="color:#fff;"><?php echo the_title(); ?></a>
                        <?php
                    }
                }
            }
        }
        ?>

        <?php



        displaySiderbarMenuWords("account-management",0);
        displaySiderbarMenuWords("manuals",0);
        displaySiderbarMenuWords("device-api",0);
        displaySiderbarMenuWords("releases",1);
        displaySiderbarMenuWords("platform-api",2);
        displaySiderbarMenuWords("product-use",3);
        ?>
    </div>
    <div class="col-lg-12 col-lg-offset-7 col-md-offset-9 col-sm-offset-9 input-group search-input-group" style="padding: 15px 0px;">
        <input type="hidden" name="scope" value="1">
        <input name="s"  id="s" autocomplete="off" type="text" class="form-control" placeholder="输入要搜索的内容关键字" style="border-top-left-radius: 8px;border-bottom-left-radius: 8px;">
<span class="input-group-addon" style="border-top-right-radius: 8px;border-bottom-right-radius: 8px;">
<button type="submit" id="searchsubmit">
    <span class="glyphicon glyphicon-search"></span>
</button>
</span>
    </div>
</form>
<!--<script>-->
<!--    var test = window.location.href.split("/")[5];-->
<!--    alert(test);-->
<!--    </script>-->