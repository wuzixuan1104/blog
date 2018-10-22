<?php

namespace M;

defined('MAPLE') || exit('此檔案不允許讀取！');

class Tag extends Model {
  // static $hasOne = [];

  // static $hasMany = [];

  // static $belongToOne = [];

  // static $belongToMany = [];

  // static $uploaders = [];

  const TYPE_DEV  = 'dev';
  const TYPE_LIFE = 'life';
  const TYPE = [
    self::TYPE_DEV  => '開發心得', 
    self::TYPE_LIFE => '生活點滴',
  ];

  const COLOR_PINK  = 'pink';
  const COLOR_BLUE = 'blue';
  const COLOR_GREEN = 'green';
  const COLOR_ORANGE = 'orange';
  const COLOR_OTHER = 'other';
  const COLOR = [
    self::COLOR_PINK  => '紅', 
    self::COLOR_BLUE => '藍',
    self::COLOR_GREEN => '綠',
    self::COLOR_ORANGE => '橘',
    self::COLOR_OTHER => '其他',
  ];
}
