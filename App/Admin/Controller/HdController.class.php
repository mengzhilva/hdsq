<?php
namespace Admin\Controller;
use Think\Controller;
// +----------------------------------------------------------------------
// | * 文件名称：活动管理控制器
// +----------------------------------------------------------------------
// | * 开发人员：吕定国
// +----------------------------------------------------------------------
// | * 开发时间：2014年12月19日
// +----------------------------------------------------------------------
// | * 修改时间：2015年1月12日
// +----------------------------------------------------------------------

class HdController extends CommonController {

        private $hd;
        private $citylevel;

        public function __construct() {
                parent::__construct();
                $this->hd = M('tbclassroom');
                $this->citylevel = $_SESSION['scadminuser']['cid'];

                $city = M('city')->where('id in (' . $this->citylevel . ')')->select();
                $this->assign('city', $city);
        }

        public function index() {

                $this->checkLevel(67);
                //列表过滤器，生成查询Map对象.
                $where = '';
                //$map = $this->_search();
                if (method_exists($this, '_filter')) {
                        $where = $this->_filter();
                }
                //var_dump($where);exit;
                $model = $this->hd;
                //判断采用自定义的Model类
                if (!empty($model)) {
                        $this->_list($model, $where);
                }
                $this->display('index');
        }

        //封装搜素条件,自动调用的方法
        public function _filter() {
                $where['_string'] = 'CityID in (' . $this->citylevel . ')';
                //搜索条件有值则做封装
                if (!empty($_REQUEST['keyword'])) {
                        $where['Title'] = array('like', "%{$_REQUEST['keyword']}%");
                }
                if (!empty($_REQUEST['CityID'])) {
                        $where['CityID'] = $_REQUEST['CityID'];
                }
                if ($_REQUEST['status'] != '') {
                        $where['Status'] = $_REQUEST['status'];
                }
                if ($_REQUEST['Ism'] != '') {
                        $where['Ism'] = array('like', "%{$_REQUEST['Ism']}%");
                }

                return $where;
        }

        public function edit() {
                $this->checkLevel(69);
                $id = I('get.id', 0);
                //var_dump($id);
                $info = $this->hd->query("select *, EndTime as endtimes,UpdateTime as UpdateTimes  from tbclassroom where ID=" . $id);
                 //var_dump(M()->getlastsql());exit;
                $this->assign('vo', $info[0]);
                $this->display("edit");
        }

        public function update() {
                $this->checkLevel(69);
                $id = I('post.id', 0);
                //var_dump($id);
                // 实例化User对象// 要修改的数据对象属性赋值
                $data['Title'] = I('post.Title', '');
                $data['LinkUrl'] = I('post.url', '');
                $data['CityID'] = I('post.CityID', 0);
                $city = M('city')->where('ID=' . $data['CityID'])->select();
                $data['CityName'] = $city[0]['NAME'];
                $data['EndTime'] = I('post.EndTime', 0);
                $data['starttime'] = I('post.starttime');
                $data['address'] = I('post.address');
                $data['istopbaoming'] = I('post.istopbaoming', 0, 'intval');
                $data['isbottom'] = I('post.isbottom', 0, 'intval');
                if (empty($data['EndTime']))
                        $data['EndTime'] = 0;
                $data['UpdateTime'] = date('Y-m-d H:i:s');
                $data['background'] = I('post.background', 0);
                $data['phonecontent'] = I('post.phonecontent', 0);
                $data['Status'] = 0;
                $data['Ism'] = I('post.Ism', 0);
                $data['Isleft'] = I('post.Isleft', 0);
                $data['hdld'] = I('post.hdld', 0);
                $data['backgroundcolor'] = I('post.backgroundcolor', 0);
                //var_dump($data);
                $imags = "http://" . $_SERVER['HTTP_HOST'] . $data['background'];//str_replace('/web_manage/','',$data['background']);
                //var_dump($imags);
                $img = getimagesize($imags);
                
                $data['width'] = $img[0];
                $data['height'] = $img[1];
                $num = $this->catimg($imags,$id);
                $data['qiegenum'] = $num;
                
                //var_dump($img);exit;
                $res = $this->hd->where('id=' . $id)->save($data); // 根据条件更新记录
                $this->success('保存成功！');
        }
        function catimg($filename,$id){

        	$ext = strrchr($filename,'.');
        	$p = 20;
        	// Get new sizes
        	list($width, $height) = getimagesize($filename);
        	$newwidth = $width;
        	$newheight = floor($height / $p);
        	$last = $height % $p;
        	// Load
        	//var_dump($ext);exit;
        	if($ext == '.png'){

        		$source = imagecreatefrompng($filename);
        	}else{
	        	$source = imagecreatefromjpeg($filename);
        	}
	        	for( $i=0 ; $i< $p; $i++ ){
	        		$_p = $newheight*$i;
	        		if( ( $i + 1 ) == $p )
	        			$newheight += $last;
	        		$thumb = ImageCreateTrueColor($newwidth, $newheight);
	        		imagecopyresized( $thumb, $source, 0, 0, 0, $_p, $newwidth,  $height, $width, $height);
	        		$res = imagejpeg( $thumb , "./Public/Uploads/hd/t{$id}{$i}.jpg" ,100);
	        		
	        	}
        	return $i;
        }

