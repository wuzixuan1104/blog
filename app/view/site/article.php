<div class="container">
  <figure class="bg"><img src="<?php echo $obj->cover != '' ? $obj->cover->url() : Url::base('asset/img/' . $obj->type . '.jpg'); ?>"></figure>
  <artical class="arti">
    <header>
      <span class="tip">
        <?php 
          echo implode('', array_map(function($v) {
            return '<a href="">' . ($v->tag ? $v->tag->name : '其他') . '</a>';
          }, $obj->tags));
        ?>
      </span>
      <h1><?php echo $obj->title; ?></h1>
    </header>
    <div class="info">
      <time data-time="<?php echo $obj->createAt->format('Y.m.d'); ?>" datetime="<?php echo (String)$obj->createAt; ?>"></time>
    </div>
    <section class="s">
      <?php echo $obj->content; ?>
    </section>
  </artical>

  <artical class="arti">
    <section class="s">
      <header class="bold">相關參考</header>
      <ul class="source">
        <?php echo implode('', array_map(function($v) {
          return '<li><span>' . $v->name . '</span><a href="' . $v->url . '" target="_blank" ></a></li>';
        }, $obj->refs)); ?>
      </ul>
    </section>
  </artical>

  <artical class="hot">
    <section class="s">
      <header>推薦文章</header>
      <div class="boxes"><?php 
          echo implode('', array_map(function($v) use ($obj){
            return $v->id == $obj->id ? '' : '<a href="' . Url::base($v->type . '/' . $v->id ) . '">
                      <figure class="bg"><img alt="" src="' . ($v->cover != '' ? $v->cover->url() : Url::base('asset/img/' . $v->type . '.jpg')) . '"></figure>
                      <b data-tip="' . ($v->tag ? $v->tag->tag->name : '其他') . '">' . $v->title . '</b>
                      <span>' . $v->desc . '</span>
                    </a>';
          }, $hots));
        ?></div>
    </section>
  </artical>
</div>