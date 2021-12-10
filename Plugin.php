<?php
if(!defined('__TYPECHO_ROOT_DIR__')){
    exit;
}
/**
 * 维护模式插件
 *
 * @package 维护模式
 * @author 伊藤雄二
 * @version 1.0.0
 * @link http://dns.doraeclub.com
 */
class Maintain_Plugin implements Typecho_Plugin_Interface
{
    public static function activate(){
        Typecho_Plugin::factory('Widget_Archive')->header = array('Maintain_Plugin', 'render');
    }
    public static function render($header,$archive){
        if (Helper::options()->plugin("Maintain")->MaintainButton === "on"){
            include("view/maintain.php");
            die();
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
        $form->addInput($title);

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
