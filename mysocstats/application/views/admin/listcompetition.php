<?php
//echo '<pre>';
//print_r($listcompetition);
//echo $id_negara;
//echo '</pre>';
?>
<legend>
	LIST COMPETITION
</legend>
<table class="table table-bordered">
	<thead>
		<tr>
			<th style="text-align: center" class="span1">No</th>
			<th style="" class="span2">Comp</th>
			<th style="" class="span8">Detail</th>
		</tr>
	</thead>
	<form method="post" action="./editcomp">
		<tbody>
			<?php foreach ($listcompetition as $key=>$c) { ?>			
				<tr>
					<td style="text-align: center"><?php echo ++$key ?></td>
                                        <input type="hidden" name="id_competition[]" value="<?php echo $c['id_competition']?>"/>
					<td><?php echo $c['competition']?></td>
					<td><input name='kepanjangan[]' type="text" value="<?php echo $c['kepanjangan']?>"/></td>
		     	</tr>
			<?php } ?>
			<tr>
				<td></td>
				<td></td>
				<td><button type="submit" class="btn btn-success">Save</button></td>
			</tr>
		</tbody>
	</form>
</table>