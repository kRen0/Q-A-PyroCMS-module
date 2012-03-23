<section class="title">
	<h4> <?= lang('qa_responding_title'); ?> </h4>
</section>

<section class="item">
	
	<?php echo form_open('admin/qa/responding/create/'); ?>
		
			<div class="form_inputs">
				<fieldset>
					<ul>
						<li>
							<label for="name"> <?= lang('faq_responding_name_label'); ?> <span>*</span> </label>
							<div class="input">
							<?= form_input('name'); ?>
							</div>
						</li>
						<li>
							<label for="email"> <?= lang('faq_responding_email_label'); ?> </label>
							<div class="input"> <?= form_input('email'); ?> </div>
						</li>
					</ul>
				</fieldset>
			</div>
	
		<div class="buttons align-right padding-top">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel') )); ?>
		</div>
	
	<?php echo form_close(); ?>
</section>