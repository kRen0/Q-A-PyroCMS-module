<section class="title">
    <h4><?php echo lang('qa_edit_title'); ?></h4>
</section>
<section class="item">
<?php echo form_open('admin/qa/view/'.$qa->id, 'id="qa"'); ?>
<div class="form_inputs">
    <fieldset>
        <ul>
            <li>
                <label for="question"><?php echo lang('faq_question_label'); ?><span class="required-icon tooltip">*</span></label>
                    <textarea class="wysiwyg-simple" name="question" rows="10" cols="40"><?php echo (set_value('question')!=''?set_value('question'):$qa->question); ?></textarea>
            </li>
			<li>
                <label for="name"><?php echo lang('faq_author_name_label'); ?><span class="required-icon tooltip">*</span></label>
                <div class="input">
                    <input name="name" type="text" value="<?php echo (set_value('name')!=''?set_value('name'):$qa->author_name); ?>" />
                </div>
            </li>
			<li>
                <label for="email"><?php echo lang('faq_email_name_label'); ?><span class="required-icon tooltip">*</span></label>
				<a href="mailto:<?php echo $qa->author_email; ?>"><?php echo $qa->author_email; ?></a>
                <div class="input">
                    <input name="email" type="text" value="<?php echo (set_value('email')!=''?set_value('email'):$qa->author_email); ?>" />
                </div>
            </li>
            <li>
                <label for="authors"><?php echo lang('qa_a_author_label'); ?></label>
                <div class="input">
                    <?php echo form_dropdown('authors', $authors_options, (set_value('authors')!=''?set_value('authors'):((!empty($answ))?$answ->author_id:0))); ?>
                </div>
            </li>
            <li>
                <label for="answer"><?php echo lang('qa_answer_label'); ?></label><br style="clear:both;">
                <textarea class="wysiwyg-simple" name="answer" rows="10" cols="40">
				<?php 
				if(set_value('answer')!='') echo set_value('answer');
				elseif(!empty($answ)) echo $answ->answer; 
				?>
				</textarea>
            </li>
        </ul>
        <input type="hidden" name="qa_id" value="<?php echo $qa->id; ?>" />
		<input type="hidden" name="a_id" value="<?php if(!empty($answ)) echo $answ->id; ?>" />
    </fieldset>
</div>
<div class="buttons">
<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
</div>
<?php echo form_close(); ?>
</section>