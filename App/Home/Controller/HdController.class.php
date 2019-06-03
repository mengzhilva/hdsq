<?php

namespace Home\Controller;

/**
 * 活动控制器
 * 开发人员：吕定国
 * 开发时间：2014.12.08
 * 修改时间：2015.1.12
 */
class HdController extends CommonController {

        private $hd;

        public function __construct() {
                parent::__construct();
                $this->hd = M('tbclassroom');
                $this->hdbm = M('tbclassroomorder');
                $webset = M('webset')->where('id=1')->find();
                $this->assign('webset', $webset);
                $webmenu = M('webmenu')->select();
                $this->assign('webmenu', $webmenu);
        }

        public function index() {
                $id = I('get.id', 0);
                $id = intval($id);
                //var_dump($id);
                $info = $this->hd->query("select *  from tbclassroom where ID=" . $id);
                // dump($info);
                if ($info['0']['Status'] != 1) {

                        echo '<h1 style="font-size:50px" align="center">此活动未通过审核，请审核后再上线！</h1>';
                }
                // dump($info);
                //外链
                if (!empty($info[0]['LinkUrl'])) {
                        header('Location:' . $info[0]['LinkUrl']);
                        exit;
                }
                //过期
                if (strtotime($info[0]['EndTime']) + 86400 < time()) {
                        //var_dump($_SERVER);
                        // echo '<script>alert(\'此活动已经结束！\');</script>';
                        $newinfo = $this->hd->query("select *  from tbclassroom where Status=1 and Ism=0 and  CityID=" . $this->city['ID'] . " and EndTime>='" . date('Y-m-d') . "' order by id desc");
                        if (!empty($this->PromoterId)) {
                                $pro = '_' . $this->PromoterId;
                        }
                        //$url = __APP__.'/'.'/lixiangzhuang/'.$newinfo[0]['ID'].'.html?'.$_SERVER['QUERY_STRING'];
                        $url = C('scurl')['HD_INDEX_ID'] . $newinfo[0]['ID'] . '.html';
                        //var_dump($url);exit;
                        if (!empty($newinfo) && $newinfo[0]['ID'] != $id) {
                                header('Location:' . $url);
                                exit;
                        }
                }


                $chajians = $this->hd->query("select *,a.id as cid from tbclassroomchajian as a left join tbclasschajian as b on a.chajianID=b.id  where a.hdID=" . $id);

                foreach ($chajians as $k => $v) {
                        if (empty($chajians[$k]['url'])) {
                                $chajians[$k]['url'] = '';
                        }
                        $chajians[$k]['width'] = intval($chajians[$k]['width']);
                        $chajians[$k]['height'] = intval($chajians[$k]['height']);
                }
                //兼容以前
                $chajiantyle = 0;
                $chajianstyle = $this->hd->query("select *,a.id as cid from tbclassroomchajian as a left join tbclasschajian as b on a.chajianID=b.id  where a.style='-1' and a.hdID=" . $id);
                if ($chajianstyle) {
                        $chajiantyle = 1;
                }
                $this->assign('chajiantyle', $chajiantyle);
                $this->assign('utm_source', I('get.utm_source', '网站'));
                $this->assign('utm_term', I('get.utm_term', 'wangzhan'));
                $PromoterID = I('get.Promoterid', 0);
                if (empty($PromoterID)) {
                        $PromoterID = $this->PromoterId;
                }
                // echo "<span style='display:none;'></span>";
                $this->assign('Promoterid', $PromoterID);
                $PromoterNames = $this->hd->query("select *  from tbPromoter where id=" . $PromoterID);
                // var_dump($info[0]);
                $PromoterName = $PromoterNames[0]['PromoterName'];
                $this->assign('PromoterName', $PromoterName);
                if($info[0]['Ism']){
                	if($info[0]['width'] !='640px'){
                		$info[0]['height'] = 640*str_replace('px','',$info[0]['height'])/str_replace('px','',$info[0]['width']).'px';
                		$info[0]['width'] = '640';
                	}
                }
                
                $this->assign('list', $info[0]);
                $this->assign('id', $id);
                $this->assign('chajians', $chajians);
                // var_dump($chajians);
                $webset = M('webset')->where('id=1')->find();
                $phone =$webset['phone'];
               
                $this->assign('PromoterTel', $phone);
                //抽奖活动
                $cj = M('cjguize')->where('hdid=' . $id)->find();
                if (!empty($cj)) {
                        $this->assign('cjid', $cj['id']);
                        $this->assign('qudao', I('get.utm_source', '网站'));
                        $gz = $cj;
                        $time = date('Y-m-d H:i:s');
                        if ($time < $gz['sdate']) {
                                $this->assign('time', -1);
                        }
                        if ($time > $gz['edate']) {
                                $this->assign('time', 1);
                        }
                        $jp = M('cjjiangpin')->where('gid=' . $id)->select();
                        $proArr = array();
                        foreach ($jp as $k => $v) {
                                $proArr[$v['id']] = $v['num'] - $v['snum'];
                        }
                        $isover = 0;
                        if (array_sum($proArr) == 0) {
                                $isover = 1;
                        }
                        $this->assign('isover', $isover);
                }

                $type = I('get.type','');
               // var_dump($type);
                if($type == 'm'){
                	$this->display('huod/nindex');
                }else{
                	$this->display();
                }
        }

