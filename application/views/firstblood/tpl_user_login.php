    <div class="container-fluid">
        <div class="login">
            <div class="login-container">
                <img alt="Logo login@2x" height="30" src="/static/images/logo-login%402x.png" width="100" />
                <form>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icon-envelope"></i></span><input class="form-control" placeholder="Email" type="text" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icon-lock"></i></span><input class="form-control" placeholder="Password" type="password" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="checkbox"><input type="checkbox" />Remember me</label>
                    </div>
                    <div class="btn btn-lg btn-primary login-submit">Log in</div>
                </form>
                <a href="index.html#">Forgot password?</a>
            </div>
        </div>
    </div>

<!--
<form class="form-horizontal col-sm-6" role="form" >
  <div class="form-group ">
    <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
    <div class="col-sm-4">
      <input type="text" class="form-control"  name="username" >
    </div>
  </div>
  <div class="form-group ">
    <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
    <div class="col-sm-4">
        <input type="password" name="password"  class="form-control">
    </div>
  </div>
<div class="form-group ">
    <label for="inputPassword3" class="col-sm-2 control-label">验证码</label>
    <div class="col-sm-4">
    <input type="text"  name="vcode"  class="form-control">
        <input type="password" name="password"  class="form-control">
        <span class="form_vcode">
            <script src="<?=base_url('imgauthcode/show_script')?>"></script>
        </span>
    </div>
  </div>

  <div class="form-group ">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="button" class="btn btn-default form_submit" >登陆</button>
    </div>
  </div>
</form>
</div>
-->


<script type="text/javascript">
    $('.form_submit').click(function(e) {
        var current_form = $(this).parents().find('form');
        $.post(
            window.location.href+'?t=1',
            current_form.serialize(),
            function(data) {

                error_input =  new Array();
                var elements = current_form.children().find('input');
                input_ele_set(elements, data);

                if(data.error_code ==1){
                    if(error_input.length>0){
                        error_input[0].focus();
                    }
                }else{
                    var success = "登陆成功！";
                    $.scojs_message(success, $.scojs_message.TYPE_OK);
                    setTimeout('redirectNext()',2000);
                }
                $('#img_authcode').click();
        });
    });
    var input_ele_set = function(elements , data){
        elements.each(function() {
            var notice_id   = $(this).attr('name');
            var error_data  = data.data[notice_id];
            if(typeof(error_data)=='undefined'){
                $(this).removeClass('error_input');
                $('#'+notice_id).removeClass('error_tips');
                $('#'+notice_id).html('');
            }else{
                $(this).addClass('error_input');
                $('#'+notice_id).addClass('error_tips');
                $('#'+notice_id).html(data.data[notice_id]);
                error_input.push(this);
            }
        });
    }
    var redirectNext = function(){window.location = 'http://' + window.location.host + '/admin/';}

    $('[name="password"]').keypress(function(event){
        var e = event||window.event;
        var o = e.target||e.srcElement;
        var keyCode  =  e.keyCode||e.which;
        var isShift  =  e.shiftKey ||(keyCode  ==   16 ) || false ;
         if (
         ((keyCode >=   65   &&  keyCode  <=   90 )  &&   !isShift)
         || ((keyCode >=   97   &&  keyCode  <=   122 )  &&  isShift)
         ){
             o.style.background ='#FFF URL(<?=base_url("static/images/capslock.png");?>) right center no-repeat';
         }
         else{o.style.backgroundImage  =  'none';}
    });

    $('[name="password"]').blur(function(event){
         var e = event||window.event;
         var o = e.target||e.srcElement;
         o.style.backgroundImage  =  'none';
    });
</script>
<script type="text/javascript">
    $('input').keydown(function(event) {
        var keyCode = event.which;
            if (keyCode == 13){
                $('.form_submit').click();
            }
    });
</script>

</body>
</html>
