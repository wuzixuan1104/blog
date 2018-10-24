<?php

namespace M;

defined('MAPLE') || exit('此檔案不允許讀取！');

class Article extends Model {
  // static $hasOne = [];

  static $hasMany = [
    'tags' => 'ArticleTag',
    'refs' => 'ArticleRef',
  ];

  // static $belongToOne = [];

  // static $belongToMany = [];

  // static $uploaders = [];

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
}