        public function add() {
                $this->checkLevel(68);
                $this->display("add");
        }

        public function insert() {
                $this->checkLevel(68);

                $data['Title'] = I('post.Title', '');
                $data['CityID'] = I('post.CityID', 0);
                $city = M('city')->where('ID=' . $data['CityID'])->select();
                $data['CityName'] = $city[0]['NAME'];
                $data['LinkUrl'] = I('post.url', '');
                $data['phonecontent'] = I('post.phonecontent', 0);
                $data['Ism'] = I('post.Ism', 0);
                $data['Isleft'] = I('post.Isleft', 0);
                $data['hdld'] = I('post.hdld', 0);

                $data['EndTime'] = I('post.EndTime', 0);
                $data['UpdateTime'] = date('Y-m-d H:i:s');
                $data['Status'] = 0;
                $data['background'] = I('post.background', 0);
                $data['backgroundcolor'] = I('post.backgroundcolor', 0);
                $data['starttime'] = I('post.starttime');
                $data['address'] = I('post.address');
                $data['istopbaoming'] = I('post.istopbaoming', 0, 'intval');
                $data['isbottom'] = I('post.isbottom', 0, 'intval');

                $imags = "http://" . $_SERVER['HTTP_HOST'] . $data['background'];//str_replace('/web_manage/','',$data['background']);
                if (empty($data['EndTime']))
                        $data['EndTime'] = 0;
                $img = getimagesize($imags);
                $data['width'] = $img[0];
                $data['height'] = $img[1];
                
                $id = $this->hd->add($data); // 根据条件更新记录
                
                $num = $this->catimg($imags,$id);
                $datass['qiegenum'] = $num;
                
                //var_dump($img);exit;
                $res = $this->hd->where('id=' . $id)->save($datass); // 根据条件更新记录
                
                if ($id) {//插入20个报名
                        $us = M('tbclassroomorder')->order('id desc')->limit(20)->select();
                        $namearr = array(0 => '王先生', 1 => '丁先生', 2 => '张先生', 3 => '夏先生', 4 => '林先生', 5 => '马先生', 6 => '高先生', 7 => '田先生', 8 => '黄先生', 9 => '刘先生', 10 => '韩先生', 11 => '杜先生', 12 => '李先生', 13 => '赵先生', 14 => '姚先生', 15 => '周先生', 16 => '华先生', 17 => '倪先生', 18 => '胡先生', 19 => '贾先生');
                        foreach ($us as $k => $v) {
                                $datas['ClassRoomID'] = $id;
                                $datas['ClassRoomName'] = $data['Title'];
                                $datas['UserName'] = $namearr[$k];
                                $datas['TelePhone'] = 15110000000;
                                $datas['UpdateTime'] = date('Y-m-d H:i:s');
                                $datas['Sex'] = $v['Sex'];
                                $datas['PromoterName'] = $v['PromoterName'];
                                $datas['CityID'] = 1;
                                $datas['CityName'] = '北京';
                                $datas['Dealstate'] = -1;
                                M('tbclassroomorder')->add($datas);
                        }
                }
                //var_dump($this->hd->getLastSql());
                $this->success('保存成功！');
        }

