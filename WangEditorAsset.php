<?php

namespace kriss\wangEditor;

use yii\web\AssetBundle;

class WangEditorAsset extends AssetBundle
{
    public $sourcePath = '@npm/dist/wang-editor';
    public $css = [
    ];
    public $js = [
        'wangEditor.js'
    ];
}