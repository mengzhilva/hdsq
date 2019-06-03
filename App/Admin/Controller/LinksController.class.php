<?php

namespace Admin\Controller;

/*
 * 友情链接管理控制器，继承CommonController
 * 方法：
 *       
 * 作者：李彭青 
 */

class LinksController extends CommonController {

        private $cityarea;
        private $citylevel;

        public function __construct() {

                parent::__construct();
                $this->cityarea = M('Cityarea');

                // 获取当前用户所拥有权限的城市ID
                $this->citylevel = $_SESSION['scadminuser']['cid'];

                $city = M('city')->where('id in (' . $this->citylevel . ')')->select();
                $this->assign('city', $city);
                $data = M('link_class')->field('id,name')->where('parentid=0')->order('id asc')->select();
                foreach ($data as $key => $value) {
                        $pindaolist[] = array('id' => $value['id'], 'name' => $value['name']);
                }
                $this->assign('pindaolist', $pindaolist);
                //单图风格
        }

        /* 封装搜素条件,自动调用的方法
         */

        public function _filter(&$map) {
                //搜索条件有值则做封装
                if (!empty($_REQUEST['keyword'])) {
                        $where['link_name'] = array('like', "%{$_REQUEST['keyword']}%");
                        $where['url'] = array('like', "%{$_REQUEST['keyword']}%");
                        $where['_logic'] = 'or';
                        $map['_complex'] = $where;
                }
                if (!empty($_REQUEST['pindaoid'])) {
                        $map['pindaoid'] = $_REQUEST['pindaoid'];
                        //$parentid = M('link_class')->where('id='.$map['canshu'])->field('parentid')->select();
                        $canshuarr = M('link_class')->where('parentid='.$map['pindaoid'])->field('id,name')->select();
                        for ($i = 0; $i < count($canshuarr); $i++) {
                                $canshu[] = array('id' => $canshuarr[$i]['id'], 'name' => $canshuarr[$i]['name']);
                        }
                        $this->assign('canshu', $canshu);
                }
                if (!empty($_REQUEST['canshu'])) {
                        $map['canshu'] = $_REQUEST['canshu'];                        
                }
                if (!empty($_REQUEST['is_pic'])) {
                        $map['is_pic'] = $_REQUEST['is_pic'];                        
                }
                if($map['pindaoid'] == '0'){
                        unset($map['pindaoid']);
                }
                if($map['canshu'] == '0'){
                        unset($map['canshu']);
                }
                if($map['is_pic'] == '0'){
                        unset($map['is_pic']);
                }
                $map['is_delete'] = 0;//只查询is_delete=0的数据，即显示未被删除的数据
        }

        /* 加载显示页面
         */

        public function index() {
                // 此方法权限ID为107
                $this->checkLevel(107);
                parent::index();
        }

        /* 加载添加友情链接页面
         */

        public function add() {
                // 此方法权限ID为108
                $this->checkLevel(108);
                $this->display("add");
        }

        public function _before_insert() {

                if (($_POST['pindaoid'] == 2) && ($_POST['cid'] == 0)) {
                        echo '请选择城市！';
                        exit;
                }
        }

        public function _before_update() {

                if (($_POST['pindaoid'] == 2) && ($_POST['cid'] == 0)) {
                        echo '请选择城市！';
                        exit;
                }
        }

        /* 执行添加友情链接数据写入
         */

        public function insert() {
                // 此方法权限ID为108                
                $this->checkLevel(108);
                $time = time();
                $pindaoid = I('pindaoid');
                $cid = I('cid');
                $canshu = I('canshu');
                $is_pic = I('is_pic');
                $postarr = array();
                $link_name = I('link_name');
                $url = I('url');
                $ress = array();
                M('links')->startTrans();//开启事务
                foreach ($link_name as $k => $v) {
                        $postarr['pindaoid'] = $pindaoid;
                        $postarr['cid'] = $cid;
                        $postarr['canshu'] = $canshu;
                        $postarr['addtime'] = $time;
                        $postarr['is_show'] = 1;
                        $postarr['is_pic'] = $is_pic;
                        $postarr['link_name'] = $link_name[$k];
                        $postarr['url'] = $url[$k];
                        $ress[$k] = M('links')->add($postarr);
                }

                if (count($ress) === count($link_name)) {
                        M('links')->commit();
                        $this->success(L('添加成功！'));
                } else {
                        M('links')->rollback();
                        $this->errot(L('添加失败！'));
                }
        }

