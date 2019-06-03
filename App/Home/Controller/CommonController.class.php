<?php

namespace Home\Controller;

use Think\Controller;

/**
 * 公共Action
 *
 */
class CommonController extends Controller {

        protected $city;
        protected $PromoterId;
        protected $PromoterName;
        protected $cityname;
        private $appkey;
        private $appsecret;
        protected $kujialeCity;

//在Controller类中构造方法执行后则会自动调用的方法。
        public function _initialize() {

 
        }

//定位城市
        function GetIpLookup($ip = '') {
                if (empty($ip)) {
                        $ip = $this->getip();
                }
                $info = $this->getcity_info($ip);
                if (!empty($info)) {
                        return $info;
                } else {
                        $res = file_get_contents('http://www.ip138.com/ips138.asp?ip=' . $ip . '&action=2');
                        $reg = '/class="ul1"><li>(.*)<\/li>/isU';
                        preg_match($reg, $res, $con);
//$con = 
                        $name = iconv('GB2312', 'UTF-8', $con[1]);
                        $city = M('city')->field('NAME,province,isshenghui')->select();
                        $info['city'] = '';
                        foreach ($city as $k => $v) {
                                if (strpos($name, $v['NAME'])) {
                                        $info['city'] = $v['NAME'];
                                        $this->ip_inputdata($ip, $v['NAME']);
                                        return $info;
                                }
                        }
                        if (empty($info['city'])) {
                                foreach ($city as $k => $v) {
                                        if (strpos($name, $v['province']) && $v['isshenghui'] == 1) {
                                                $this->ip_inputdata($ip, $v['NAME']);
                                                $info['city'] = $v['NAME'];
                                        }
                                }
                        }
                        return $info;
                }
        }

//        function GetIpLookup($ip = '') {
//                if (empty($ip)) {
//                        $ip = $this->getip();
//                }
//                //$ip = '27.191.128.78';
//                $res = file_get_contents('http://www.ip138.com/ips138.asp?ip='.$ip.'&action=2');
//                $reg = '/class="ul1"><li>(.*)<\/li>/isU';
//                preg_match($reg,$res,$con);
//                //$con = 
//                $name = iconv('GB2312','UTF-8',$con[1]);
//                $city = M('city')->field('NAME,province,isshenghui')->select();
//                $info['city'] = '';
//                //var_dump($city);
//                foreach($city as $k=>$v){
//                	if(strpos($name, $v['NAME'])){
//                		$info['city'] = $v['NAME']; 
//                		return $info;
//                	}
//                }
//                if(empty($info['city'])){
//                	foreach($city as $k=>$v){
//                		if(strpos($name, $v['province']) && $v['isshenghui'] == 1){
//                			$info['city'] = $v['NAME'];
//                		}
//                	}
//                }
//                return $info;
//                //老方法
//               /* 
//               // $ip = '222.35.90.66';
//				$info = M('cityip')->field('city')->where("ip='".$ip."'")->find();
//				//var_dump($info);exit;
//				if(!empty($info)){
//					return $info;
//				}else{
//
//					$res = @file_get_contents('http://api.map.baidu.com/location/ip?ak=U1pC2qp2xano5GDg1zsIlNuoUpUVbdhf&ip='.$ip.'&coor=bd09ll&qq-pf-to=pcqq.c2c');
//					
//					$infoarr = json_decode($res, true);
//					$info['city'] = str_replace('市', '', $infoarr['content']['address_detail']['city']);
//					$data['ip'] = $ip;
//					$data['city'] = $info['city'];
//					$data['x'] = $infoarr['content']['point']['x'];
//					$data['y'] = $infoarr['content']['point']['y'];
//					$data['province'] = $infoarr['content']['address_detail']['province'];
//					M('cityip')->add($data);
//					return $info;
//				}
//				$res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);
//                if (empty($res)) {
//                        return false;
//                }
//                $jsonMatches = array();
//                preg_match('#\{.+?\}#', $res, $jsonMatches);
//                if (!isset($jsonMatches[0])) {
//                        return false;
//                }
//                $json = json_decode($jsonMatches[0], true);
//                if (isset($json['ret']) && $json['ret'] == 1) {
//                        $json['ip'] = $ip;
//                        unset($json['ret']);
//                } else {
//                        return false;
//                }
//                return $json;
//                */
//        }
//访问量方法
        protected function vistlog($table, $visitfield, $id, $idfield) {
                $ip = $this->getip();
                if (!empty($ip)) {
                        $ipmodel = M('visitlogo');
                        $where['ip'] = $ip;
                        $where['did'] = $id;
                        $visit = $ipmodel->where($where)->find();
                        $date = date('Y-m-d');
                        $model = M($table);
                        $data['ip'] = $ip;
                        $data['dates'] = $date;
                        $data['did'] = $id;
                        if (empty($visit)) {
                                $ipmodel->add($data);
//更新访问量
                                $model->query("update $table set $visitfield=$visitfield+1 where $idfield=$id");
                        } else {
                                if ($visit['dates'] !== $date && $visit['did'] !== $id) {
//更新访问量
                                        $model->query("update $table set $visitfield=$visitfield+1 where $idfield=$id");
                                        $ipmodel->where(array('id' => $visit['id']))->save($data);
                                }
                        }
                }
        }

        function getip() {
                if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                        $online_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                        $online_ip = $_SERVER['HTTP_CLIENT_IP'];
                } else {
                        $online_ip = $_SERVER['REMOTE_ADDR'];
                }
                return $online_ip;
        }

