<?php
/**
 * 将当前时间戳格式化，如 2015-10-15 15:15:15
 */
//导出excel
function PHPExcel($title, $field, $data) {
        vendor('PHPExcel.PHPExcel');
        vendor('PHPExcel.PHPExcel.Writer.Excel5');
        vendor('PHPExcel.PHPExcel.Writer.Excel2007');

        $objPHPExcel = new PHPExcel();
        $activeSheet = $objPHPExcel->getActiveSheet();
        foreach ($field as $k => $v) {
                //$activeSheet->getColumnDimension($k)->setAutoSize(true);
                $activeSheet->getColumnDimension($k)->setWidth($v[1]);//���
                $activeSheet->getStyle($k . '1')->getFont()->setBold(true);  // �Ӵ�
                $activeSheet->setCellValue($k . '1', $v[0]);
        }

        $i = 2;
        foreach ($data as $ob) {
                foreach ($ob as $k => $v) {
                        $activeSheet->setCellValue($k . $i, $v);
                }
                $i++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        ob_end_clean();
        header("Pragma:public");
        header("Expires:0");
        header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");
        header("Content-Disposition:attachment;filename={$title}.xls");
        header("Content-Transfer-Encoding:binary");
        $objWriter->save("php://output");
        exit();
}

function importexcel($filePath) {
        vendor('PHPExcel.PHPExcel');
        vendor('PHPExcel.PHPExcel.Reader.Excel5');
        vendor('PHPExcel.PHPExcel.Reader.Excel2007');

        $PHPExcel = new PHPExcel();
        /*         * 默认用excel2007读取excel，若格式不对，则用之前的版本进行读取 */
        $PHPReader = new PHPExcel_Reader_Excel2007();
        if (!$PHPReader->canRead($filePath)) {
                $PHPReader = new PHPExcel_Reader_Excel5();
                if (!$PHPReader->canRead($filePath)) {
                        echo 'no Excel';
                        return;
                }
        }

        $PHPExcel = $PHPReader->load($filePath);
        $currentSheet = $PHPExcel->getSheet(0);  //读取excel文件中的第一个工作表
        $allColumn = $currentSheet->getHighestColumn(); //取得最大的列号
        $allRow = $currentSheet->getHighestRow(); //取得一共有多少行
        $erp_orders_id = array();  //声明数组

        /*         * 从第二行开始输出，因为excel表中第一行为列名 */
        for ($currentRow = 1; $currentRow <= $allRow; $currentRow++) {

                /*                 * 从第A列开始输出 */
                for ($currentColumn = 'A'; $currentColumn <= $allColumn; $currentColumn++) {

                        $val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65, $currentRow)->getValue();/*                         * ord()将字符转为十进制数 */
                        if ($val != '') {
                                $erp_orders_id[] = $val;
                        }
                        /*                         * 如果输出汉字有乱码，则需将输出内容用iconv函数进行编码转换，如下将gb2312编码转为utf-8编码输出 */
                        //echo iconv('utf-8','gb2312', $val)."\t";
                }
        }
        return $erp_orders_id;
}

function getDatetime() {
        return date('Y-m-d H:i:s', time());
}

function getjisuanstylename($id) {
        return M('jisuanstyle')->where('id=' . $id)->getField('name');
}

function getkjrs($kjid = 0) {
        return M('weixinkjuserin')->where('kjid=' . $kjid)->count();
}

/**
 * 获取频道
 */
function getpindaoname($id = 0, $type = 1) {
        //$pindaoname = array('全部', '集团首页', '城市首页', '效果图频道', '装修知识聚合频道', '装修问答', '友情链接页', '现代简约装修效果图', '背景墙装修效果图', '玄关装修效果图', '壁纸装修效果图', '地中海效果图');
        $pindaoname = array('全部', '集团首页', '城市首页', '效果图频道', '装修知识聚合频道', '装修问答', '友情链接页', '单图风格', '单图空间', '单图局部', '图册风格', '报价','理想装','装修知识','单页面');
        if ($type == 1) {
                return $pindaoname[$id];
        } else {
                return $pindaoname;
        }
}
function getpindaonamebyid($id){
        return M('link_class')->where('id='.$id)->getField('name');
}
function getbrandslistname($ids) {
        return implode(',', M('brands')->where('id in (' . $ids . ')')->getField('name', true));
}