        /**
         * 方法功能:前台下拉菜单调去的子分类
         * 开发时间：16-5-24 下午4:55
         */
        public function getsonclass($id) {
                // 接收级联菜单中的一级分类ID
                $data['parentid'] = $_GET['id'];
                //获取二级分类
                $guideclasssub = M('link_class')->where($data)->select();
                if (empty($guideclasssub)) {
                        $classsub = '[["", "空"]]';
                } else {
                        $classsub = '[["", "选择"]';
                        foreach ($guideclasssub as $v) {
                                $classsub .= ',["' . $v['id'] . '","' . $v['name'] . '"]';
                        }
                        $classsub .= ']';
                }
                exit($classsub);
        }

        /* 加载编辑友情链接页面
         */

        public function edit() {

                // 此方法的权限ID为109
                $this->checkLevel(109);
                //创建信息操作对象
                $mod = M("Links");
                //获取修改的信息
                $link = $mod->find($_GET['link_id'] + 0);
                //将修改信息放置模板
                $this->assign("vo", $link);
                //加载修改模板
                $this->display("edit");
        }

        /* 执行编辑友情链接后的数据更新操作
         */

        public function update() {

                // 此方法的权限ID为109
                $this->checkLevel(109);
                //创建信息操作对象
                // $mod = M("Links");
                if (empty($_POST['pic'])) {
                        unset($_POST['pic']);
                }
                $_POST['addtime'] = time();
                $_POST['is_show'] = 1;
                parent::update();
        }

        /* 加载链接审核页面
         */

        public function check() {

                // 此方法的权限ID为111
                $this->checkLevel(111);
                $id = I('get.link_id', 0, 'intval');
                $links = M("Links")->where(" link_id={$id}")->field('link_id,is_show')->find();
                $this->assign('links', $links);
                $this->display('check');
        }

        public function audit() {
                $this->checkLevel(111);
                (!$_REQUEST['ids'] || !$_GET['type']) && $this->error(L('缺少必要的参数！'));
                $id = explode(',', $_REQUEST['ids']);
                $type = $_GET['type'] == 'y' ? 1 : -1;
                $news = M('Links');
                $data['is_show'] = $type;
                foreach ($id AS $k => $v) {
                        $where['link_id'] = $v;
                        $news->where($where)->save($data);
                }
                $this->success(L('更新成功'));
        }

        /* 执行链接审核后数据更新操作
         */

        public function chupdate() {

                // 此方法权限ID为111
                $this->checkLevel(111);
                parent::update();
        }

        /* 图片上传
         */

        public function upload($path) {
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize = 3145728;// 设置附件上传大小
                $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath = './Public/'; // 设置文件上传保存的根路径  
                $upload->savePath = $path; // 设置附件上传目录
                $upload->subName = '';//子目录
                $info = $upload->upload();
                if (!$info) {// 上传错误提示错误信息
                        return false;
                } else {// 上传成功 获取上传文件信息
                        return $info;
                }
        }

        /* 执行删除状态操作(并未删除数据)
         */

        public function delete_tag() {

                // 此方法权限ID为110
                $this->checkLevel(110);
                $data['is_delete'] = 1;
                $id = I('get.link_id', 0, 'intval');
                $m = M("Links")->where(" link_id={$_GET['link_id']}")->save($data);
                if ($m) {
                        $this->success("成功删除！");
                } else {
                        $this->error("删除失败");
                }
        }

}
