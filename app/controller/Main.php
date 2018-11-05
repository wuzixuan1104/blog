<?php defined('MAPLE') || exit('此檔案不允許讀取！');

class Main extends SiteController {
  public function __construct() {
    parent::__construct();

    $this->view->with('title', '首頁 - Hsuan\'s Blog');
  }

  public function index() {
    $asset = $this->asset->addCSS('/asset/css/site/Main/index.css');
    
    $dbActs = \M\AdminAction::all(['select' => 'date(createAt) as date, count(createAt) as cnt', 'group' => 'date(createAt)', 'order' => 'createAt DESC']);
      
    $endDt = date('Y-m-d', strtotime('-209 days'));

    $now = date('Y-m-d');
    $dates[0] = ['date' => $now, 'cnt' => 0];

    while($endDt < $now) {
      $now = date('Y-m-d', strtotime($now . ' - 1 day'));
      $dates[] = ['date' => $now, 'cnt' => 0];
    }

    foreach($dates as $k => $v) {
      foreach($dbActs as $kAct => $vAct) 
        if($v['date'] == $vAct->date)
          $dates[$k]['cnt'] = $vAct->cnt;
    }

    return $this->view->setPath('site/main.php')
                      ->with('asset', $asset)
                      ->with('dates', $dates);

  }
}
