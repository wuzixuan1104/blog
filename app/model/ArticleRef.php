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

  public static function checkFormat($params) {
    preg_match_all("/\s*(?P<title>[^-]+)\s*-\s*(?P<href>[^\n]+)/", $params['references'], $matches);
    if(!($matches['title'] && $matches['href']))
      return false;

    $tmp = [];
    ($tmp['title'] = $matches['title']) && ($tmp['href'] = $matches['href']);
    return $tmp;
  }

  public static function multiCreate($articleId, $refs) {
    foreach($refs['title'] as $k => $title) 
      if(!ArticleRef::create(['articleId' => $articleId, 'name' => $title, 'url' => $refs['href'][$k]]))
        return false;
    return true;
  }
}
