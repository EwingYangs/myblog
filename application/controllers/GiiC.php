<?php 
class GiiC extends CI_Controller{
	public function gii(){
		$this->load->view('gii');
	}

	public function make(){
		//获取表名
		$tableName = $this->input->post('table_name');
		//去掉前缀的名称
		$name = ucfirst(str_replace('b39_', '', $tableName));
		//构造控制器名还有模型名
		$cName = $name.'C';
		$mName = $name.'M';
		//获取表中的字段信息
		$fields = $this->db->query("show full fields from $tableName");
		$fields = $fields->result('array');
		//根据字段构造表单的验证规则
		$rules = array();
		foreach ($fields as $key => $value) {
			//如果是id字段就跳过
			if($value['Field'] == 'id'){
				continue;
			}
			//如果是not null 并且 没有default值得话就构造验证规则
			if($value['Null'] == 'NO' && $value['Default'] === null){
				$rules[] = '$this->form_validation->set_rules(\''.$value['Field'].'\', \''.$value['Comment'].'\', \'required\');';
			}
		}
		//*********************************生成控制器**********************************
		//开启缓冲区
		ob_start();
		//引入模板文件
		include './application/controllers/Gii_template/controller.php';
		//获取缓冲区的内容并清空缓冲区
		$str = ob_get_clean();
		//生成模板文件
		file_put_contents('./application/controllers/admin/'.$cName.'.php', "<?php\r\n".$str);
		//*********************************生成模型*************************************
		//开启缓冲区
		ob_start();
		//引入模板文件
		include './application/controllers/Gii_template/model.php';
		//获取缓冲区的内容并清空缓冲区
		$str = ob_get_clean();
		//生成模板文件
		file_put_contents('./application/models/'.$mName.'.php', "<?php\r\n".$str);


		//*********************************生成模板文件*************************************
		//先创建一个和控制器对应的目录
		$dir = './application/views/admin/'.$cName;
		if(!is_dir($dir)){
			mkdir($dir,0777,true);//第三个参数true可以运行在php的安全模式下
		}

		//生成add.php
		ob_start();
		//引入模板文件
		include './application/controllers/Gii_template/add.php';
		//获取缓冲区的内容并清空缓冲区
		$str = ob_get_clean();
		//生成模板文件
		file_put_contents($dir.'/add.php', $str);

		//生成lst.php
		ob_start();
		//引入模板文件
		include './application/controllers/Gii_template/lst.php';
		//获取缓冲区的内容并清空缓冲区
		$str = ob_get_clean();
		//生成模板文件
		file_put_contents($dir.'/lst.php', $str);


		//生成save.php
		ob_start();
		//引入模板文件
		include './application/controllers/Gii_template/save.php';
		//获取缓冲区的内容并清空缓冲区
		$str = ob_get_clean();
		//生成模板文件
		file_put_contents($dir.'/save.php', $str);
	}
}