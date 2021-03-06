<?php
class GroupModel extends Model {
	Protected $_map = array(
	 'name' => 'group_name',
	 'cg_id' => 'group_id',
	);

	protected $_validate = array(
	 array('group_name','water','请输入分组名称',0,'callback'),
	);

	//防灌水
  	Protected function water($st) {
    	//验证用户是否胡乱输入空格回车灌水
    	$str = trim($st);// 首先去掉头尾空格
    	$str = preg_replace('/\s(?=\s)/', '', $str);// 接着去掉两个空格以上的
    	$str = preg_replace('/[\n\r\t]/', ' ', $str); //最后将非空格替换为一个空格

    	if (!empty($str)) {
    		return true;
    	} else {
    		return false;
    	}	
  	}
}