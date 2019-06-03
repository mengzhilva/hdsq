<?php

//自定义函数库
/**
 * 方法功能:判断是是否是手机号，是正常返回。不是返回0
 * 开发时间：16-6-2 上午10:47
 */
function Is_TelePhone($int) {
        if (preg_match("/^1[34578]{1}\d{9}$/", $int)) {
                return $int;
        } else {
                return 0;
        }
}

//判断是否是正整数
function Is_Number($int, $parm = 7) {
        $reg = "/^\d{1,$parm}$/";
        if (preg_match($reg, $int)) {
                return $int;
        } else {
                return 0;
        }
}

//判断是否是QQ号
function Is_Qq($int) {
        if (preg_match("/[1-9][0-9]{4,}/", $int)) {
                return $int;
        } else {
                return 0;
        }
}

//判断是否是身份证
function Is_IDcard($int) {
        if (preg_match("/^(\d{6})(\d{4})(\d{2})(\d{2})(\d{3})([0-9]|X)$/", $int)) {
                return $int;
        } else {
                return 0;
        }
}

//我们的故事管理中的自定义函数（前后台共用）
// 由ID获取相册名称
function getphotoname($id) {
        $m = M('Story');
        return $m->where('id=' . $id)->getField('photoname');
}

// 由ID获取省名称
function getregionprovincename($id) {
        $m = M('Regionprovince');
        return $m->where('id=' . $id)->getField('name');
}

function get_get() {
        return $_GET;
}

// 由ID获取市名称
function getregioncityname($id) {
        $m = M('Regioncity');
        return $m->where('id=' . $id)->getField('name');
}

// 由ID获取区县名称
function getregioncountyname($id) {
        $m = M('regioncounty');
        return $m->where('id=' . $id)->getField('name');
}

//预防数据库攻击
function check_input($value) {
        // 去除斜杠
        if (get_magic_quotes_gpc()) {
                $value = stripslashes($value);
        }
        // 如果不是数字则加引号
        if (!is_numeric($value)) {
                $value = addslashes($value);
                // $value = "" . mysql_real_escape_string($value) . "";
        }
        str_replace("<", "", $value);
        str_replace(">", "", $value);
        return $value;
}

// 根据ID获取管理员名称
function getcjguize($uid) {
        $m = M('cjguize');
        return $m->where('id=' . $uid)->getField('title');
}

// 根据ID获取管理员名称
function getadminname($uid) {
        $m = M('admin');
        return $m->where('id=' . $uid)->getField('username');
}

//根据ID获取店铺
function getStorename($ID) {
        $m = M('Storefront');
        return $m->where('ID=' . $ID)->getField('StoreName');
}

// 获取订单用户名称 
function getodusersname($usid) {
        $m = M('users');
        return $m->where('id=' . $usid)->getField('username');
}

// 获取色系编码
function getsxname($usid) {
        $m = M('housecolor');
        return $m->where('COLO_ID=' . $usid)->getField('bianma');
}

// 获取色系编码
function gethosecolor($usid) {
        $m = M('housecolor');
        return $m->where('COLO_ID=' . $usid)->getField('NAME');
}

//获取城市名字1
function getcityname($CID) {
        $m = M('city');
        return $m->where('ID=' . $CID)->getField('NAME');
}

//获取城市名字1
function getcitydomain($CID) {
        $m = M('city');
        return $m->where('ID=' . $CID)->getField('DOMAIN');
}

//根据城市名字获取ID
function getcityid($name) {
        $m = M('city');
        return $m->where(array('NAME' => $name))->getField('ID');
}

// 获取城市区域名称2
function getcityareaname($AID) {
        $m = M('cityarea');
        return $m->where('ID=' . $AID)->getField('NAME');
}

// 获取小区名称3
function getcommunityname($comid) {
        $m = M('community');
        return $m->where('ID=' . $comid)->getField('NAME');
}

// 获取户型名称4
function gethousetype($houid) {
        $m = M('housetype');
        return $m->where('ID=' . $houid)->getField('NAME');
}

// 获取户型fontName
function gethouseFontname($houid = '') {
        $where = '1';
        if ($houid) {
                $where .= ' AND ID=' . $houid;
        }

        $m = M('housetype');
        return $m->where($where)->getField('FONT_PINYIN');
}

// 获取户型ID
function gethouseid($name) {
        $m = M('housetype');
        return $m->where(array('NAME' => $name))->getField('ID');
}

