Yii2 wangEditor widget
======================

Yii2 wangEditor widget

v2.x 与 [v1.x](https://github.com/krissss/yii2-wang-editor/tree/v1.2) 版本之间存在差异，升级请注意

[wangEditor 官网](http://www.wangeditor.com/)

安装
------------

```
composer require kriss/yii2-wang-editor
```

使用
-----

### widget
 
```php
<?php
use kriss\wangEditor\widgets\WangEditorWidget;

echo WangEditorWidget::widget([
    'name' => 'inputName',
    //'canFullScreen' => true, // 增加全屏的按钮
    //'customConfig' => [], // 扩展配置
]);
// or
echo $form->field($model, 'content')->widget(WangEditorWidget::class, [
    //'canFullScreen' => true,
]);
```

### action

```php
<?php

namespace admin\controllers;

use yii\web\Controller;
use kriss\wangEditor\actions\UploadAction;

class FileController extends Controller
{
    public function actions()
    {
        return [
            'wang-editor' => [
                'class' => UploadAction::class,
                'savePath' => '@webroot/uploads',
                'displayPath' => '@web/uploads',
            ],
        ];
    }
}
```
