<h3 class="faq-heading"><?php echo lang('qa_title'); ?></h3>
<? echo lang('qa_pages')?>:<br />
<?php foreach($pages as $page): ?>
	- <?php echo ($page == $current_page)?"<b>{$page}</b>":"<a href=".site_url('/qa/view/'.$page).">{$page}</a>" ?> -
<?php endforeach; ?>
<br />
<?php if(!empty($questions)): ?>
<table width="100%" border="0" cellspacing="1" cellpadding="4">
<tbody>
<td width="30%" height="20"><?php echo lang('qa_author_label'); ?>.</td>
<td width="70%" height="20"><?php echo lang('faq_question_label'); ?></td>
</tr>
    <?php foreach($questions as $question): ?>
    <tr>
	<td width="30%" valign="top">
        <b><?php echo "<a href=\"mailto:".$question->author_email."\">".$question->author_name."</a>"; ?></b>
	</td>
	<td width="70%" valign="top">
	<span class="small">
	<?php echo lang('faq_date_add_label'); ?>: <?php echo $question->date_add; ?>
	<hr/>
	</span>
        <?php echo $question->question; ?>
	<hr/>
	<span>
    <?php $q_id = $question->id;
	echo (!empty($answers[$q_id]))?
		$answers[$q_id]->answer."<font color=\"#FF8000\">".lang('qa_a_author_v_label').": ".($answers[$q_id]->author_id != 0?
			"<a href=\"mailto:".$authors[$answers[$q_id]->author_id]['email']."\">".$authors[$answers[$q_id]->author_id]['name']."</a>"
			:lang('qa_no_author'))."</font>"
		:lang('qa_no_answer');
	?>
	</span>
	</td>
</tr>
    <?php endforeach; ?>
</tbody>
</table>
<?php else: ?>
    <p><?php echo lang('faq_no_questions'); ?></p>
<?php endif; ?>
