<?php
namespace Home\Controller;
/**
 * 关于我们控制器
 * 开发人员：吕定国
 * 开发时间：2014.12.08
 * 修改时间：2015.1.12
 */
class AboutController extends CommonController {

        public function __construct() {
                parent::__construct();
                //如果不是北京地区，在头部指向BJ的链接：樊琦 2015-04-28
                $city = $this->city['DOMAIN'];
                if ($city != 'bj' && !strstr($city, 'bj_')) {
                        $arr = explode('/', __ACTION__);
                        if (strstr($city, '_')) {
                                //如果地区带有推广的ID（tj_381）,就改成bj_381
                                $replace = explode('_', $city);
                                $url = "http://www.sc.cc_" . $replace[1] . "/about/" . $arr[3] . '.' . __EXT__;
                        } else {
                                $url = "http://www.sc.cc/about/" . $arr[3] . '.' . __EXT__;
                        }
                        $this->assign('HeadUrl', $url);
                        $this->assign('actionFan', 'about');
                        $this->assign('cityFan', $city);
                }
                $citydomainarr = explode('.', $_SERVER['SERVER_NAME']);
                if ($citydomainarr[0] != C('scurl')['SEC_DOMAIN']) {
                        header('HTTP/1.1 301 Moved Permanently');
                        header('Location:http://' . C('scurl')['SEC_DOMAIN'] . C('scurl')['DOMAIN'] . $_SERVER['REQUEST_URI'] . '');
                        exit;
                }
        }

        public function index() {
                $title = '实创装饰集团介绍_关于实创-实创装饰集团官方网站';
                $keywords = "实创装饰,实创装饰介绍,实创家居装饰集团有限公司,实创装饰集团官方网站";
                $description = "实创装饰集团官网关于实创栏目主要为大家免费提供：实创家居装饰集团有限公司简介、实创创始人、企业文化、品牌历程、品牌荣誉、新闻中心、法律声明、社会责任等及相关内容。";

                $this->assign('title', $title);
                $this->assign('keywords', $keywords);
                $this->assign('description', $description);
                $this->assign('title', $title);
                $this->display('about-qyjj');
        }

        // public function newslist() {
        // 	$news = M('tbnews');
        // 	$where['Statusdescription'] = 1;
        // 	$newslist = $news->where($where)->select();
        // }
        // public function newsinfo() {
        // 	$news = M('tbnews');
        // 	$id = I('get.id',0);
        // 	$where['ID'] = $id;
        // 	$newsinfo = $news->where($where)->select();
        // 	var_dump($newsinfo);
        // }
        //企业简介
        public function sitrust() {
                $title = '实创装饰_实创装饰集团介绍_实创家居装饰集团有限公司-实创装饰集团官方网站';
                $keywords = "实创装饰,实创装饰介绍,实创家居装饰集团有限公司,实创装饰集团官方网站";
                $description = "实创装饰集团官网企业简介栏目主要为大家免费提供：实创家居装饰集团有限公司简介、实创装饰怎么样，实创装修怎么样等，了解实创装饰集团企业的相关信息就上实创装饰集团企业简介栏目。";

                $this->assign('title', $title);
                $this->assign('keywords', $keywords);
                $this->assign('description', $description);
                $this->display('about-qyjj');
        }

        //品牌历程
        public function history() {
                $title = '实创发展历程_实创品牌历程_关于实创-实创装饰集团官方网站';
                $keywords = "实创发展历程,实创品牌历程,关于实创,实创装饰集团官方网站";
                $description = "实创装饰集团官网品牌历程栏目主要为大家免费提供：实创品牌的发展历程，了解实创装饰集团品牌历程的相关信息就上实创装饰集团品牌历程栏目。";

                $this->assign('title', $title);
                $this->assign('keywords', $keywords);
                $this->assign('description', $description);
                $this->display('about-pplc');
        }

        //品牌荣誉
        public function brand() {
                $title = '实创装饰怎么样_实创品牌荣誉_关于实创-实创装饰集团官方网站';
                $keywords = "实创装饰怎么样,实创品牌荣誉,关于实创,实创装饰集团官方网站";
                $description = "实创装饰集团官网品牌荣誉栏目主要为大家免费提供：实创装饰怎么样、实创品牌荣誉等方面的内容，了解实创装饰集团品牌荣誉的相关信息就上实创装饰集团品牌荣誉栏目。";

                $this->assign('title', $title);
                $this->assign('keywords', $keywords);
                $this->assign('description', $description);
                $this->display('about-ppry');
        }

        //企业创始人
        public function sunwei() {
                $title = '孙威简介_孙威介绍_实创家居装饰创始人-实创装饰集团官方网站';
                $keywords = "孙威简介,孙威介绍,实创家居装饰创始人,实创装饰集团官方网站";
                $description = "孙威—实创装饰集团董事长传播学博士，曾荣膺第四届中国居家论坛年度家居行业风云人物、北京明星建筑装饰企业家、2007年度家居行业推动力人物等诸多殊荣。";

                $this->assign('title', $title);
                $this->assign('keywords', $keywords);
                $this->assign('description', $description);
                $this->display('about-qycsr');
        }

        //企业文化
        public function culture() {
                $title = '企业文化_实创企业文化_关于实创-实创装饰集团官方网站';
                $keywords = "企业文化,实创企业文化,关于实创,实创装饰集团官方网站";
                $description = "实创装饰集团官网企业文化栏目主要为大家免费提供：集团使命、集团愿景、品牌个性、核心价值观等方面的内容，了解实创装饰集团企业文化的相关信息就上实创装饰集团企业文化栏目。";

                $this->assign('title', $title);
                $this->assign('keywords', $keywords);
                $this->assign('description', $description);
                $this->display('about-qywh');
        }

