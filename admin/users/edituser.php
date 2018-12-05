<link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
<link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
<link rel="stylesheet" href="/assets/css/admin.css">
<script src="/assets/vendors/jquery/jquery.js"></script>
<script src="/assets/vendors/nprogress/nprogress.js"></script>
<?php
//接收数据 admin_id
$id = $_GET['id'];
//拼接SQL语句
$sql = "select * from ali_admin where admin_id = $id";
//链接MySQL并执行SQL语句
include_once '../include/mysqli.php';
//这里由于是查询，单条语句用One
$admin_info = execSql($sql, 'One');
//将查询结果写入表单

?>

<div class="col-md-4">
<!-- 这里取消了 action 和method 使用FormData来接收，再用ajax来发送 -->
  <form>
    <h2>编辑新信息</h2>
    <div class="form-group">
      <label for="name">id</label>
      <input id="name" class="form-control" name="id" readonly type="text" value="<?php echo $admin_info['admin_id'] ?>">
    </div>
    <div class="form-group">
      <label for="slug">别名</label>
      <input id="slug" class="form-control" name="slug" type="text" value="<?php echo $admin_info['admin_slug'] ?>">
    </div>
    <div class="form-group">
      <label for="nickname">昵称</label>
      <input id="nickname" class="form-control" name="nickname" type="text" value="<?php echo $admin_info['admin_nickname'] ?>">
    </div>
    <div class="form-group">
      <label for="state">状态</label>
      <?php if ($admin_info['admin_state'] == 1) { ?>
      <input type="radio" name="state" value="1" checked>启用
      <input type="radio" name="state" value="2">禁用
      <?php } else { ?>
      <input type="radio" name="state" value="1">启用
      <input type="radio" name="state" value="2" checked>禁用
      <?php } ?>
    </div>
    
    <div class="form-group">
      <button class="btn btn-primary" type="button">添加</button>
    </div>
  </form>
</div>

<script>
  $('.btn-primary').click(function () {
    //获取表单数据
    var fm = $('form')[0];
    var fd = new FormData(fm);

    //发送ajax请求
    $.ajax({
      url: 'edituser_deal.php',
      data: fd,
      type: 'post',
      datatype: 'text',
      contentType: false,
      processData: false,
      success: function (data) {
        console.log(data);
        if (data == 1) {
          parent.layer.alert('修改成功',function (index) {
            var frame_index =  parent.layer.getFrameIndex(window.name);
            parent.layer.close(frame_index);
            parent.layer.close(index);
            parent.location.reload();
          });
        } else {
          layer.alert('修改失败');
        }
      }
    })
  })

</script>