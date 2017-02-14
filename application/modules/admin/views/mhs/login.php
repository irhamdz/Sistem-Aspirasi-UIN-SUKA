	<div id="separate"></div>
	<div id="sidebar">
		<div class="widget">
			
			<h2>Login</h2>
			<br>
			<div class="form-login">
			<form method="post" action="<?php echo base_url() . "login/process/in"; ?>">		
			<div class="control-group">
            <!-- Username -->
            <div class="controls">
                <input type="text" id="username" name="username" placeholder="Username" class="input-xlarge" style="width:180px">
                <span style="color:red;"><?php echo form_error('username') ?></span>
            </div>
			</div>	
			<div class="control-group">
            <!-- Password-->
            <div class="controls">
                <input type="password" id="password" name="password" placeholder="Password" class="input-xlarge" style="width:180px">
                <span style="color:red;"><?php echo form_error('password') ?></span>
            </div>
			</div>
			<!-- Button -->
			<button type="submit" class="btn-uin btn-inverse btn btn-small" style="float:right; margin-right:50px;"><i class="btn-uin"></i> Sign in</button><br>
			</form>
			</div>
			
	
	</div>
</div>