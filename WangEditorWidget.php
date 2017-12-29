<?php

namespace kriss\wangEditor;

use yii\helpers\Html;
use yii\widgets\InputWidget;

class WangEditorWidget extends InputWidget
{
    /**
     * 客户端 js 扩展
     * 使用替换变量：{name}:editor实例，{hiddenInputId}:隐藏输入域的id
     * example:
     * <<<JS
     * {name}.customConfig.uploadImgServer = '/upload/wang';
     * {name}.customConfig.onchange = function (html) {
     *    $('#{hiddenInputId}').val(html);
     * }
     * JS;
     * @link https://www.kancloud.cn/wangfupeng/wangeditor3/332599
     * @var string
     */
    public $clientJs;
    /**
     * 是否显示全屏
     * @link https://github.com/chris-peng/wangEditor-fullscreen-plugin
     * @var bool
     */
    public $canFullScreen = false;

    /**
     * @var string
     */
    private $_editorId;

    public function init()
    {
        parent::init();
        $this->_editorId = 'editor-' . $this->id;
    }

    public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeHiddenInput($this->model, $this->attribute, $this->options);
            $attribute = $this->attribute;
            $content = $this->model->$attribute;
        } else {
            echo Html::hiddenInput($this->name, $this->value, $this->options);
            $content = $this->value;
        }
        echo Html::tag('div', $content, ['id' => $this->_editorId]);
        $this->registerJs();
    }

    public function registerJs()
    {
        $view = $this->getView();
        WangEditorAsset::register($view);
        if ($this->canFullScreen) {
            WangEditorFullScreenAsset::register($view);
        }

        $id = $this->_editorId;
        $name = 'editor' . $this->id;
        $hiddenInputId = $this->options['id'];
        $clientJs = strtr($this->clientJs, [
            '{name}' => $name,
            '{hiddenInputId}' => $hiddenInputId
        ]);
        $js = <<<JS
var WangEditor = window.wangEditor;
var {$name} = new WangEditor('#{$id}');
{$name}.customConfig.onchange = function (html) {
    $('#{$hiddenInputId}').val(html);
}
{$clientJs}
{$name}.create();
JS;
        if ($this->canFullScreen) {
            $js .= <<<JS
WangEditor.fullscreen.init('#{$id}');
JS;
        }
        $view->registerJs($js);
    }

    protected function registerFullScreenAsset()
    {

    }
}