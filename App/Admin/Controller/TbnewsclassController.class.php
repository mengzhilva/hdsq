<?php
namespace Admin\Controller;
/*
*新闻分类管理控制器，继承CommonController
*方法：
*       
*作者：李彭青 
*/
class TbnewsclassController extends CommonController {

    private $cityarea;
    private $citylevel;

    public function __construct(){

        parent::__construct();
        $this->cityarea = M('Cityarea');
        // 获取当前用户所拥有权限的城市ID
        $this->citylevel = $_SESSION['scadminuser']['cid'];
        // 获取拥有权限城市的数据
        $city = M('city')->where('id in ('.$this->citylevel.')')->select();
        $this->assign('city',$city);
    }

    /*加载新闻分类显示页面
     */
    public function index(){

        // 此方法的权限ID为49
        $this->checkLevel(49);
        parent::index();
    }

    /*加载新闻分类添加页面
     */
    public function add(){

        // 此方法的权限ID为50
        $this->checkLevel(50);
        parent::add();
    }

    /*执行新闻分类添加后的数据写入
     */
    public function insert(){

        // 此方法的权限ID为50
        $this->checkLevel(50);
        parent::insert();
    }

    /*加载新闻分类编辑页面
     */
    public function edit(){

        // 此方法的权限ID为51
        $this->checkLevel(51);
        parent::edit();
    }

    /*执行新闻分类编辑后的数据更新
     */
    public function update(){

        // 此方法的权限ID为51
        $this->checkLevel(51);
        parent::update();
    }

    /*执行新闻分类的数据删除
     */
    public function del() {

        // 此方法的权限ID为52
        $this->checkLevel(52);
        $model = M(CONTROLLER_NAME);
        if (!empty($model)) {
            $id = $_REQUEST['ids']; 
            if (isset($id) && is_string($id)) {
                //批量删除
                $condition = array('ClassID' => array('in', $id));
                if (false !== $model->where($condition)->delete()) {
                    $this->success(L('删除成功'));
                } else {
                    $this->error(L('删除失败'));
                }
            } else if (is_array($id)){
                 //批量删除
                $condition = array('ClassID'=> array('in', explode(',', $id)));
                if (false !== $model->where($condition)->delete()) {
                    $this->success(L('删除成功'));
                } else {
                    $this->error(L('删除失败'));
                }
            }else {
                $this->error('非法操作');
            }
        }
    }
    

}