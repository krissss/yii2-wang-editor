<?php

namespace kriss\wangEditor\actions;

use Yii;
use yii\base\Action;
use yii\helpers\FileHelper;
use yii\web\Response;

class BaseAction extends Action
{
    /**
     * 文件保存路径
     * @var string
     */
    public $savePath = '@webroot/uploads';
    /**
     * 文件显示的路径
     * @var string
     */
    public $displayPath = '@web/uploads';
    /**
     * 自定义消息的内容
     * @var array
     */
    public $messageMap = [];
    /**
     * @var bool
     */
    public $normalizePath = 'auto';

    public function init()
    {
        parent::init();
        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->request->enableCsrfValidation = false;
        if ($this->normalizePath === 'auto') {
            $this->normalizePath = strpos($this->savePath, '..') !== false;
        }
    }

    protected function getSaveFilename($filename)
    {
        return $this->getFullFilename($filename, $this->savePath);
    }

    protected function getDisplayFilename($filename)
    {
        return $this->getFullFilename($filename, $this->displayPath);
    }

    protected function getFullFilename($filename, $path)
    {
        $filename = Yii::getAlias(rtrim($path, '/') . '/' . $filename);
        if ($this->normalizePath) {
            return FileHelper::normalizePath($filename);
        }
        return $filename;
    }

    protected function solveDisplay2SaveFilename($displayFilename)
    {
        $displayPath = Yii::getAlias(rtrim($this->displayPath, '/'));
        if ($this->normalizePath) {
            $displayPath = FileHelper::normalizePath($displayPath);
            $displayFilename = FileHelper::normalizePath($displayFilename);
        }
        $filename = str_replace($displayPath, '', $displayFilename);
        $filename = Yii::getAlias(rtrim($this->savePath) . '/' . ltrim($filename, '/'));
        if ($this->normalizePath) {
            return FileHelper::normalizePath($filename);
        }
        return $filename;
    }

    public function returnError($msg, $code = 422)
    {
        return [
            'errno' => $code,
            'code' => $code,
            'msg' => $msg,
        ];
    }

    public function returnSuccess($data = [], $msg = 'ok', $code = 200)
    {
        return [
            'errno' => 0,
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
    }

    protected function defaultMessage()
    {
        return [
            UPLOAD_ERR_OK => '上传成功',
            UPLOAD_ERR_INI_SIZE => '超出 php.ini 中定义的 upload_max_filesize 大小',
            UPLOAD_ERR_FORM_SIZE => '上传文件超过 MAX_FILE_SIZE 指令中指定的HTML表单',
            UPLOAD_ERR_PARTIAL => '上传文件只有部分上传',
            UPLOAD_ERR_NO_FILE => '没有文件被上传',
            UPLOAD_ERR_NO_TMP_DIR => '缺少一个临时文件夹',
            UPLOAD_ERR_CANT_WRITE => '没有写文件到磁盘',
            UPLOAD_ERR_EXTENSION => '一个PHP扩展停止了文件上传',
        ];
    }

    protected function resolveErrorMessage($value)
    {
        $messages = array_merge($this->defaultMessage(), $this->messageMap);
        return isset($messages[$value]) ? $messages[$value] : $value;
    }
}
