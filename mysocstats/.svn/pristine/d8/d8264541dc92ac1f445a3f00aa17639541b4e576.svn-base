
<?php echo form_open_multipart('administrator/do_tambah_barang/movie'); ?>
	<fieldset>
		<legend>
			Tambah Movie
		</legend>
		<label>Movie Title</label>
		<input class="input-xxlarge" type="text" placeholder="Judul Movie" name="nama_barang">

		<label>Tanggal Rilis</label>
		<div class="input-append date" id="awal" data-date="2013-02-04" data-date-format="yyyy-mm-dd">
		 	<input name="akhir" placeholder="Tanggal RIlis" name="release_date" size="16" type="text" ="">
		 	<span class="add-on">
				<i class="icon-calendar"></i>
			</span>
		</div>

		<label>Quality</label>
		<select name="id_quality">
			<option> - </option>
			<?php foreach($ctrl['quality'] as $q){?>
			<option value="<?php echo $q['id_quality']; ?>"><?php echo $q['quality_name']; ?></option>
			<?php } ?>
		</select>

		<label>Size</label>
		<input name="size" type="text" placeholder="15 KB or 40 MB or 990 GB">

		<label>Negara</label>
		<select name="id_negara">
			<option> - </option>
			<?php foreach($ctrl['negara'] as $q){?>
			<option value="<?php echo $q['id_negara']; ?>"><?php echo $q['negara']; ?></option>
			<?php } ?>
		</select>

		<label>Imdb Link</label>
		<input name="imdb_link" class="input-xxlarge" type="text" placeholder="Link IMDB">

		<label>Summary</label>
		<textarea name="summary" rows="5"></textarea>																														
		
 		<label>Trailer Youtube</label>
		<input name="youtube_link" name="country" class="input-xxlarge" type="text" placeholder="Link Youtube">

		<label>Labels</label>
		<input name="labels" class="input-xxlarge" type="text" placeholder="label1, label 2, label_3, label4">

		<label>Image</label>
		<input type="file" name="userfile" size="20" />

		<br/>
		<br/>
		<button type="submit" class="btn">
			Post
		</button>
	</fieldset>
</form>