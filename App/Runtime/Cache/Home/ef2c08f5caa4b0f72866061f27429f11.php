<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8" />
<title>hzcms安装</title>
<link rel="stylesheet" href="/Public/install/simpleboot/themes/flat/theme.min.css" />
<link rel="stylesheet" href="/Public/install/css/install.css" />
<link rel="stylesheet" href="/Public/font-awesome/css/font-awesome.min.css" type="text/css">


</head>
<body>
<div class="wrap">
    <div class="header">
	<h1 class="logo">HDSQ 安装向导</h1>
	<div class="version">1.0</div>
</div>
    <section class="section">
        <div class="step">
            <ul class="unstyled">
                <li class="current"><em>1</em>检测环境</li>
                <li><em>2</em>创建数据</li>
                <li><em>3</em>完成安装</li>
            </ul>
        </div>
        <div class="server">
            <table width="100%">
                <tr>
                    <td class="td1">环境检测</td>
                    <td class="td1" width="25%">推荐配置</td>
                    <td class="td1" width="25%">当前状态</td>
                    <td class="td1" width="25%">最低要求</td>
                </tr>
                <tr>
                    <td>操作系统</td>
                    <td>类UNIX</td>
                    <td><i class="fa fa-check correct"></i> <?php echo ($os); ?></td>
                    <td>不限制</td>
                </tr>
                <tr>
                    <td>PHP版本</td>
                    <td>>5.6.x</td>
                    <td><i class="fa fa-check correct"></i> <?php echo ($phpversion); ?></td>
                    <td>5.3.0</td>
                </tr>
                <!-- 模块检测 -->
                <tr>
                    <td class="td1" colspan="4">
                        模块检测
                    </td>
                </tr>
                <tr>
                    <td>session</td>
                    <td>开启</td>
                    <td>
                        <?php echo ($session); ?>
                    </td>
                    <td>开启</td>
                </tr>
                <tr>
                    <td>
                        PDO
                        <a href="https://www.baidu.com/s?wd=开启PDO,PDO_MYSQL扩展" target="_blank">
                            <i class="fa fa-question-circle question"></i>
                        </a>
                    </td>
                    <td>开启</td>
                    <td>
                        <?php echo ($pdo); ?>
                    </td>
                    <td>开启</td>
                </tr>
                <tr>
                    <td>
                        PDO_MySQL
                        <a href="https://www.baidu.com/s?wd=开启PDO,PDO_MYSQL扩展" target="_blank">
                            <i class="fa fa-question-circle question"></i>
                        </a>
                    </td>
                    <td>开启</td>
                    <td>
                        <?php echo ($pdo_mysql); ?>
                    </td>
                    <td>开启</td>
                </tr>
                <tr>
                    <td>
                        CURL
                        <a href="https://www.baidu.com/s?wd=开启PHP CURL扩展" target="_blank">
                            <i class="fa fa-question-circle question"></i>
                        </a>
                    </td>
                    <td>开启</td>
                    <td>
                        <?php echo ($curl); ?>
                    </td>
                    <td>开启</td>
                </tr>
                <tr>
                    <td>
                        GD
                        <a href="https://www.baidu.com/s?wd=开启PHP GD扩展" target="_blank">
                            <i class="fa fa-question-circle question"></i>
                        </a>
                    </td>
                    <td>开启</td>
                    <td>
                        <?php echo ($gd); ?>
                    </td>
                    <td>开启</td>
                </tr>
                <tr>
                    <td>
                        MBstring
                        <a href="https://www.baidu.com/s?wd=开启PHP MBstring扩展" target="_blank">
                            <i class="fa fa-question-circle question"></i>
                        </a>
                    </td>
                    <td>开启</td>
                    <td>
                        <?php echo ($mbstring); ?>
                    </td>
                    <td>开启</td>
                </tr>
                <tr>
                    <td>
                        fileinfo
                        <a href="https://www.baidu.com/s?wd=开启PHP fileinfo扩展" target="_blank">
                            <i class="fa fa-question-circle question"></i>
                        </a>
                    </td>
                    <td>开启</td>
                    <td>
                        <?php echo ($fileinfo); ?>
                    </td>
                    <td>开启</td>
                </tr>
                <?php if(!empty($show_always_populate_raw_post_data_tip)): ?><tr>
                        <td>
                            $HTTP_RAW_POST_DATA关闭检测
                            <a href="https://www.baidu.com/s?wd=开启PHP fileinfo扩展" target="_blank">
                                <i class="fa fa-question-circle question"></i>
                            </a>
                        </td>
                        <td>关闭</td>
                        <td>
                            <?php echo ($always_populate_raw_post_data); ?>

                        </td>
                        <td>关闭</td>
                    </tr>
                    <tr>
                        <td>$HTTP_RAW_POST_DATA未关闭解决</td>
                        <td colspan="3">
							<pre>
								;php.ini 找到 always_populate_raw_post_data设置如下:
								always_populate_raw_post_data = -1
							</pre>
                        </td>
                    </tr><?php endif; ?>
                <!-- 大小限制检测 -->
                <tr>
                    <td class="td1" colspan="4">
                        大小限制检测
                    </td>
                </tr>
                <tr>
                    <td>附件上传</td>
                    <td>>2M</td>
                    <td>
                        <?php echo ($upload_size); ?>
                    </td>
                    <td>不限制</td>
                </tr>
            </table>
            <table width="100%">
                <tr>
                    <td class="td1">目录、文件权限检查</td>
                    <td class="td1" width="25%">写入</td>
                    <td class="td1" width="25%">读取</td>
                </tr>
                <?php if(is_array($folders)): foreach($folders as $dir=>$vo): ?><tr>
                        <td>
                            <?php echo ($dir); ?>
                        </td>
                        <td>
                            <?php if($vo['w']): ?><i class="fa fa-check correct"></i> 可写
                                <?php else: ?>
                                <i class="fa fa-remove error"></i> 不可写<?php endif; ?>
                        </td>
                        <td>
                            <?php if($vo['r']): ?><i class="fa fa-check correct"></i> 可读
                                <?php else: ?>
                                <i class="fa fa-remove error"></i> 不可读<?php endif; ?>
                        </td>
                    </tr><?php endforeach; endif; ?>
            </table>
        </div>
        <div class="bottom text-center">
            <a href="/index/step2" class="btn btn-primary">重新检测</a>
            <a href="/index/step3" class="btn btn-primary">下一步</a>
        </div>
    </section>
</div>
<div class="footer">
	&copy; 2017-<?php echo date('Y');?> <a href="http://www.bjhanzhuo.com" target="_blank">hzcms Team</a>
</div>
</body>
</html>