<?php

namespace kriss\wangEditor\assets;

use yii\web\AssetBundle;

class BaseAsset extends AssetBundle
{
    public $sourcePath = '@npm/wangeditor/release';
    public $css = [
    ];
    public $js = [
        'wangEditor.min.js'
    ];
}
