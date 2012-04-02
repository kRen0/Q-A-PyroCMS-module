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
			console.debug(response.data);
			 for(var i in response.data){
				if(response.data[i]){
					noty({text:response.data[i],animateOpen:{opacity:'show'},animateClose:{opacity:'hide'},layout:'topLeft',theme:'noty_theme_default',type:'error',timeout:10000});  
				}
			 }
		}
		
		setTimeout("HideError()", 10000);
	}
	function HideError()  { 

		$('#output').attr('style','display:none');
		$('#name_error_output').html('');
		$('#email_error_output').html('');
		$('#question_error_output').html('');
		$('#captcha_error_output').html('');
			
	}
 var RecaptchaOptions = {
    theme : 'custom',
    custom_theme_widget: 'recaptcha_widget'
 };
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
<span id="output" class="error_string" style="display:none">При заполнении формы обнаружены ошибки</span>
<form id="sendQuestion" action="<?php echo site_url(); ?>/qa/createquestion" method="post">
<span id="name_error_output"></span>
<input name="name" type="text" title="Ваше имя" placeholder="Ваше имя" />
<span id="email_error_output"></span>
<input name="email" type="text" title="Ваш email" placeholder="Ваш email" />
<span id="question_error_output"></span>
<textarea name="question" title="Текст сообщения" placeholder="Текст сообщения"></textarea>
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
<input type="hidden" placheholder="Код" name="recaptcha_response_field" value="manual_challenge"></noscript>
<hr class="breaker" />
<input name="input" style="width:142px; height:31px; background-color:#FFFFFF" type="submit" class="long" value="Задать вопрос"/>
</form>
</div>
</div>
</div>