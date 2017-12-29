<?php

namespace kriss\wangEditor;

use yii\web\AssetBundle;

class WangEditorFullScreenAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/plugin-full-screen';
    public $css = [
        'wangEditor-fullscreen-plugin.css'
    ];
    public $js = [
        'wangEditor-fullscreen-plugin.js'
    ];
}