<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Think;

class Page {

        public $firstRow; // 起始行数
        public $listRows; // 列表每页显示行数
        public $parameter; // 分页跳转时要带的参数
        public $totalRows; // 总行数
        public $totalPages; // 分页总页面数
        public $rollPage = 11;// 分页栏每页显示的页数
        public $lastSuffix = false; // 最后一页是否显示总页数
        // public $lastSuffix = true; // 最后一页是否显示总页数
        private $p = 'p'; //分页参数名
        private $url = ''; //当前链接URL
        private $nowPage = 1;
        // 分页显示定制
        private $config = array(
            'header' => '<span class="rows">共 %TOTAL_ROW% 条记录</span>',
            'prev' => '上一页',
            'next' => '下一页',
            'first' => '首页',
            'last' => '总记录%TOTAL_PAGE%',
            'theme' => '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%',
        );

        /**
         * 架构函数
         * @param array $totalRows  总的记录数
         * @param array $listRows  每页显示记录数
         * @param array $parameter  分页跳转的参数
         */
        public function __construct($totalRows, $listRows = 20, $parameter = array()) {
                C('VAR_PAGE') && $this->p = C('VAR_PAGE'); //设置分页参数名称
                /* 基础设置 */
                $this->totalRows = $totalRows; //设置总记录数
                $this->listRows = $listRows;  //设置每页显示行数
                $this->parameter = empty($parameter) ? $_GET : $parameter;
                $this->nowPage = empty($_GET[$this->p]) ? 1 : intval($_GET[$this->p]);
                $this->nowPage = $this->nowPage > 0 ? $this->nowPage : 1;
                $this->firstRow = $this->listRows * ($this->nowPage - 1);
        }

        /**
         * 定制分页链接设置
         * @param string $name  设置名称
         * @param string $value 设置值
         */
        public function setConfig($name, $value) {
                if (isset($this->config[$name])) {
                        $this->config[$name] = $value;
                }
        }

        /**
         * 生成链接URL
         * @param  integer $page 页码
         * @return string
         */
        private function url($page) {
                /* lv吕定国修改第一页不重复 */
                if ($page == 1) {
                        $pag = str_replace(urlencode('[PAGE]'), $page, $this->url);
                        $pag = str_replace('p-1.html', '', $pag);
                        return $pag;
                }
                /* lv吕定国修改第一页不重复 */
                return str_replace(urlencode('[PAGE]'), $page, $this->url);
        }