// 获取风格名称5
function getstyletype($houid) {
        $m = M('housestyle');
        return $m->where('ID=' . $houid)->getField('BACKNAME');
}

function getstyletypef($houid) {
        $m = M('Housestyle');
        return $m->where('ID=' . $houid)->getField('FONTNAME');
}

function getstyletypeFontPy($houid) {
        $m = M('Housestyle');
        return $m->where('ID=' . $houid)->getField('FONT_PINYIN');
}

// 获取风格id
function getstyleid($name) {
        $m = M('housestyle');
        return $m->where(array('BACKNAME' => $name))->getField('ID');
}

// 获取风格name20150721
function getstylepinyin($name) {
        $m = M('housestyle');
        return $m->where(array('FONT_PINYIN' => $name))->getField('FONTNAME');
}

// 获取风格拼音
function getStyleFontPinyin($houid) {
        $m = M('Housestyle');
        return $m->where('ID=' . $houid)->getField('FONT_PINYIN');
}

// 获取空间名称6
function getkongtype($houid) {
        $m = M('housefunction');
        return $m->where('ID=' . $houid)->getField('BACKNAME');
}

// 获取空间名称6
function getkongtypeurl($houid) {
        $m = M('housefunction');
        return $m->where('ID=' . $houid)->getField('FONT_PINYIN');
}

// 获取新闻类型7
function getnewsclass($ClassID) {
        $m = M("tbnewsclass");
        return $m->where('ClassID=' . $ClassID)->getField('ClassName');
}

//读取设计师级别8
function getdesignerlevel($id) {
        $m = M("designerlevel");
        return $m->where('id=' . $id)->getField('name');
}

//读取设计师名字9
function getdesignername($id) {
        if ($id > 0) {
                $m = M("designer");
                return $m->where('ID=' . $id)->getField('name');
        } elseif ($id == '0') {
                return '实创设计师';
        }
}

//读取设计师名字10
function getdesignerphoto($id) {
        $m = M("designer");
        return $m->where('ID=' . $id)->getField('PHOTE');
}

//获取案例效果图张数11
function getpicnum($id) {
        $m = M("case_image");
        return $m->where("CID='$id'")->count("CID");
}

//读取案例名字
function getcasesname($id) {
        $m = M("casedecorate");
        return $m->where('ID=' . $id)->getField('NAME');
}

//读取套餐名字12
function getpackagename($id) {
        $m = M("package");
        return $m->where('HTYPE=' . $id)->getField('NAME');
}

//读取整体家装品牌城市名称13
function getpackagebrcityname($id) {
        $br = M("package_city_config");
        $cid = $br->field("CID")->where("ID=$id")->select();
        $name = M("city")->field("NAME,ID")->where("ID='" . $cid[0]['CID'] . "'")->select();
        return $name[0]['NAME'];
}

//通过pid读取套餐名字14
function getpname($id) {
        $m = M("package");
        return $m->where('ID=' . $id)->getField('NAME');
}

//根据设计师ID获取星级
function getstarbyid($id) {
        return M('designer')->where("ID=" . $id)->getField('STAR');
}

//根据案例ID获取设计师ID
function getdidbycid($id) {
        return M('casedecorate')->where("ID=" . $id)->getField('DID');
}

//根据设计师名字获取星级
function getstar($name) {
        return M('designer')->where("NAME='$name'")->getField('STAR');
}

//设计师星级文字
function getdesignerstar($star) {
        $starstr = "";
        for ($si = 0; $si < $star; $si++) {
                $starstr = $starstr . "★";
        }
        return $starstr;
}

//读取复选框
function reqs($str) {
        $arrayss = $_REQUEST[$str];
        $sizess = count($arrayss);
        $catess = "";
        for ($iss = 0; $iss < $sizess; $iss++) {
                if ($iss == $sizess - 1) {
                        $catess = $catess . $arrayss[$iss];
                } else {
                        $catess = $catess . $arrayss[$iss] . ",";
                }
        }
        return $catess;
}

//安全化字符串
function formathtml($str) {
        return str_replace("’", "'", $str);
}

//输出脚本
function wscript($str) {
        return "<script>$str</script>";
}

//设计师模板使用的函数
function strposs($tag, $id) {
        return strpos("," . $tag . ",", "," . $id . ",");
}