        /**
         * 一键领取报名
         */
        public function onekey() {
                $data = array(
                    'UserName' => I('post.UserName', '', 'strip_tags'),
                    'TelePhone' => I('post.TelePhone', '', 'strip_tags'),
                    'ClassRoomID' => I('post.ClassRoomID', 0, 'intval'),
                    'ClassRoomName' => I('post.ClassRoomName', '', 'strip_tags'),
                    'qudao' => I('post.qudao', '', 'strip_tags'),
                    'PromoterId' => I('post.Promoterid', 0, 'strip_tags'),
                    'PromoterName' => I('post.PromoterName', '', 'strip_tags'),
                    'utm_term' => I('post.utm_term', '', 'strip_tags'),
                    'CityID' => I('post.CityID', '', 'strip_tags'),
                    'CityName' => I('post.CityName', '', 'strip_tags'),
                );
                if (empty($data['TelePhone'])) {
                        $this->error('请填写手机号！');
                        exit;
                }
                if (M('tbclassroomorder')->where('ClassRoomID=' . $data['ClassRoomID'] . ' AND TelePhone=' . $data['TelePhone'])->find()) {
                        $this->error('请匆重复报名！');
                        exit;
                }
                if (D('tbclassroomorder')->adduser($data)) {
                        //发送邮件短信
                        if (!empty($data['PromoterId'])) {
                                sendMailPro($data['PromoterId'], $data['UserName'], $data['TelePhone'], '', '');
                        }
                        M()->query("update tbclassroom set Nums=Nums+1 where ID=" . $data['ClassRoomID'] . "");
                        $this->success('报名成功！');
                } else {
                        $this->error(D('tbclassroomorder')->getError());
                }

                exit;
        }

