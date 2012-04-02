<section class="title">
	<h4><?php echo lang('qa_manage_title'); ?></h4>
</section>

<section class="item">			
	<div class="form_inputs">	
		<?php echo form_open('admin/qa/del');?>
		<?php if (!empty($questions)): ?>
		
			<table border="0" class="table-list">
				<thead>
					<tr>
						<th width="30"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
						<th><?= lang('faq_date_add_label'); ?></th>
						<th><?= lang('faq_author_name_label'); ?> </th>
						<th><?= lang('qa_is_answered'); ?> </th>
						<th>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach( $questions as $quest ): ?>
					<tr <?= $quest->answered=='0'?'style="background-color: #E4F6A8"':'' ?>>
						<td><?=  form_checkbox('action_to[]', $quest->id); ?></td>
						<td><?= anchor('admin/qa/view/'.$quest->id,$quest->date_add); ?> </td>
						<td><?= $quest->author_name; ?></td>
						<td><?= $quest->answered=='1'?lang('qa_answered'):lang('qa_not_answered')?></td>
						<td class="align-center buttons buttons-small">
							<?php echo anchor('admin/qa/view/'.$quest->id, lang('qa_views_label'), 'class="button" '); ?>
							<?php echo anchor('admin/qa/del/'.$quest->id, lang('global:delete'), array('class'=>'confirm button delete')); ?>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		
			<div class="table_action_buttons">
				<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete') )); ?>
			</div>
		<?= form_close(); ?>
		<?php else: ?>
			<div class="blank-slate">
				<div class="no_data">
					<?php echo lang('faq_no_questions'); ?>
				</div>
			</div>
		<?php endif;?>
	</div>
</section>