//多个ID对应的值擅长风格
function VHID($HID) {
        $m = M('Housestyle');
        $HIDNAME = $m->query('select * from housestyle where ID in(' . $HID . ')');
        foreach ($HIDNAME as $key => $val) {
                print_r($val['BACKNAME']);
                echo'&nbsp;';
        }
}

// 多个ID对应的擅长风格（带URL链接）版本
function VHID_URL($HID) {
        $m = M('Housestyle');
        $HIDNAME = $m->query('select * from housestyle where ID in(' . $HID . ')');
        foreach ($HIDNAME as $key => $val) {
                $BACKNAME = '<a target="_blank" href="' . C("scurl")["XIAOGUOTU_TUCE"] . $val["FONT_PINYIN"] . '/">' . $val['BACKNAME'] . '</a>';
                print_r($BACKNAME);
                echo'&nbsp;';
        }
}

//获取设计师作品数（案例表）
function casenum($DID) {
        $m = M('casedecorate');
        return $m->where('DID=' . $DID . ' AND status = 1 AND Cottage = 0')->count();
}

//获取设计师作品数：个人中心调用
function casenum_gr($DID) {
        $m = M('casedecorate');
        return $m->where('DID=' . $DID . ' AND Cottage = 0')->count();
}

//设计师预约量
function reservationnum($ID) {
        // $m = M('Reservation_designer');
        // return $m->where('DID ='.$ID)->count();
        $m = M('reservation_construction');
        return $m->where('TYPE=5 and DID =' . $ID)->count();
}

//设计师文章
function news($ID) {
        $news = M('tbfitmentguide');
        return $news->where('Uid=' . $ID)->count();
}

// 获取文章分类名称
function getclassname($classid) {
        $m = M('tbfitmentguideclass');
        return $m->where('ClassID=' . $classid)->getField('ClassName');
}

//获取报名类型
function getbmlx($id) {
        $arr = array('预约装修(右侧栏)', '装修报价', '申请参观工地', '企业客户', '预约装修', '预约设计师', '免费户型设计', '预约参观工地', '申请免费服务', '预约装修专家', 'm站预约设计师', 'm站免费量房', '门店预约', '公众号在线报修', '获得报价', '免费量房', '小区定制', '我要去看量房现场', '设计师访谈专题预约', '参观样板间工地', '免费抢设计', '诊断风水', '领暖冬法宝', 'pc在线报修', '免费户型规划', '家装案例', '专题报名管理', 'M定制工期', '申请监理', 'M理想装详情页', '免费云设计', 'M环保装修', 'M定制设计', '精细报价');
        return $arr[$id];
}

//获取报名类型所有
function getbmlxall() {
        $arr = array('预约装修(右侧栏)', '装修报价', '申请参观工地', '企业客户', '预约装修', '预约设计师', '免费户型设计', '预约参观工地', '申请免费服务', '预约装修专家', 'm站预约设计师', 'm站免费量房', '门店预约', '公众号在线报修', '获得报价', '免费量房', '小区定制', '我要去看量房现场', '设计师访谈专题预约', '参观样板间工地', '免费抢设计', '诊断风水', '领暖冬法宝', 'pc在线报修', '免费户型规划', '家装案例', '专题报名管理', 'M定制工期', '申请监理', 'M理想装详情页', '免费云设计', 'M环保装修', 'M定制设计', '精细报价');
        return $arr;
}

//获取来源
function getsource() {
        $arr = array('PC首页', 'PC装修报价页', 'PC理想装详情页', 'PC右侧栏', 'PCS3（只有上海有）', 'PC效果图单图详情页', 'PC效果图图册详情页', 'PC3D样板间列表页', 'PC装修知识详情页', 'PC家装案例详情页', 'PC设计师聚合页', 'PC设计师列表页', 'PC设计师详情页', 'PC小区装修详情页', 'PC小区装修列表页', 'PC装修知识聚合页', 'PC装修知识列表页', 'M装修报价页', 'M站免费量房', 'M理想装详情页', 'MS3（只有上海有）', 'M设计师详情页', 'M家装案例详情页', 'PC理想装详情页', 'pc活动报价', 'M定制工期', '申请监理', '免费云设计', 'M环保装修', 'M定制设计', 'PC大牌对大牌', 'PC理想装家的向往', '精细报价', 'M免费云设计', 'M装修报价页B');
        return $arr;
}

/* * mfsj
 * 获取来源
 */