        public function del() {
                $this->checkLevel(70);

                $id = I('get.id', 0);
                $res1 = $this->hd->delete($id);
                $info = $this->hd->query("delete from tbclassroomchajian where hdID=" . $id);
                if ($res1) {
                        $this->success('删除成功！');
                } else {
                        $this->error('删除失败了！');
                }
        }

        public function check() {
                $this->checkLevel(71);

                $id = I('get.id', 0);
                //var_dump($id);
                $info = $this->hd->query("select *  from tbclassroom where ID=" . $id);
                //var_dump($info);
                $this->assign('vo', $info[0]);
                $this->display("check");
        }

        public function audit() {
                $this->checkLevel(71);
                (!$_REQUEST['ids'] || !$_GET['type']) && $this->error(L('缺少必要的参数！'));
                $id = explode(',', $_REQUEST['ids']);
                $type = $_GET['type'] == 'y' ? 1 : -1;
                $news = M('tbclassroom');
                $data['Status'] = $type;
                foreach ($id AS $k => $v) {
                        $where['ID'] = $v;
                        $news->where($where)->save($data);
                }
                $this->success(L('更新成功'));
        }

        function updatecheck() {
                $this->checkLevel(71);

                $id = I('post.id', 0);
                //var_dump($id);
                // 实例化User对象// 要修改的数据对象属性赋值
                $data['Status'] = I('post.STATUS', '');
                $data['StatusDescription'] = I('post.STATUSDESCRIPTION', 0);
                //var_dump($data);exit;
                $this->hd->where('id=' . $id)->save($data); // 根据条件更新记录

                $this->success('保存成功！');
        }

        function checkbm() {
                $id = I('get.id', 0);
                $action = I('post.action', '');
                $m = M('tbclassroomorder');
                if ($action == 'check') {
                        $id = I('post.ID', 0);
                        $data['Dealstate'] = 1;
                        $m->where('ID=' . $id)->save($data);
                        $this->success('保存成功！');
                } else {
                        $info = $m->where('Id=' . $id)->select();
                        $this->assign('info', $info[0]);
                        $this->display("checkbm");
                }
        }

        public function editDisplay() {
                $id = I('get.id', 0);
                //var_dump($id);
                $info = $this->hd->query("select *  from tbclassroom where ID=" . $id);
                //var_dump($info);

                $chajians = $this->hd->query("select a.*,b.*,a.id as rhcid from tbclassroomChajian as a left join tbClassChajian as b on a.chajianID=b.id  where a.hdID=" . $id);
                $chajianss = array();
                foreach ($chajians as $k => $v) {
                        $v['tops'] = str_replace('px', '', $v['tops']);
                        $v['tops'] = ($v['tops'] - 20) . 'px';

                        $chajianss[$k] = $v;
                }
                $chajian = $this->hd->query("select * from tbClassChajian where ism=0");

                $this->assign('list', $info[0]);
                $this->assign('id', $id);
                $this->assign('chajians', $chajianss);
                $this->assign('chajian', $chajian);
                $this->display("editDisplay");
        }

