<section class="title">
	<h4> <?= lang('qa_responding_title'); ?> </h4>
</section>

<section class="item">
	<?php if(!empty($author)): ?>
	<?php echo form_open('admin/qa/responding/view/'.$author->id); ?>
		
			<div class="form_inputs">
				<fieldset>
					<ul>
						<li>
							<label for="name"> <?= lang('faq_responding_name_label'); ?> <span>*</span> </label>
							<div class="input">
							<?= form_input('name',(set_value('name')!=''?set_value('name'):$author->name)); ?>
							</div>
						</li>
						<li>
							<label for="email"> <?= lang('faq_responding_email_label'); ?><span>*</span> </label>
							<div class="input"> <?= form_input('email',(set_value('email')!=''?set_value('email'):$author->email)); ?> </div>
						</li>
					</ul>
				</fieldset>
			</div>
	
		<div class="buttons align-right padding-top">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel') )); ?>
		</div>
		<?php endif; ?>
	<?php echo form_close(); ?>
</section>