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
		<h2>Choose from the left menu</h2>
	</div>
	
	<div class="clear"></div>
	
</div>