function getsourcename($id = 0) {
        $sourcename = array('PC首页', 'PC装修报价页', 'PC理想装详情页', 'PC右侧栏', 'PCS3（只有上海有）', 'PC效果图单图详情页', 'PC效果图图册详情页', 'PC3D样板间列表页', 'PC装修知识详情页', 'PC家装案例详情页', 'PC设计师聚合页', 'PC设计师列表页', 'PC设计师详情页', 'PC小区装修详情页', 'PC小区装修列表页', 'PC装修知识聚合页', 'PC装修知识列表页', 'M装修报价页', 'M站免费量房', 'M理想装详情页', 'MS3（只有上海有）', 'M设计师详情页', 'M家装案例详情页', 'PC理想装详情页', 'pc活动报价', 'M定制工期', '申请监理', 'PC云设计', 'M环保装修', 'M定制设计', 'PC大牌对大牌', 'PC理想装家的向往', '精细报价', 'M免费云设计', 'M装修报价页B');
        return $sourcename[$id];
        // if($type == 1){
        // 	return $sourcename[$id];
        // }else{
        // 	return $sourcename;
        // }
}

function getbrands() {
        $brands = array(1 => '地板', 2 => '涂料', 3 => '卫浴', 4 => '橱柜', 5 => '木门', 6 => '瓷砖', 7 => '辅材');
        return $brands;
}

function getbrandtypename($id) {
        $brands = array(1 => '地板', 2 => '涂料', 3 => '卫浴', 4 => '橱柜', 5 => '木门', 6 => '瓷砖', 7 => '辅材');
        return $brands[$id];
}

function getbrandname($ids) {
        $brands = M('brands')->where('id in (' . $ids . ' )')->field('name')->select();
        $arr = array();
        foreach ($brands as $k => $v) {
                $arr[] = $v['name'];
        }//var_dump($brands);var_dump($arr);
        return implode($arr, '、');
}

//获取推广员姓名
function gettgyname($id) {
        $m = M('tbpromoter');
        $name = $m->where('Id=' . $id)->getField('PromoterName');
        if (empty($name)) {
                $name = '暂无';
        }
        return $name;
}

//获取推广员类型
function gettgyclass($id) {
        $m = M('tbpromoterclass');
        $name = $m->where('id=' . $id)->getField('name');
        if (empty($name)) {
                $name = '暂无';
        }
        return $name;
}

//推广员发送邮件
function sendMailPro($Promoterid, $username = '', $TelePhone = '', $xiaoqu = '', $mianji = '') {
        //导入mail类文件
        //require("./PHPMailer/class.phpmailer.php");

        vendor('PHPMailer.class#phpmailer'); //Thinkphp的导入方式，放在/ThinkPHP/Extend/Vendor/

        $pro = M('tbpromoter')->where(array('Id' => $Promoterid))->find();
        if (!empty($pro)) {
                $email = $pro['PromoterQQ'];
                //创建mail对象
                $mail = new \PHPMailer();

                $mail->IsSMTP(); //设置使用SMTP服务器发送
                $mail->Host = "mail.sc.cc";  //设置126邮箱服务
                $mail->SMTPAuth = true;     // 设置需要验证
                //$mail->Username = C("MAIL_USERNAME");  // 发件人使用邮箱
                $mail->Username = "classroomorder";  // 发件人使用邮箱
                $mail->Password = "28800.cn"; // 设置发件人密码

                $mail->From = "classroomorder@sc.cc";// 发件人邮箱
                $mail->FromName = "classroomorder"; //发送者名称
                $addresss = $email;
                $mail->AddAddress($addresss); // 添加发送地址
                $address = "classroomorder@sc.cc";
                $mail->AddAddress($address); // 添加发送地址

                $mail->IsHTML(true); //指定支持html格式
                $mail->CharSet = "UTF-8";

                $mail->Subject = "订单人: $username ";
                $mail->Body = '实创装饰活动报名订单:""<br>""活动名称："官网推广"<br>用户名称："' . $username . '"<br>性别："先生"<br>电话："' . $TelePhone . '"<br>提交时间："' . date('Y-m-d H:i:s') . '"<br>邮箱：" "<br>楼盘名称："' . $xiaoqu . ' ""<br>面积："' . $mianji . ' "<br>渠道：""<br>备注：" ';
                //推广员@您好，您有一个新的订单 姓名：@ 电话：@ 小区：@ 面积：@ 报名时间：@ 请及时处理。
                $msg = '推广员' . $pro['PromoterName'] . '您好，您有一个新的订单 姓名：' . $username . ' 电话：' . $TelePhone . ' 小区： ' . $xiaoqu . ' 面积：' . $mianji . ' 报名时间：' . date('Y-m-dH:i:s') . ' 请及时处理';

                sendPhonePro($pro['PromoterTel'], $msg);
                if ($mail->Send()) {
                        return true;
                } else {
                        return false;
                }
        }
}

