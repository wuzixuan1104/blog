<?php defined('MAPLE') || exit('此檔案不允許讀取！');

abstract class SitePageController extends SiteController {
  
  public function __construct() {
    parent::__construct(func_get_args());

    Load::sysLib('Pagination.php');
    Pagination::$firstClass  = 'icon-ll';
    Pagination::$prevClass   = 'icon-l';
    Pagination::$activeClass = 'active';
    Pagination::$nextClass   = 'icon-r';
    Pagination::$lastClass   = 'icon-rr';
    Pagination::$limitD4 = 10;
    Pagination::$firstText   = '';
    Pagination::$lastText    = '';
    Pagination::$prevText    = '';
    Pagination::$nextText    = '';
  }
}