        public function meditDisplay() {
                $id = I('get.id', 0);
                //var_dump($id);
                $info = $this->hd->query("select *  from tbclassroom where ID=" . $id);
                //var_dump($info);

                $chajians = $this->hd->query("select a.*,b.*,a.id as rhcid from tbclassroomChajian as a left join tbClassChajian as b on a.chajianID=b.id  where a.hdID=" . $id);
                $chajianss = array();
                foreach ($chajians as $k => $v) {
                        $v['tops'] = str_replace('px', '', $v['tops']);
                        $v['tops'] = ($v['tops'] - 20) . 'px';

                        $chajianss[$k] = $v;
                }
                $chajian = $this->hd->query("select * from tbClassChajian where ism=1");
                if($info[0]['Ism']){
                	if($info[0]['width'] !='640px'){
                		$info[0]['height'] = 640*str_replace('px','',$info[0]['height'])/str_replace('px','',$info[0]['width']).'px';
                		$info[0]['width'] = '640';
                	}
                }
                $this->assign('list', $info[0]);
                $this->assign('id', $id);
                $this->assign('chajians', $chajianss);
                $this->assign('chajian', $chajian);
                $this->display("editDisplay");
        }

        public function displayedit() {

                $id = I('post.id', 0);
                $str = I('post.str', 0);
                $chaj = explode('-', $str);
                $chajian = array();
                $rhcids = array();
                foreach ($chaj as $k => $v) {
                        $val = explode(',', $v);
                        if ($val[5] != 0) {
                                $rhcids[] = $val[5];
                        }
                }
                $rhcidss = implode(',', $rhcids);
                if (!empty($rhcids)) {
                        $sql = "delete from tbclassroomChajian where hdID=" . $id . " and id not in (" . $rhcidss . ")";
                } else {
                        $sql = "delete from tbclassroomChajian where hdID=" . $id;
                }

                M('tbclassroom')->where('ID=' . $id)->save(array('Status' => '0'));

                //echo $sql;exit;
                $this->hd->query($sql);
                //var_dump($chaj);
                foreach ($chaj as $k => $v) {
                        $val = explode(',', $v);
                        $top = $val[1];
                        $left = $val[0];
                        $width = $val[2];
                        $height = $val[3];
                        $chajianid = $val[4];
                        $rhcid = $val[5];
                        $style = "0";
                        $top = str_replace('px', '', $top);
                        $top = ($top + 20) . 'px';
                        //echo $rhcid;
                        if ($rhcid == 0) {
                                $insertsql = "insert into tbclassroomChajian  (hdID,tops,lefts,width,height,style,chajianID) values (";
                                $insertsql = $insertsql . "$id,";
                                $insertsql = $insertsql . "'$top',";
                                $insertsql = $insertsql . "'$left',";
                                $insertsql = $insertsql . "'$width',";
                                $insertsql = $insertsql . "'$height',";
                                $insertsql = $insertsql . "'$style',";
                                $insertsql = $insertsql . "'$chajianid')";
                                //var_dump($insertsql);
                                $this->hd->query($insertsql);

                                if ($chajianid == 6 || $chajianid == 16) {
                                        $max = $this->hd->query("select id from tbclassroomChajian order by id desc");
                                        $maxid = $max[0]['id'];
                                        $mid = $maxid + 1;
                                        $this->hd->query("update tbclassroomChajian set url=" . $mid . " where id=" . $maxid);
                                }
                        } else {
                                $insertsql = "update tbclassroomChajian set ";
                                $insertsql = $insertsql . "tops = '$top',";
                                $insertsql = $insertsql . "lefts = '$left',";
                                $insertsql = $insertsql . "width = '$width',";
                                $insertsql = $insertsql . "height = '$height',";
                                $insertsql = $insertsql . "style = '$style',";
                                $insertsql = $insertsql . "chajianID = '$chajianid'";
                                $insertsql = $insertsql . " where id=$rhcid";

                                //var_dump($insertsql);
                                $this->hd->query($insertsql);
                        }
                }

                //echo $insertsql;
                echo '操作成功';
        }

        public function upindex() {
                $this->display();
        }

        /*
         * 图片上传
         */