//发邮件
function sendMail($email, $title, $message) {

        vendor('PHPMailer.class#phpmailer'); //Thinkphp的导入方式，放在/ThinkPHP/Extend/Vendor/
        $mail = new \PHPMailer();

        $mail->IsSMTP(); //设置使用SMTP服务器发送
        $mail->Host = "mail.sitrust.cn";  //设置126邮箱服务
        $mail->SMTPAuth = true;     // 设置需要验证
        //$mail->Username = C("MAIL_USERNAME");  // 发件人使用邮箱
        $mail->Username = "classroomorder";  // 发件人使用邮箱
        $mail->Password = "28800.cn"; // 设置发件人密码

        $mail->From = "classroomorder@sc.cc";// 发件人邮箱
        $mail->FromName = "classroomorder"; //发送者名称
        $addresss = $email;
        $mail->AddAddress($addresss); // 添加发送地址
        $address = "classroomorder@sc.cc";
        $mail->AddAddress($address); // 添加发送地址

        $mail->IsHTML(true); //指定支持html格式
        $mail->CharSet = "UTF-8";

        $mail->Subject = $title;
        $mail->Body = $message;
        if ($mail->Send()) {
                return true;
        } else {
                return false;
        }
}

//发送短信
function sendPhonePro($phone, $Content) {
        $Content = urlencode($Content);
        $HttpUrl = "http://125.208.3.91:8888/sms.aspx?action=send&userid=7080&account=SC1&password=sc51567769";
        $HttpUrl .= "&Mobile=" . $phone;
        $HttpUrl .= "&Content=" . $Content;
        $HttpUrl .= "&sendTime=&extno=";
        $res = file_get_contents($HttpUrl);
        $xml = simplexml_load_string($res);
        // var_dump($xml);
        // var_dump($res);exit;
        if ($xml->message == 'ok') {
                return true;
                exit;
        } else {

                return false;
                exit;
        }
}

//截取中文字符串
// function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true){
//     if(function_exists("mb_substr")){
//         if($suffix)
//         return mb_substr($str, $start, $length, $charset)."...";
//         else
//         return mb_substr($str, $start, $length, $charset);
//     }elseif(function_exists('iconv_substr')) {
//         if($suffix)
//             return iconv_substr($str,$start,$length,$charset)."...";
//         else
//             return iconv_substr($str,$start,$length,$charset);
//     }
//         $re['utf-8']   = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef]
//                   [x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
//         $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
//         $re['gbk']    = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
//         $re['big5']   = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
//         preg_match_all($re[$charset], $str, $match);
//         $slice = join("",array_slice($match[0], $start, $length));
//         if($suffix) return $slice."…";
//         return $slice;
// }
//截取中文字符串
function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true) {
        preg_match_all('/./us', $str, $arr);

        if (function_exists("mb_substr")) {
                if ($suffix) {
                        $res = count($arr[0]) > $length ? mb_substr($str, $start, $length, $charset) . "..." : mb_substr($str, $start, $length, $charset);
                        return $res;
                } else {
                        return mb_substr($str, $start, $length, $charset);
                }
        } elseif (function_exists('iconv_substr')) {

                if ($suffix) {
                        $res = count($arr[0]) > $length ? iconv_substr($str, $start, $length, $charset) . "..." : iconv_substr($str, $start, $length, $charset);
                        return $res;
                        // return iconv_substr($str,$start,$length,$charset)."...";
                } else {
                        return iconv_substr($str, $start, $length, $charset);
                }
        }
        $re['utf-8'] = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef]
                  [x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
        $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
        $re['gbk'] = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
        $re['big5'] = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("", array_slice($match[0], $start, $length));


        if ($suffix) {
                if (count($match[0]) < $length) {
                        return $slice;
                } else {
                        return $slice . "…";
                }
        }
        return $slice;
}