        public function bm() {
                $UPDATETIME = date('Y-m-d H:i:s');
                @set_magic_quotes_runtime(0);
                $arr['state'] = 0;

                $username = $this->stripslashes_array(I('POST.UserName', 0));
                $TelePhone = $this->stripslashes_array(I('post.TelePhone', 0, 'Is_TelePhone'));
                if (empty($TelePhone)) {
                        $arr['state'] = -1;
                        $arr['msg'] = '请填写电话！';
                        echo json_encode($arr);
                        exit;
                }
                $servername = $HTTP_SERVER_VARS['SERVER_NAME']; //获取本站域名
                $sub_from = $HTTP_SERVER_VARS["HTTP_REFERER"];  //获取来源的referer
                $sub_len = strlen($servername); //计算本站域名的长度
                $checkfrom = substr($sub_from, 7, $sub_len); //截取来源域名
                if ($checkfrom != $servername) { //假如截取的来源域名不等于本站域名,则终止.
                        //外部提交
                        $arr['state'] = -1;
                        $arr['msg'] = '站外提交！';
                        echo json_encode($arr);
                        exit;
                }
                $ClassRoomID = intval(I('post.ClassRoomID', 0));
                $ClassRoomName = $this->stripslashes_array(I('post.ClassRoomName', ''));
                $CityID = intval(I('post.CityID', 0));
                $city = M('city')->where('ID=' . $CityID)->select();
                $CityName = $city[0]['NAME'];

                $Sex = I('post.Sex', '先生');
                $LpName = $this->stripslashes_array(I('post.LpName', ''));
                $LpNamem = $this->stripslashes_array(I('post.LpNamem', ''));
                $LpName = $LpName . ',' . $LpNamem;
                $qudao = $this->stripslashes_array(I('post.qudao', ''));
                $utm_term = $this->stripslashes_array(I('post.utm_term', ''));
                $Promoterid = intval(I('post.Promoterid', 0));
                $PromoterName = $this->stripslashes_array(I('post.PromoterName', ''));
                $isbm = M('tbclassroomorder')->where(array('ClassRoomID' => $ClassRoomID, 'TelePhone' => $TelePhone))->find();
                if (!empty($isbm)) {
                        $arr['state'] = -1;
                        $arr['msg'] = '请勿重复报名！';
                        echo json_encode($arr);
                        exit;
                }
                $UserIp = $_SERVER["REMOTE_ADDR"];
                //根据ip来限制
                $now = date('Y-m-d H:i:s');
                $ip = $this->getip();
                $history = M('tbclassroomorder')->where(array('UserIp' => $ip))->order('UpdateTime desc')->find();
                if (!empty($history)) {
                        $historytime = strtotime($history['UpdateTime']);
                        if ((time() - $historytime) < 15) {
                                $arr['state'] = -2;
                                $arr['msg'] = '频繁操作！';
                                echo json_encode($arr);
                                exit;
                        }
                }
                $insertsql = "insert into tbclassroomorder  (UserIp,qudao,utm_term,Promoterid,PromoterName,ClassRoomID,ClassRoomName,UserName,TelePhone,LpName,Sex,CityID,CityName,nums,UpdateTime) values (";
                $insertsql = $insertsql . "'$UserIp',";
                $insertsql = $insertsql . "'$qudao',";
                $insertsql = $insertsql . "'$utm_term',";
                $insertsql = $insertsql . "'$Promoterid',";
                $insertsql = $insertsql . "'$PromoterName',";
                $insertsql = $insertsql . "$ClassRoomID,";
                $insertsql = $insertsql . "'$ClassRoomName',";
                $insertsql = $insertsql . "'$username',";
                $insertsql = $insertsql . "'$TelePhone',";
                $insertsql = $insertsql . "'$LpName',";
                $insertsql = $insertsql . "'$Sex',";
                $insertsql = $insertsql . "'$CityID',";
                $insertsql = $insertsql . "'$CityName',1,";
                $insertsql = $insertsql . "'$UPDATETIME')";
                //var_dump($insertsql);
                $this->hdbm->query($insertsql);

                $this->hdbm->query("update tbclassroom set Nums=Nums+1 where ID=$ClassRoomID");
                //发送邮件短信
                if (!empty($Promoterid)) {
                        sendMailPro($Promoterid, $username, $TelePhone, $LpName, '');
                }

                $arr['state'] = 1;
                $arr['msg'] = '报名成功';
                echo json_encode($arr);
                exit;
                ;
                // echo wscript("alert('报名成功');history.go(-1);");
                // exit();
        }

        function stripslashes_array($array) {
                if (is_array($array)) {
                        foreach ($array as $k => $v) {
                                $array[$k] = stripslashes_array($v);
                        }
                } else if (is_string($array)) {
                        $array = stripslashes($array);
                        $array = strip_tags($array);
                }
                return $array;
        }