        public function doUpload() {

                $type = I('post.type', '');//获取上传图片属性 qq,weixin,image
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize = 3145728;// 设置附件上传大小
                $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath = './Public/Uploads/hd/'; // 设置附件上传目录
                $upload->autoSub = false; //关闭自动生成子目录
                // 上传文件
                $info = $upload->upload();
                //准备响应信息
                $res = array("err" => "", "msg" => "");
                $res['state'] = 0;

                //var_dump($info);exit;
                if (!$info) {
                        // 上传错误提示错误信息
                        $res['err'] = "上传失败：原因:" . $upload->getError();
                } else {
                        foreach ($info as $upfile) {
                                // 上传成功
                                $res['msg'] = __ROOT__ . "/Public/Uploads/hd/" . $upfile['savename'];
                                $res['state'] = 200;
                                $res['type'] = $type;
                        }
                }
                //var_dump($res);exit;
                // 将数据以ajax返回
                $this->ajaxReturn($res);
        }

        public function get_chajian() {

                $id = I('post.id', 0);
                $tops = I('post.top', 0);
                $tops = ($tops + 100) . 'px';
                $top = "top:" . $tops;
                //var_dump("select * from tbClassChajian where id = $id");exit;
                $results = $this->hd->query("select * from tbClassChajian where id = $id");
                //var_dump($results);exit;
                $html = str_replace('top: 150px', $top, $results[0]['html']);
                echo $html;
        }

        public function chajianlist() {
                $this->checkLevel(76);
                $cid = I('post.CityID', 0);
                $name = I('post.keyword', 0);

                $addsql = "where 1=1 ";//and CityID in ($level_cid)
                if ($cid != "") {
                        if ($cid == "0") {
                                $addsql = $addsql . " and c.CityID is null ";
                        } else {
                                $addsql = $addsql . " and c.CityID = $cid ";
                        }
                }
                if ($name != "") {
                        $addsql = $addsql . " and c.Title like '%$name%' ";
                }


                $ssql = "select ";
                $itemsql = "*";
                $esql = "from tbclassroomChajian as a left join  tbClassChajian as b on a.chajianID=b.id left join tbclassroom as c on c.id=a.hdID";

                $total = $this->hd->query("$ssql count(*) as nums $esql $addsql");

                $total = $total[0]['nums'];
                $count = $total;
                //每页显示的记录数
                if (!empty($_REQUEST['numPerPage'])) {
                        $listRows = $_REQUEST['numPerPage'];
                } else {
                        $listRows = '20';
                }
                //设置当前页码
                if (!empty($_REQUEST['pageNum'])) {
                        $nowPage = $_REQUEST['pageNum'];
                } else {
                        $nowPage = 1;
                }
                $_GET['p'] = $nowPage;

                //创建分页对象
                $p = new \Think\Page($count, $listRows);


                //分页查询数据

                $itemsql = "select a.*,b.*,c.*,a.id as chid,b.id as cjid ,a.url as curl ";
                $esql = " from tbclassroomChajian as a left join  tbClassChajian as b on a.chajianID=b.id left join tbclassroom as c on c.id=a.hdID  ";
                $pagesql = " ";
                $osql = " order by a.id desc";
                $limit = "limit $p->firstRow,$p->listRows";
                //echo "$ssql $itemsql $esql $addsql $pagesql $osql ";
                $list = $this->hd->query(" $itemsql $esql $addsql $pagesql $osql $limit");

                //分页跳转的时候保证查询条件
                foreach ($map as $key => $val) {
                        if (!is_array($val)) {
                                $p->parameter .= "$key=" . urlencode($val) . "&";
                        }
                }

                //分页显示
                $page = $p->show();

                //列表排序显示
                $sortImg = $sort;                                 //排序图标
                $sortAlt = $sort == 'desc' ? '升序排列' : '倒序排列';   //排序提示
                $sort = $sort == 'desc' ? 1 : 0;                  //排序方式
                //var_dump($list);

                $city = M('city')->select();
                //var_dump($info);
                $this->assign('city', $city);
                //模板赋值显示
                $this->assign('list', $list);
                $this->assign('sort', $sort);
                $this->assign('order', $order);
                $this->assign('sortImg', $sortImg);
                $this->assign('sortType', $sortAlt);
                $this->assign("page", $page);

                $this->assign("search", $search);   //搜索类型
                $this->assign("values", $_POST['values']); //搜索输入框内容
                $this->assign("totalCount", $count);   //总条数
                $this->assign("numPerPage", $p->listRows);  //每页显多少条
                $this->assign("currentPage", $nowPage);   //当前页码
                $this->display("chajianlist");
        }

