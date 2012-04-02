<?$publickey = "6LdeMc8SAAAAAF-QChdCiwNebOrGowvxJfy6toIS";?>
    <div id="purr" style="display:none" class="">
		<h1> Сообщение добавлено </h1>
		Спасибо за ваше сообщение, <br/>мы обязательно ответим на него!
    </div>
<script type="text/javascript">
$(document).ready(function(){
var options = { 
    success: showResponse,
    timeout: 3000
  };
  $('#sendQuestion').submit(function() { 
    $(this).ajaxSubmit(options); 
    return false;
  }); 
});
	function showResponse(responseText, statusText)  { 
		Recaptcha.reload();

		var response = eval( '('+responseText+')' );
		if((response.success) == 1) {
			$("#sendQuestion").resetForm();
			$("#purr").purr();
		}
		else {
			$('#output').attr('style','display:block');
			$('#name_error_output').html(response.data.name);
			$('#email_error_output').html(response.data.email);
			$('#question_error_output').html(response.data.question);
			$('#captcha_error_output').html(response.data.captcha);
		}
	}
 var RecaptchaOptions = {
    theme : 'custom',
    custom_theme_widget: 'recaptcha_widget'
 };
 function hint(elem, action) {
	if(action == 1) {
		if(elem.value === elem.title) elem.value="";
	}
	else {
		if(elem.value === "") elem.value = elem.title;
	}
 }
</script>
<div class="voprosout">
<div class="vopros">
<div>
<img src="/addons/shared_addons/themes/arteflight/img/TatyanaLobanova.jpg" alt="Татьяна лобанова"/>
<span class="name">Татьяна Лобанова</span>
<span class="pcih">
психолог
<br/>
 бизнес-консультант
</span>
<span id="output" class="error" style="display:none">При заполнении формы обнаружены ошибки</span>
<form id="sendQuestion" action="<?php echo site_url(); ?>/qa/createquestion" method="post">
<span id="name_error_output"></span>
<input name="name" type="text" title="Ваше имя" value="Ваше имя" onFocus="hint(this,'1')" onBlur="hint(this)" />
<span id="email_error_output"></span>
<input name="email" type="text" title="Ваш email" value="Ваш email" onFocus="hint(this,'1')" onBlur="hint(this)" />
<span id="question_error_output"></span>
<textarea name="question" title="Текст сообщения" onFocus="hint(this,'1')" onBlur="hint(this)">Текст сообщения</textarea>
<span id="captcha_error_output"></span>
<span id="recaptcha_widget" style="display:none"><span id="recaptcha_image"></span>

<input type="text" id="recaptcha_response_field" name="recaptcha_response_field" style="width:140px; float:left"/><a href="javascript:Recaptcha.reload()">
<img src="/addons/shared_addons/themes/arteflight/img/refresh.gif" alt="обновить код" /></a>
<script type="text/javascript" src="http://www.google.com/recaptcha/api/challenge?k=<?=$publickey?>"></script>
</span>
<noscript>
<a href="http://www.google.com/recaptcha/api/noscript?k=<?=$publickey?>" target="_blank">Нажмите, для получния кода подтверждения</a><br>
Введите код подтверждения сюда:<br />
<textarea name="recaptcha_challenge_field" rows="3" cols="40">
             </textarea>
<input type="hidden" name="recaptcha_response_field" value="manual_challenge"></noscript>
<hr class="breaker" />
<input name="input" style="width:142px; height:31px; background-color:#FFFFFF" type="submit" class="long" value="Задать вопрос"/>
</form>
</div>
</div>
</div>