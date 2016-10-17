<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户完善信息</title>
    
</head>
<body>

  <!-- 用户完善信息的表单 -->
  <form action="<?php echo site_url('Admin/User/addUser'); ?>" method="POST">
      体重：<input type="text" name="weight">kg
      <br />
      身高：<input type="text" name="height">cm
      <br />
      场位：<select name="position">
                   <option value="1">控球后卫PG</option>
                   <option value="2">得分后卫SG</option>>
                   <option value="3">小前锋SF</option>>
                   <option value="4">大前锋PF</option>>
                   <option value="5">中锋C</option>>
               </select>
       <br />
       <input type="submit" value="提交">
  </form>

</body>
</html>