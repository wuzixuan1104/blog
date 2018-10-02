/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 - 2018, OAF2E
 * @license     http://opensource.org/licenses/MIT  MIT License
 * @link        https://www.ioa.tw/
 */
 
$(function () {
  if($("#cover-photo").length > 0)
    $("#cover-photo").imgLiquid();

  $('#search').click(function() {
    $(this).toggle('active');
  });

  $('.items > a , .menu > a').click(function() {
    console.log('test');
    $(this).toggle('active').siblings().removeClass('active');
  });
});