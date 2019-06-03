<?php
namespace Home\Controller;
/**
 * 公共Action
 *
 */
class EmptyController extends CommonController {

        function index() {
                header("HTTP/1.0 404 Not Found");//使HTTP返回404状态码
                $this->display('Empty/index');
        }

        function _empty() {
                header("HTTP/1.0 404 Not Found");//使HTTP返回404状态码 
                $this->display('Empty/index');
        }

}
