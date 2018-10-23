<?php defined('MAPLE') || exit('此檔案不允許讀取！');

class CkeditorImg extends AdminCrudController {
  
  public function __construct() {
    parent::__construct();
  }
  
  public function upload() {
    $funcNum = $_GET['CKEditorFuncNum'];
    $files = Input::file(filename)();

    validator(function() use (&$files) {
      Validator::need($files, 'upload', '上傳圖片檔')->isUploadFile();
    });
    
    if (($img = \M\CkeditorImg::create(['name' => ''])) && $img->name->put($files['upload']))
      echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction ($funcNum, '" . $img->name->url() . "', '上傳成功！');</script>";
    else 
      echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction ($funcNum, '', '上傳失敗！');</script>";
  }

  public function browse() {
    $asset = Asset::create()
                  ->addJS('/asset/js/admin/ckedit.js')
                  ->addCSS('/asset/css/admin/ckedit.css');

    return View::create('admin/ckedit.php')
               ->with('asset', $asset);
  }
}