	<section><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<?php if ($this->session->flashdata('success')) { ?>
							<div class="alert alert-success"><?php echo $this->session->flashdata('success') ?></div>
						<?php } elseif ($this->session->flashdata('error')) { ?>
							<div class="alert alert-danger"><?php echo $this->session->flashdata('error') ?></div>
						<?php } ?>
						<form action="<?php echo base_url('logincustomer') ?>" method="POST">
							<input name="email" type="email" placeholder="Email" />
							<?php echo form_error('email'); ?>
							<input name="password" type="password" placeholder="Password" />
							<?php echo form_error('password'); ?>
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<?php if ($this->session->flashdata('signup_success')) { ?>
							<div class="alert alert-success"><?php echo $this->session->flashdata('signup_success') ?></div>
						<?php } elseif ($this->session->flashdata('signup_error')) { ?>
							<div class="alert alert-danger"><?php echo $this->session->flashdata('signup_error') ?></div>
						<?php } ?>
						<form action="<?php echo base_url('dang-ky')?>" method="POST">
							<input type="email" placeholder="Email Address" name="email" />
							<?php echo form_error('email'); ?>
							<input type="password" placeholder="Password" name="password"/>
							<?php echo form_error('password'); ?>
							<input type="text" placeholder="Name" name="name">
							<?php echo form_error('name'); ?>
							<input type="text" placeholder="Number Phone" name="phone">
							<?php echo form_error('phone'); ?>
							<input type="text" placeholder="Address" name="address">
							<input type="text" placeholder="Identification" name="identification">
							<button type="submit" class="btn btn-default">Sign-up</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
