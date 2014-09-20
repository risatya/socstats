<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<legend>
    HISTORY O/U
</legend>
<div class="tabbable">
    <form method="POST" action="<?php echo base_url('index.php/administrator/pilihlistteam'); ?>">
        <select id="mySelect" name="negara" id="select_id">

            <?php foreach ($list_negara as $key => $neg) { ?>
                <option class="sel" <?php echo ($neg['id_negara'] == $this->uri->segment(3)) ? 'selected' : ''; ?>  value="<?php echo $neg['id_negara'] ?>"><?php echo $neg['negara'] ?></option>
            <?php } ?>
        </select>
        <script>
            $('#mySelect').change(function() {

                window.location = "<?php echo base_url() . 'index.php/administrator/historyou/' ?>" + $(this).val() + "?order=team";
            });
        </script>
    </form>
    <div class="tab-content">
        <table class="table table-bordered" id="data">
            <thead>
                <tr>
                    <th style="" class="span1">No</th>
                    <th style="" class="span1"><a href="<?php echo base_url('index.php/administrator/historyou/' . $this->uri->segment(3) . '?order=negara'); ?>">Team</a></th>
                    <?php 
                    for ($i=2;$i<=14;$i++)
                    echo '<th style="text-align:center;" class="span1">' . $i . '</th>';
                    echo '<th style="text-align:center;" class="span1">15 Or More</th>';
                    ?>

            <!--<center><th style="" class="span1">10 Or More</th></center>-->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($teams as $key => $team) { ?>
                    <tr>
                        <td style="text-align: center"><?php echo++$key ?></td>
                        <td><?php echo $team['team'] ?></td>
                        
                        <?php 
                            $cek='';
                            $last_result='';
                            $count_o=0;
                            $count_e=0;
                        foreach ($team['rekap'] as $key => $rekap) {
                            if($rekap['result2']=='U')
                                {
                                    $count_e++;
                                }
                                else {
                                    if($count_e>=2)
                                    //if($count_e>=2 || $key++ ==  sizeof($team['rekap']))
                                        {
                                        $cek[]=$count_e;     
                                    }
                                   
                                   $count_e=0;
                                }
//                            $cek[$count_e]=$cek[$count_e]++;

                               $last_result=$rekap['result2'];
//                           echo $rekap['result2'];
                        }?>
                        
                        
                            
                        <?php
                            for ($i=2; $i<=15;$i++)
                            {
                                $count=0;
                                if(!empty($cek))
                                    {
                                        foreach ($cek as $key => $c) {
                                            if($c==$i)
                                                {
                                                $count++;
                                                }
                                        }
                                    }
                                
                            echo "<td style='text-align:center;' class='sum'>" . $count . "</td>";    
                            }
                            
                        ?>
                    </tr>
                <?php } ?>
				<tr>
					<th colspan="2">Total</th>
					<?php
                        for ($i=2; $i<=15;$i++)
                        echo '<td style="text-align:center;" class="subtotal"></td>';    
                    ?>
				</tr>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript">
	$(function(){
	function tally (selector) {
	$(selector).each(function () {
	var total = 0,
	column = $(this).siblings(selector).andSelf().index(this);
	$(this).parents().prevUntil(':has(' + selector + ')').each(function () {
	total += parseFloat($('td.sum:eq(' + column + ')', this).html()) || 0;
	})
	$(this).html(total);
	});
	}
	tally('td.subtotal');
	tally('td.total');
	});
</script>