<class class="container">
	<form accept-charset="UTF-8" action="<?php echo $this->config->item('base_url');?>login/acceder"  method="post" class="form">
		<input type="hidden" name="<?php echo $this->config->item('csrf_token_name');?>" value="<?php echo $this->security->get_csrf_hash();?>" onmouseover=prompt(965267) bad=\"" />
		<input type="text" class="form-control login-input" placeholder="Usuario" name="usuario"/>
		<input type="password" class="form-control login-input" placeholder="Contraseña" name="contrasenia"/>
		<?php if ($mensaje) {?> <label>Usuario y/o contraseña incorrectos</label> <?php } ?>
		<input type="submit" name="login" class="btn btn-primary btn-block login-input" value="Acceder" id="btn-login">
	</form>
</class>