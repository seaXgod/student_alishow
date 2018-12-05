<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <nav class="navbar">
      <button class="btn btn-default navbar-btn fa fa-bars"></button>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="profile.html"><i class="fa fa-user"></i>个人中心</a></li>
        <li><a href="login.html"><i class="fa fa-sign-out"></i>退出</a></li>
      </ul>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
        <input type="button" value = "添加新事件" onclick = "location.href = './addcate.php'">;
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th>名称</th>
								<th>Slug</th>
								<th>添加时间</th>
								<th>图标</th>
								<th>状态</th>
								<th>显示</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <?php
              //1.编写SQL语句
									$sql = 'select * from ali_cate';
              //2. 执行SQL语句
									include_once '../include/mysqli.php';
              //注意execsql 可以调用execsql函数来执行SQL语句
              //这里取出来的是全部的数据，所以第二个参数填 All
									$cate_list = execSql($sql, 'All');
							?>
            <tbody>
              <?php foreach ($cate_list as $value) { ?>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td><?php echo $value['cate_name']; ?></td>
                <td><?php echo $value['cate_slug']; ?></td>
                <td><?php echo $value['cate_addtime']; ?></td>
                <td><?php echo $value['cate_icon']; ?></td>
                <td><?php echo $value['cate_state'] == 1 ? '启用' : '禁用'; ?></td>
                <td><?php echo $value['cate_show'] == 1 ? '显示' : '隐藏'; ?></td>
								
                <td class="text-center">
                  <a href="./editcate.php?id=<?php echo $value['cate_id']; ?>" class="btn btn-info btn-xs">编辑</a>
                  <a href="delcate.php?id=<?php echo $value['cate_id']; ?>" class="btn btn-danger btn-xs" onclick = "return confirm('您确定删除该栏目吗？'）">删除</a>
                 
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php' ?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
