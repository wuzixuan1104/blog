<?php

namespace M;

defined('MAPLE') || exit('此檔案不允許讀取！');

class CkeditorImg extends Model {
  // static $hasOne = [];

  // static $hasMany = [];

  // static $belongToOne = [];

  // static $belongToMany = [];

  static $uploaders = [
    'name' => 'CkeditorImgNameImageUploader',
  ];

  public function putFiles($files) {
    foreach ($files as $key => $file)
      if ($file && isset($this->$key) && $this->$key instanceof Uploader && !$this->$key->put($file))
        return false;
    return true;
  }
}

class CkeditorImgNameImageUploader extends ImageUploader {
  public function versions() {
    return [
      'w100' => ['resize' => [100, 100, 'width']],
    ];
  }
}