        //法律声明
        public function legal() {
                $title = '实创法律声明_法律声明_关于实创-实创装饰集团官方网站';
                $keywords = "实创法律声明,法律声明,关于实创,实创装饰集团官方网站";
                $description = "感谢您访问本网站。在使用本网站前，请仔细阅读以下使用条款，该使用条款中包含您作为本网站用户所享有的权利和义务等重要内容。";

                $this->assign('title', $title);
                $this->assign('keywords', $keywords);
                $this->assign('description', $description);
                $this->display('about-flsm');
        }

        //社会责任
        public function social() {
                $title = '实创公益活动_社会责任_关于实创-实创装饰集团官方网站';
                $keywords = "实创公益活动,社会责任,关于实创,实创装饰集团官方网站";
                $description = "实创装饰集团在经营规模不断壮大的同时，认真落实科学发展观、积极履行企业社会责任，自觉地把企业社会责任融入到公司的战略、企业文化和生产经营活动中，努力构建和谐企业！";

                $this->assign('title', $title);
                $this->assign('keywords', $keywords);
                $this->assign('description', $description);
                $this->display('about-shzr');
        }

        //新闻中心
        public function news() {
                $model = M('tbnews');
                $order = 'ID';
                $asc = 'desc';
                $where['Statusdescription'] = 1;
                //$where['ClassName']='实创新闻';
                if (!empty($model)) {
                        $this->lists($model, $where, $order, $asc, 21);
                }
                $title = '实创新闻_实创新闻中心_关于实创-实创装饰集团官方网站';
                $keywords = "实创新闻,实创新闻中心,关于实创,实创装饰集团官方网站";
                $description = "实创装饰集团官网新闻中心栏目主要为大家免费提供：关于实创的最新信息的内容，了解实创装饰集团最新动态的相关信息就上实创装饰集团新闻中心栏目。";

                $this->assign('title', $title);
                $this->assign('keywords', $keywords);
                $this->assign('description', $description);
                $this->display('about-news');
        }

        //新闻详情页	
        public function newsinfo() {

                $model = M('tbnews');
                $id = I('get.id', 0);
                $where['ID'] = $id;
                $where['Statusdescription'] = 1;
                //$where['ClassName']='实创新闻';		
                $show = $model->where($where)->find();
                $prev = $model->where("ClassName = '实创新闻' and Statusdescription = 1 and ID < " . $id)->order('id desc')->find();
                $next = $model->where("ClassName = '实创新闻' and Statusdescription = 1 and ID > " . $id)->order('id asc')->find();
                $this->assign('show', $show);
                $this->assign('prev', $prev);
                $this->assign('next', $next);
                $title = $show['Title'] . '_关于实创-实创装饰集团官方网站';
                $keywords = $show['Title'];
                $description = $show['Title'];

                $this->assign('title', $title);
                $this->assign('keywords', $keywords);
                $this->assign('description', $description);
                $this->display('about-news-show');
        }

        //校园招聘
        public function join_campus() {
                $model = M('tbjob');
                $order = 'id';
                //$where['Passed']=1;
                $where['ClassName'] = '校园招聘';
                if (!empty($model)) {
                        $this->_list($model, $where, $order, false, 15);
                }
                $title = '校园招聘-实创装饰官网_实创装饰官网';
                $keywords = "实创招聘,实创装饰校园招聘,校招";
                $description = "实创装饰校园招聘-欢迎您加入实创";

                $this->assign('title', $title);
                $this->assign('keywords', $keywords);
                $this->assign('description', $description);
                $this->display('joinus-xyzp');
        }

        //社会招聘
        public function join_social() {
                $model = M('tbjob');
                $order = 'id';
                //$where['Passed']=1;
                $where['ClassName'] = '社会招聘';
                if (!empty($model)) {
                        $this->_list($model, $where, $order, false, 15);
                }
                $title = '社会招聘-实创装饰官网_实创装饰官网';
                $keywords = "实创招聘,实创装饰社会招聘,社招";
                $description = "实创装饰社会招聘-欢迎您加入实创";

                $this->assign('title', $title);
                $this->assign('keywords', $keywords);
                $this->assign('description', $description);
                $this->display('joinus-shzp');
        }

        //招聘详情页
        public function jobinfo() {
                $title = '社会招聘-实创装饰官网_实创装饰官网';
                $keywords = "实创招聘,实创装饰社会招聘,社招";
                $description = "实创装饰社会招聘-欢迎您加入实创";

                $this->assign('title', $title);
                $this->assign('keywords', $keywords);
                $this->assign('description', $description);

                $model = M('tbjob');
                $id = I('get.id', 0);
                $where['id'] = $id;
                $show = $model->where($where)->find();
                $prev = $model->where("id < " . $id)->order('id desc')->find();
                $next = $model->where("id > " . $id)->order('id asc')->find();
                $this->assign('show', $show);
                $this->assign('prev', $prev);
                $this->assign('next', $next);
                $title = $show['Title'] . '_实创招聘_加入我们';
                $this->assign('title', $title);
                $this->display('joinus-shzp-show');
        }

