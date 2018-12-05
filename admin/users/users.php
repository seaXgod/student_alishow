<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Users &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/jquery/jquery.js"></script>
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
     <h1>用户</h1>
     <input id='btnl' type='button' value='添加管理员'>
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
                <th class="text-center" width="80">头像</th>
                <th>邮箱</th>
                <th>别名</th>
                <th>昵称</th>
                <th>状态</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
              <!-- 模板 -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php' ?>
  </div>
  
  
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="/assets/vendors/jquery/template-web.js"></script>
  <script src="/assets/vendors/layer/layer.js"></script>

  <script type="text/template" id = "admin_list">
  <!-- //定义模板 -->
  <!-- 注意这里的 users 是ajax请求回来数据库里的data 数组 -->
    {{each users value}}
    <tr>
      <td class="text-center"><input type="checkbox"></td>
      <td class="text-center"><img class="avatar" src="/assets/img/default.png"></td>
      <td>{{value.admin_email}}</td>
      <td>{{value.admin_slug}}</td>
      <td>{{value.admin_nickname}}</td>
      <td>{{value.admin_state}}</td>

      <td class="text-center">
        <a href="javascript:;" data="{{value.admin_id}}" class="btn edit btn-default btn-xs">编辑</a>
        <a href="javascript:;" data="{{value.admin_id}}" class="btn del btn-danger btn-xs">删除</a>
        
      </td>
    </tr>
    {{/each}}

    
  </script>



  
  <script>
  //加载数据库里所有的项 --- 把模板里设置的数据和data调用出来的数组拼接在一起
    //在页面载入时发送ajax请求
    $.post('getAdminList.php',function (data) {
      // console.log(data)
      //包装 ---> 这里注意一下，这里所用的users 是为了填模板里的 循环数组，
      // 用对象的方式接收，
      var obj = {"users": data};
      var tbodyStr = template('admin_list',obj);
      $('tbody').html(tbodyStr);
      //这里的json 是把后台的字符串转成数组



    },'json');





    // <!-- 给 新建管理员 按钮注册点击事件 -->
    $('#btnl').click(function () {
      layer.ready(function () {
        layer.open({
          type: 2,
          title: '添加管理员',
          area: ['800px','450px'],
          content: './addusers.php',
        });
      })
    })
    
    //删除按钮
    //要用事件委托来绑定事件
    $('tbody').on('click','.del',function () {
      //注意：将当前删除按钮转存
      var _this = $(this);
      layer.confirm('您确定要删除该管理员吗？',function () {
      //1.获取admin_id
      var admin_id = _this.attr('data');
      //2.发送ajax请求
      $.get('deluser.php', {id:admin_id, a:Math.random()}, function (data) {
        console.log(data);
        if (data == 1) {
          layer.msg('删除成功');
          _this.parent().parent().remove();
        } else {
          layer.alert('删除失败');
        }
      });
      })
    })

    //编辑按钮
    //事件委托绑定事件
    $('tbody').on('click','.edit',function () {
      //获取admin_id
      var admin_id = $(this).attr('data');
      //弹出层
      layer.ready(function () {
        layer.open({
          type: 2,
          title: '修改管理员信息',
          area: ['800px','500px'],
          //注意这个ID 它是作为发送的值和后端接收到的值
          content: './edituser.php?id=' + admin_id,
        });
      });
    })
    </script>

  <script>NProgress.done()</script>
</body>
</html>