/**
 * 可以统计中文字符串长度的函数
 * @param $str 要计算长度的字符串
 * @param $type 计算长度类型，0(默认)表示一个中文算一个字符，1表示一个中文算两个字符
 *
 */
function abslength($str) {
        if (empty($str)) {
                return 0;
        }
        if (function_exists('mb_strlen')) {
                return mb_strlen($str, 'utf-8');
        } else {
                preg_match_all("/./u", $str, $ar);
                return count($ar[0]);
        }
}

function my_strip_tags($str) {
        return strip_tags($str, '<p>');
}

function WatermarkImage($img) {
        $image = new \Think\Image();
        $image->open($img);
        $image->water('./Public/logo.png', \Think\Image::IMAGE_WATER_SOUTHEAST, 100)->save($img);
}

// 获取空间名称
function getspacename($id) {
        return M('housefunction')->where('id=' . $id)->getField('FONTNAME');
}

//获取空间ID
function getSpaceId($name) {
        $m = M("housefunction");
        $info = $m->where("BACKNAME='{$name}'")->Field('ID')->select();
        return $info[0]['ID'];
}

//装修攻略，随机收藏
function gongluecollect($hit) {
        if ($hit == 0) {
                $collect = 0;
        } elseif ($hit > 0 && $hit < 100) {
                $collect = $hit - rand(0, 10);
        } elseif ($hit > 100) {
                $collect = $hit - rand(10, 25);
        }
        return abs($collect);
}

//装修攻略，随机分享次数
function gonglueshare($hit) {
        if ($hit == 0) {
                $share = 0;
        } elseif ($hit > 0 && $hit < 100) {
                $share = $hit - rand(0, 20);
        } elseif ($hit > 100) {
                $share = $hit - rand(30, 45);
        }
        return abs($share);
}

function isMobile() {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
                return true;
        }
        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset($_SERVER['HTTP_VIA'])) {
                // 找不到为flase,否则为true
                return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        }
        // 脑残法，判断手机发送的客户端标志,兼容性有待提高
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
                $clientkeywords = array('nokia',
                    'sony',
                    'ericsson',
                    'mot',
                    'samsung',
                    'htc',
                    'sgh',
                    'lg',
                    'sharp',
                    'sie-',
                    'philips',
                    'panasonic',
                    'alcatel',
                    'lenovo',
                    'iphone',
                    'ipod',
                    'blackberry',
                    'meizu',
                    'android',
                    'netfront',
                    'symbian',
                    'ucweb',
                    'windowsce',
                    'palm',
                    'operamini',
                    'operamobi',
                    'openwave',
                    'nexusone',
                    'cldc',
                    'midp',
                    'wap',
                    'mobile'
                );
                // 从HTTP_USER_AGENT中查找手机浏览器的关键字
                if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                        return true;
                }
        }
        // 协议法，因为有可能不准确，放到最后判断
        if (isset($_SERVER['HTTP_ACCEPT'])) {
                // 如果只支持wml并且不支持html那一定是移动设备
                // 如果支持wml和html但是wml在html之前则是移动设备
                if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
                        return true;
                }
        }
        return false;
}

/**
 * 方法功能:新版发送短信接口
 * 开发时间：16-7-26 下午2:29
 * $phone ：需要发送目的地手机号
 * $content; 需要发送的内容
 */
function sendSMS($phone, $content) {
        $options = array(
            'userid' => 0, //userId可以不写，不验证
            'account' => 'xpt11326', //账号
            'password' => '2800D59407F07719B37A2985768F088B', //32位大写接口密码xpt1132644
            'mobile' => $phone,
            'content' => $content,
            'sendTime' => '', //定时发送时间 为空表示立即发送，定时发送格式2010-10-24 09:08:10（可选）
            'action' => 'send', //发送任务命令
            'extno' => '',
        );
        $apiUrl = 'http://114.113.154.110/smsJson.aspx';
        $data = getCurlData($apiUrl, $options, 'POST', 0);
        if ($data['returnstatus'] == 'Success') {
                return true;
                exit;
        } else {
                return false;
                exit;
        }
}

/**
 * 方法功能:获取接口数据
 * 开发时间：16-7-26 下午2:22
 * $url：请求地址
 * $params：请求参数
 * $type：请求类型。GET，POST，PUT，DELETE
 * $success;是否json_decode并转换成数组,默认0表示需要转
 */
function getCurlData($url = '', $params = array(), $type = '', $success = 0) {

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
