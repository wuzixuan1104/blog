<?php

namespace M;

defined('MAPLE') || exit('此檔案不允許讀取！');

class ArticleTag extends Model {
  // static $hasOne = [];

  // static $hasMany = [];

  static $belongToOne = [
    'article' => 'Article',
    'tag' => 'Tag',
  ];

  // static $belongToMany = [];

  // static $uploaders = [];
  const MAIN_YES  = 'yes';
  const MAIN_NO = 'no';
  const MAIN = [
    self::MAIN_YES  => '是', 
    self::MAIN_NO => '否',
  ];

  public static function checkFormat($params) {
    preg_match_all("/#\s*(?P<name>[^#\n]+)/", $params['tags'], $matches);
    if (!$matches['name'])
      return false;

    ($tags = \M\Tag::all()) && ($ids = arrayColumn($tags, 'id')) && ($names = arrayColumn($tags, 'name'));
    
    $tmp = $r = [];
    foreach($matches['name'] as $k => $t) {
      if(in_array(($t = trim($t)), $r))
        continue;

      if (false === ($key = array_search($t, $names))) {
        if(!$newTag = \M\Tag::create(['name' => $t, 'color' => 'other']))
          return false;

        $tmp[$k] = $r[] = $newTag->id;
      } else {
        $tmp[$k] = $r[] = $ids[$key];
      }
    }
    return $tmp;
  }

  public static function multiCreate($articleId, $tagIds) {
    foreach($tagIds as $t) 
      if(!ArticleTag::create(['articleId' => $articleId, 'tagId' => $t]))
        return false;
    return true;
  }
}