        //员工风采
        public function life() {
                $title = '员工风采-实创企业简介_实创装饰官网';
                $keywords = "员工风采,实创装饰官网";
                $description = "员工风采-实创装饰官网";

                $this->assign('title', $title);
                $this->assign('keywords', $keywords);
                $this->assign('description', $description);
                $model = M('tbnews');
                $order = 'ID';
                $where['Statusdescription'] = 1;
                $where['ClassName'] = '员工风采';
                if (!empty($model)) {
                        $this->_list($model, $where, $order, false, 8);
                }
                //员工风采-成长实创
                $where['InIndex'] = 1;
                $czsc = $model->where($where)->limit(3)->select();
                $this->assign('czsc', $czsc);
                $title = '员工风采_加入我们';
                $this->assign('title', $title);
                $this->display('joinus-ygfc');
        }

        //员工风采详情页	
        public function lifeinfo() {
                $title = '员工风采-实创企业简介_实创装饰官网';
                $keywords = "员工风采,实创装饰官网";
                $description = "员工风采-实创装饰官网";

                $this->assign('title', $title);
                $this->assign('keywords', $keywords);
                $this->assign('description', $description);

                $model = M('tbnews');
                $id = I('get.id', 0);
                $where['ID'] = $id;
                $where['Statusdescription'] = 1;
                $where['ClassName'] = '员工风采';
                $show = $model->where($where)->find();
                $prev = $model->where("ClassName = '员工风采' and Statusdescription = 1 and ID < " . $id)->order('id desc')->find();
                $next = $model->where("ClassName = '员工风采' and Statusdescription = 1 and ID > " . $id)->order('id asc')->find();
                $this->assign('show', $show);
                $this->assign('prev', $prev);
                $this->assign('next', $next);
                $title = $show['Title'] . '_员工风采_加入我们';
                $this->assign('title', $title);
                $this->display('joinus-ygfc-show');
        }

        //薪酬福利
        public function welfare() {
                $title = '员工福利-实创企业简介_实创装饰官网';
                $keywords = "员工福利,实创薪酬待遇,";
                $description = "员工福利-实创装饰官网";

                $this->assign('title', $title);
                $this->assign('keywords', $keywords);
                $this->assign('description', $description);
                $this->display('joinus-xcfl');
        }

        //加入我们
        public function joinus() {
                $model = M('tbjob');
                $order = 'id';
                //$where['Passed']=1;
                $where['ClassName'] = '社会招聘';
                if (!empty($model)) {
                        $this->_list($model, $where, $order, false, 15);
                }
                $title = '关于实创-实创企业简介_实创装饰官网';
                $keywords = "实创装饰,加入我们,实创招聘";
                $description = "加入我们-实创装饰集团.如果你不止爱家还爱家装,如果你不止才华横溢还不甘于现状,如果你活在互联网里又领导人群,那么我们诚挚邀请您加入实创";

                $this->assign('title', $title);
                $this->assign('keywords', $keywords);
                $this->assign('description', $description);
                $this->display('joinus');
        }

        function lists($model, $map = array(), $sortBy = '', $asc = '', $pnum = '') {



                //排序字段 默认为主键名
                if (!empty($_REQUEST['_order'])) {
                        $order = $_REQUEST['_order'];
                } else {
                        $order = !empty($sortBy) ? $sortBy : $model->getPk();
                }

                //排序方式默认按照倒序排列
                //接受 sort参数 0 表示倒序 非0都 表示正序
                if (!empty($_REQUEST['_sort'])) {
                        $sort = $_REQUEST['_sort'] == 'asc' ? 'asc' : 'desc';
                } else {
                        $sort = $asc ? 'asc' : 'desc';
                }

                //取得满足条件的记录数
                $count = $model->where($map)->count();
                //每页显示的记录数
                if (!empty($_REQUEST['numPerPage'])) {
                        $listRows = $_REQUEST['numPerPage'];
                } else if (!empty($pnum)) {
                        $listRows = $pnum;
                } else {
                        $listRows = '10';
                }
                $path = $_SERVER['REQUEST_URI'];
                if (strpos($path, '/p-')) {
                        $rowtemp = explode("-", $path);
                        $_REQUEST['p'] = substr($rowtemp[1], 0, strrpos($rowtemp[1], '.'));
                }

                //设置当前页码
                if (!empty($_REQUEST['p'])) {
                        $nowPage = $_REQUEST['p'];
                } else {
                        $nowPage = 1;
                }
                $_GET['p'] = $nowPage;

                //创建分页对象
                $p = new \Think\Page($count, $listRows);

                $order = "ID";
                $sort = "desc";

                //分页查询数据
                $list = $model->where($map)->order($order . ' ' . $sort)
                        ->limit($p->firstRow . ',' . $p->listRows)
                        ->select();
                // echo $model->getlastsql();          
                //回调函数，用于数据加工，如将用户id，替换成用户名称
                if (method_exists($this, '_tigger_list')) {
                        $this->_tigger_list($list);
                }


                //分页显示
                $page = $p->show($this->city['DOMAIN']);

                //列表排序显示
                $sortImg = $sort;                                 //排序图标
                $sortAlt = $sort == 'desc' ? '升序排列' : '倒序排列';   //排序提示
                $sort = $sort == 'desc' ? 1 : 0;                  //排序方式
                //模板赋值显示
                $this->assign('list', $list);
                $this->assign('sort', $sort);
                $this->assign('order', $order);
                $this->assign('sortImg', $sortImg);
                $this->assign('sortType', $sortAlt);
                $this->assign("page", $page);

                $this->assign("search", $search);           //搜索类型
                $this->assign("values", $_POST['values']);  //搜索输入框内容
                $this->assign("totalCount", $count);            //总条数
                $this->assign("numPerPage", $p->listRows);      //每页显多少条
                $this->assign("currentPage", $nowPage);          //当前页码
        }

