<?php if (!defined('THINK_PATH')) exit();?><!-- 管理员列表 -->
<table id="adminRoleList" class="easyui-datagrid" title="<?php echo ($currentpos); ?>" data-options="border:false,fit:true,fitColumns:true,rownumbers:true,singleSelect:true,url:'<?php echo U('Admin/roleList');?>',toolbar:adminRoleToolbar,">
<thead>
	<tr>
		<th data-options="field:'id_order',width:5,align:'center',formatter:adminRoleOrderText">排序</th>
		<th data-options="field:'roleid',width:5,align:'center',sortable:true">ID</th>
		<th data-options="field:'rolename',width:15,sortable:true">角色名称</th>
		<th data-options="field:'description',width:25">角色描述</th>
		<th data-options="field:'disabled',width:10,sortable:true,formatter:adminRoleStateText">状态</th>
		<th data-options="field:'id',width:15,formatter:adminRoleOperateText">管理操作</th>
	</tr>
</thead>
</table>

<!-- 权限设置 -->
<div id="adminRoleSetBox" class="easyui-dialog" title="权限设置" data-options="modal:true,closed:true,iconCls:'icon-edit',buttons:[{text:'确定',iconCls:'icon-ok',handler:function(){$('#adminRoleSetForm').submit();}},{text:'取消',iconCls:'icon-cancel',handler:function(){$('#adminRoleSetBox').dialog('close');}}]" style="width:400px;height:300px;"></div>

<!-- 添加角色 -->
<div id="adminRoleAddBox" class="easyui-dialog" title="添加角色" data-options="modal:true,closed:true,iconCls:'icon-add',buttons:[{text:'确定',iconCls:'icon-ok',handler:function(){$('#adminRoleAddForm').submit();}},{text:'取消',iconCls:'icon-cancel',handler:function(){$('#adminRoleAddBox').dialog('close');}}]" style="width:480px;height:300px;"></div>

<!-- 编辑角色 -->
<div id="adminRoleEditBox" class="easyui-dialog" title="编辑角色" data-options="modal:true,closed:true,iconCls:'icon-edit',buttons:[{text:'确定',iconCls:'icon-ok',handler:function(){$('#adminRoleEditForm').submit();}},{text:'取消',iconCls:'icon-cancel',handler:function(){$('#adminRoleEditBox').dialog('close');}}]" style="width:480px;height:300px;"></div>

<script type="text/javascript">
//工具栏
var adminRoleToolbar = [
	{ text: '添加角色', iconCls: 'icon-add', handler: adminRoleAdd },
	{ text: '刷新', iconCls: 'icon-reload', handler: adminRoleReload },
	{ text: '排序', iconCls: 'icon-edit', handler: adminRoleOrder }
];
//生成排序内容
function adminRoleOrderText(val){
	var arr = val.split('_');
	return '<input class="adminRoleOrder" type="text" name="order['+arr[0]+']" value="'+arr[1]+'" size="2" style="text-align:center" />';
}
//生成状态内容
function adminRoleStateText(val){
	return val == 1 ? '<font color="red">未启用</font>' : '已启用';
}
//生成操作内容
function adminRoleOperateText(val){
	var btn = [];
	if(val == 1){
		btn.push('权限设置');
		btn.push('编辑');
		btn.push('删除');
	}else{
		btn.push('<a href="javascript:void(0);" onclick="adminRoleSet('+val+')">权限设置</a>');
		btn.push('<a href="javascript:void(0);" onclick="adminRoleEdit('+val+')">编辑</a>');
		btn.push('<a href="javascript:void(0);" onclick="adminRoleDelete('+val+')">删除</a>');
	}
	return btn.join(' | ');
}
//排序
function adminRoleOrder(){
	$.post('<?php echo U('Admin/roleOrder');?>', $(".adminRoleOrder").serialize(), function(data){
		if(!data.status){
			$.messager.alert('提示信息', data.info, 'error');
		}else{
			$.messager.alert('提示信息', data.info, 'info');
			adminRoleReload();
		}
	}, 'json');
}
//添加
function adminRoleAdd(){
	$('#adminRoleAddBox').dialog({href:'<?php echo U('Admin/roleAdd');?>'});
	$('#adminRoleAddBox').dialog('open');
}
//编辑
function adminRoleEdit(id){
	if(typeof(id) !== 'number'){
		$.messager.alert('提示信息', '未选择角色', 'error');
		return false;
	}
	var url = '<?php echo U('Admin/roleEdit');?>';
	url += url.indexOf('?') != -1 ? '&id='+id : '?id='+id;
	$('#adminRoleEditBox').dialog({href:url});
	$('#adminRoleEditBox').dialog('open');
}
//删除
function adminRoleDelete(id){
	if(typeof(id) !== 'number'){
		$.messager.alert('提示信息', '未选择角色', 'error');
		return false;
	}
	$.messager.confirm('提示信息', '确定要删除吗？', function(result){
		if(!result) return false;
		$.post('<?php echo U('admin/roleDelete');?>', {id: id}, function(data){
			if(!data.status){
				$.messager.alert('提示信息', data.info, 'error');
			}else{
				adminRoleReload();
				$.messager.alert('提示信息', data.info, 'info');
			}
		}, 'json');
	});
}
//刷新
function adminRoleReload(){
	$('#adminRoleList').datagrid('reload');
}
//权限管理
function adminRoleSet(id){
	if(typeof(id) !== 'number'){
		$.messager.alert('提示信息', '未选择角色', 'error');
		return false;
	}
	var url = '<?php echo U('Admin/roleSet');?>';
	url += url.indexOf('?') != -1 ? '&id='+id : '?id='+id;
	$('#adminRoleSetBox').dialog({href: url});
	$('#adminRoleSetBox').dialog('open');
}
</script>