        //热点链接弹出页
        function link() {
                $id = I('get.id', 0);
                $id = intval($id);
                //var_dump($id);
                $info = $this->hd->query("select *  from tbclassroom where ID=" . $id);

                $this->assign('utm_source', I('get.utm_source', 0));
                $this->assign('utm_term', I('get.utm_term', 0));
                $this->assign('Promoterid', I('get.Promoterid', 0));
                $PromoterID = I('get.Promoterid', 0);
                $PromoterNames = $this->hd->query("select *  from tbPromoter where id=" . $PromoterID);
                //var_dump($PromoterNames);
                $PromoterName = $PromoterNames[0]['PromoterName'];
                $this->assign('PromoterName', $PromoterName);
                $this->assign('list', $info[0]);
                $this->assign('id', $id);
                //var_dump($chajians);
                $this->display('link');
        }

        function sendView() {
                $id = I('get.id', 0);
                $id = intval($id);
                //var_dump($id);
                $info = $this->hd->query("select *  from tbclassroom where ID=" . $id);

                $this->assign('utm_source', I('get.utm_source', 0));
                $this->assign('utm_term', I('get.utm_term', 0));
                $this->assign('Promoterid', I('get.Promoterid', 0));
                $PromoterID = I('get.Promoterid', 0);
                $PromoterNames = $this->hd->query("select *  from tbPromoter where id=" . $PromoterID);
                //var_dump($PromoterNames);
                $PromoterName = $PromoterNames[0]['PromoterName'];
                $this->assign('PromoterName', $PromoterName);
                $this->assign('list', $info[0]);
                $this->assign('id', $id);
                //var_dump($chajians);
                $this->display('send');
        }

        //报名失败提示
        function bmsb() {
                $msg = I('get.msg', '报名失败！');
                $is1 = I('get.is1', '0');
                $this->assign('is1', $is1);
                $this->assign('msg', $msg);
                $this->display();
        }

        function bmok() {
                $msg = I('get.msg', '报名成功！');
                $is1 = I('get.is1', '0');
                $this->assign('is1', $is1);
                $this->assign('msg', $msg);
                $this->display();
        }

