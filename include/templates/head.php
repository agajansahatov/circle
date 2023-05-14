<div class="header">
	<div class="profile_field">
		<?php 
			echo '<img src="uploads/user_images/' .$_SESSION['Agajan_Circle_default_image'] . '" id="user_img"/>';
		?>
		<div id="user_name">
			<?php 
				if(!empty($_SESSION['Agajan_Circle_firstname'])){
					echo $_SESSION['Agajan_Circle_firstname'];
				}
			?>
		</div>
	</div>
</div>