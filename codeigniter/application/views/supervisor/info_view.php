<?php echo $header; ?>

	<div id="body">
	
		<div class="body-wrapper">
		
			<?php echo $left_nav; ?>
			
			<div class="content-wrapper">
			
				<h2><?php echo $page_subtitle; ?></h2>
				
				<label><span class="bold">User ID :</span><?php echo $logged_in->id; ?></label>
				<label><span class="bold">Username :</span><?php echo $logged_in->username; ?></label>
				
				<h3>Personal Information</h3>
				<table class="table info">
					<tbody>
						<tr>
							<td>First Name</td>
							<td>none</td>
						</tr>
						<tr>
							<td>Last Name</td>
							<td>none</td>
						</tr>
						<tr>
							<td>Address</td>
							<td>none</td>
						</tr>
						<tr>
							<td>Country</td>
							<td>none</td>
						</tr>
						<tr>
							<td>Zip Code</td>
							<td>none</td>
						</tr>
						<tr>
							<td>Contact Number</td>
							<td>none</td>
						</tr>
						<tr>
							<td>Email Address</td>
							<td>none</td>
						</tr>
					</tbody>
				</table>
				
			</div>
			
			<div class="clear"></div>
			
		</div>
		
	</div>
	
<?php echo $footer; ?>