        //发送到手机
        function send() {
                $id = I('post.ClassRoomID', 0);

                $UPDATETIME = date('Y-m-d H:i:s');
                @set_magic_quotes_runtime(0);

                $username = $this->stripslashes_array(I('POST.UserName', 0));
                $TelePhone = $this->stripslashes_array(I('post.TelePhone', 0, 'Is_TelePhone'));
                if (empty($TelePhone)) {
                        $arr['state'] = -1;
                        $arr['msg'] = '请填写电话！';
                        echo json_encode($arr);
                        exit;
                }
                $ClassRoomID = intval(I('post.ClassRoomID', 0));
                $ClassRoomName = $this->stripslashes_array(I('post.ClassRoomName', 0));
                $CityID = intval(I('post.CityID', 0));
                $city = M('city')->where('ID=' . $CityID)->select();
                $CityName = $city[0]['NAME'];

                $Sex = I('post.Sex', 0);
                $LpName = $this->stripslashes_array(I('post.LpName', 0));
                $LpNamem = $this->stripslashes_array(I('post.LpNamem', 0));

                $qudao = $this->stripslashes_array(I('post.qudao', 0));
                $utm_term = $this->stripslashes_array(I('post.utm_term', 0));
                $Promoterid = intval(I('post.Promoterid', 0));
                $PromoterName = $this->stripslashes_array(I('post.PromoterName', 0));

                $isbm = M('tbclassroomorder')->where(array('ClassRoomID' => $ClassRoomID, 'TelePhone' => $TelePhone))->find();

                $UserIp = $_SERVER["REMOTE_ADDR"];
                //根据ip来限制
                $now = date('Y-m-d H:i:s');
                $ip = $this->getip();
                $history = M('tbclassroomorder')->where(array('UserIp' => $ip))->order('UpdateTime desc')->find();
                if (!empty($history)) {
                        $historytime = strtotime($history['UpdateTime']);
                        if ((time() - $historytime) < 15) {
                                $arr['state'] = -2;
                                $arr['msg'] = '频繁操作！';
                                echo json_encode($arr);
                                exit;
                        }
                }
                $UserIp = $_SERVER["REMOTE_ADDR"];
                $insertsql = "insert into tbclassroomorder  (UserIp,qudao,utm_term,Promoterid,PromoterName,ClassRoomID,ClassRoomName,UserName,TelePhone,LpName,Sex,CityID,CityName,nums,UpdateTime) values (";
                $insertsql = $insertsql . "'$UserIp',";
                $insertsql = $insertsql . "'$qudao',";
                $insertsql = $insertsql . "'$utm_term',";
                $insertsql = $insertsql . "'$Promoterid',";
                $insertsql = $insertsql . "'$PromoterName',";
                $insertsql = $insertsql . "$ClassRoomID,";
                $insertsql = $insertsql . "'$ClassRoomName',";
                $insertsql = $insertsql . "'$username',";
                $insertsql = $insertsql . "'$TelePhone',";
                $insertsql = $insertsql . "'$LpName',";
                $insertsql = $insertsql . "'$Sex',";
                $insertsql = $insertsql . "'$CityID',";
                $insertsql = $insertsql . "'$CityName',1,";
                $insertsql = $insertsql . "'$UPDATETIME')";
                //var_dump($insertsql);
                if (empty($isbm)) {
                        $this->hdbm->query($insertsql);
                }

                $Mobile = I('post.TelePhone');
                $info = $this->hd->query("select *  from tbclassroom where ID=" . $id);
                //$info[0]['Title']
                //推广员信息
                $PromoterNames = $this->hd->query("select *  from tbPromoter where id=" . $Promoterid);
                $PromoterTel = $PromoterNames[0]['PromoterTel'];
                $phone = $city[0]['TELEPHONE'];
                if (!empty($PromoterTel)) {
                        $phone = $PromoterTel;
                }
                $Content = '尊敬的‘' . $username . '’您好，' . $info[0]['phonecontent'] . '，详情：' . $phone;
                //新版发送短信
                $res = sendSMS($Mobile, $Content);
                if ($res) {
                        $arr['state'] = 1;
                        $arr['msg'] = '报名成功';
                        echo json_encode($arr);
                        //发送邮件短信
                        if (!empty($Promoterid)) {
                                sendMailPro($Promoterid, $username, $TelePhone, $LpName, '');
                        }
                        exit;
                } else {
                        $arr['state'] = -1;
                        $arr['msg'] = '发送失败';
                        echo json_encode($arr);
                        exit;
                }
        }

        public function gd() {
                $id = I('get.id', 0);
                $id = intval($id);
                $height = I('get.h', 0);

                $this->assign('height', $height);
                $this->assign('id', $id);
                $this->display('gd');
        }

        public function ajaxget() {

                $id = I('post.id', 0);
                $id = intval($id);
                //
                $list = $this->hd->query("select *  from tbclassroomorder where ClassRoomId=" . $id . " limit 80");

                $html = '';
                if (count($list) < 50) {

                        foreach ($list as $k => $v) {
                                $time = date('m月d日', strtotime($v['UpdateTime']));
                                $html .='<li>' . mb_substr($v['UserName'], 0, 1, 'utf-8') . ' ' . substr_replace($v['TelePhone'], '****', 3, 5) . ' 申请成功 </li>';
                        }
                        foreach ($list as $k => $v) {
                                $time = date('m月d日', strtotime($v['UpdateTime']));
                                $html .='<li>' . mb_substr($v['UserName'], 0, 1, 'utf-8') . ' ' . substr_replace($v['TelePhone'], '****', 3, 5) . ' 申请成功 </li>';
                        }
                        foreach ($list as $k => $v) {
                                $time = date('m月d日', strtotime($v['UpdateTime']));
                                $html .='<li>' . mb_substr($v['UserName'], 0, 1, 'utf-8') . ' ' . substr_replace($v['TelePhone'], '****', 3, 5) . ' 申请成功 </li>';
                        }
                } else {
                        foreach ($list as $k => $v) {
                                $time = date('m月d日', strtotime($v['UpdateTime']));
                                $html .='<li>' . mb_substr($v['UserName'], 0, 1, 'utf-8') . ' ' . substr_replace($v['TelePhone'], '****', 3, 5) . ' 申请成功 </li>';
                        }
                }
                echo $html;
                //$this->load->view('welcome_message');
        }