        public function link() {
                $this->tonghang = M('links')->where(array('pindaoid' => 6, 'is_pic' => 4, 'is_show' => 1))->select();
                $this->zonghe = M('links')->where(array('pindaoid' => 6, 'is_pic' => 5, 'is_show' => 1))->select();
                $this->difang = M('links')->where(array('pindaoid' => 6, 'is_pic' => 6, 'is_show' => 1))->select();
                $friend = M('Links')->where('is_delete=0 AND is_show=1 AND pindaoid=1 AND is_pic=1')->select();
                $this->assign('friend', $friend);
                $redian = D('Links')->getRedian(0, 1);
                $this->assign('redian', $redian);

                $this->title = '友情链接_关于实创-实创装饰集团官方网站';
                $this->keywords = "友情链接,实创装饰集团官方网站";
                $this->description = "实创装饰集团官方网站友情链接规则介绍。";

                $this->display();
        }

        /**
         * [laofang description]老房装修专题页
         * @return [type] [description]
         */
        public function laofang() {
                R('About/oldnewhouse');
                //底部热点标签
                $friend = D('Links')->getLinks(0, 123, 126);

                $this->assign('friend', $friend);
                $this->pindao = 2;

                //分配当前网址 隐藏底部广告
                // $this ->SERVER_NAME=$_SERVER['SERVER_NAME'];
                //tdk
                $this->title = '老房装修_老房装修设计_老房改造-实创装饰集团官方网站';
                $this->keywords = '老房装修,老房装修设计,老房改造,实创装饰集团官方网站';
                $this->description = '实创装饰集团官方网站的老房装修栏目为您提供老房装修的案例、老房装修的注意事项、老房改造的相关问题等内容和服务，查找老房改造的相关内容和服务就上实创装饰老房装修栏目。';
                $this->display();
        }

        public function xinfang() {
                R('About/oldnewhouse');
                // $this ->SERVER_NAME=$_SERVER['SERVER_NAME'];
               
                //底部热点标签
                $friend = D('Links')->getLinks(0, 123, 125);

                $this->assign('friend', $friend);
                $this->pindao = 2;
                //tdk
                $this->title = '新房装修_新房装修设计_新房装修步骤-实创装饰集团官方网站';
                $this->keywords = '新房装修_新房装修设计_新房装修步骤-实创装饰集团官方网站';
                $this->description = '实创装饰集团官方网站的新房装修栏目为您提供新房装修设计、新房装修的注意事项、新房步骤的相关问题等内容和服务，查找新房装修的相关内容和服务就上实创装饰新房装修栏目。';
                $this->display();
        }

        /**
         * [xiaohuxing description] 小户型
         * @return [type] [description]
         */
        public function xiaohuxing()
        {
                R('About/oldnewhouse');
                $tuce = M('casedecorate')->where(array('status' => 1,'AREA'=>array('lt','75')))->field('ID,Name,IMAGE,AREA,TYPEID,SID,UPDATETIME')->order('UPDATETIME Desc')->limit(8)->select();
                foreach ($tuce as $k => $v) {
                        $tuce[$k]['url'] = 'http://zhuangxiuxiaoguotu.sc.cc/tuce-' . $v['ID'] . '.html';
                }
                $this -> tuce =$tuce;

                // $this ->SERVER_NAME=$_SERVER['SERVER_NAME'];
                //底部热点标签
                $friend = D('Links')->getLinks(0, 123, 199);
                $this->pindao = 2;
                $this->assign('friend', $friend);
                $this->title = '小户型家装_小户型装修_小户型装修设计-实创装饰集团官方网站';
                $this->keywords = '小户型家装,小户型装修,小户型装修设计,实创装饰集团官方网站';
                $this->description = '实创装饰集团官方网站的小户型装修栏目为您提供小户型装修的各种服务、案例、风格、效果图及小户型装修的相关知识。查找小户型装修的相关服务和知识就上小户型装修栏目。';
                $this -> display();
        }

