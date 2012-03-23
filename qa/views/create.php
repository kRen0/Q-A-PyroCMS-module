<?= validation_errors(); ?>
<?= (isset($captcha_err))?$captcha_err:"";?>
<?= (isset($success))?
'<p><span class="success">'.lang('qa_question_create_success').'</span></p>'
:"";?>