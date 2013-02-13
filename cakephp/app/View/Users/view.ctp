
<div id="body">

	<div class="nav-menu">
		<ul>
		<li><?php echo $this->Html->link('View Users',
			array('controller' => 'users', 'action' => 'view')); ?></li>
		<li><?php echo $this->Html->link('Create User',
			array('controller' => 'users', 'action' => 'create')); ?></li>
		<li>-</li>
		<li><?php echo $this->Html->link('View Teams',
			array('controller' => 'teams', 'action' => 'view')); ?></li>
		<li><?php echo $this->Html->link('Create Team',
			array('controller' => 'teams', 'action' => 'create')); ?></li>
		<li>-</li>
		<li><?php echo $this->Html->link('Assign User to Team',
			array('controller' => 'users', 'action' => 'assign_team')); ?></li>
	
	</div>
	
	<div class="content-wrapper">
		<h2><?php echo $page_subtitle; ?></h2>
		<?php //var_dump($users); ?>
		
		<div class="error-wrapper">
			<?php //echo $this->session->flashdata( 'error' ); ?>
		</div>
		
		<div class="success-wrapper">
			<?php //echo $this->session->flashdata( 'success' ); ?>
		</div>
		
		<table class="table">
			<thead>
				<tr>
					<th><?php echo 'ID'; ?></th>
					<th><?php echo 'Username'; ?></th>
					<th><?php echo 'Level'; ?></th>
					<th><?php echo 'Team'; ?></th>
					<th><?php echo 'Action'; ?></th>
				</tr>
			</thead>
			
			<tbody>
			<?php foreach ( $users as $user ): ?>
				<tr>
					<td><?php echo $user['User']['id']; ?></td>
					<td><?php echo $user['User']['username']; ?></td>
					<td><?php echo $user['User']['level']; ?></td>
					<td><?php echo $user['User']['id']; ?></td>
					<td>
						<a href="#"><?php 
						echo 'Edit'; ?></a><?php echo '|';?>
						<a href="#"><?php echo 'Delete'; ?></a>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
			
		</table>
	</div>
	
	<div class="clear"></div>
	
</div>
