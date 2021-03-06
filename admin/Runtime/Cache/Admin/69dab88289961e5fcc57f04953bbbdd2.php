<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>提示信息</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/easyui/themes/bootstrap/easyui.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/easyui/themes/icon.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/easyui/locale/easyui-lang-zh_CN.js"></script>
<style type="text/css">
a{color:#08c;text-decoration:none}
a:hover,a:focus{color:#005580;text-decoration:underline}
</style>
</head>
<body>
<div class="easyui-window" title="提示信息" style="width:380px;height:200px" data-options="iconCls:'icon-tip',modal:false,resizable:false,collapsible:false,minimizable:false,maximizable:false,closable:false">
<div style="font-size:18px;text-align:center;margin-top:40px">
	<?php if(isset($message)): ?><p class="success"><?php echo ($message); ?></p>
	<?php else: ?>
		<p class="error"><?php echo ($error); ?></p><?php endif; ?>
	<p style="font-size:12px">
		页面自动 <a id="href" href="<?php echo ($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo ($waitSecond); ?></b>
	</p>
</div>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>