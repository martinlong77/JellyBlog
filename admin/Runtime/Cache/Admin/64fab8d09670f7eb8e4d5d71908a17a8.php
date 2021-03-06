<?php if (!defined('THINK_PATH')) exit();?><!-- 日志列表 -->
<table id="HdList" class="easyui-datagrid" title="<?php echo ($currentpos); ?>" data-options="border:false,fit:true,fitColumns:true,rownumbers:true,singleSelect:true,url:'<?php echo U('Official/hd_list');?>',toolbar:HdToolbar,pagination:true">
<thead>
	<tr>
		<th data-options="field:'title',width:7,sortable:true">标题</th>
		<th data-options="field:'atype',width:2,sortable:true">类型</th>
		<th data-options="field:'akind',width:1,sortable:true">活动类型</th>
		<th data-options="field:'time',width:2,sortable:true">发布时间</th>
		<th data-options="field:'enrolled',width:1,sortable:true">报名人数</th>
		<th data-options="field:'payed_count',width:1,sortable:true">付款人数</th>
		<th data-options="field:'begin',width:2,sortable:true">开始时间</th>
		<th data-options="field:'end',width:2,sortable:true">结束时间</th>	
		<th data-options="field:'click',width:1,sortable:true">点击数</th>				
        <th data-options="field:'id',width:1,formatter:HdOperateText">管理操作</th>
	</tr>
</thead>
</table>
<div id="ArtToolbar" style="padding:5px;height:auto">
	<form id="ArtSearchForm">
		用户名: 
		<select name="search[username]" class="easyui-combobox" panelHeight="auto" style="width:100px">
			<option value="">全部用户</option>
			<?php if(is_array($adminList)): foreach($adminList as $key=>$admin): ?><option value="<?php echo ($admin["username"]); ?>"><?php echo ($admin["username"]); ?></option><?php endforeach; endif; ?>
		</select><a href="../Menu/list.html">list</a>
		模块: 
		<select name="search[module]" class="easyui-combobox" panelHeight="auto" style="width:100px">
			<option value="">所有模块</option>
			<?php if(is_array($moduleList)): foreach($moduleList as $key=>$module): ?><option value="<?php echo ($module["m"]); ?>"><?php echo ($module["m"]); ?></option><?php endforeach; endif; ?>
		</select>
		时 间: <input name="search[begin]" class="easyui-datebox" style="width:100px">
		至: <input name="search[end]" class="easyui-datebox" style="width:100px">
		
		<a href="javascript:;" onclick="ArtSearch();" class="easyui-linkbutton" iconCls="icon-search">搜索</a>
		<a href="javascript:;" onclick="ArtDelete();" class="easyui-linkbutton" iconCls="icon-no">删除一月前数据</a>
	</form>
</div>

<script type="text/javascript">
//参数格式化
/*
function ArtView(val){
	var id = '<?php echo U('Content/article_add');?>';
	var tit = '我是标题你是谁';
	return '<a href="javascript:;" onclick="openUrl(id,tit,0);">'+id+'</a>';
}

//搜索日志
function ArtSearch(){
	var queryParams = $('#ArtList').datagrid('options').queryParams;
	$.each($("#ArtSearchForm").form().serializeArray(), function (index) {
		queryParams[this['name']] = this['value'];
	});
	$('#ArtList').datagrid('reload');
}*/
//工具栏
var HdToolbar = [
	{ text: '添加', iconCls: 'icon-add', handler: HdAdd },
	{ text: '刷新', iconCls: 'icon-reload', handler: HdReload }
];

//生成操作内容
function HdOperateText(val){
	var btn = [];
	btn.push('<a href="javascript:void(0);" onclick="HdEdit('+val+')">编辑</a>');
	btn.push('<a href="javascript:void(0);" onclick="HdDelete('+val+')">删除</a>');
	return btn.join(' | ');
}

//添加
function HdAdd(){
	add = $('#pagetabs').tabs('exists','添加活动'); 
	edit = $('#pagetabs').tabs('exists','修改活动');  			
	if(add || edit){ 
	 $('#pagetabs').tabs('close', '添加活动');
	 $('#pagetabs').tabs('close', '修改活动');
	} 
	 openUrl("<?php echo U('Official/hd_operate?type=gh');?>", '添加活动', 0);
}

function HdEdit(id){	
	add = $('#pagetabs').tabs('exists','添加活动'); 
	edit = $('#pagetabs').tabs('exists','修改活动');  			
	if(add || edit){ 
	 $('#pagetabs').tabs('close', '添加活动');
	 $('#pagetabs').tabs('close', '修改活动');
	} 
	
	var url = "<?php echo U('Official/hd_operate?type=gh');?>";
	url += url.indexOf('?') != -1 ? '&id='+id : '?id='+id;
	openUrl(url, '修改活动', 0);
}

//删除菜单
function HdDelete(id){
	$.messager.confirm('提示信息', '确定要删除吗？', function(result){
		if(!result) return false;
		$.post("<?php echo U('Official/del');?>", {id: id}, function(data){
			data.status ? openUrl("<?php echo U('Official/hd_list');?>", '活动列表', 0) : $.messager.alert('提示信息', data.info, 'error');		

		}, 'json');
	});
}
//刷新
function HdReload(){
	$('#HdList').datagrid('reload');
}
</script>