        /**
         * [xiaohuxing description] 软装装修
         * @return [type] [description]
         */
        public function ruanzhuang()
        {
                //城市装修报价
                $this -> map_citys =$this ->zhuangxiubaojiafuc();
                //最新图册
                $this->tuce = new_tuce(8);
                // $this ->SERVER_NAME=$_SERVER['SERVER_NAME'];
                //最新文章
                $this -> rZaritcle = $this -> ruanzhuangfuc(131);
         
                
                //底部热点标签
                $friend = D('Links')->getLinks(0, 123, 200);
          
                $this->pindao = 2;
                $this->assign('friend', $friend);
                $this->title = '软装_软装设计_室内软装设计-实创装饰集团官方网站';
                $this->keywords = '软装,软装设计,室内软装设计,实创装饰集团官方网站';
                $this->description = '实创装饰集团官方网站的软装装修栏目为您提供最新软装装修案例，精美的软装装修效果图，为您解决软装装修过程中遇到的一系列问题。查找软装装修的案例就上软装装修栏目。';
                $this -> display();
        }
        /**
         * [xhx description] 案例小户型 实例
         * @return [type] [description]
         */
         public function xhx()
         {
                 //城市装修报价
                $this -> map_citys =$this ->zhuangxiubaojiafuc();

                //*平米装修实例
                $this -> thirtypm=$this -> tuceFuc(30,3);
                $this -> fortypm=$this -> tuceFuc(40,3);
                $this -> fiftypm=$this -> tuceFuc(50,3);
                $this -> sixtypm=$this -> tuceFuc(60,3);
                $this -> seventypm=$this -> tuceFuc(70,3);
                $this -> eightypm=$this -> tuceFuc(80,3);
              
                //底部热点标签
                $friend = D('Links')->getLinks(0, 123, 201);
          
                $this->pindao = 2;
                $this->assign('friend', $friend);
                $this->title = '小户型装修实例_小户型家装案例_小户型装修案例-实创装饰集团官方网站';
                $this->keywords = '小户型装修实例,小户型家装案例,小户型装修案例,实创装饰集团官方网站';
                $this->description = '实创装饰集团官方网站的小户型装修实例栏目为您提供最新小户型装修案例，精美的小户型装修效果图，为您解决小户型装修装修过程中遇到的一系列问题。查找小户型装修的案例就上小户型装修实例栏目。';
                $this -> display();
         }
        /**
         *  新房|老房|小户型 调用的公共方法
         */
        public function oldnewhouse() {
                //城市分类  城市报价
                $map_citys = M('city')->field('AreaName')->group('AreaName')->select();
                $cityName = M('city')->field('DOMAIN,NAME,AreaName')->select();

                foreach ($map_citys as $k => $v) {
                        foreach ($cityName as $i => $r) {
                                if ($v['AreaName'] == $r['AreaName']) {
                                        $cityName[$i]['urls'] = $r['DOMAIN'] . '.sc.cc/';
                                        $cityName[$i]['anli_url'] = $r['DOMAIN'] . '.sc.cc/zhuangxiuanli/';
                                        $cityName[$i]['baojia_url'] = $r['DOMAIN'] . '.sc.cc/baojia/';
                                        $cityName[$i]['shejs_url'] = $r['DOMAIN'] . '.sc.cc/shejishi/';
                                        $cityName[$i]['xqzy_url'] = $r['DOMAIN'] . '.sc.cc/xiaoquzhuangxiu/';
                                        $cityName[$i]['lxz_url'] = $r['DOMAIN'] . '.sc.cc/lixiangzhuang/';
                                        $map_citys[$k]['area'][] = $cityName[$i];
                                }
                        }
                }

                $this->map_citys = $map_citys;
                //最新案例
                $this->cased = new_tuce(8);
                //老房最新文章
                $article = M('tbfitmentguide')->where(array('Status' => 1, 'ClassID' => 46))->field('ID,ClassID,Title,DefaultPicUrl,Intro,UpdateTime')->order('UpdateTime Desc')->limit(4)->select();

                foreach ($article as $k => $v) {
                        $res1 = M('tbfitmentguideclass')->where(array('ClassID' => $v['ClassID']))->field('Rewrite_Dir,ParentID')->find();
                        if ($res1['ParentID']) {
                                $res2 = M('tbfitmentguideclass')->where(array('ClassID' => $res1['ParentID']))->field('Rewrite_Dir,ParentID')->find();
                                $article[$k]['url'] = 'http://gonglue.sc.cc/' . $res2['Rewrite_Dir'] . '/' . $res1['Rewrite_Dir'] . '/' . $v['ID'] . '.html';
                        } else {
                                $article[$k]['url'] = 'http://gonglue.sc.cc/' . $res1['Rewrite_Dir'] . '/' . $v['ID'] . '.html';
                        }
                }
                $this->article = $article;

                //新房装修
                $newarticle = M('tbfitmentguide')->where(array('Status=1 and Title like "' . '%新房装修%' . '"'))->field('ID,ClassID,Title,DefaultPicUrl,Intro,UpdateTime')->order('UpdateTime Desc')->limit(4)->select();

                foreach ($newarticle as $k => $v) {
                        $res1 = M('tbfitmentguideclass')->where(array('ClassID' => $v['ClassID']))->field('Rewrite_Dir,ParentID')->find();
                        if ($res1['ParentID']) {
                                $res2 = M('tbfitmentguideclass')->where(array('ClassID' => $res1['ParentID']))->field('Rewrite_Dir,ParentID')->find();
                                $newarticle[$k]['url'] = 'http://gonglue.sc.cc/' . $res2['Rewrite_Dir'] . '/' . $res1['Rewrite_Dir'] . '/' . $v['ID'] . '.html';
                        } else {
                                $newarticle[$k]['url'] = 'http://gonglue.sc.cc/' . $res1['Rewrite_Dir'] . '/' . $v['ID'] . '.html';
                        }
                }
                $this->newarticle = $newarticle;

                //小户型装修文章
                 $xhxarticle =  M('tbfitmentguide')->where(array('Status' => 1, 'ClassID' => 157))->field('ID,ClassID,Title,DefaultPicUrl,Intro,UpdateTime')->order('UpdateTime Desc')->limit(4)->select();
                foreach ($xhxarticle as $k => $v) {
                        $res1 = M('tbfitmentguideclass')->where(array('ClassID' => $v['ClassID']))->field('Rewrite_Dir,ParentID')->find();
                        if ($res1['ParentID']) {
                                $res2 = M('tbfitmentguideclass')->where(array('ClassID' => $res1['ParentID']))->field('Rewrite_Dir,ParentID')->find();
                                $xhxarticle[$k]['url'] = 'http://gonglue.sc.cc/' . $res2['Rewrite_Dir'] . '/' . $res1['Rewrite_Dir'] . '/' . $v['ID'] . '.html';
                        } else {
                                $xhxarticle[$k]['url'] = 'http://gonglue.sc.cc/' . $res1['Rewrite_Dir'] . '/' . $v['ID'] . '.html';
                        }
                }
                $this->xhxarticle = $xhxarticle;
        }

