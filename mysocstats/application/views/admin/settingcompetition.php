<?php 
//echo '<pre>';
//print_r($list_negara);
//echo '</pre>';
?>

<legend>
	Choose Country on Summary
</legend>

<table class="table">
	<thead>
		<tr>
			<th class="span1">No</th>
			<th class="span3">Competition</th>
			<th class="span1"><center>Choose</center></th>
			
		</tr>
	</thead>
    <form method="post" action="<?php echo base_url('index.php/administrator/updateCheckedkompetisi')?>">	
	<tbody>
		<div>
		<?php $i=1;foreach ($list_kompetisi as $key => $ln) { ?>
		<tr class="bd">
			<input class="idnegara" type="hidden" value="<?php echo $ln['id_competition'];?>" />
			<td><?php echo $i++?></td>
			<td><?php echo $ln['competition']?></td>
			<td><center><input type="checkbox" name="sync[<?php echo $i?>]" <?php if($ln['is_checked'] == 1) echo "checked='checked'"; else echo " ";?> value="<?php echo $ln['id_competition'] ?>"/></center></td>
			<!--<td><center><?php //echo $ln['count']?></center></td>-->
		</tr>	
		<?php } ?>
		</div>
		<tr>
			<td></td>
			<td></td>
			<td><button class="cek btn">check all</button></td>
			<td><button class="save btn btn-success" type="submit">Save</button></td>
		</tr>
	</tbody>
    </form>
	
</table>
<?php 
//print_r($list_negara)
?>

<div class="result"></div>