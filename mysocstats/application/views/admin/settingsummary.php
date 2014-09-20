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
			<th class="span3">Country</th>
			<th class="span1"><center>Choose</center></th>
			
			<!--<th class="span1">Jumlah</th>
			<th class="span1"><center>Team</center></th>
			<th class="span1"><center>Start_Date</center></th>
			<th class="span2"><center>Action</center></th>
			<th class="span1"><center>Last_Sync</center></th>-->
		</tr>
	</thead>
    <form method="post" action="<?php echo base_url('index.php/administrator/updateCheckednegara')?>">	
	<tbody>
		<div>
		<?php $i=1;foreach ($list_negara as $key => $ln) { ?>
		<tr class="bd">
			<input class="idnegara" type="hidden" value="<?php echo $ln['id_negara'];?>" />
			<td><?php echo $i++?></td>
			<td><?php echo $ln['negara']?></td>
			<td><center><input type="checkbox" name="sync[<?php echo $i?>]" <?php if($ln['is_checked'] == 1) echo "checked='checked'"; else echo " ";?> value="<?php echo $ln['id_negara'] ?>"/></center></td>
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
<script>
        $('.cek').click(function() {
                $("input[type=checkbox]").attr('checked', true);
                //alert('asdasd');
        }); 
        var ajaxQueue = $({});

        $.ajaxQueue = function(ajaxOpts) {
                // Hold the original complete function.
                var oldComplete = ajaxOpts.complete;

                // Queue our ajax request.
                ajaxQueue.queue(function(next) {
                        // Create a complete callback to fire the next event in the queue.
                        ajaxOpts.complete = function() {
                                // Fire the original complete if it was there.
                                if (oldComplete) {
                                        oldComplete.apply(this, arguments);
                                }
                                // Run the next query in the queue.
                                next();
                        };

                        // Run the query.
                        $.ajax(ajaxOpts);
                });
        };

        var arr = [];
        var ya =  

        $('.but').click(function() {
                
                $('.reesult').html('');
                $("input[type=checkbox]:checked").each(function(i) {
                        //$('.result').html(i);
                        //$('.result').append(this.value);
                        arr.push(this.value)
                });
                $.ajax({
                        url : '/index.php/administrator/lstcontt',
                        data : {
                                'arrai' : arr
                        },
                        type : 'post',
                        success : function(data) {
                                $(".but").prop('disabled', true);
                                //$('.result').html(data);
                                var jsonp = data;
                                var obj = $.parseJSON(jsonp);
                                var size= jQuery(obj).size();
                                var i=0;
                                
                                $.each(obj, function() {
                                        //lang += this['Lang'] + "<br/>";
                                        //$('.result').append(this['id_team']);
                                        //var id = $(this).val();
                                        var link= this['link'];
                                        var team= this['team'];
                                        var id= this['id_team'];
                                        
                                        $.ajaxQueue({
                                                
                                                type : "Get",
                                                url : "/index.php/administrator/grabsingle?link="+link+'&id_team='+id,
                                                datatype : "html",
                                                timeout : 1000000,
                                                beforeSend : function() {
                                                        //  $('td[name=res'+id+']').html('loading');
                                                        //$('td[name=res' + id + ']').html('');

                                                },
                                                success : function(response) {
                                                        if(response=='1')
                                                        $('.result').append('<span class="label label-success">'+team+'</span> ');
                                                        else $('.result').append('<span class="label label-important">'+team+'</span> ');
                                                        i++;
                                                        p=i/size*100;
                                                        $('.valz').html('<span class="label label-success">'+p.toFixed(2)+'</span>');
                                                        $('.progress').html('<div class="bar" style="width: '+p+'%;"></div>');
                                                        if(size!=i)
                                                        {
                                                                $(".but").prop('disabled', true);
                                                        }else
                                                        {
                                                                $(".but").prop('disabled', false);
                                                        }
                                                },
                                                error : function(xhr, textStatus, errorThrown) {
                                                        $('.result').append('<span class="label label-important">'+team+'</span> ');
                                                        i++;
                                                        p=i/size*100;
                                                        $('.valz').html('<span class="label label-success">'+p.toFixed(2)+'</span>');
                                                        $('.progress').html(p.toFixed(2)+'<div class="bar" style="width: '+p+'%;"></div>');
                                                        if(size!=i)
                                                        {
                                                                $(".but").prop('disabled', true);
                                                        }else
                                                        {
                                                                $(".but").prop('disabled', false);
                                                        }
                                                }
                                        });

                                });     
                        }
                });
        }); 
</script>
<?php 
//print_r($list_negara)
?>

<div class="result"></div>