        /**
         *   公共方法 【返回最新文章】
         */
        public function ruanzhuangfuc($ClassID,$limit=4)
        {
                $article = M('tbfitmentguide')->where(array('Status' => 1, 'ClassID' => $ClassID))->field('ID,ClassID,Title,DefaultPicUrl,Intro,UpdateTime')->order('UpdateTime Desc')->limit($limit)->select();

                foreach ($article as $k => $v) {
                        $res1 = M('tbfitmentguideclass')->where(array('ClassID' => $v['ClassID']))->field('Rewrite_Dir,ParentID')->find();
                        if ($res1['ParentID']) {
                                $res2 = M('tbfitmentguideclass')->where(array('ClassID' => $res1['ParentID']))->field('Rewrite_Dir,ParentID')->find();
                                $article[$k]['url'] = 'http://gonglue.sc.cc/' . $res2['Rewrite_Dir'] . '/' . $res1['Rewrite_Dir'] . '/' . $v['ID'] . '.html';
                        } else {
                                $article[$k]['url'] = 'http://gonglue.sc.cc/' . $res1['Rewrite_Dir'] . '/' . $v['ID'] . '.html';
                        }
                }
               return $article;
        }
        /**
         * [zhuangxiubaojiafuc description] 城市报价
         * @return [type] [description]
         */
        public function zhuangxiubaojiafuc()
        {
                         //城市分类  城市报价
                $map_citys = M('city')->field('AreaName')->group('AreaName')->select();
                $cityName = M('city')->field('DOMAIN,NAME,AreaName')->select();

                foreach ($map_citys as $k => $v) {
                        foreach ($cityName as $i => $r) {
                                if ($v['AreaName'] == $r['AreaName']) {
                                        $cityName[$i]['urls'] = $r['DOMAIN'] . '.sc.cc/';
                                        $cityName[$i]['anli_url'] = $r['DOMAIN'] . '.sc.cc/zhuangxiuanli/';
                                        $cityName[$i]['baojia_url'] = 'http://'.$r['DOMAIN'] . '.sc.cc/baojia/';
                                        $cityName[$i]['shejs_url'] = $r['DOMAIN'] . '.sc.cc/shejishi/';
                                        $cityName[$i]['xqzy_url'] = $r['DOMAIN'] . '.sc.cc/xiaoquzhuangxiu/';
                                        $cityName[$i]['lxz_url'] = $r['DOMAIN'] . '.sc.cc/lixiangzhuang/';
                                        $map_citys[$k]['area'][] = $cityName[$i];
                                }
                        }
                }

                return $map_citys;
        }
        /**
         * [tuceFuc description] 
         * @param  [type]  $area  [description]  面积
         * @param  integer $limit [description] 查询数据条数
         * @return [type]         [description]
         */
        public function tuceFuc($area=null,$num=3)
        {
                if(!empty($area)) $aread=$area+10;
                     $cased = M('casedecorate')->where(array('status' => 1,'AREA'=>array(array('egt',$area),array('lt',$aread))))->field('ID,Name,IMAGE,AREA,TYPEID,SID,UPDATETIME')->order('id Desc')->limit($num)->select();

                      foreach ($cased as $k => $v) {
                                $cased[$k]['url'] = 'http://zhuangxiuxiaoguotu.sc.cc/tuce-' . $v['ID'] . '.html';
                      }
                        return $cased;
        }

        /**
         * [yangbanjian description]  装修样板间
         * @return [type] [description]
         */
        public function yangbanjian()
        {       
                // echo "<pre>";
                $mt =I('mtu');
                
                //获取当前页面路径
                $shareUrl = $this -> _shareUrl($mt);
                //分配筛选路径
                $this -> styles=$shareUrl['style'];
                $this -> huxing = $shareUrl['huxing'];
                $this -> area =$shareUrl['area'];
                 //最新图册
                $this->tuce = new_tuce(8);
                //案例图片
                $data = $this->indexs(1, $keywords,$mt);
                //友情链接
                 $this->pindao = 2;
                 $this -> friend = D('Links')->getLinks(0, 202, 0);
                //城市装修报价
                $this -> map_citys =$this ->zhuangxiubaojiafuc();
                // print_r($this -> map_citys);
                $this->assign("totalCount", $data['totalCount']);
                $this->assign("numPerPage", $data['numPerPage']);
                $this->assign("currentPage", $data['currentPage']);
                $this->assign("page", $data['page']);
                $meituarray = $data['list'];
              
                $this->assign("meitulist", $meituarray);

                $this -> display();
        }

