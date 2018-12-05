<link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
<link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
<link rel="stylesheet" href="/assets/css/admin.css">
<script type="text/javascript" src="/assets/vendors/jquery/jquery.js"></script>
<script src="/assets/vendors/nprogress/nprogress.js"></script>
<!-- <script src="/assets/vendors/layer/layer.js"></script> -->
<div class="col-md-4">
<form>
  <div class="form-group">
    <label for="email">邮箱</label>
    <input id="email" class="form-control" name="email" type="email" placeholder="邮箱">
  </div>
  <div class="form-group">
    <label for="slug">别名</label>
    <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
  </div>
  <div class="form-group">
    <label for="nickname">昵称</label>
    <input id="nickname" class="form-control" name="nickname" type="text" placeholder="昵称">
  </div>
  <div class="form-group">
    <label for="password">密码</label>
    <input id="password" class="form-control" name="password" type="text" placeholder="密码">
  </div>
  <div class="form-group">
    <label for="password">状态</label>
    <input name="state" type="radio" value="激活">激活
    <input name="state" type="radio" value="禁用">禁用
  </div>
  <div class="form-group">
    <input class="btn btn-primary" type="button" value="添加">
  </div>
</form>
</div>

<script>
//点击事件
$('.btn-primary').click(function () {
    //事件函数
    //获取表单数据  formData
    var fm = $('form')[0];
    var fd = new FormData(fm);

    //发送Ajax请求
    $.ajax({
        url: './adduser_deal.php',
        data: fd,
        type: 'post',
        datatype: 'text',
        contentType: false,
        processData: false,
        success: function (data) {
      //console.log(data);
      if (data == 1) {
        //parnet是一个BOM对象
        parent.layer.alert('添加成功', function (i) {
          //当type=2时，获取弹出层索引的代码是固定的
          var index = parent.layer.getFrameIndex(window.name);
          parent.layer.close(index);
          parent.layer.close(i);
          //重载父页面
          parent.location.reload();
        });
        
      } else {
        parent.layer.alert('添加失败');
      }
    }
  })
})

</script>