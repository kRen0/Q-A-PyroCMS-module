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
		/*
		if(responseText.indexOf('success') + 1) {
			text = "<p><span class=\"success\">Благодарим! Ваш вопрос принят.</span></p>";
			document.getElementById('output').innerHTML=text;
			$("#sendQuestion").resetForm();
		}
		*/
		/*
		*
		* получаем JSON объект, он будет содержать два поля response.responseCode и response.data
		* по responseCode понимаем, что произошло, а выводим response.data
		*
		*
		*/
		$("#sendQuestion").resetForm();
		$("#purr").purr();
	}
 var RecaptchaOptions = {
    theme : 'custom',
    custom_theme_widget: 'recaptcha_widget'
 };
 window.onload = function() {
              Recaptcha.focus_response_field();
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
<div id="output"></div>
<form id="sendQuestion" action="<?php echo site_url(); ?>/qa/createquestion" method="post">
<input name="name" type="text" placeholder="Ваше имя" />
<input name="email" type="text" placeholder="Ваш email"/>
<textarea name="question" placeholder="Текст сообщения"></textarea>

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