        public function chajianedit() {
                $this->checkLevel(77);

                $id = I('get.id', 0);
                $info = $this->hd->query("select a.*,b.*,c.*,a.id as chid,a.width as hwidth,a.height as hheight,a.url as curl,b.id as cjid from tbclassroomChajian as a left join  tbClassChajian as b on a.chajianID=b.id left join tbclassroom as c on c.id=a.hdID where a.id = $id");

                $this->assign('vo', $info[0]);
                $this->display("chajianedit");
        }

        public function chajianupdate() {
                $this->checkLevel(77);

                $id = I('post.id', 0);
                $image = I('post.image', '');
                $background = I('post.backgroundimg', 0);
                $color = I('post.color', '');
                $name = I('post.name', 0);
                $url = I('post.url', '');
                $width = I('post.width', 0);
                $height = I('post.height', 0);
                $caseid = I('post.caseid', 0);
                $font = I('post.font_size', 0);
                $hid = M('tbclassroomchajian')->where('ID=' . $id)->getField('hdID');
                M('tbclassroom')->where('ID=' . $hid)->save(array('Status' => '0'));

                $insertsql = "update tbclassroomChajian set ";
                //$insertsql = $insertsql . "name = '$name',";
                $insertsql = $insertsql . "url = '$url',";
                $insertsql = $insertsql . "image = '$image',";
                $insertsql = $insertsql . "backgroundimg = '$background',";
                if ($width != 0) {
                        $insertsql = $insertsql . "width = '$width',";
                }
                if ($caseid != 0) {
                        $insertsql = $insertsql . "caseid = '$caseid',";
                }
                if ($height != 0) {
                        $insertsql = $insertsql . "height = '$height',";
                }
                if(!empty($font)){
                        $insertsql = $insertsql . "font_size = '$font',";
                }
                $insertsql = $insertsql . "color = '$color'";
                $insertsql = $insertsql . " where id=$id";
                //var_dump($insertsql);
                $info = $this->hd->query($insertsql);

                $this->success('修改成功！');
                if (!$info) {
                        /// 上传错误提示错误信息
                        //$this->error('修改失败');
                } else {
                        //$this->success('修改！'.$name);
                }
        }

        public function hdbm() {

                $this->checkLevel(172);


                //列表过滤器，生成查询Map对象.
                $where = '';
                //$map = $this->_search();
                if (method_exists($this, '_filterbm')) {
                        $where = $this->_filterbm();
                }
                //var_dump($where);exit;
                $model = M('tbclassroomorder');
                //判断采用自定义的Model类
                if (!empty($model)) {
                        $this->_list($model, $where);
                }
                $this->display("hdbm");
        }

