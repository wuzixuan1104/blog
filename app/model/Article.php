<?php

namespace M;

defined('MAPLE') || exit('此檔案不允許讀取！');

class Article extends Model {
  static $hasOne = [
    'tag' => 'ArticleTag',
  ];

  static $hasMany = [
    'tags' => 'ArticleTag',
    'refs' => 'ArticleRef',
  ];

  // static $belongToOne = [];

  // static $belongToMany = [];

  static $uploaders = [
    'cover' => 'ArticleCoverImageUploader',
  ];

  const TYPE_DEV  = 'dev';
  const TYPE_LIFE = 'life';
  const TYPE = [
    self::TYPE_DEV  => '開發心得', 
    self::TYPE_LIFE => '生活點滴',
  ];

  const ENABLE_NO  = 'no';
  const ENABLE_YES = 'yes';
  const ENABLE = [
    self::ENABLE_NO  => '關閉', 
    self::ENABLE_YES => '啟用',
  ];

  public function putFiles($files) {
    foreach ($files as $key => $file)
      if ($file && isset($this->$key) && $this->$key instanceof Uploader && !$this->$key->put($file))
        return false;
    return true;
  }
}

class ArticleCoverImageUploader extends ImageUploader {
  public function versions() {
    return [
      'w100' => ['resize' => [100, 100, 'width']],
    ];
  }
}