        public function _shareUrl($mtu){
                //取得当前地址例如：bj/xiaoguotu/meitu/oushi-60
                //oushi-liangju-60pingmi   
                 
                      if(isset($mtu)&&!empty($mtu)){
                             $mtu_arr = explode("-", $mtu); //将字符串转化为数组
                             $style_arr = M('housestyle')->distinct(true)->getField('FONT_PINYIN',true);//样式
                             $hu_arr = M('housetype')->getField('FONT_PINYIN',true);//户型
                             $area_arr =array('60pingmi', '90pingmi', '120pingmi', '160pingmi', '200pingmi', '1000pingmi');//面积
                            $map=array();//查询条件
                             $mtuCon = array();
                             //返回查询map 条件
                             foreach ($mtu_arr as $k => $v) {
                                   //判断查询条件在样式中
                                    if(in_array($mtu_arr[$k], $style_arr)){
                                        $sid =M('housestyle')->where("FONT_PINYIN='$mtu_arr[$k]'")->getField('ID');
                                        $sName =M('housestyle')->where("FONT_PINYIN='$mtu_arr[$k]'")->getField('FONTNAME');
                                        $map['casedecorate.SID']=$sid;
                                        $mtuCon['style']=$mtu_arr[$k];
                                        $mtuCon['sName']=$sName;//名称
                                    }
                                    //判断查询条件在户型中
                                    if(in_array($mtu_arr[$k], $hu_arr)){
                                        $typeid = M('housetype')->where("FONT_PINYIN='$mtu_arr[$k]'")->getField('ID');
                                        $tName = M('housetype')->where("FONT_PINYIN='$mtu_arr[$k]'")->getField('NAME');
                                        $map['casedecorate.TYPEID']=$typeid;
                                        $mtuCon['huxing']=$mtu_arr[$k];
                                        $mtuCon['sName']=$tName;//名称
                                    }
                                    //判断查询条件在面积
                                    if(in_array($mtu_arr[$k], $area_arr)){
                                             switch ($mtu_arr[$k]) {
                                                case '60pingmi':
                                                        $map['casedecorate.AREA'] = array('between', '1,60');
                                                        $mtuCon['area']=$mtu_arr[$k];
                                                         $mtuCon['aName']='60㎡以下';
                                                        break;
                                                case '90pingmi':
                                                        $map['casedecorate.AREA'] = array('between', '60,90');
                                                        $mtuCon['area']=$mtu_arr[$k];
                                                        $mtuCon['aName']='60-90㎡以下';
                                                        break;
                                                case '120pingmi':
                                                        $map['casedecorate.AREA'] = array('between', '90,120');
                                                        $mtuCon['area']=$mtu_arr[$k];
                                                         $mtuCon['aName']='90-120㎡以下';
                                                        break;
                                                case '160pingmi':
                                                        $map['casedecorate.AREA'] = array('between', '120,160');
                                                        $mtuCon['area']=$mtu_arr[$k];
                                                         $mtuCon['aName']='120-160㎡以下';
                                                        break;
                                                case '200pingmi':
                                                        $map['casedecorate.AREA'] = array('between', '160,200');
                                                        $mtuCon['area']=$mtu_arr[$k];
                                                         $mtuCon['aName']='160-200㎡以下';
                                                        break;
                                                case '1000pingmi':
                                                        $map['casedecorate.AREA'] = array('between', '200,1000');
                                                        $mtuCon['area']=$mtu_arr[$k];
                                                        $mtuCon['aName']='200㎡以上';
                                                        break;
                                             }
                                    }
                             }
                             
                        }
                      //户型风格
                      $style = M('housestyle')->distinct(true)->field('BACKNAME,FONTNAME,FONT_PINYIN')->select();
                      //户型
                      $huxing = M('housetype')->field('ID,NAME,FONT_PINYIN')->select();
                      $area = array(
                                 array('NAME'=>'60㎡以下','FONT_PINYIN'=> '60pingmi'),
                                 array('NAME'=>'60-90㎡以下','FONT_PINYIN'=> '90pingmi'),
                                 array('NAME'=>'90-120㎡','FONT_PINYIN'=> '120pingmi'),
                                 array('NAME'=>'120-160㎡','FONT_PINYIN'=> '160pingmi'),
                                 array('NAME'=>'160-200㎡','FONT_PINYIN'=> '200pingmi'),   
                                 array('NAME'=>'200㎡以上','FONT_PINYIN'=> '1000pingmi')
                        );
                
                $map['casedecorate.cityID']=$this -> city['ID'];
                $res =array('style'=>$style,'huxing'=>$huxing,'area'=>$area,'map'=>$map);
                $this ->mtuCon =$mtuCon;//将传入的参数分配到模板

                //分配TDK
                if($mtuCon){
                        $content=$mtuCon['sName'].$mtuCon['tName'].$mtuCon['aName'];
                        $this->title = $content.'样板间_'.$content.'装修样板间_实创'.$content.'样板间-实创装饰集团官方网站';
                        $this->keywords = '样板间,'.$content.'装修样板间,实创'.$content.'样板间,实创装饰集团官方网站';
                        $this->description = $content.'实创装饰官网'.$content.'样板间为您提供各种'.$content.'装修样板间的最新和最时尚的'.$content.'装修样板间的效果图，查找'.$content.'样板间就上实创'.$content.'装修样板间。';  
                }else{
                       $this->title = '装修样板间_家装样板间_样板间-实创装饰集团官方网站';
                        $this->keywords = '装修样板间,家装样板间,样板间,实创装饰集团官方网站';
                        $this->description = '实创装饰集团官方网站的装修样板间栏目拥有海量的实创装修样板间图片。涵盖客厅、卧室、厨房、卫生间、阳台、玄关、儿童房等多种装修样板间图片，帮助业主从这些样板间中找设计灵感。';    
                }
               return $res;
        }
    
          /*
         * 方法功能：展示案例列表信息  
         * 修改时间：2015年1月7日 Jean 
         */

