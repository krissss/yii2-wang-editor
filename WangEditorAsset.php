<?php

namespace kriss\wangEditor;

use yii\web\AssetBundle;

class WangEditorAsset extends AssetBundle
{
    public $sourcePath = '@npm/wangeditor/release';
    public $css = [
    ];
    public $js = [
        'wangEditor.min.js'
    ];
}