        public function ajaxgetnew() {

                $id = I('id', 0);
                $id = intval($id);
                $list = M()->query("select *  from tbclassroomorder where ClassRoomId=$id  order by ID desc limit 80");
                $html = '';
                if (count($list) < 50) {

                        foreach ($list as $k => $v) {
                                $stryue = intval(substr($v['UpdateTime'], 5, 2));
                                $strri = intval(substr($v['UpdateTime'], 8, 2));
                                $time = $stryue . '月' . $strri . '日';
                                //$time = date('m月d日',strtotime($v['UpdateTime']));
                                $html .='<li>' . mb_substr($v['UserName'], 0, 1, 'utf-8') . '先生' . ' ' . $time . ' 申请成功 </li>';
                        }
                        foreach ($list as $k => $v) {
                                $stryue = intval(substr($v['UpdateTime'], 5, 2));
                                $strri = intval(substr($v['UpdateTime'], 8, 2));
                                $time = $stryue . '月' . $strri . '日';
                                //$time = date('m月d日',strtotime($v['UpdateTime']));
                                $html .='<li>' . mb_substr($v['UserName'], 0, 1, 'utf-8') . '先生' . ' ' . $time . ' 申请成功 </li>';
                        }
                        foreach ($list as $k => $v) {
                                $stryue = intval(substr($v['UpdateTime'], 5, 2));
                                $strri = intval(substr($v['UpdateTime'], 8, 2));
                                $time = $stryue . '月' . $strri . '日';
                                //$time = date('m月d日',strtotime($v['UpdateTime']));
                                $html .='<li>' . mb_substr($v['UserName'], 0, 1, 'utf-8') . '先生' . ' ' . $time . ' 申请成功 </li>';
                        }
                } else {
                        foreach ($list as $k => $v) {
                                $stryue = intval(substr($v['UpdateTime'], 5, 2));
                                $strri = intval(substr($v['UpdateTime'], 8, 2));
                                $time = $stryue . '月' . $strri . '日';
                                //$time = date('m月d日',strtotime($v['UpdateTime']));
                                $html .='<li>' . mb_substr($v['UserName'], 0, 1, 'utf-8') . '先生' . ' ' . $time . ' 申请成功 </li>';
                        }
                }
                echo $html;
                //$this->load->view('welcome_message');
        }

        function hdp() {
                $id = I('get.id', 0);
                $width = I('get.width', 0, 'intval');
                $height = I('get.height', 0, 'intval');

                $m = M('tbclassroomhdp');
                $hdp = $m->where('cid=' . $id)->order('id asc')->select();
                $this->assign('hdp', $hdp);
                $this->assign('width', $width);
                $this->assign('height', $height);
                // var_dump($chajians);

                $this->display('hdp');
        }

        public function ajaxgetbmnumber() {

                $id = $_GET['id'] + 0;
                //$id = intval($id);
                //
		$list = $this->hd->query("select count(1) as num  from tbclassroomorder where ClassRoomId=" . $id);
                if (!empty($list)) {
                        echo $list[0]['num'];
                } else {
                        echo 0;
                }
        }

        //案例轮播图
        public function lunbotu() {
                $caseid = I('get.id', 0);
                $cainfo = M('casedecorate')->where('ID=' . $caseid)->field('CID,TYPEID,SID')->find();
                $title = getcommunityname($cainfo['CID']) . gethousetype($cainfo['TYPEID']) . getstyletype($cainfo['SID']) . '装修案例';
                $imgarr = M('case_image')->where('CID=' . $caseid)->order('ID asc')->field('IMAGE')->select();
                $this->assign('title', $title);
                $this->assign('imgarr', $imgarr);
                $this->display('lunbo');
        }

}
