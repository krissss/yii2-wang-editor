<?php

namespace kriss\wangEditor\assets;

use yii\web\AssetBundle;

class FullScreenAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets/plugin-full-screen1.0';
    public $css = [
        'wangEditor-fullscreen-plugin.css'
    ];
    public $js = [
        'wangEditor-fullscreen-plugin.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'kriss\wangEditor\assets\BaseAsset'
    ];
}