function getpackagenames($pid) {
        return M('package')->where('id=' . $pid)->getField('name');
}

/**
 * 获取当前用户拥有权限的城市列表
 */
function getusercitylist() {
        $cid = $_SESSION[C('SESSION_USER_KEY')]['cid'];
        $citylist = M('City')->field('id,name')->where('ID IN (' . $cid . ')')->select();
        return $citylist;
}

/**
 * 获取装修档次名称
 */
function getlevelname($id) {
        return M('Standard')->where('id=' . $id)->getField('levelname');
}

/**
 * 获取装修档次的面积
 */
function getarea($id) {
        return M('Standard')->where('id=' . $id)->getField('area');
}

//根據id返回攻略详情页分類拼音链接id格式：pinyin/id
function gonglue_pinyin_id($id) {
        $classid = M('tbfitmentguide')->where('id=' . $id)->getField('classid');
        $py = M('tbfitmentguideclass')->where('classid=' . $classid)->field('rewrite_dir,ParentID')->find();
        if (!empty($py['ParentID'])) {
                $pyurl = $py['rewrite_dir'];
                $py = M('tbfitmentguideclass')->where('classid=' . $py['ParentID'])->field('rewrite_dir,ParentID')->find();
                $py['rewrite_dir'] = $py['rewrite_dir'] . '/' . $pyurl;
        }
        return $py['rewrite_dir'] . '/' . $id;
}

/**
 * 由城市名称获取拼音缩写
 */
function getCitySX($name) {
        return M('City')->where('NAME LIKE \'' . $name . '\'')->getField('domain');
}

/**
 * 由活动表ID获取是否m站
 */
function getIsm($ClassRoomID) {
        if (M('tbclassroom')->where('ID=' . $ClassRoomID)->getField('Ism')) {
                return M;
        } else {
                return PC;
        }
}

function getfengshui($id) {
        $res = M('tbclassroomorderfs')->where('tbclassroomorderid=' . $id)->find();
        if ($res) {
                return $res['rytype'] . '-朝' . $res['chaoxiang'] . '<a href="http://m.sc.cc/h5/' . $res['img'] . '" target="_blank" >-查看户型图</a>';
        }
}
/**
 * 根据ID获取链接分类名称
 */
function getlink_name($dtstyleid=0,$dtkongid=0,$dtjubuid=0,$tucestyleid=0,$baojiaid=0,$lixiangzhuangid=0,$gonglueid=0){
        if(!empty($dtstyleid)){
                $id=$dtstyleid;
        }
        if(!empty($dtkongid)){
                $id=$dtkongid;
        }
        if(!empty($dtjubuid)){
                $id=$dtjubuid;
        }
        if(!empty($tucestyleid)){
                $id=$tucestyleid;
        }
        if(!empty($gonglueid)){
                $id=$gonglueid;
        }
        if(!empty($baojiaid)){
                $id=$baojiaid;
        }
        if(!empty($lixiangzhuangid)){
                $id=$lixiangzhuangid;
        }
        if($baojiaid ==0 && $lixiangzhuangid==0){
                return M('link_class')->where('id='.$id)->getField('name');                
        }  else {
                return M('city')->where('ID='.$id)->getField('NAME');
        }
}
/**
 * 报名管理页面，根据classroomid查询当前活动报名人数(20条加数据不算在内)
 */
function getHdBmNum($id){
        $num = M('tbclassroomorder')->where("TelePhone != '15110000000' and ClassRoomID=".$id)->count();
        return $num;
}