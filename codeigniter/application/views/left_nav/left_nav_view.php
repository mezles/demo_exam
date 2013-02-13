<div class="nav-menu">
	<ul>
		<?php $level = $this->session->userdata( 'logged_in' )->level; ?>
		<?php 
			switch ( (int) $level ) {
				case 1:
					echo '<li><a href="' . site_url('user/view') . '">View Users</a></li>';
					echo '<li><a href="' . site_url('user/create') . '">Create User</a></li>';
					echo '<li>-</li>';
					echo '<li><a href="' . site_url('team/view') . '">View Teams</a></li>';
					echo '<li><a href="' . site_url('team/create') . '">Create Team</a></li>';
					echo '<li>-</li>';
					echo '<li><a href="' . site_url('user/assign_team') . '">Assign User to Team</a></li>';
					break;
				case 2:
					echo '<li><a href="' . site_url('supervisor/info') . '">View Info</a></li>';
					echo '<li><a href="' . site_url('supervisor/update_info') . '">Update Info</a></li>';
					echo '<li>-</li>';
					echo '<li><a href="' . site_url('supervisor/team') . '">View Team</a></li>';
					echo '<li>-</li>';
					echo '<li><a href="' . site_url('supervisor/assign_team') . '">Assign User to Your Team</a></li>';
					break;
				case 3:
					break;
				default:
					break;
			}
		?>
	</ul>
</div>