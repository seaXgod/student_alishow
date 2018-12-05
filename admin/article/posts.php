<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>

  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.min.css">
  <script src="/assets/vendors/jquery/jquery.min.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.min.js"></script>
  <script src="/assets/vendors/twbs-pagination/jquery.twbsPagination.js"></script>
</head>
<body>
  <?php include_once '../include/checksession.php' ?>
  <script>NProgress.start()</script>

  <div class="main">
    <nav class="navbar">
      <?php include_once '../include/nav.php' ?>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>所有文章</h1>
        <a href="post-add.html" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
        <form class="form-inline">
          <select name="" class="form-control input-sm">
            <option value="">所有分类</option>
            <option value="">未分类</option>
          </select>
          <select name="" class="form-control input-sm">
            <option value="">所有状态</option>
            <option value="">草稿</option>
            <option value="">已发布</option>
          </select>
          <button class="btn btn-default btn-sm">筛选</button>
        </form>
        <ul class="pagination pagination-sm pull-right">
          
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          
          
        </tbody>
      </table>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php' ?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="/assets/vendors/twbs-pagination/jquery.twbsPagination.js"></script>
  <?php  
    //目标： 计算总页数
    //查询数据总页数
    $sql = 'select count(*) as num from ali_article';
    include_once '../include/mysqli.php';
    $arr = execsql($sql, 'One');
    
    //自定义每页显示条数
    $pagesize = 3;
    //计算总页数
    $totalPages = ceil($arr['num'] / $pagesize);

  ?>
  <?php
    //目标：验证sql语句查询结果是否正确
    //设置页号
    $pageno = 3;  
    //设置每页显示的数量
    $pagesize = 3;
    $start = ($pageno - 1) * $pagesize;
    $sql = "select * from ali_article limit $start,$pagesize";

    include_once '../include/mysqli.php';
    $list = execsql($sql, 'All');

    print_r($list);
  ?>

  <script type="text/template" id = "tpl">
  {{each list value}}
  <tr>
    <td class="text-center"><input type="checkbox"></td>
    <td>{{value.article_title}}</td>
    <td>{{value.article_adminid}}</td>
    <td>{{value.article_cateid}}</td>
    <td class="text-center">{{value.article_addtime}}</td>
    <td class="text-center">{{value.article_state}}</td>
    <td class="text-center">
      <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
      <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
    </td>
  </tr>
  {{/each}}
</script>
  <script>
    //导航条---> 调用twbspagination函数
   window.pagObj = $('.pagination').twbsPagination({
      totalPages: <?php echo $totalPages; ?>,
      visiblePages: 4,
      first: '首页',
      prev: '上一页',
      next: '下一页',
      last: '尾页',
      
      onPageClick: function (event, page) {
        console.log(page + '(from options)');
        //发送Ajax请求并将页号一起发送给后端getContent.php
        $.ajax({
          url: 'getContent.php',
          data: {pagenoo: page},
          type: 'post',
          dataType: 'text',
          success: function (data) {
            console.log(data);
          }
        })
      }
    })
  

    //数据
    onPageClick: function (event,page) {
      console.info(page + '(from options)');
      //发送Ajax请求并将页号一起发送给后端getContent.php页面
      $.ajax({
        url: 'getContent.php',
        data: {pageno: page},
        type: 'post',
        dataType: function (data) {
          consloe.log(data);
          var obj = {"list": data};
          var tbodyStr = template('tpl',obj);
          $('tbody').html(tbodyStr);
        }
      })
    }
</script>



  <script>NProgress.done()</script>
</body>
</html>
