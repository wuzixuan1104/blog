<?php defined('MAPLE') || exit('此檔案不允許讀取！');

abstract class SiteController extends Controller {
  protected $asset, $view;
  
  public function __construct() {
    parent::__construct();

    Load::sysLib('Asset.php');
    Load::sysLib('Html.php');

    $this->asset = Asset::create(1)
         ->addCSS('/asset/css/res/jquery.datetimepicker.css')
         ->addCSS('/asset/css/icon-site.css')
         ->addJS('/asset/js/res/jquery-1.10.2.min.js')
         ->addJS('/asset/js/res/jquery_ui_v1.12.1.js')
         ->addJS('/asset/js/res/jquery_ujs.js')
         ->addJS('/asset/js/res/imgLiquid-min.js')
         ->addJS('/asset/js/res/timeago.js')
         ->addJS('/asset/js/res/datetimepicker/jquery.datetimepicker.full.js')
         ->addJS('/asset/js/res/oaips-20180115.js')
         ->addJS('/asset/js/res/autosize-3.0.8.js')
         ->addJS('/asset/js/res/OAdropUploadImg-20180115.js')
         ->addJS('/asset/js/res/ckeditor_d2015_05_18/ckeditor.js')
         ->addJS('/asset/js/res/ckeditor_d2015_05_18/adapters/jquery.js')
         ->addJS('/asset/js/res/ckeditor_d2015_05_18/plugins/tabletools/tableresize.js')
         ->addJS('/asset/js/res/ckeditor_d2015_05_18/plugins/dropler/dropler.js')
         ->addJS('/asset/js/site/layout.js');

    $this->view = View::maybe(Router::className() . '/' . Router::methodName() . '.php')
                          ->withReference('asset', $this->asset);
    // $this->view = View::maybe('admin/' . Router::className() . '/' . Router::methodName() . '.php')
    //                   ->appendTo(View::create('admin/layout.php'), 'content')
    //                   ->with('flash', $this->flash)
    //                   ->with('currentUrl', null)
    //                   ->with('theme', $theme)
    //                   ->withReference('asset', $this->asset);
  }
}
