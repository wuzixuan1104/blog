<?php

namespace M;

defined('MAPLE') || exit('此檔案不允許讀取！');

class ArticleRef extends Model {
  // static $hasOne = [];

  // static $hasMany = [];

  static $belongToOne = [
    'article' => 'Article',
  ];

  // static $belongToMany = [];

  // static $uploaders = [];

  public static function multiCreate($articleId, $refs) {
    foreach($refs['title'] as $k => $title) 
      if(!ArticleRef::create(['articleId' => $articleId, 'name' => $title, 'url' => $refs['href'][$k]]))
        return false;
    return true;
  }
}
