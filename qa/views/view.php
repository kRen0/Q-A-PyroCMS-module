<h1 class="page_title"><?php echo lang('qa_title'); ?></h1>
<div class="pagination">
<?php foreach($pages as $page): ?>
	- <?php echo ($page == $current_page)?"<span class=\"current_page\">{$page}</span>":"<a href=".site_url('/qa/view/'.$page).">{$page}</a>" ?> -
<?php endforeach; ?>
</div>
<?php if(!empty($questions)): ?>
<?php $i=0; ?>
<table width="100%" border="0" cellspacing="1" cellpadding="4">
<tbody>
<tr class="questionheader">
<td width="30%" height="20"><?php echo lang('qa_author_label'); ?>.</td>
<td width="70%" height="20"><?php echo lang('faq_question_label'); ?></td>
</tr>
    <?php foreach($questions as $question): ?>
    <tr class="questionview<?php echo $i; $i=!$i + 0; ?>">
	<td width="30%" valign="top">
        <b><?php echo "<a href=\"mailto:".$question->author_email."\" class=\"authorhref\">".$question->author_name."</a>"; ?></b>
	</td>
	<td width="70%" valign="top">
	<span class="small">
	<span class="datesmoll"><?php echo lang('faq_date_add_label'); ?>: <?php echo $question->date_add; ?></span>
	<hr/>
	</span>
        <?php echo $question->question; ?>
	<hr/>
	<span class="answer">
    <?php $q_id = $question->id;
	echo (!empty($answers[$q_id]))?
		$answers[$q_id]->answer."<font color=\"#FF8000\">".lang('qa_a_author_v_label').": ".($answers[$q_id]->author_id != 0?
			"<a href=\"mailto:".$authors[$answers[$q_id]->author_id]['email']."\" class=\"authorhref\">".$authors[$answers[$q_id]->author_id]['name']."</a>"
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
<div class="pagination">
<?php foreach($pages as $page): ?>
	- <?php echo ($page == $current_page)?"<span class=\"current_page\">{$page}</span>":"<a href=".site_url('/qa/view/'.$page).">{$page}</a>" ?> -
<?php endforeach; ?>
</div>
