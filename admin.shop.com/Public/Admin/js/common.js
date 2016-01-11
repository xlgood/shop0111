//通用的ajax的get请求
$(function () {
  $('.ajax-get').click(function () {     //找到class为ajax-get的标签
    var url = $(this).prop('href');      //获取该标签的url属性作为请求地址
    $.get(url, showAjaxLayer);           //发送get请求 由于url上已经有参数，所以第二个参数可以不写
    return false;                        //取消标签默认事件
  });
});
//通用的ajax的post请求
$(function () {
  $('.ajax-post').click(function () {
    var form = $(this).closest('form');
    if(form.length!=0){
      form.ajaxSubmit({success:showAjaxLayer});   //通过jquery.form.js里面的ajaxSubmit方法进行表单提交
    }else{
      var url = $(this).attr('url');  //获取当前删除按钮的url属性的值
      var params = $('.ids:checked').serialize();  //获取表单元素的值
      //console.debug(url);
      //return;
      $.post(url,params,showAjaxLayer);  //提交post请求
    }
    return false;                               //取消标签默认事件
  });
});
//显示layer提示框 并进行跳转
function showAjaxLayer(data) {     //data为请求的响应数据
  //console.debug(data);
  //return;
  if(data.status){
    layer.msg(data.info, {
      time:1000,
      offset:0,
      shift:0,
      icon:data.status
    },function(){
      //关闭后的操作
      location.href = data.url;
    });

  }else{
    layer.msg(data.info, {
      time:1000,
      offset:0,
      shift:0,
      icon:data.status
    },function(){
      //关闭后的操作
      location.href = data.url;
    })
  }
}

$(function () {
  $('.id').click(function () {
    $('.ids').prop('checked',$(this).prop('checked'));
  });
  $('.ids').click(function () {
    $('.id').prop('checked',$('.ids:not(:checked)').length==0);
  });
});