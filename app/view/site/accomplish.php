<div class="container">
  <figure><div class="bg"><img src="<?php echo Url::base('asset/img/maple.jpg'); ?>"></div></figure>
  <artical id="timeline">
    <?php 
      $tmpDate = '';
      echo implode('', array_map(function($obj) use (&$tmpDate) {
              $date = new Datetime($obj->createAt);

              $tmp = '';
              if($tmpDate != '' && $tmpDate != $date->format('F Y')) {
                $tmp = '<session class="period"><header>' . $tmpDate . '</header></session>';
              }

              $tmpDate = $date->format('F Y');
              return $tmp . '<session class="item">
                        <time data-time="' . $date->format('F j') . '" date="' . $date->format('Y-m-d') . '"></time>
                        <i class="' . $obj->type . '"></i>
                        <div class="content">
                          <h3>' . $obj->title . '</h3>' .
                          ($obj->tags ? 
                          '<span class="tag">' .
                            implode('', array_map(function($v) {
                              return '<a href="">' . $v->tag->name . '</a>';
                            }, $obj->tags)) .
                          '</span>' : '') .
                          '<p>' . $obj->desc . '</p>
                          <a class="more" href="' . Url::base($obj->type . '/' . $obj->id) . '"></a>
                        </div>
                      </session>';
            }, $objs)); ?>

  </artical>
</div>