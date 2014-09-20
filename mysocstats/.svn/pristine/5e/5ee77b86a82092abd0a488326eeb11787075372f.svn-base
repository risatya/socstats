<?php if (validation_errors()) {
?>

<div class="alert alert-error">
	<button type="button" class="close" data-dismiss="alert">
		x
	</button>
	<h4>Terjadi Kesalahan!</h4>
	<?php echo validation_errors(); ?>
</div>
<?php } ?>


<?php 
	echo form_open('administrator/do_input_negara/', 'class="form-horizontal"'); 
	
?>
<div class="control-group">
	<legend>
		INPUT COUNTRY
	</legend>
</div>
<div class="control-group">
	<label class="control-label" for="kd_negara">Country</label>
	<div class="controls">
            <input <?php echo (!empty($status)) ? 'disabled' : '' ;?> type="text" style="width:300px;" name="negara" placeholder="country" value="<?php echo $ctrl['negara']; ?>">
	</div>
</div>


<a class="btn" href="<?php echo site_url('administrator'); ?>"><i class="icon-chevron-left"></i>Back</a>
<button class="btn btn-primary" type="submit" value="submit" name="submit">
	<i class="icon-check"></i> Save
</button>
<?php echo form_close(); ?>
</br></br>
<?php 
	echo form_open('administrator/do_input/', 'class="form-horizontal"'); 
	
?>
<div class="control-group">
	<legend>
		INPUT TEAM
	</legend>
</div>
<input type="hidden" name="tipe" value="Input"/>
<div class="control-group">
	<label class="control-label" for="kd_negara">Country</label>
	<div class="controls">
            <select name="negara">
            	<?php foreach ($list_negara as $key => $ln) { ?>
					<option value="<?php echo $ln['negara'] ?>"><?php echo $ln['negara'] ?></option>
				<?php } ?>
            </select>
	</div>
</div>

<div class="control-group">
	<label class="control-label" for="kd_negara">Team</label>
	<div class="controls">
            <input <?php echo (!empty($status)) ? 'disabled' : '' ;?> type="text" style="width:300px;" name="team" placeholder="team" value="<?php echo $ctrl['negara']; ?>">
	</div>
</div>


<div class="control-group">
	<label class="control-label" for="kd_negara">Link</label>
	<div class="controls">
            <input <?php echo (!empty($status)) ? 'disabled' : '' ;?> type="text" style="width:300px;" name="link" placeholder="link" value="<?php echo $ctrl['negara']; ?>">
	</div>
</div>


<a class="btn" href="<?php echo site_url('administrator'); ?>"><i class="icon-chevron-left"></i>Back</a>
<button class="btn btn-primary" type="submit" value="submit" name="submit">
	<i class="icon-check"></i> Save
</button>
<?php echo form_close(); ?>

