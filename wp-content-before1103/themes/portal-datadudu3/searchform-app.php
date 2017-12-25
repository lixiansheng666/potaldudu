<form action="//www.ubibot.cn/app-h5-search-view/" method="get" class="form-horizontal" id="search-app"  role="search" style="display: block;">
    <div class="col-lg-12 col-lg-offset-7 col-md-offset-7 col-sm-offset-7 input-group search-input-group" style="padding: 15px 0px;margin:0px auto;width: 80%">
<!--        <input type="hidden" name="scope" value="1">-->
        <input name="searchTerm"  id="s" autocomplete="off" type="text" class="form-control" placeholder="输入要搜索的内容关键字" style="border-top-left-radius: 8px;border-bottom-left-radius: 8px;">
<span class="input-group-addon" style="border-top-right-radius: 8px;border-bottom-right-radius: 8px;">
<button type="submit" id="search-app-submit">
    <span class="glyphicon glyphicon-search"></span>
</button>
</span>
    </div>
</form>
<script>
    function formsubmit(){
        document.getElementById("search-app").submit();
    }
</script>