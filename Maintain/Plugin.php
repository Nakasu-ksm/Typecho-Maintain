<?php
if(!defined('__TYPECHO_ROOT_DIR__')){
    exit;
}
/**
 * 维护模式插件
 *
 * @package 维护模式
 * @author 伊藤雄二
 * @version 1.6.0
 * @link http://dns.doraeclub.com
 */
define("Plugin_VERSION","v1.6");
class Maintain_Plugin implements Typecho_Plugin_Interface
{
    public static function activate(){
        Typecho_Plugin::factory('Widget_Archive')->header = array('Maintain_Plugin', 'render');
        Typecho_Plugin::factory('admin/menu.php')->navBar = array('Maintain_Plugin', 'nav');

    }
    public static function test(){
        die();
    }
    public static function render($header,$archive){
        if (Helper::options()->plugin("Maintain")->MaintainButton === "on"){
            $data = Helper::options()->plugin('Maintain');
            if ($data->superadmin=="on"){
                if (Typecho_Widget::widget('Widget_User')->pass('administrator', true))
                return;
            }
            include("view/maintain.php");
            die();
        }

    }
    public static function nav(){
        //die(Helper::options()->plugin('Maintain')->checknew);
        if (Helper::options()->plugin('Maintain')->MaintainButton == 'on'){
            echo '<span class="message error">'
                . "闭站维护中"
                . '</span>';
        }else{

            echo '<span class="message success">'
                . "正常开站中"
                . '</span>';
        }
        if (Helper::options()->plugin('Maintain')->checknew=="on"){
            $version = file_get_contents("https://cdn.jsdelivr.net/gh/itoukou1/checknew@master/test.txt");

            if (Plugin_VERSION != $version){
                echo '<span class="message warning"><a style="color: red;" href="https://github.com/itoukou1/Typecho-Maintain">'
                    . "闭站维护插件需要升级(点我去升级)"
                    . '</a></span>';

            }
        }
    }
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        $MaintainButton = new Typecho_Widget_Helper_Form_Element_Select('MaintainButton', array(
            'off' => '关闭（默认）',
            'on' => '开启',
        ),"off",_t("维护模式"),'介绍：开启后，全站进入维护状态');
        $form->addInput($MaintainButton->multiMode());
        $MaintainContent = new Typecho_Widget_Helper_Form_Element_Textarea('MaintainContent', NULL, NULL, '网站维护文本显示', '填入文本后将显示维护内容否则默认');
        $form->addInput($MaintainContent);
        $MaintainBackground = new Typecho_Widget_Helper_Form_Element_Text('MaintainBackground', NULL, NULL, '背景图片', '填入URL');
        $form->addInput($MaintainBackground);
        $url = new Typecho_Widget_Helper_Form_Element_Text('URL',Null, Null, '按钮链接', "填写URL");
        $form->addInput($url);
        $title = new Typecho_Widget_Helper_Form_Element_Text('title',NULL, "点我访问", "按钮显示文本","默认：点我访问");
        $sakura = new Typecho_Widget_Helper_Form_Element_Select('sakura',
        array(
            'off'=>'关闭樱花飘落效果',
            'on'=>'开启樱花飘落效果'
        ), 'off', '樱花效果', '关闭和开启樱花飘落');
        $form->addInput($sakura->multiMode());
        $form->addInput($title);
        $superadmin = new Typecho_Widget_Helper_Form_Element_Select('superadmin', array(
            'off'=>'关闭超级访问',
            'on'=>'开启超级访问'
        ),'on','超级访问','开启后在页面关闭的时候，管理可以正常访问');
        $form->addInput($superadmin->multiMode());
        $superadmin = new Typecho_Widget_Helper_Form_Element_Select('checknew', array(
            'on'=>'开启自动检测更新',
            'off'=>'关闭自动检测更新'
        ),'on','检测更新','是否检测插件更新');
        $form->addInput($superadmin->multiMode());
    }
    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {
        // TODO: Implement personalConfig() method.
    }
    public static function deactivate()
    {
        // TODO: Implement deactivate() method.
    }
}
