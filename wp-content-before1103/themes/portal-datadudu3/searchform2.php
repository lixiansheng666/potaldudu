<!--<form role="search" method="get" id="searchform" action="--><?php //echo home_url( '/' ); ?><!--">-->
<!--    <div><label class="screen-reader-text" for="s"></label>-->
<!--        <input type="text" value="" name="s" id="s" placeholder="请简要描述您的问题"/>-->
<!--        <input type="submit" id="searchsubmit" value="Search" />-->
<!--    </div>-->
<!---->
<!---->
<!--</form>-->

<form action="<?php echo home_url( '/' ); ?>" method="get" class="form-horizontal" id="searchform"  role="search" style="display: block;">
    <div class="col-lg-12 col-lg-offset-7 col-md-offset-7 col-sm-offset-7 input-group search-input-group" style="padding: 15px 0px;">
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