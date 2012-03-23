<section class="title">
	<h4><?php echo lang('qa_responding_title'); ?></h4>
</section>

<section class="item">			
	<div class="form_inputs">	
		<?php echo form_open('admin/qa/responding/del');?>
		<?php if (!empty($all_authors)): ?>
		
			<table border="0" class="table-list">
				<thead>
					<tr>
						<th width="30"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
						<th><?= lang('faq_responding_name_label'); ?></th>
						<th><?= lang('faq_responding_email_label'); ?> </th>
						<th>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach( $all_authors as $author ): ?>
					<tr>
						<td><?=  form_checkbox('action_to[]', $author->id); ?></td>
						<td><?= anchor('admin/qa/responding/view/'.$author->id,$author->name); ?> </td>
						<td><?= $author->email; ?></td>
						<td class="align-center buttons buttons-small">
							<?php echo anchor('admin/qa/responding/view/'.$author->id, lang('qa_views_label'), 'class="button" '); ?>
							<?php echo anchor('admin/qa/responding/del/'.$author->id, lang('global:delete'), array('class'=>'confirm button delete')); ?>
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
					<?php echo lang('qa_no_responding'); ?>
				</div>
			</div>
		<?php endif;?>
	</div>
</section>