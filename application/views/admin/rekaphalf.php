<?php
//echo '<pre>';
//echo print_r($teams);
//echo '</pre>';
?>
<legend>
	STATISTIC O/E Half-time
</legend>
<div class="tabbable">
   
    <form method="POST" action="<?php echo base_url('index.php/administrator/pilihrekap'); ?>">
		<select id="mySelect" name="negara" id="select_id">
		
		<?php foreach ($list_negara as $key => $neg) { ?>
			<option class="sel" <?php echo ($neg['id_negara']==$this->uri->segment(3)) ? 'selected' : '' ; ?>  value="<?php echo $neg['id_negara'] ?>"><?php echo $neg['negara'] ?></option>
		<?php } ?>
		</select>
		<script>
		$('#mySelect').change(function(){ 
	    
	    	window.location = "<?php echo base_url().'index.php/administrator/rekap/'?>"+$(this).val()+"?order=team";
		});
		</script>
	
		
	</form>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th><a href="<?php echo base_url('index.php/administrator/rekap/'.$this->uri->segment(3).'?order=team');?>">Team</a></th>
            </tr>
        </thead>
        <tbody style="font-size: 9pt">
            <!-- start -->
            <?php if (!empty($teams)) { ?>
                
           
            <?php foreach ($teams as $key => $team) { ?>
                <tr>
                <td rowspan="2"><?php echo ++$key?></td>
                <td rowspan="2"><?php echo $team['team']?></td>
                <?php foreach ($team['rekap'] as $key => $rekap) { ?>
                	<td><center><?php 
                	$source = $rekap['date'];
					$date = new DateTime($source);
                	echo $date->format('d/m'); 
                	?></center></td>
                <?php } ?>
            </tr>
            <tr>
                <?php foreach ($team['rekap'] as $key => $rekap) { ?>
                	<td><center><?php
                	if ($rekap['extratime']==0) {
                		echo $rekap['result'] ; 	
					} else {
						echo '<a href="'.base_url('index.php/administrator/extratimelist').'">';
						echo $rekap['result'] ; 
						echo '</a>';
					}
					
                	
                	?></center></td>
                <?php } ?>
            </tr>
            <?php }?>
             <?php } ?>
        </tbody>
    </table>
</div>
<?php echo $halaman; ?>