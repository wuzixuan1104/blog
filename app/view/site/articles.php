<div class="container">
  <form id="search">
    <button class="icon-s" type="submit"></button>
    <input type="text" name="keyword" value="<?php echo isset($keyword) ? $keyword : ''?>" placeholder="搜尋 Hsuan 的文章 ..."/>
  </form>

<?php if(isset($keyword)): ?>
  <div id="backBtn" class="icon-l2"><input type ="button" onclick="history.back()" value="回上一頁"></div>
<?php endif;?>

<?php 
  echo '<div class="lists">' . implode('', array_map(function($obj) {
    return '<a href="' . Url::base($obj->type . '/' . $obj->id) . '" class="' . ($obj->tag ? $obj->tag->tag->color : 'other') . '">
              <b data-tip="' . ($obj->tag ? $obj->tag->tag->name : '其他') . '">' . $obj->title . '</b>
              <span>' . $obj->desc . '</span>
            </a>';
  }, $objs)) . '</div>';
?>

  <div id="page">
    <ul>
      <li class="active"><a href="#">1</a></li>
      <li><a href="#">2</a></li>
      <li><a href="#">3</a></li>
      <li><a href="#">4</a></li>
      <li><a class="icon-r" href="#"></a></li>
      <li><a class="icon-rr" href="#"></a></li>
    </ul>
  </div>
</div>