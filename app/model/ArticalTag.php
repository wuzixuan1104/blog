<?php

namespace M;

defined('MAPLE') || exit('此檔案不允許讀取！');

class ArticalTag extends Model {
  // static $hasOne = [];

  // static $hasMany = [];

  // static $belongToOne = [];

  // static $belongToMany = [];

  // static $uploaders = [];
  const MAIN_YES  = 'yes';
  const MAIN_NO = 'no';
  const MAIN = [
    self::MAIN_YES  => '是', 
    self::MAIN_NO => '否',
  ];
}