        public function hdplist() {
                $this->checkLevel(76);
                $id = I('get.id', 0);
                $ssql = "select ";
                $itemsql = "*";
                $esql = "from  tbclassroomhdp  where cid=$id";

                $total = $this->hd->query("$ssql count(*) as nums $esql ");

                $total = $total[0]['nums'];
                $count = $total;
                //每页显示的记录数
                if (!empty($_REQUEST['numPerPage'])) {
                        $listRows = $_REQUEST['numPerPage'];
                } else {
                        $listRows = '20';
                }
                //设置当前页码
                if (!empty($_REQUEST['pageNum'])) {
                        $nowPage = $_REQUEST['pageNum'];
                } else {
                        $nowPage = 1;
                }
                $_GET['p'] = $nowPage;

                //创建分页对象
                $p = new \Think\Page($count, $listRows);


                //分页查询数据

                $itemsql = "select * ";
                $esql = "from  tbclassroomhdp  where cid=$id";
                $pagesql = " ";
                $osql = " order by id desc";
                $limit = "limit $p->firstRow,$p->listRows";
                //echo "$ssql $itemsql $esql $addsql $pagesql $osql ";
                $list = $this->hd->query(" $itemsql $esql  $pagesql $osql $limit");



                //分页显示
                $page = $p->show();

                //列表排序显示
                $sort = $sort == 'desc' ? 1 : 0;                  //排序方式
                $city = M('city')->select();
                //var_dump($info);
                $this->assign('city', $city);
                //模板赋值显示
                $this->assign('list', $list);
                $this->assign('sort', $sort);
                $this->assign('cid', $id);
                $this->assign("page", $page);

                $this->assign("values", $_POST['values']); //搜索输入框内容
                $this->assign("totalCount", $count);   //总条数
                $this->assign("numPerPage", $p->listRows);  //每页显多少条
                $this->assign("currentPage", $nowPage);   //当前页码
                $this->display("hdplist");
        }

        public function hdpadd() {
                $this->checkLevel(77);
                $id = I('get.id', 0);
                $this->assign('cid', $id);
                $this->display("hdpadd");
        }

        public function hdpinsert() {
                $this->checkLevel(77);

                $cid = I('post.cid', 0);
                $img = I('post.background', '');
                $url = I('post.url', '');
                $insertsql = "insert into tbclassroomhdp (url,cid,img) values (";
                //$insertsql = $insertsql . "name = '$name',";
                $insertsql = $insertsql . "'$url',";
                $insertsql = $insertsql . "'$cid',";
                $insertsql = $insertsql . "'$img')";
                //var_dump($insertsql);
                $info = $this->hd->query($insertsql);

                $this->success('修改成功！');
                if (!$info) {
                        /// 上传错误提示错误信息
                        //$this->error('修改失败');
                } else {
                        //$this->success('修改！'.$name);
                }
        }

        public function hdpupdate() {
                $this->checkLevel(77);

                $id = I('post.id', 0);
                $img = I('post.img', '');
                $url = I('post.url', '');
                $insertsql = "update tbclassroomhdp set ";
                //$insertsql = $insertsql . "name = '$name',";
                $insertsql = $insertsql . "url = '$url',";
                $insertsql = $insertsql . "img = '$img'";
                $insertsql = $insertsql . " where id=$id";
                //var_dump($insertsql);
                $info = $this->hd->query($insertsql);

                $this->success('修改成功！');
                if (!$info) {
                        /// 上传错误提示错误信息
                        //$this->error('修改失败');
                } else {
                        //$this->success('修改！'.$name);
                }
        }

        public function hdpedit() {
                $this->checkLevel(77);

                $id = I('get.id', 0);
                $info = $this->hd->query("select * from tbclassroomhdp where id = $id");

                $this->assign('vo', $info[0]);
                $this->display("hdpedit");
        }

        //封装搜素条件,自动调用的方法
        public function _filterbm() {
                $where['_string'] = 'CityID in (' . $this->citylevel . ')';
                //搜索条件有值则做封装
                if (!empty($_REQUEST['keyword'])) {
                        $where['ClassRoomName'] = array('like', "%{$_REQUEST['keyword']}%");
                }
                if (!empty($_REQUEST['CityID'])) {
                        $where['CityID'] = $_REQUEST['CityID'];
                }

                return $where;
        }

        public function delbmr() {
                $this->checkLevel(70);

                $id = I('get.id', 0);
                $res1 = $this->hd->query("delete from tbclassroomOrder where id=" . $id);
                if ($res1) {
                        $this->success('删除成功！');
                } else {
                        $this->error('删除失败了！');
                }
        }

}
