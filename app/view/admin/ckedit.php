<!DOCTYPE html>
<html lang="tw">
  <head>
    <meta http-equiv="Content-Language" content="zh-tw" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui" />

    <title>>圖片上傳</title>

    <?php echo $asset->renderCSS();?>
    <?php echo $asset->renderJS();?>

  </head>
  <body lang="zh-tw">
    <main id="imgs">
      <?php echo implode('', array_map(function($obj) {
        return '<div data-url="' . $obj->name->url() . '">
                  <img src="' . $obj->name->url() . '">
                  <time datetime="' . (string)$obj->createAt . '">' . (string)$obj->createAt . '</time>
                </div>';
      }, \M\CkeditorImg::all(['order' => 'createAt desc'])))?>
    </main>
  </body>
</html>