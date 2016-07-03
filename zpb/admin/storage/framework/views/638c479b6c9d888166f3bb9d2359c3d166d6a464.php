<html>
<head>
<style>
	ul li{ list-style-type:none; }
	.pagination li{
		float: left;
		margin-left: 10px;
	}
</style>
</head>
    <body>
    <input type="text" name="sea" id="" ><input type="button" value="搜索">
        <div class="container">
            <?php echo $__env->yieldContent('content'); ?>
            <table border="1"> 
    		<tr>
    			<th>id</th>
    			<th>用户名</th>
    			<th>密码</th>
    		</tr>
            <?php foreach($users as $user): ?>
    		<tr>
    			<td><?php echo e($user->id); ?></td>
    			<td><?php echo e($user->username); ?></td>
    			<td><?php echo e($user->password); ?></td>
    		</tr>
			<?php endforeach; ?>
			<tr>
				<td><?php echo e($users->render()); ?></td>
			</tr>
            </table>
        </div>
    </body>
    <script type="text/javascript" src='../../public/js/jquery.js'></script>
    <script type="text/javascript">
    $(function(){
    	alert(1)
    })
    </script>
</html>