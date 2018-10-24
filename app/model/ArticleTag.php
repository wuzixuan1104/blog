<?php

namespace M;

defined('MAPLE') || exit('此檔案不允許讀取！');

class ArticleTag extends Model {
  // static $hasOne = [];

  // static $hasMany = [];

  static $belongToOne = [
    'article' => 'Article',
  ];

  // static $belongToMany = [];

  // static $uploaders = [];
  const MAIN_YES  = 'yes';
  const MAIN_NO = 'no';
  const MAIN = [
    self::MAIN_YES  => '是', 
    self::MAIN_NO => '否',
  ];

  public static function multiCreate($articleId, $tagIds) {
    foreach($tagIds as $t) 
      if(!ArticleTag::create(['articleId' => $articleId, 'tagId' => $t]))
        return false;
    return true;
  }
}
