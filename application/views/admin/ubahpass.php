<legend>
	Ubah Password
</legend>
<?php 
	//if (!empty($this->session->flashdata('result'))) {
		echo $this->session->flashdata('result');
	//}
?>
<form action="<?php echo base_url() ?>index.php/administrator/doubahpass" method="POST" class="form-horizontal">
	<div class="control-group">
		<label class="control-label" for="kd_negara">Old Password</label>
		<div class="controls">
	        <input type="password" name="oldpass" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="kd_negara">New Password</label>
		<div class="controls">
	        <input type="password" name="newpass" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="kd_negara">Re Enter New Password</label>
		<div class="controls">
	        <input type="password" name="renewpass"/>
		</div>
	</div>
	<button class="btn btn-success" type="submit" onclick="alert('yakin ingin mengubah password?');">Change Password</button>
</form>