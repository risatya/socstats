<?php 
//echo '<pre>';
//print_r($summary);
//echo '</pre>';
?>
<legend>
	SUMMARY X/O
</legend>
<select id="mySelect">
	<option value="2" <?php echo ($f==2) ? 'selected' : '' ;?>>2 or more</option>
	<option value="3" <?php echo ($f==3) ? 'selected' : '' ;?>>3 or more</option>
	<option value="4" <?php echo ($f==4) ? 'selected' : '' ;?>>4 or more</option>
	<option value="5" <?php echo ($f==5) ? 'selected' : '' ;?>>5 or more</option>
</select></br>
<script>
$('#mySelect').change(function(){ 
    
    window.location = "<?php echo base_url().'index.php/administrator/summaryox/'.$this->uri->segment(3).'?f=' ?>"+$(this).val();
});
</script>
<div><a style="float: left" href="<?php echo base_url('index.php/administrator/summary/'.($this->uri->segment(3)-1));?>">Prev</a> <a style="float: right" href="<?php echo base_url('index.php/administrator/summary/'.($this->uri->segment(3)+1));?>">Next</a></div>
<hr/>

<div class="row-fluid">
 <div class="accordion-heading"><a class="accordion-toggle" href="#collapse<?php echo "0" ?>" data-toggle="collapse" data-parent="#accordion<?php echo "0" ?>"><?php echo "INTERNATIONAL CUP" ?></a></div>
 <div class="accordion-body in collapse" id="collapse<?php echo "0" ?>">
    <table class="table table-bordered">
        <thead>
            <tr >

                <?php foreach ($tanggal as $key => $t) { ?>
                <td class="span3"> <center><?php
                if (($key == 1) && $this->uri->segment(3) == 0)
                    echo '<b>today</b>';
                else
                    echo date('d/m', strtotime($t))
                ?></center></td>
                <?php } ?>

            </tr>
        </thead>
        <?php
        $perulangan = 0;
        foreach ($summarycomp as $d) {
            $lg = sizeof($d);
            if ($perulangan < $lg)
                $perulangan = $lg;
        }
        ?>
        <tbody>
            <?php for ($i = 0; $i < $perulangan; $i++) { ?>
            <tr>
                <?php for ($j = 0; $j < 5; $j++) { ?>
                <td class="span2" style="font-size: 9pt"><center><a href="<?php echo (!empty($summarycomp[$j][$i]['link_competition']))?$summarycomp[$j][$i]['link_competition']:""; ?>" data-toggle="tooltip" title="<?php echo (!empty($summarycomp[$j][$i]['kepanjangan']))?$summarycomp[$j][$i]['kepanjangan']:""; ?>"><?php echo (!empty($summarycomp[$j][$i]['team'])) ? $summarycomp[$j][$i]['competition'] . ' </a> - ' . '<a href="' . $summarycomp[$j][$i]['link'] . '" data-toggle="tooltip" title="' . $summarycomp[$j][$i]['team_a'] . " vs " . $summarycomp[$j][$i]['team_b'] . '">' . $summarycomp[$j][$i]['team'] . '</a>' . '<a href="' . base_url('index.php/administrator/rekap/' . $summarycomp[$j][$i]['id_negara'] . '?order=team') . '">' . ' (' . $summarycomp[$j][$i]['sum'] . ')' . '</a>' : ''; ?></center></td>    
                <?php } ?>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="row-fluid">
  <?php  if(!empty($summary)){ ?> 
  <?php foreach ($summary as $key => $s) { ?>
  
  <div class="accordion-heading"><a class="accordion-toggle" href="#collapse<?php echo $key+1?>" data-toggle="collapse" data-parent="#accordion<?php echo $key+1?>"><?php echo $s['negara']?></a></div>
  <div class="accordion-body in collapse" id="collapse<?php echo $key+1?>">
   
    <table class="table table-bordered">
     <thead>
        <tr >
            <?php foreach ($tanggal as $key => $t) { ?>
            <td><center><?php 
            if(($key == 1) && $this->uri->segment(3)==0)
               echo '<b>today</b>';
           else
               echo date('d/m',  strtotime($t)) 
           
           ?></center></td>
           <?php } ?>
       </tr>
   </thead>
   <?php 
   $perulangan=0;
   foreach($s['row'] as $d)
   {
     $lg=sizeof($d);
     if($perulangan<$lg)$perulangan=$lg;
 }
 ?>
 <tbody>
   <?php for ($i=0; $i < $perulangan; $i++) { ?>
   <tr>
    <?php for ($j=0; $j < 5; $j++) { ?>
    <td class="span2" style="font-size: 9pt"><center><a href="<?php echo (!empty($s['row'][$j][$i]['link_competition']))? $s['row'][$j][$i]['link_competition'] :""; ?>" data-toggle="tooltip" title="<?php echo (!empty($s['row'][$j][$i]['kepanjangan']))?$s['row'][$j][$i]['kepanjangan']:""; ?>"><?php echo (!empty($s['row'][$j][$i]['team'])) ? $s['row'][$j][$i]['competition'] . ' </a> - ' . '<a href="' . $s['row'][$j][$i]['link'] . '" data-toggle="tooltip" title="' . $s['row'][$j][$i]['team_a'] . " vs " . $s['row'][$j][$i]['team_b'] . '">' . $s['row'][$j][$i]['team'] . '</a>' . '<a href="' . base_url('index.php/administrator/rekap/' . $s['row'][$j][$i]['id_negara'] . '?order=team') . '">' . ' (' . $s['row'][$j][$i]['sum'] . ')' . '</a>' : ''; ?></center></td>     
    <?php } ?>
    
</tr>
<?php }?>
</tbody>
</table>


</div>
<?php }?>
<?php }?>

</div>