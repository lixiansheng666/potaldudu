<form action="<?php echo home_url( '/' ); ?>" method="get" class="form-horizontal" id="searchform"  role="search" style="display: block;">
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