        /**
         * 组装分页链接
         * @return string
         */
        public function show($city = '') {
                if (0 == $this->totalRows)
                        return '';

                /* 生成URL */
           

                $this->parameter[$this->p] = '[PAGE]';
                $this->url = U(ACTION_NAME, $this->parameter);
                /* lv吕定国修改分页支持城市 */
                if (!empty($city)) {
                        $this->url = str_replace('/city/' . $city, '', $this->url);
                        $city = '';
                        $this->url = str_replace(__ROOT__, '', $this->url);
                        //var_dump($this->url);
                        $this->url = str_replace('About', 'about', $this->url);
                        //$this->url = strtolower($this->url);
                        $this->url = str_replace('/xiaoguotu/meitu/mtu/', '', $this->url);
                        $this->url = str_replace('/Xiaoguotu/meitu/mtu/', '', $this->url);
                        $this->url = str_replace('xiaoguotu/homepic/mtu/', '', $this->url);
                        $this->url = str_replace('Xiaoguotu/homepic/mtu/', '', $this->url);
                        $this->url = str_replace('index/mtu/', '', $this->url);
                        $this->url = str_replace('Zhuangxiuanli/', 'zhuangxiuanli/', $this->url);
                        $this->url = str_replace('zhuangxiuanli/index/', 'zhuangxiuanli/', $this->url);
                        $this->url = str_replace('Zhuangxiuanli/index/', 'zhuangxiuanli/', $this->url);
                        $this->url = str_replace('zhuangxiuanli/keywords/', 'zhuangxiuanli/keywords=', $this->url);
                        $this->url = str_replace('xiaoguotu/homepic/', '', $this->url);
                        $this->url = str_replace('Xiaoguotu/homepic/', '', $this->url);
                        $this->url = str_replace('xiaoguotu/tuce/mtu/', 'tuce/', $this->url);
                        $this->url = str_replace('Xiaoguotu/tuce/mtu/', 'tuce/', $this->url);
                        $this->url = str_replace('/c/tuce', '', $this->url);
                        $this->url = str_replace('xiaoguotu/tuce/', 'tuce/', $this->url);
                        $this->url = str_replace('Xiaoguotu/tuce/', 'tuce/', $this->url);
                        $this->url = str_replace('colorid/', 'color-', $this->url);
                        //wenda
                        $this->url = str_replace('Wenda/index', 'wenda', $this->url);
                        $this->url = str_replace('wenda/index', 'wenda', $this->url);
                        $this->url = str_replace('Wenda/lists', 'wenda', $this->url);
                        $this->url = str_replace('wenda/lists', 'wenda', $this->url);
                        $this->url = str_replace('Wenda/search/keyword/', 'wenda/search/keyword=', $this->url);

                        $this->url = str_replace('%3A/', '', $this->url);
                        //前台设计师登陆
                        if(strpos('designerhome/index/new', $this->url)){
                                $this->url = str_replace('designerhome/index', 'designerhome', $this->url);
                        }
                        
                        //gonglue
                        $this->url = str_replace('/gonglue/lists/class/', '', $this->url);
                        $this->url = str_replace('/Gonglue/lists/class/', '', $this->url);
                        $this->url = str_replace('gonglue/lists/rewrite_dir/', '', $this->url);
                        $this->url = str_replace('Gonglue/lists/rewrite_dir/', '', $this->url);
                        $this->url = str_replace('/rewrite_dir', '', $this->url);
                        $this->url = str_replace('gonglue/search/keyword/', 'search/keyword=', $this->url);
                        $this->url = str_replace('Gonglue/search/keyword/', 'search/keyword=', $this->url);
                        $this->url = str_replace('/c/search', '', $this->url);
                        
                        
                        $this->url = str_replace('/xiaoguotu/three/c/three', 'yangbanjian', $this->url);
                        $this->url = str_replace('/Xiaoguotu/three/c/three', 'yangbanjian', $this->url);
                        $this->url = str_replace('/xiaoguotu/index/', '', $this->url);
                        $this->url = str_replace('/Xiaoguotu/index/', '', $this->url);
                        if (!strpos('/Xiaoguotu/three', $this->url)) {
                                $this->url = str_replace('/c/three', '', $this->url);
                                $this->url = str_replace('/Xiaoguotu/three', '/yangbanjian', $this->url);
                        }
                        if (!strpos('/xiaoguotu/three', $this->url)) {
                                $this->url = str_replace('/c/three', '', $this->url);
                                $this->url = str_replace('/xiaoguotu/three', '/yangbanjian', $this->url);
                        }
                        //20150723增加局部空间分页
                        $this->url = str_replace('/sechtype/m/m', '', $this->url);
                        $this->url = str_replace('/sechtype/h/h', '', $this->url);
                        $this->url = str_replace('/sechtype/t/t', '', $this->url);
                        //sjs
                        $this->url = str_replace('designer/', 'shejishi/', $this->url);
                        $this->url = str_replace('Designer/', 'shejishi/', $this->url);
                        $this->url = str_replace('lists/levelid/1', 'gaoduangongzuoshi', $this->url);
                        $this->url = str_replace('lists/levelid/2', 'shouxishejishi', $this->url);
                        $this->url = str_replace('lists/levelid/3', 'zhurenshejishi', $this->url);
                        $this->url = str_replace('lists/levelid/4', 'youxiushejishi', $this->url);
                        $this->url = str_replace('lists/levelid/5', 'putongsheijishi', $this->url);
                        $this->url = str_replace('detail/id/', '', $this->url);

                        //xq
                        $this->url = str_replace('cases/index', 'xiaoquzhuangxiu', $this->url);
                        $this->url = str_replace('Cases/index', 'xiaoquzhuangxiu', $this->url);
                        $this->url = str_replace('xiaoquzhuangxiu/aid/', 'xiaoquzhuangxiu/aid-', $this->url);
                        $this->url = str_replace('Xiaoquzhuangxiu/aid/', 'xiaoquzhuangxiu/aid-', $this->url);
                        if (!strpos('/cases/anli/xiaoqu', $this->url)) {
                                $this->url = str_replace('/id/', '/anli/', $this->url);
                                $this->url = str_replace('p/', 'p-', $this->url);
                                $this->url = str_replace('/cases/anli/xiaoqu', '/xiaoquzhuangxiu', $this->url);
                        }
						if (!strpos('/Cases/anli/xiaoqu', $this->url)) {
                                $this->url = str_replace('/id/', '/anli/', $this->url);
                                $this->url = str_replace('p/', 'p-', $this->url);
                                $this->url = str_replace('/Cases/anli/xiaoqu', '/xiaoquzhuangxiu', $this->url);
                        }
                        $this->url = str_replace('Cases/huxingtu/xiaoqu','xiaoquzhuangxiu');
                        $this->url = str_replace('Gonglue/zhuanti/c/zhuanti/', 'huodongzhuanti/', $this->url);
                        $this->url = str_replace('gonglue/zhuanti/c/zhuanti/', 'huodongzhuanti/', $this->url);
                        $this->url = str_replace('gonglue/zhuanti/', 'huodongzhuanti/', $this->url);
                        $this->url = str_replace('Gonglue/zhuanti/', 'huodongzhuanti/', $this->url);
                        $this->url = str_replace('/c/zhuanti', '', $this->url);
                        $this->url = str_replace('keyword/', 'keyword=', $this->url);


                        if (strpos('index.php/', $this->url)) {
                                $this->url = str_replace('index.php/', '', $this->url);
                                $this->url = __ROOT__ . 'index.php' . '/' . $city . $this->url;
                        } else {
                                $this->url = __ROOT__ . '/' . $city . $this->url;
                        }
                        $this->url = str_replace('//', '/', $this->url);
                        $this->url = str_replace('p/', 'p-', $this->url);
                        //var_dump($this->url);
                }

                // 装修样板间的案例 www.sc.cc/yangbanjian
                if (stripos($this->url, 'about/yangbanjian')) {
                        $this->url = str_replace('about/yangbanjian', 'yangbanjian', $this->url);
                        $this->url = str_replace('yangbanjian/mtu', 'yangbanjian', $this->url);
                        $this->url = str_replace('/p/', '/p-', $this->url);
                        $this->url = str_replace('.html', '/', $this->url);
                }

                // 酷家乐3D云设计分页url
                if (stripos($this->url, 'searchmodel/c/searchmodel', 0)) {
                        $this->url = str_replace('xiaoguotu/searchmodel/c/searchModel', 'yunsheji/search', $this->url);
                        $this->url = str_replace('/g/', '/?g=', $this->url);
                        $this->url = str_replace('/p/', '&p=', $this->url);
                        $this->url = str_replace('.html', '', $this->url);
                }
                //小区户型图
                if (!strpos('cases/huxingtu/xiaoqu', $this->url)) {
                        $this->url = str_replace('/id/', '/huxingtu/', $this->url);
                        $this->url = str_replace('/p/', '/p-', $this->url);
                        $citys = '/city/'.$_COOKIE['city'];
                        $this->url = str_replace($citys, '', $this->url);
                        $this->url = str_replace('/cases/huxingtu/xiaoqu', '/xiaoquzhuangxiu', $this->url);
                }
				if (!strpos('Cases/huxingtu/xiaoqu', $this->url)) {
                        $this->url = str_replace('/id/', '/huxingtu/', $this->url);
                        $this->url = str_replace('/p/', '/p-', $this->url);
                        $citys = '/city/'.$_COOKIE['city'];
                        $this->url = str_replace($citys, '', $this->url);
                        $this->url = str_replace('/Cases/huxingtu/xiaoqu', '/xiaoquzhuangxiu', $this->url);
                }
                /* 计算分页信息 */
                $this->totalPages = ceil($this->totalRows / $this->listRows); //总页数
                if (!empty($this->totalPages) && $this->nowPage > $this->totalPages) {
                        $this->nowPage = $this->totalPages;
                }

                /* 计算分页零时变量 */
                $now_cool_page = $this->rollPage / 2;
                $now_cool_page_ceil = ceil($now_cool_page);
                $this->lastSuffix && $this->config['last'] = $this->totalPages;
                if (!stripos($this->url, 'yunsheji/search', 0)) {
                        //上一页
                        $up_row = $this->nowPage - 1;
                        $up_page = $up_row > 0 ? '<a class="gray-bg" href="' . $this->url($up_row) . '">' . $this->config['prev'] . '</a>' : '';
                        //下一页
                        $down_row = $this->nowPage + 1;
                        $down_page = ($down_row <= $this->totalPages) ? '<a  href="' . $this->url($down_row) . '">' . $this->config['next'] . '</a>' : '';

                        //第一页
                        $the_first = '';
                        if ($this->totalPages > $this->rollPage && ($this->nowPage - $now_cool_page) >= 1) {
                                $the_first = '<a class="gray-bg" href="' . $this->url(1) . '">' . $this->config['first'] . '</a>';
                        }

                        //最后一页
                        $the_end = '';
                        if ($this->totalPages > $this->rollPage && ($this->nowPage + $now_cool_page) < $this->totalPages) {
                                $the_end = '<a class="gray-bg" href="' . $this->url($this->totalPages) . '">' . $this->config['last'] . '</a>';
                        }

                        //数字连接
                        $link_page = "";
                        for ($i = 1; $i <= $this->rollPage; $i++) {
                                if (($this->nowPage - $now_cool_page) <= 0) {
                                        $page = $i;
                                } elseif (($this->nowPage + $now_cool_page - 1) >= $this->totalPages) {
                                        $page = $this->totalPages - $this->rollPage + $i;
                                } else {
                                        $page = $this->nowPage - $now_cool_page_ceil + $i;
                                }
                                if ($page > 0 && $page != $this->nowPage) {

                                        if ($page <= $this->totalPages) {
                                                $link_page .= '<a  href="' . $this->url($page) . '">' . $page . '</a>';
                                        } else {
                                                break;
                                        }
                                } else {
                                        if ($page > 0 && $this->totalPages != 1) {
                                                $link_page .= '<a class="page-active">' . $page . '</a>';
                                        }
                                }
                        }
                        //替换分页内容
                        $page_str = str_replace(
                                array('%HEADER%', '%NOW_PAGE%', '%UP_PAGE%', '%DOWN_PAGE%', '%FIRST%', '%LINK_PAGE%', '%END%', '%TOTAL_ROW%', '%TOTAL_PAGE%'), array($this->config['header'], $this->nowPage, $up_page, $down_page, $the_first, $link_page, $the_end, $this->totalRows, $this->totalPages), $this->config['theme']);
                } else {
                        // 酷家乐单独分页样式
                        $up_row = $this->nowPage - 1;
                        $page_str = "";
                        if ($this->totalPages != 1 && $this->totalPages > 0) {
                                $page_str = '<a  href="' . $this->url($up_row) . '" class="snUp" id="snUpH">上一页</a>';
                        }

                        for ($i = 1; $i <= $this->totalPages; $i++) {
                                if (($this->nowPage - $now_cool_page) <= 0) {
                                        $page = $i;
                                } elseif (($this->nowPage + $now_cool_page - 1) >= $this->totalPages) {
                                        $page = $this->totalPages - $this->rollPage + $i;
                                } else {
                                        $page = $this->nowPage - $now_cool_page_ceil + $i;
                                }
                                if ($page > 0 && $page != $this->nowPage) {

                                        if ($page <= $this->totalPages) {
                                                $page_str .= '<a  href="' . $this->url($page) . '" class="snPl" >' . $page . '</a>';
                                        } else {
                                                break;
                                        }
                                } else {
                                        if ($page > 0 && $this->totalPages != 1) {
                                                $page_str .= '<a class="snPl" id="snPlH">' . $page . '</a>';
                                        }
                                }
                        }
                        //下一页
                        $down_row = $this->nowPage + 1;
                        if ($this->totalPages > 1) {
                                $page_str .= '<a href="' . $this->url($down_row) . '" class="snUp" id="snUpH" >下一页</a>';
                        }
                        $page_str .= '共&nbsp;' . $this->totalPages . '&nbsp;页&nbsp;&nbsp;';
//            $down_page = ($down_row <= $this->totalPages) ? '<a  href="' . $this->url($down_row) . '">' . $this->config['next'] . '</a>' : '';
                }

               
                return "{$page_str}";
        }

}
