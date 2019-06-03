<?php

namespace Admin\Controller;

/*
 */

class WebmenuController extends CommonController {

        private $cityarea;
        private $citylevel;

        public function __construct() {

                parent::__construct();
        }

        /* 封装搜素条件,自动调用的方法
         */

        public function _filter(&$map) {
                //搜索条件有值则做封装
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
                parent::insert();
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
                $mod = M("Webmenu");
                //获取修改的信息
                $link = $mod->find($_GET['id'] + 0);
                //将修改信息放置模板
                $this->assign("vo", $link);
                //加载修改模板
                $this->display("edit");
        }

        /* 执行编辑友情链接后的数据更新操作
         */

        public function update() {

                // 此方法的权限ID为109
                //创建信息操作对象
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