        function indexs($n, $keywords,$mtu) {
                if (!empty($keywords)) {
                        //搜索框查询
                        $map = $this->seach_key($keywords, $n);
                        // $this->jubu_map= $this->seach_keyjubu($keywords,$n);
                        $this->jubu_map = $this->seach_keyjubu($keywords, $n);
                } else {
                        //并列条件查询
                        $res= $this->_shareUrl($mtu);    
                        $map=$res['map'];
                }


                if ($n != 2) {
                        $map['casedecorate.IS3D'] = $n;
                } else {
                        $map[] = ' 1 and 1 ';
                }

                $map['casedecorate.status'] = 1;

                //处理页码 
                //$p=1;
                if (!empty($_POST['pageNum'])) {
                        $p = $_POST['pageNum'];
                }
                $_GET['p'] = I('get.p', 1);
                
                //处理每页条数：
                if (!empty($_POST['numPerPage'])) {
                        $numPerPage = $_POST['numPerPage'];
                } else {
                        $numPerPage = 18;
                }

                //排序处理
                //获取当前城市ID，使当前城市的案例排在最前
                $sechType = I('get.mtu', '');
                $sechType = strtolower(trim(substr(strrchr($sechType, '/'), 1)));
                //var_dump($sechType);
                $this->assign('sechtype', $sechType);
                switch ($sechType) {
                        case m:
                                $order = "casedecorate.cityID = {$this->city['ID']} DESC,casedecorate.ID";
                                $jubuorder = "cityid = {$this->city['ID']} DESC,id ";
                                $sort = "desc";
                                break;
                        case h:
                                $order = "casedecorate.HITS";
                                $jubuorder = "hits ";
                                $sort = "desc";
                                break;
                        case t:
                                $order = "casedecorate.ID ";
                                $jubuorder = "id ";
                                $sort = "desc";
                                break;
                        default:
                                $order = "casedecorate.ID ";
                                $jubuorder = "id ";
                                $sort = "desc";
                                break;
                }


                // dump($map);
                $colorid = implode(',', $map['casedecorate.COLO_ID']['1']);
                // dump($colorid);
                if ($colorid) {
                        $homodel = M('housecolor');
                        $colorlist = implode(',', $homodel->where('PID in (' . $colorid . ')')->getField('COLO_ID', true));
                        $map['casedecorate.COLO_ID'] = array('in', $colorlist);
                }
       
                $mod = M("casedecorate");
                if ($n == 1) {
                        //3 D 样板
                        $select = $mod->where($map)->select();
                } elseif ($n == 2) {
                        //局部空间
                        $select = $mod->field("casedecorate.ID")->join('case_image on casedecorate.ID=case_image.CID')->where($map)->select();
                } elseif ($n == 3) {
                        // 20150723家装美图
                        $select = M('localspace')->where($this->jubu_map)->select();
                } else {
                       
                        //精美图册
                        $select = $mod->field("distinct(casedecorate.ID)")->join('case_image on casedecorate.ID=case_image.CID')->join('designer on casedecorate.DID=designer.ID')->where($map)->select();       
                }
                //var_dump( M()->getLastSql());

                $total = count($select);
               
                $page = new \Think\Page($total, $numPerPage);

                if ($n == 1) {
                        //获取3D案例列表信息
                        $list = $mod->field("ID,IMAGE,NAME,URL3D,SID,AREA,TYPEID")->where($map)->order($order . " " . $sort)->limit($page->firstRow . ',18')->select(); 
                         // echo $mod->getLastSql();
                } elseif ($n == 2) {
                        //获取案例局部列表信息
                      
                        $list = $mod->field("casedecorate.ID,casedecorate.NAME,casedecorate.IMAGE,casedecorate.PID,casedecorate.AREA,casedecorate.TYPEID,casedecorate.DID,casedecorate.ZAN,casedecorate.IS3D,casedecorate.HITS,casedecorate.DESCRIPTION,designer.LID,designer.Office,casedecorate.Cottage,designer.STATUS,case_image.HID,case_image.JID")->join('LEFT JOIN case_image on casedecorate.ID=case_image.CID')->join('LEFT JOIN designer on casedecorate.DID=designer.ID')->where($map)->group("casedecorate.ID")->order($order . " " . $sort)->limit($page->firstRow . ',' . $page->listRows)->select();
                        
                        foreach ($list as &$v) {
                           
                                if (array_key_exists('case_image.JID', $map)) {
                                        $v['IMAGE'] = M('case_image')->where('CID=' . $v['ID'] . ' AND JID=' . $v['JID'] . ' AND HID=' . $v['HID'])->getField('IMAGE');                                       
                                } else {
                                        $v['IMAGE'] = M('case_image')->where('CID=' . $v['ID'] . ' AND HID=' . $v['HID'])->getField('IMAGE');
                                }
                                
                        }
                        
                } elseif ($n == 3) {
                        //家装美图
                        // dump(M('localspace')->where($this->jubu_map)->order($jubuorder." ".$sort)->limit($page->firstRow.','.$page->listRows)->select());
                        $list = M('localspace')->where($this->jubu_map)->order($jubuorder . " " . $sort)->limit($page->firstRow . ',' . $page->listRows)->select();

                } else { 
                        //获取图片案例列表信息
                        $list = $mod->field("casedecorate.ID,casedecorate.CID,casedecorate.SID,casedecorate.NAME,casedecorate.IMAGE,casedecorate.PID,casedecorate.AREA,casedecorate.TYPEID,casedecorate.DID,casedecorate.ZAN,casedecorate.IS3D,casedecorate.HITS,casedecorate.DESCRIPTION,designer.LID,designer.Office,casedecorate.Cottage,designer.STATUS,case_image.HID")->join('LEFT JOIN case_image on casedecorate.ID=case_image.CID')->join('LEFT JOIN designer on casedecorate.DID=designer.ID')->where($map)->group("casedecorate.ID")->order($order . " " . $sort)->limit($page->firstRow . ',' . $page->listRows)->select();

                }
            
                $num = count($list);
                //分页显示
                $pages = $page->show();
                
               
                return $arr = array(
                    "totalCount" => $total,
                    "numPerPage" => $numPerPage,
                    "currentPage" => $p,
                    "page" => $pages,
                    "list" => $list,
                    "num" => $num,
                );
        }
}
