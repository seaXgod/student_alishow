<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Add new post &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
  
  <link rel="stylesheet" href="/assets/vendors/editor/themes/default/css/umeditor.css">
  <script src="/assets/vendors/editor/third-party/jquery.min.js"></script>
  <script src="/assets/vendors/editor/umeditor.config.js"></script>
  <script src="/assets/vendors/editor/umeditor.min.js"></script>
  <script src="/assets/vendors/editor/lang/zh-cn/zh-cn.js"></script>
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
        <h1>写文章</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="row">
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
          </div>
          <div class="form-group">
            <label for="content">内容</label>
            <textarea id="content" name="content"></textarea>
          </div>
        </div>
        <div class="col-md-3">
         
          <div class="form-group">
            <label for="feature">特色图像</label>
            <!-- show when image chose -->
            <img class="help-block thumbnail" style="display: none" >
            <input id="feature" class="form-control" name="feature" type="file">
          </div>
          <div class="form-group">
            <label for="category">所属分类</label>
            <select id="category" class="form-control" name="category">
              
            </select>
          </div>
          <div class="form-group">
            <label for="status">状态</label>
            <select id="status" class="form-control" name="status">
              <option value="drafted">草稿</option>
              <option value="published">已发布</option>
            </select>
          </div>
          <div class="form-group">
            <button class="btn btn-primary" type="submit">保存</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php' ?>
  </div>

  <!-- <script src="/assets/vendors/jquery/jquery.js"></script> -->
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="/assets/vendors/jquery/template-web.js"></script>
  <script src="/assets/vendors/layer/layer.js"></script>
 
  <!-- 模板 -->
  <script type="text/template" id="tpl">
    {{each cate_list value}}
    <option value="{{value.cate_id}}">{{value.cate_naem}}</option>
    {{/each}}
  </script>
  
  <!-- 实例化富文本编辑器 -->
  <script>
    var um = UM.getEditor('content', {
      initialFrameWidth: '100%',
      initialFrameHeight: 300,
    });
    $.post('getCate.php', function (data) {
      console.log(data);
      var obj = {"cate_list": data};
      var optionStr = template('tpl', obj);
      $('#category').html(optionStr);

    },'json')

    //Ajax 文件上传 
    $('#feature').change(function () {
      //获取文件对象
      var file_obj = this.files[0];
      var fd = new FormData();
      fd.append('f', file_obj);
      //发送Ajax请求，并将文件对象一起发送给后端
      $.ajax({
        url: '../uploadImg.php',
        data: fd,
        type: 'post',
        datatype: 'text',
        contentType: false,
        processData: false,
        success: function(data) {
          console.log(data);
          if (data == 2) {
            layer.msg('文件上传失败');
          } else {
            layer.msg('文件上传成功');
            $('.thumbnail').attr('src', data).show();
          }
        }
      })
    })
  </script>
  
  <script>NProgress.done()</script>
</body>
</html>