// protected function getip() {
//        if (isset($_SERVER)) 
//        {
//                if (isset($_SERVER[HTTP_X_FORWARDED_FOR]) && strcasecmp($_SERVER[HTTP_X_FORWARDED_FOR], "unknown"))//代理
//                {
//                        $realip = $_SERVER[HTTP_X_FORWARDED_FOR];
//                } 
//                elseif(isset($_SERVER[HTTP_CLIENT_IP]) && strcasecmp($_SERVER[HTTP_CLIENT_IP], "unknown"))
//                {
//                        $realip = $_SERVER[HTTP_CLIENT_IP];
//                } 
//                elseif(isset($_SERVER[REMOTE_ADDR]) && strcasecmp($_SERVER[REMOTE_ADDR], "unknown"))
//                {
//                        $realip = $_SERVER[REMOTE_ADDR];
//                } 
//                else
//                {
//                        $realip = '';
//                }
//        } 
//        else
//        {
//                if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
//                {
//                        $realip = getenv("HTTP_X_FORWARDED_FOR");
//                }
//                elseif(getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
//                {
//                        $realip = getenv("HTTP_CLIENT_IP");
//                } 
//                elseif(getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
//                {
//                        $realip = getenv("REMOTE_ADDR");
//                } 
//                else
//                {
//                        $realip = '';
//                }
//        } 
//        return $realip;
// }
        protected function jump() {
                $arr = array('nanchang.sc.cc' => 'www.sc.cc/nc', 'hangzhou.sc.cc' => 'www.sc.cc/hz', 'xining.sc.cc' => 'www.sc.cc/xn', 'changchun.sc.cc' => 'www.sc.cc/cc', 'shanghai.sc.cc' => 'www.sc.cc/sh', 'guangzhou.sc.cc' => 'www.sc.cc/gz', 'hefei.sc.cc' => 'www.sc.cc/gf', 'chengdu.sc.cc' => 'www.sc.cc/cd', 'hanxdan.sc.cc' => 'www.sc.cc/hd', 'lanzhou.sc.cc' => 'www.sc.cc/lz', 'changsha.sc.cc' => 'www.sc.cc/cs', 'taiyuan.sc.cc' => 'www.sc.cc/ty', 'jinan.sc.cc' => 'www.sc.cc/jn', 'xian.sc.cc' => 'www.sc.cc/xa', 'wuhan.sc.cc' => 'www.sc.cc/wh', 'nanjing.sc.cc' => 'www.sc.cc/nj', 'yinchuan.sc.cc' => 'www.sc.cc/yc', 'haerbin.sc.cc' => 'www.sc.cc/heb', 'huhehaote.sc.cc' => 'www.sc.cc/hhht', 'yantai.sc.cc' => 'www.sc.cc/yt', 'qingdao.sc.cc' => 'www.sc.cc/qd', 'shijiazhuang.sc.cc' => 'www.sc.cc/sjz', 'shenyang.sc.cc' => 'www.sc.cc/sy', 'qinhuangdao.sc.cc' => 'www.sc.cc/qhd', 'tangshan.sc.cc' => 'www.sc.cc/ts', 'zhengzhou.sc.cc' => 'www.sc.cc/zz', 'tianjin.sc.cc' => 'www.sc.cc/tj');
                $server = $_SERVER['SERVER_NAME'];
                if ($server != 'www.sc.cc') {

                        Header("HTTP/1.1 301 Moved Permanently");
                        Header("Location: http://" . $arr[$server]);
                }
        }

        protected function bmadd($data) {

                $data = $this->objectToArray($data);
                $model = M("reservation_construction");
                $datas = array();
                foreach ($data as $k => $v) {
                        $v = strip_tags($v);
                        $datas[$k] = check_input($v);
                }
                $data = $datas;
//验证手机
                $reg = '/^[1][0-9][0-9]{9}$/';
                if (!preg_match($reg, $data['PHONE'])) {
                        $regzj = '/^[0-9]*\-\d?/';//座机
                        if (!preg_match($regzj, $data['PHONE'])) {
                                return 0;
                                exit;
                        }
                }
//是否已报名
                $isbm = $model->where(array('PHONE' => $data['PHONE'], 'TYPE' => $data['TYPE']))->find();
                if (!empty($isbm)) {
                        return 0;
                        exit;
                }
                $now = date('Y-m-d H:i:s');
                $ip = $this->getip();
                $history = $model->where(array('ip' => $ip))->order('addtime desc')->find();
                if (!empty($history)) {
                        $historytime = strtotime($history['addtime']);
                        if ((time() - $historytime) < 5) {
                                return 0;
                                exit;
                        }
                }
                if ($data['NAME'] == '88888') {
                        return 0;
                        exit;
                }
//对渠道来源的cookie支持

                $utm = cookie('utm');
                if (empty($data['qudao']) && !empty($utm['utm_source']) && $utm['utm_term'] != 'tuiguangyuan') {
                        $data['qudao'] = $utm['utm_source'];
                }
                if (empty($data['utm_term']) && !empty($utm['utm_term']) && $utm['utm_term'] != 'tuiguangyuan') {
                        $data['utm_term'] = $utm['utm_term'];
                }
                if (!empty($utm['utm_term']) && !empty($utm['utm_source']) && $utm['utm_term'] == 'tuiguangyuan') {
                        $tgy = M('tbpromoter')->where('id=' . $utm['utm_source'])->find();
                        $data['CID'] = $tgy['CityID'];
                        $data['PromoterId'] = $utm['utm_source'];
                }
                $data['ip'] = $this->getip();
                $data['addtime'] = $now;
                $id = $model->add($data);
                if ($data['PHONE'] == 15112999999) {
//var_dump(M()->getlastsql());exit;
                }
                return $id;
        }

        public function index() {
//列表过滤器，生成查询Map对象
                $map = $this->_search();
                if (method_exists($this, '_filter')) {
                        $this->_filter($map);
                }
//判断采用自定义的Model类
                if (!defined(CONTROLLER_NAME)) {
                        $model = D(CONTROLLER_NAME);
                }

                if (!empty($model)) {
                        $this->_list($model, $map);
                }
                $this->display();
                return;
        }

        /**
         * 根据表单生成查询条件
         * 进行列表过滤
         * @param string $name 数据对象名称
         * @return HashMap
         */
        protected function _search($name = '') {
//生成查询条件
                if (empty($name)) {
                        $name = CONTROLLER_NAME;
                }
                $model = M($name);
                $map = array();
                foreach ($model->getDbFields() as $key => $val) {
                        if (substr($key, 0, 1) == '_')
                                continue;
                        if (isset($_REQUEST[$val]) && $_REQUEST[$val] != '') {
                                $map[$val] = $_REQUEST[$val];
                        }
                }
                return $map;
        }

        /**
         * 根据表单生成查询条件
         * 进行列表过滤
         * @param Model $model 数据对象
         * @param HashMap $map 过滤条件
         * @param string $sortBy 排序
         * @param boolean $asc 是否正序
         */
        protected function _list($model, $map = array(), $sortBy = '', $asc = false, $pnum = '') {


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


//设置当前页码
                if (!empty($_REQUEST['p'])) {
                        $nowPage = $_REQUEST['p'];
                } else {
                        $nowPage = 1;
                }
                $_GET['p'] = $nowPage;

//创建分页对象
                $p = new \Think\Page($count, $listRows);


//分页查询数据
                $list = $model->where($map)->order($order . ' ' . $sort)
                        ->limit($p->firstRow . ',' . $p->listRows)
                        ->select();

//回调函数，用于数据加工，如将用户id，替换成用户名称
                if (method_exists($this, '_tigger_list')) {
                        $this->_tigger_list($list);
                }


//分页跳转的时候保证查询条件
//foreach ($map as $key => $val) {
//if (!is_array($val)) {
//$p->parameter .= "$key=" . urlencode($val) . "&";
//}
// }
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

        protected function entry($data, $id = 0) {
                $data = $this->objectToArray($data);
                $user = array();
                if (empty($data['uid'])) {
                        $user = M("users")->where(array('mobilephone' => $data['PHONE']))->find();

                        if (empty($user)) {
                                $pass = rand(111111, 999999);
                                $datas['mobilephone'] = $data['PHONE'];
                                $datas['username'] = $data['NAME'];
                                $datas['registerTime'] = date('Y-m-d H:i:s');
                                $datas['password'] = MD5($pass);
                                $datas['CID'] = $data['CID'];
                                $datas['Promoterid'] = $data['PromoterId'];
                                $id = M("users")->add($datas);
                                $user = M("users")->where(array('mobilephone' => $data['PHONE']))->find();
                        }
                }
                $_SESSION[C('SESSION_USER_KEY')] = $user;
//短信发送
                $msg = '【实创装饰】您好，您在实创官网（www.sc.cc）的登陆名：' . $data['PHONE'] . '，密码是：' . $pass . '，请您妥善保管。整体家装688元/㎡详询实创官网。';
                //新版发送短信
                sendSMS($datas['mobilephone'], $msg);
                return $user;
        }

        protected function objectToArray($e) {
                $e = (array) $e;
                foreach ($e as $k => $v) {
                        if (gettype($v) == 'resource')
                                return;
                        if (gettype($v) == 'object' || gettype($v) == 'array')
                                $e[$k] = (array) objectToArray($v);
                }
                return $e;
        }

        /**
         * 酷家乐单点登陆
         */
        public function sigleLogin($params = array()) {
                $options = array(
                    'appuid' => 0, // 用户id
                    'appuname' => '', // 用户名
                    'appuemail' => '', // 用户邮箱
                    'appuphone' => '', // 用户手机号
                    'appussn' => '', // 用户身份证
                    'appuaddr' => '', // 用户地址
                    'appuavatar' => '', // 头像
                    'apputype' => 1, // 0表示这个单点登录的账号需要开通酷家乐的虚拟体验馆后台管理权限，1表示这个账号只是作为酷家乐的普通用户存在
                    'dest' => 0,
                    'designid' => 0,
                    'planid' => 0,
                    'apputype' => 0,
                );

                if (is_array($params) && !empty($params)) {
                        $options = array_merge($options, $params);
                }
// print_r($options);die;
                extract($options);
                unset($params);

// API地址，生产环境域名对应为www.kujiale.com
                $apiUrl = $this->kujialeDomain . "/p/openapi/login";

// 取得13位时间戳
                $timestamp = self::getMillisecond(13, '') + 456000;

// 签名加密
                $sign = md5($this->appsecret . $this->appkey . $appuid . $timestamp);
// 拼装参数
                $params = array(
                    'appkey' => $this->appkey,
                    'timestamp' => $timestamp,
                    'appuid' => $appuid,
                    'sign' => $sign,
                    'appuname' => $appuname,
                    'appuemail' => $appuemail,
                    'appuphone' => $appuphone,
                    'appussn' => $appussn,
                    'appuaddr' => $appuaddr,
                    'appuavatar' => $appuavatar,
                    'dest' => $dest,
                    'apputype' => $apputype,
                );
                if ($designid) {
                        $params['designid'] = $designid;
                }
                if ($planid) {
                        $params['planid'] = $planid;
                }
//                if($appuid == 14113){
                $url = $apiUrl . '?timestamp=' . $timestamp . '&sign=' . $sign . '&appuid=' . $appuid . '&appkey=' . $this->appkey . '&appuname=' . $appuname;
                $url.= "&appuemail=" . $appuemail . "&appuphone=" . $appuphone . '&appussn=' . $appussn . '&appuaddr=' . $appuaddr . '&appuavatar=' . $appuavatar . '&dest=' . $dest . '&apputype=' . $apputype;
//                  echo $url;die;
//                }
                $data = self::getCurl($apiUrl, $params, 'POST');

                return $data;
        }

        /**
         * 由户型图生成一个3D方案
         */
        public function generating3DUnits($params = array()) {
                $options = array(
                    'appuid' => 0,
                    'planid' => 0,
                );

                if (is_array($params) && !empty($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);
                unset($params);

// API地址，生产环境域名对应为www.kujiale.com
                $apiUrl = $this->kujialeDomain . "/p/openapi/design";
// 取得13位时间戳
                $timestamp = self::getMillisecond(13, time()) + 456000;
// 签名加密
                $sign = md5($this->appsecret . $this->appkey . $appuid . $timestamp);

                $apiUrl .= '?timestamp=' . $timestamp . '&appkey=' . $this->appkey . '&sign=' . $sign . '&planid=' . $planid . '&appuid=' . $appuid;

// $data  = self::getCurl($apiUrl,array(),'GET');
// 返回参数为字符串，需单独请求
                $ch = curl_init();   // 初始化
                curl_setopt($ch, CURLOPT_URL, $apiUrl); //请求地址
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HTTPGET, true);
                $data = curl_exec($ch);
                curl_close($ch);
                return $data;
        }

        /**
         * 获取指定方案的渲染图列表
         */
        public function RenderingList($params = array()) {
                $options = array(
                    'designid' => '', // 酷家乐3D方案id
                    'starttime' => '', // 起始时间 如果此参数不为空，则获取当前时间之后的数据
                );

                if (!empty($params) && is_array($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);
                unset($params);
// 获取13位时间戳
                $timestamp = self::getMillisecond(13, '') + 456000;
// 	获取13位起始时间戳
                if (!$starttime) {
                        $starttime = $timestamp - 300 * 24 * 3600 * 1000;
                } else {
                        $starttime = self::getMillisecond(13, $starttime);
                }

// 签名加密
                $sign = md5($this->appsecret . $this->appkey . $timestamp);

                $apiUrl = $this->kujialeDomain . '/p/openapi/design/' . $designid . '/renderpics?starttime=' . $starttime . '&sign=' . $sign . '&timestamp=' . $timestamp;
                $apiUrl .= '&appkey=' . $this->appkey;

// $data = self::curlGet($apiUrl);
                $data = self::getCurl($apiUrl, array(), 'GET');
// print_r($data);die;
                return $data;
        }

        /**
         * 	获取指定方案的户型图
         */
        public function getApartmentLayout($params = array()) {
                $options = array(
                    'designid' => 0,
                );

                if (!empty($params) && is_array($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);

                $data = array();
                if ($designid) {
                        $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位的时间戳
                        $sign = md5($this->appsecret . $this->appkey . $timestamp); // 签名加密
                        $apiUrl = $this->kujialeDomain . '/p/openapi/design/' . $designid . '&appkey=' . $this->appkey . '&timestamp=' . $timestamp . '&sign=' . $sign;
// $data      = self::curlGet($apiUrl);
                        $data = self::getCurl($apiUrl, array(), 'GET');
                }
                return $data;
        }

        /**
         * 	获取指定方案的装修清单
         */
        public function getDecorationList($params = array()) {
                $options = array(
                    'designid' => 0,
                    'start' => 0,
                    'num' => 0,
                );
                if (!empty($params) && is_array($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);

                $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                $sign = md5($this->appsecret . $this->appkey . $timestamp); // 签名加密
                $apiUrl = $this->kujialeDomain . ';/p/openapi/design/' . $designid . '/itemlist?start=' . $start . '&num=' . $num . '&appkey=' . $this->appkey . '&timestamp=' . $timestamp . '&sign=' . $sign;
                $data = array();
                if ($designid) {
// $data = self::curlGet($apiUrl);
                        $data = self::getCurl($apiUrl, array(), 'GET');
                }
                return $data;
        }

        /**
         * 删除方案
         */
        public function deleteDesign($params = array()) {
                $options = array(
                    'designid' => 0,
                );
                if (!empty($params) && is_array($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);

                $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                $sign = md5($this->appsecret . $this->appkey . $timestamp); // 签名加密
                $apiUrl = $this->kujialeDomain . '/p/openapi/design/' . $designid . '?timestamp=' . $timestamp . '&appkey=' . $this->appkey . '&sign=' . $sign;
//                $params = array('timestamp' => $timestamp, 'appkey' => $this->appkey, 'sign' => $sign);
//            print_r($params);die;
//                 .'?timestamp='.$timestamp.'&appkey='.$this->appkey.'&sign='.$sign;
                $data = array();
                if ($designid) {
                        $data = self::getCurl($apiUrl, array(), 'DELETE', 1);
                }
                return $data;
        }

        /**
         * 	获取指定用户的3D方案列表
         */
        public function getAppoint3DList($params = array()) {
                $options = array(
                    'appuid' => 0, // 用户id
                    'start' => 0, // 起始位置
                    'num' => 0, // 数量
                );

                if (is_array($params) && !empty($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);
                $data = array();
                if ($appuid) {
                        $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                        $sign = md5($this->appsecret . $this->appkey . $appuid . $timestamp); // 签名加密
                        $apiUrl = $this->kujialeDomain . '/p/openapi/user/design?start=' . $start . '&num=' . $num . '&appkey=' . $this->appkey . '&appuid=' . $appuid . '&timestamp=' . $timestamp . '&sign=' . $sign;
// $data  = self::curlGet($apiUrl);
                        $data = self::getCurl($apiUrl, array(), 'GET');
                }
                return $data;
        }

        /**
         * 获取指定3D渲染方案的副本
         */
        public function getRenderGraphCopy($params = array()) {
                $options = array(
                    'designid' => 0,
                    'appuid' => 0,
                );
                if (is_array($params) && !empty($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);
                $data = array();
                if ($appuid && $designid) {
                        $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                        $sign = md5($this->appsecret . $this->appkey . $appuid . $timestamp); // 签名加密
                        $apiUrl = $this->kujialeDomain . '/p/openapi/design/' . $designid . '/copy?appkey=' . $this->appkey . '&timestamp=' . $timestamp . '&sign=' . $sign . '&appuid=' . $appuid;
// $data      = self::curlGet($apiUrl);
                        $data = self::getCurl($apiUrl, array(), 'GET');
                }
                return $data;
        }

        /**
         * 获取指定3D渲染方案的基本数据
         */
        public function getRenderingBasicData($params = array()) {
                $options = array(
                    'designid' => 0,
                );
                if (is_array($params) && !empty($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);

                $data = array();
                if ($designid) {
                        $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                        $sign = md5($this->appsecret . $this->appkey . $timestamp); // 签名加密
                        $apiUrl = $this->kujialeDomain . '/p/openapi/design/' . $designid . '?appkey=' . $this->appkey . '&timestamp=' . $timestamp . '&sign=' . $sign;
// $data 	   = self::curlGet($apiUrl);
                        $data = self::getCurl($apiUrl, array(), 'GET');
                }
                return $data;
        }

        /**
         * 更新3D渲染方案的名字
         */
        public function updateRenderingName($params = array()) {
                $options = array(
                    'designid' => 0,
                    'name' => '', // 修改的名字
                );
                if (is_array($params) && !empty($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);

                $data = array();
                if ($designid) {
                        $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                        $sign = md5($this->appsecret . $this->appkey . $timestamp); // 签名加密
                        $apiUrl = $this->kujialeDomain . '/p/openapi/design/' . $designid;
                        $params = "timestamp=" . $timestamp . "&name=" . $name . "&appkey=" . $this->appkey . "&sign=" . $sign;
//                        $params = array( 'timestamp' => $timestamp, 'name' => $name,  'appkey' => $this->appkey, 'sign' => $sign);
                        $data = self::getCurl($apiUrl, $params, 'PUT', 1);
                }
                return $data;
        }

        /**
         * 全屋漫游图生成接口
         * picids：指定的同一方案中的若干全景图的ID，用英文逗号拼接，格式为"3FO4JVCAJI54,3FO4JVBUVOAQ"。第一个ID默认为全屋漫游的起始图。其中图片ID在“获取指定方案的渲染图列表”接口中可以获得，全景图ID即为在“获取指定方案的渲染图列表”接口中picType字段为1的picId。
         */
        public function roamingGeneration($params = array()) {
                $options = array(
                    'picids' => '',
                    'override' => false, // 是否覆盖之前已生成的全屋漫游图 false:不覆盖 true:覆盖
                );
                if (is_array($params) && !empty($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);
                unset($params);
                $data = array();
                if ($picids) {
                        $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                        $sign = md5($this->appsecret . $this->appkey . $timestamp); // 签名加密
                        $apiUrl = $this->kujialeDomain . '/p/openapi/pano';
                        $params = array(
                            'timeStamp' => $timestamp,
                            'sign' => $sign,
                            'appkey' => $this->appkey,
                            'picids' => $picids,
                            'override' => $override,
                        );
                        $data = self::getCurl($apiUrl, $params, 'POST', 1);
                }
                return $data;
        }

        /**
         * 获取指定户型的基本数据
         */
        public function getFloorplanInfo($params = array()) {
                $options = array(
                    'planid' => 0,
                );
                if (is_array($params) && !empty($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);
                $data = array();
                if ($planid) {
                        $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                        $sign = md5($this->appsecret . $this->appkey . $timestamp); // 签名加密
                        $apiUrl = $this->kujialeDomain . '/p/openapi/floorplan/' . $planid . '/info' . '?appkey=' . $this->appkey . '&timestamp=' . $timestamp . '&sign=' . $sign;
// $data      = self::curlGet($apiUrl);
                        $data = self::getCurl($apiUrl, array(), 'GET');
                }
                return $data;
        }

        /**
         * 获取指定户型图的房间数据
         */
        public function getRoomplanInfo($params = array()) {
                $options = array(
                    'planid' => 0, // 酷家乐户型图ID
                );
                if (is_array($params) && !empty($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);

                $data = array();
                if ($planid) {
                        $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                        $sign = md5($this->appsecret . $this->appkey . $timestamp); // 签名加密
                        $apiUrl = $this->kujialeDomain . '/p/openapi/floorplan/' . $planid . '/roominfo?timestamp=' . $timestamp . '&sign=' . $sign . '&appkey=' . $this->appkey;
// $data      = self::curlGet($apiUrl);
                        $data = self::getCurl($apiUrl, array(), 'GET');
                }
                return $data;
        }

        /**
         * 删除户型图
         */
        public function deleteFloorplan($params = array()) {
                $options = array(
                    'planid' => 0,
                );
                if (!empty($params) && is_array($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);
                $data = array();
                if ($planid) {
                        $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                        $sign = md5($this->appsecret . $this->appkey . $timestamp); // 签名加密
                        $apiUrl = $this->kujialeDomain . '/p/openapi/floorplan/' . $planid;
                        $params = array('timestamp' => $timestamp, 'sign' => $sign, 'appkey' => $this->appkey);
                        $data = self::getCurl($apiUrl, $params, 'DELETE');
                }
                return $data;
        }

        /**
         * 获取用户下的户型图数据
         */
        public function getUserPlanInfo($params = array()) {
                $options = array(
                    'appuid' => 0,
                    'start' => 0,
                    'num' => 0,
                );
                if (is_array($params) && !empty($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);
                $data = array();
                if ($appuid) {
                        $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                        $sign = md5($this->appsecret . $this->appkey . $appuid . $timestamp); // 签名加密
                        $apiUrl = $this->kujialeDomain . '/p/openapi/user/floorplan?start=' . $start . '&num=' . $num . '&appuid=' . $appuid . '&sign=' . $sign . '&appkey=' . $this->appkey . '&timestamp=' . $timestamp;
                        $data = self::getCurl($apiUrl, array(), 'GET');
                }
                return $data;
        }

        /**
         * 获取指定户型图的副本
         */
        public function getUserPlanCopy($params = array()) {
                header('Content-type: text/plain;charset=UTF-8');
                $options = array(
                    'planid' => 0,
                    'appuid' => 0,
                );
                if (is_array($params) && !empty($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);
                $data = '';
                if ($appuid) {
                        $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                        $sign = md5($this->appsecret . $this->appkey . $appuid . $timestamp); // 签名加密
                        $apiUrl = $this->kujialeDomain . '/p/openapi/floorplan/' . $planid . '/copy?timestamp=' . $timestamp . '&appuid=' . $appuid . '&sign=' . $sign . '&appkey=' . $this->appkey;
// 返回参数为字符串，需单独请求
                        $ch = curl_init();   // 初始化
                        curl_setopt($ch, CURLOPT_URL, $apiUrl); //请求地址
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_HTTPGET, true);
                        $data = curl_exec($ch);
                        curl_close($ch);
                }
                return $data;
        }

        /**
         * 更新户型图名字
         */
        public function updatePlanName($params = array()) {
                $options = array(
                    'planid' => 0,
                    'name' => '',
                );
                if (is_array($params) && !empty($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);
                $data = array();
                if ($planid) {
                        $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                        $sign = md5($this->appsecret . $this->appkey . $timestamp); // 签名加密
                        $apiUrl = $this->kujialeDomain . '/p/openapi/floorplan/' . $planid;
                        $params = 'name=' . $name . '&timestamp=' . $timestamp . '&appkey=' . $this->appkey . '&sing=' . $sign;
//                        $params = array('name' => $name, 'timestamp' => $timestamp, 'sign' => $sign, 'appkey' => $this->appkey);
                        $data = self::getCurl($apiUrl, $params, 'PUT', 1);
                }
                return $data;
        }

        /**
         * 获取酷家乐城市列表
         */
        public function getCityInfo() {
                $timestamp = self::getMillisecond(13, '') + 456000 + 456000; // 获取13位时间戳
                $sign = md5($this->appsecret . $this->appkey . $timestamp); // 签名加密
                $apiUrl = $this->kujialeDomain . '/p/openapi/city?timestamp=' . $timestamp . '&appkey=' . $this->appkey . '&sign=' . $sign;

                $data = self::getCurl($apiUrl, array(), 'GET');
                return $data;
        }

        /**
         * 搜索户型图接口
         */
        public function searchFloorplan($params = array()) {
                $options = array(
                    'name' => '', // 查询词
                    'start' => 0,
                    'num' => 0,
                    'cityid' => 0,
                );
                if (is_array($params) && !empty($params)) {
                        $options = array_merge($options, $params);
                }

                extract($options);
                $data = array();
                if ($name) {
                        $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                        $timestamp +=1456000;
                        $sign = md5($this->appsecret . $this->appkey . $timestamp); // 签名加密
                        $apiUrl = $this->kujialeDomain . '/p/openapi/floorplan?timestamp=' . $timestamp . '&q=' . $name . '&start=' . $start . '&num=' . $num . '&cityid=' . $cityid . '&sign=' . $sign . '&appkey=' . $this->appkey;

                        $data = self::getCurl($apiUrl, array(), 'GET');
                }
                return $data;
        }

        /**
         * 获取户型评测结果
         */
        public function getRoomEvaluating($params = array()) {
                $options = array(
                    'planid' => 0,
                );
                if (is_array($params) && !empty($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);

                $data = array();
                if ($planid) {
                        $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                        $timestamp += '456000';
                        $sign = md5($this->appsecret . $this->appkey . $timestamp); // 签名加密
                        $apiUrl = $this->kujialeDomain . '/p/openapi/floorplan/' . $planid . '/evaluation?timestamp=' . $timestamp . '&sign=' . $sign . '&appkey=' . $this->appkey;
                        $data = self::getCurl($apiUrl, array(), 'GET');
                }
                return $data;
        }

        /**
         * 获取模型分类
         */
        public function getModelType() {
                $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                $sign = md5($this->appsecret . $this->appkey . $timestamp); // 签名加密
                $apiUrl = $this->kujialeDomain . '/p/openapi/model/cats?timestamp=' . $timestamp . '&sign=' . $sign . '&appkey=' . $this->appkey;
                $data = array();
// $data      = self::curlGet($apiUrl);
                $data = self::getCurl($apiUrl, array(), 'GET');

                return $data;
        }

        /**
         * 根据模型分类获取模型列表
         */
        public function getModelTypeForModelList($params = array()) {
                $options = array(
                    'catid' => 0, // 获取模型分类“接口中获取到的id
                    'start' => 0,
                    'num' => 0,
                );
                if (is_array($params) && !empty($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);
                $data = array();
                if ($catid) {
                        $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                        $sign = md5($this->appsecret . $this->appkey . $timestamp); // 签名加密
                        $apiUrl = $this->kujialeDomain . '/p/openapi/model?catid=' . $catid . '&start=' . $start . '&num=' . $num . '&timestamp=' . $timestamp . '&sign=' . $sign . '&appkey=' . $this->appkey;
// $data      = self::curlGet($apiUrl);
                        $data = self::getCurl($apiUrl, array(), 'GET');
                }
                return $data;
        }

        /**
         * 收藏模型的接口
         */
        public function doCollectingModel($params = array()) {
                $options = array(
                    'appuid' => 0,
                    'bid' => 0, // 酷家乐模型的id，在商家调用”获取模型列表“的接口当中返回
                );
                if (is_array($params) && !empty($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);
                unset($params);
                $data = array();
                if ($appuid && $bid) {
                        $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                        $sign = md5($this->appsecret . $this->appkey . $appuid . $timestamp); // 签名加密

                        $apiUrl = $this->kujialeDomain . '/p/openapi/model/collection';
                        $params = array(
                            'appkey' => $this->appkey,
                            'timestamp' => $timestamp,
                            'appuid' => $appuid,
                            'sign' => $sign,
                            'bid' => $bid,
                        );
// $data = self::curlPost($params);
                        $data = self::getCurl($apiUrl, $params, 'POST');
                }
                return $data;
        }

        /**
         * 取消收藏模型的接口 // DELETE
         */
        public function doCancelCollectingModel($params = array()) {
                $options = array(
                    'appuid' => 0,
                    'bid' => 0, // 酷家乐模型的id，在商家调用”获取模型列表“的接口当中返回
                );
                if (is_array($params) && !empty($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);
                unset($params);
                $data = array();
                if ($appuid && $bid) {
                        $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                        $sign = md5($this->appsecret . $this->appkey . $appuid . $timestamp); // 签名加密

                        $apiUrl = $this->kujialeDomain . '/p/openapi/model/collection';
                        $params = array(
                            'appkey' => $this->appkey,
                            'timestamp' => $timestamp,
                            'appuid' => $appuid,
                            'sign' => $sign,
                            'bid' => $bid,
                        );
// $data = self::curlPost($params);
                        $data = self::getCurl($apiUrl, $params, 'DELETE');
                }
                return $data;
        }

        /**
         * 更新模型信息的接口
         */
        public function updateModelInfo($params = array()) {
                $options = array(
                    'modelid' => 0, // 模型id，和“根据模型分类获取模型列表”接口中返回的模型数据中“obsId”字段一致
                    'name' => '', // 可选参数，要更改的模型名字
                    'unitprice' => '', // 可选参数，要更改的模型的单价
                    'produrl' => '', // 可选参数，要更改的模型的商品链接
                    'note' => '', // 可选参数，要更改的模型的备注文字
                    'catid' => '', // 可选参数，要更改的模型的类别id，即“获取模型分类”接口中的id字段。可以将指定模型归类到该catid表示的类别下
                    'brandgoodcode' => '', // 可选参数，要更改的模型的在商家自己系统中的产品编码
                );
                if (is_array($params) && !empty($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);
                unset($params);
                $data = array();
                if ($modelid) {
                        $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                        $sign = md5($this->appsecret . $this->appkey . $timestamp); // 签名加密
                        $apiUrl = $this->kujialeDomain . '/p/openapi/model/' . $modelid;
                        $params = 'timestamp=' . $timestamp . '&sign=' . $sign . '&appkey=' . $this->appkey . '&name=' . $name . '&unitprice=' . $unitprice . '&produrl=' . $produrl . '&note=' . $note . '&catid=' . $catid . '&brandgoodcode=' . $brandgoodcode;
                        $data = self::getCurl($apiUrl, $params, 'PUT', 1);
                }
                return $data;
        }

        /**
         * 拉取所有单点登录账号酷币数据
         */
        public function getAllKubi($params = array()) {
                $options = array(
                    'start' => 0,
                    'num' => 0,
                );
                if (is_array($params) && !empty($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);
                $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                $sign = md5($this->appsecret . $this->appkey . $timestamp); // 签名加密
                $apiUrl = $this->kujialeDomain . '/p/openapi/kubi?start=' . $start . '&num=' . $num . '&sign=' . $sign . '&timestamp=' . $timestamp . '&appkey=' . $this->appkey;
// $data      = self::curlGet($apiUrl);
                $data = self::getCurl($apiUrl, array(), 'GET');

                return $data;
        }

        /**
         * 获取指定商家用户的酷币数
         */
        public function getUserKubi($params = array()) {
                $options = array(
                    'appuid' => 0,
                );
                if (is_array($params) && !empty($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);
                $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                $sign = md5($this->appsecret . $this->appkey . $appuid . $timestamp); // 签名加密
                $apiUrl = $this->kujialeDomain . '/p/openapi/kubi?appuid=' . $appuid . '&sign=' . $sign . '&timestamp=' . $timestamp . '&appkey=' . $this->appkey;
// $data      = self::curlGet($apiUrl);
                $data = self::getCurl($apiUrl, array(), 'GET');

                return $data;
        }

        /**
         * 分配酷币
         */
        public function doDistributionkubi($params = array()) {
                $options = array(
                    'appuid' => 0, // 要分配的对象用户ID
                    'amount' => 0, // 要分配的酷币数量
                    'incr' => true, // true或false，true表示分配给用户{amount}数量的酷币数，false表示从用户收回{amount}数量的酷币数
                );
                if (is_array($params) && !empty($params)) {
                        $options = array_merge($options, $params);
                }
                extract($options);
                unset($params);
                $data = array();
                if ($appuid) {
                        $timestamp = self::getMillisecond(13, '') + 456000; // 获取13位时间戳
                        $sign = md5($this->appsecret . $this->appkey . $appuid . $timestamp); // 签名加密
                        $apiUrl = $this->kujialeDomain . '/p/openapi/kubi';
                        $params = 'timestamp&=' . $timestamp . '&sign=' . $sign . '&appkey=' . $this->appkey . 'appuid=' . $appuid . '&amount=' . $amount . '&incr=' . $incr;
                        $data = self::getCurl($apiUrl, $params, 'PUT', 1);
                }
                return $data;
        }

        /**
         * 获取13位时间戳（精确到微秒）
         *
         * @author yangyb
         * @date  2016-03-22
         */
        private static function getMillisecond($digits = false, $time = '') {

                $digits = $digits > 10 ? $digits : 10;  // 时间戳长度
                $digits = $digits - 10;

                if ($time) {
                        $time = $time;
                } else {
                        $time = time();
                }

                if ((!$digits) || ($digits == 10)) {
                        return time();
                } else if (!is_numeric($time)) {
                        $today = $time;
                        $timeStr = strtotime($today);
                } else {
                        $timeStr = microtime(true);
                }

                return number_format($timeStr, $digits, '', '');
        }

        /**
         * curl 请求
         */
        public static function getCurl($url = '', $params = array(), $type = '', $success = 0) {

                $ch = curl_init();   // 初始化
                curl_setopt($ch, CURLOPT_URL, $url); //请求地址
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_TIMEOUT, 120); // 设置超时时间
                switch ($type) {
                        case 'GET':
                                curl_setopt($ch, CURLOPT_HTTPGET, true);
                                break;
                        case 'POST':
                                curl_setopt($ch, CURLOPT_POST, true);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                                break;
                        case 'PUT':
                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                                break;
                        case 'DELETE':
                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                                break;

                        default:
                }
                $data = curl_exec($ch);//获得返回值

                curl_close($ch);
                if (!$success) {
                        $data = json_decode($data, true);
                }

                return $data;
        }

        /**
         * 方法功能:根据ip从数据库获取城市信息，没有当前城市取得省，显示省会,没有省会显示id排序中第一个
         * 开发时间：16-7-13
         */
        private function getcity_info($ip) {
                $iparr = explode('.', $ip);
                $ip = $iparr[0] . '.' . $iparr[1] . '.' . $iparr[2] . '.' . '50';
                $ipinfo = array();
                $info = array();
                $ipinfo = M('ipdatabase')->where("ip='$ip'")->Field('city_id,region_id')->limit(1)->select();
                if (!empty($ipinfo)) {
                        $city_id = $ipinfo[0]['city_id'];
                        $region_id = $ipinfo[0]['region_id'];
                        $domain = M('city')->where("city_id='$city_id'")->getField('NAME');
                        if (!empty($domain)) {
                                $domain = str_replace('市', '', $domain);
                                $info['city'] = $domain;
                        } else {
                                $domain = M('city')->where("region_id='$region_id' and isshenghui=1")->getField('NAME');
                                if (!empty($domain)) {
                                        $domain = str_replace('市', '', $domain);
                                        $info['city'] = $domain;
                                } else {
                                        $domain = M('city')->where("region_id='$region_id'")->order('id asc')->getField('NAME');
                                        if (!empty($domain)) {
                                                $domain = str_replace('市', '', $domain);
                                                $info['city'] = $domain;
                                        }
                                }
                        }
                } else {
                        $url = 'http://ip.taobao.com/service/getIpInfo.php?ip=' . $ip;
                        $json_array = $this->getCurls($url, $params, 'GET');
                        if ($json_array['data']['country_id'] !== 'IANA' && !empty($json_array)) {
//入库
                                $this->intodata($json_array['data']);
                                $city_id = $json_array['data']['city_id'];
                                $region_id = $json_array['data']['region_id'];
                                $domain = M('city')->where("city_id='$city_id'")->getField('NAME');
                                if (!empty($domain)) {
                                        $domain = str_replace('市', '', $domain);
                                        $info['city'] = $domain;
                                } else {
                                        $domain = M('city')->where("region_id='$region_id' and isshenghui=1")->getField('NAME');
                                        if (!empty($domain)) {
                                                $domain = str_replace('市', '', $domain);
                                                $info['city'] = $domain;
                                        } else {
                                                $domain = M('city')->where("region_id='$region_id'")->order('id asc')->getField('NAME');
                                                if (!empty($domain)) {
                                                        $domain = str_replace('市', '', $domain);
                                                        $info['city'] = $domain;
                                                }
                                        }
                                }
                        }
                }
                return $info;
        }

        /**
         * 方法功能:把数据库没有的IP导入数据库中
         * 开发时间：16-7-13 上午11:43
         */
        private function ip_inputdata($ip, $city) {
                $iparr = explode('.', $ip);
                $ip = $iparr[0] . '.' . $iparr[1] . '.' . $iparr[2] . '.' . '50';
                $cityinfo = M('city')->where("NAME='$city'")->field('city_id,region_id,province')->find();
                $data['ip'] = $ip;
                $data['city_id'] = $cityinfo['city_id'];
                $data['region_id'] = $cityinfo['region_id'];
                $data['city'] = $city . '市';
                $data['country'] = '中国';
                $data['country_id'] = 'CN';
                $data['region'] = $cityinfo['province'];
                M('ipdatabase')->add($data);
        }

        /**
         * curl 请求
         */
        private function getCurls($url = '', $params = array(), $type = '', $success = 0) {

                $ch = curl_init();   // 初始化
                curl_setopt($ch, CURLOPT_URL, $url); //请求地址
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
//curl_setopt($ch, CURLOPT_TIMEOUT, 120); // 设置超时时间
                curl_setopt($ch, CURLOPT_TIMEOUT_MS, 750);//500毫秒超时时间
                switch ($type) {
                        case 'GET':
                                curl_setopt($ch, CURLOPT_HTTPGET, true);
                                break;
                        case 'POST':
                                curl_setopt($ch, CURLOPT_POST, true);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                                break;
                        case 'PUT':
                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                                break;
                        case 'DELETE':
                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                                break;

                        default:
                }
                $data = curl_exec($ch);//获得返回值

                curl_close($ch);
                if (!$success) {
                        $data = json_decode($data, true);
                }

                return $data;
        }

        /**
         * 方法功能:请求的淘宝IP库录入数据库
         * 开发时间：16-7-13 下午5:14
         */
        function intodata($json_array) {
                $v = $json_array;
                $data['ip'] = $v['ip'];
                $data['country'] = $v['country'];
                $data['country_id'] = $v['country_id'];
                $data['area'] = $v['area'];
                $data['area_id'] = $v['area_id'];
                $data['region'] = $v['region'];
                $data['region_id'] = $v['region_id'];
                $data['city'] = $v['city'];
                $data['city_id'] = $v['city_id'];
                $data['isp'] = $v['isp'];
                $data['isp_id'] = $v['isp_id'];
                M('ipdatabase')->add($data);
        }

}

?>