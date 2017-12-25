<div class="col-md-3 blog-right">
    <div class="categories">
        <h2>新闻分类</h2>
        <ul>
            <li><a href="#"><?php wp_list_cats('sort_column=name&optioncount=1&hierarchical=0'); ?>	</a></li>
        </ul>
    </div>
    <div class="categories">
        <h3>最近新闻</h3>
        <ul>
            <li><a href="#"><?php wp_get_archives('type=postbypost&limit=5'); ?></a></li>
        </ul>
    </div>
    <div class="categories">
        <h3>热门标签</h3>
        <ul>
            <?php wp_tag_cloud('smallest=12&largest=18&unit=px&number=20');?>
        </ul>
    </div>
</div>