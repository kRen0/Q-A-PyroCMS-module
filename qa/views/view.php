<h3 class="faq-heading"><?php echo lang('qa_title'); ?></h3>
<? echo lang('qa_pages')?>:<br />
<?php foreach($pages as $page): ?>
	- <?php echo ($page == $current_page)?"<b>{$page}</b>":"<a href=".site_url('/qa/view/'.$page).">{$page}</a>" ?> -
<?php endforeach; ?>
<br />
<?php if(!empty($questions)): ?>
<ul id="faq">
    <?php foreach($questions as $question): ?>
    <li class="question">
        <span><?php echo lang('faq_question_label'); ?>: </span><br />
        <?php echo $question->question; ?>
    <ul><li class="answer"><?php $q_id = $question->id;
	echo (!empty($answers[$q_id]))?
		$answers[$q_id]->answer."<br />".lang('qa_a_author_v_label').": ".($answers[$q_id]->author_id != 0?
			$authors[$answers[$q_id]->author_id]['name']
			:lang('qa_no_author'))
		:lang('qa_no_answer');
	?></li></ul>
	</li>
    <?php endforeach; ?>
</ul>

<?php else: ?>
    <p><?php echo lang('faq_no_questions'); ?></p>
<?php endif; ?>
