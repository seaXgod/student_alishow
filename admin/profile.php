<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Dashboard &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <?php include_once '../admin/include/checksession.php' ?>
  <script>NProgress.start()</script>

  <div class="main">
    <nav class="navbar">
      <?php include_once '../admin/include/nav.php' ?>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>我的个人资料</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <?php 
        //从session中获取admin_id
        $id = $_SESSION['id'];

        //拼接SQL语句
        $sql = "select * from ali_admin where admin_id = $id";

        //链接MySQL并执行语句
        include_once './include/mysqli.php';
        $admin_info = execSql($sql,'One');
      
      ?>
      <form class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-3 control-label">头像</label>
          <div class="col-sm-6">
            <label class="form-image">
              <input id="avatar" type="file">
              <img src="<?php echo $admin_info['admin_pic'] ?>">
              <i class="mask fa fa-upload"></i>
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-3 control-label">邮箱</label>
          <div class="col-sm-6">
            <input id="email" class="form-control" name="email" type="type" value="<?php echo $admin_info['admin_email']; ?>" readonly>
            <p class="help-block">登录邮箱不允许修改</p>
          </div>
        </div>
        <div class="form-group">
          <label for="slug" class="col-sm-3 control-label">别名</label>
          <div class="col-sm-6">
            <input id="slug" class="form-control" name="slug" type="type" value="<?php echo $admin_info['admin_slug']; ?>" placeholder="slug">
          </div>
        </div>
        <div class="form-group">
          <label for="nickname" class="col-sm-3 control-label">昵称</label>
          <div class="col-sm-6">
            <input id="nickname" class="form-control" name="nickname" type="type" value="<?php echo $admin_info['admin_nickname']; ?>">
            <p class="help-block">限制在 2-16 个字符</p>
          </div>
        </div>
        <div class="form-group">
          <label for="bio" class="col-sm-3 control-label">简介</label>
          <div class="col-sm-6">
            <textarea id="bio" class="form-control" cols="30" rows="6"><?php echo $admin_info['admin_sign'] ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-primary">更新</button>
            <a class="btn btn-link" href="password-reset.html">修改密码</a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../admin/include/aside.php' ?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="/assets/vendors/layer/layer.js"></script>
  <script>
    $('#avatar').change(function () {
      //获取图片文件对象 ---FormData
      var file = document.getElementById('avatar').files[0];
      //实例化一个空的FormData对象
      var fd = new FormData();
      //调用formdata的append方法
      fd.append('f', file);

      //发送Ajax请求，将文件对象一起发送给后端
      $.ajax({
        url: 'uploadImg.php',
        data: fd,
        type: 'post',
        dataType: 'text',
        contentType: false,
        processData: false,
        success: function (data) {
          // console.log(data);
          if (data == 2) {
            layer.msg('头像上传失败');
          } else {
            layer.msg('头像上传成功');
            $('#avatar_img').attr('src', data);
          }
        }
      })
    })
  
  </script>
  <script>NProgress.done()</script>
</body>
</html>
