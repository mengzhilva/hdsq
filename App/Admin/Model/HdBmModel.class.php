<?php 
namespace Admin\Model;
use Think\Model;
class HdBmModel extends Model {
	protected $tableName = 'tbClassRoomOrder';
	protected $tablePrefix = '';
	protected $connection = array( 
				'db_type'    =>   'sqlsrv',    
				'db_host'    =>   'localhost',    
				'db_user'    =>   'sa',    
				'db_pwd'     =>   'root',       
				'db_name'    =>    'SC_CMS_New', );
	
}

?>