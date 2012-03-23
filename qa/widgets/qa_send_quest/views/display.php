<?require_once('recaptchalib.php');
$publickey = "6LdeMc8SAAAAAF-QChdCiwNebOrGowvxJfy6toIS";?>
<script type="text/javascript">
$(document).ready(function(){
var options = { 
  	target: "#output",
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
	if(responseText.indexOf('success') + 1) {
		text = "<p><span class=\"success\">Благодарим! Ваш вопрос принят.</span></p>";
		document.getElementById('output').innerHTML=text;
		$("#sendQuestion").resetForm();
	}
}
 var RecaptchaOptions = {
    theme : 'clean'
 };
 function clearHint(elem, str) {
	if(elem.value === str) elem.value="";
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
<input name="name" type="text" value="Ваше имя" onClick="clearHint(this, 'Ваше имя')" />
<input name="email" type="text" value="Ваш email" onClick="clearHint(this, 'Ваш email')" />
<textarea name="question" onClick="clearHint(this, 'Текст сообщения')">Текст сообщения</textarea>
<?=recaptcha_get_html($publickey);?>
<input name="input" style="width:142px; height:31px; background-color:#FFFFFF" type="submit" class="long" value="Задать вопрос"/>
</form>
</div>
</div>
</div>