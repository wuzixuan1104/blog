<h1><?php echo $me->name; ?></h1>
<header>
  <figure class="bg"><img src="<?php echo $me->cover->url(); ?>"></figure>
  <span class="bottom"><?php echo $me->slogan; ?></span>
</header>

<artical class="m">
  <span class="title">關於Hsuan</span>
  <div class="about"><?php echo $me->content;?></div>
  <span class="title">更新記錄</span>
  <div class="calendar">
    
    <?php echo implode('', array_map(function($date) {
      return '<div>' . implode('' , array_map(function($v) {
        return '<a href="#" data-cnt="' . $v['cnt'] . '"><span>' . $v['date'] . ' 操作了 ' . $v['cnt'] . ' 次</span></a>';
      }, $date)) . '</div>';
    }, array_chunk($dates, 7))); ?>

  </div>

  <span class="title">熱門文章</span>
  <div class="hot"><?php 
      echo implode('', array_map(function($v) {
        return '<a href="' . Url::base($v->type . '/' . $v->id ) . '">
                  <figure class="bg"><img src="' . $v->cover->url() . '"></figure>
                  <b data-tip="' . ($v->tag ? $v->tag->tag->name : '') . '">' . $v->title . '</b>
                  <span>' . $v->desc . '</span>
                </a>';
      }, \M\Article::all(['where' => ['enable = ?', \M\Article::ENABLE_YES], 'order' => 'cntPv DESC', 'limit' => 4])));
    ?></div>
</artical>
