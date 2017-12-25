<!--<form role="search" method="get" id="searchform" action="--><?php //echo home_url( '/' ); ?><!--">-->
<!--    <div><label class="screen-reader-text" for="s"></label>-->
<!--        <input type="text" value="" name="s" id="s" placeholder="请简要描述您的问题"/>-->
<!--        <input type="submit" id="searchsubmit" value="Search" />-->
<!--    </div>-->
<!---->
<!---->
<!--</form>-->

<form action="<?php echo home_url( '/' ); ?>" method="get" class="form-horizontal" id="searchform"  role="search" style="display: block;">

    <div class="container-fluid">
        <div>
            <div class="row-fluid footedinfo">
                <div class="col-lg-2"></div>

                <div class="col-md-8 col-sm-8 col-xs-12 col-lg-5" style="color: #fff;padding: 20px 20px;">
                    <?php $target1 = get_category_by_slug( 'account-management' | 'product-use' | 'platform-api' | 'releases' | 'mannual');
                    $args = array('parent' => $target1->cat_ID,"child_of"=>$target1->cat_ID,'hide_empty'=>0,'order'=> 'ASC');
                    $sub1=get_categories($args);
                    foreach($sub1 as $cat) {
                        if (in_category($cat->cat_ID)) {
//                var_dump($cat);
                            ?>
                            <span style="color: #fff;"><?php echo $cat->name; ?></span>
                            <?php
                        }
                        $target1 = get_category_by_slug($cat->slug);
                        $args = array('parent' => $target1->cat_ID,"child_of"=>$target1->cat_ID,'hide_empty'=>0,'order'=> 'ASC');
                        $sub1=get_categories($args);
                        foreach($sub1 as $cat) {

                            if (in_category($cat->cat_ID)) {
                                ?>
                                <span style="color: #fff;">&nbsp;>&nbsp;<?php echo $cat->name; ?></span>
                                <?php
                            }

                    $childrenPostArgs = array('posts_per_page' => 6, 'category_name' => $cat->slug, 'order' => 'ASC',);
                    $rand_posts = get_posts($childrenPostArgs);
                    //            var_dump($rand_posts);
                    foreach ($rand_posts as $post1) {
//                var_dump($post1);
//                var_dump(get_post_permalink($post1->ID));
                        $page_id     = get_queried_object_id();
                        if (in_category($cat->cat_ID) && $post1->ID == $page_id) { ?>
                            <span style="color: #fff;">&nbsp;>&nbsp;<?php echo $post1->post_title; ?></span>
                        <?php
                        }
                    }

                        }
                    }
                    ?>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-12 col-lg-3 input-group search-input-group" style="padding: 15px 0px;">
                    <input type="hidden" name="scope" value="1">
                    <input name="s"  id="s" autocomplete="off" type="text" class="form-control" placeholder="输入要搜索的内容关键字" style="border-top-left-radius: 8px;border-bottom-left-radius: 8px;">
        <span class="input-group-addon" style="border-top-right-radius: 8px;border-bottom-right-radius: 8px;">
        <button type="submit" id="searchsubmit">
            <span class="glyphicon glyphicon-search"></span>
        </button>
</span>

                </div>

            </div>
        </div>

    </div>

</form>
<!--<script>-->
<!--    var test = window.location.href.split("/")[5];-->
<!--    alert(test);-->
<!--    </script>-->