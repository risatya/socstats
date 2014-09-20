<?php 
//echo '<pre>';
//print_r($list_negara);
//echo '</pre>';
?>

<legend>
	LIST COUNTRY
</legend>

<table class="table">
	<thead>
		<tr>
			<th class="span1">No</th>
			<th class="span3">Country</th>
			<!--<th class="span1">Jumlah</th>-->
			
			<th class="span1"><center>Syncronize</center></th>
			<th class="span1"><center>Team</center></th>
			<th class="span1"><center>Start_Date</center></th>
			<th class="span2"><center>Action</center></th>
			<th class="span1"><center>Last_Sync</center></th>
			
		</tr>
	</thead>
		
	<tbody>
		<div>
		<?php $i=1;foreach ($list_negara as $key => $ln) { ?>
		<tr class="bd">
			<input class="idnegara" type="hidden" value="<?php echo $ln['id_negara'];?>" />
			<td><?php echo $i++?></td>
			<td><?php echo $ln['negara']?></td>
			<td><center><input type="checkbox" name="sync[<?php echo $i?>]" value="<?php echo $ln['id_negara']?>"/></center></td>
			<td><center><?php echo $ln['count']?></center></td>
			<td>
				<div id="datetimepicker3" class="input-append date datetimepicker">
					<input value="<?php echo $ln['tgl_start'];?>" type="text" class="dt3 tgl" placeholder="Start Date" name="date">
					</input>
					<span class="add-on"> <i class="icon-calendar"></i> </span>
				</div>
			</td>
			<!--<td><center><?php echo $ln['count']?></center></td>-->			
			<td><center><?php echo anchor('administrator/syncronizrall/'.$ln['id_negara'], '<i class="icon-refresh"></i>', 'title="Refresh"'); ?> <a href="<?php echo site_url('administrator/edit_country/' . $ln['id_negara']); ?>" title="Edit"><i class="icon-edit"></i></a> <a href="<?php echo site_url('administrator/delete_country/' . $ln['id_negara']); ?>" onclick="return confirm('Anda yakin ?');" title="Delete"><i class="icon-remove"></i></a></center></td>
                <td><center><?php echo substr($ln['llast_sync'], 0, 10) ?>	</center></td>
		</tr>	
		<?php } ?>
		</div>
		<tr>
			<td><div class="valz"></div></td>
			<td><div class="progress">
			   
			</div></td>
			<td><button class="cek btn">check all</button></td>
			<td><button class="but btn btn-success">Syncronize</button></td>
			<td><button class="save btn btn-success">Save</button></td>
		</tr>
	</tbody>
	
</table>

<div ="suk"></div>
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
			url : '/my-soc-stats/index.php/administrator/lstcontt',
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
						url : "/my-soc-stats/index.php/administrator/grabsingle?link="+link+'&id_team='+id,
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
	
	$('.save').click(function(){
		$(".bd").each(function(i) {
			var tgl=$(this).find('.tgl').val();
			var id=$(this).find('.idnegara').val();
			if (tgl!='') 
			{
				$.ajaxQueue({
	
					type : "Get",
					url : "/index.php/administrator/ubahstartdate?tgl=" + tgl + '&id=' + id,
					datatype : "html",
					timeout : 1000000,
					beforeSend : function() {
						//  $('td[name=res'+id+']').html('loading');
						//$('td[name=res' + id + ']').html('');
	
					},
					success : function(response) {
						if (response == '1')
							$('.result').append('<span class="label label-success">' + 'start date update' + '</span> ');
						else
							$('.result').append('<span class="label label-important">' + 'gagal startupupdae' + '</span> ');
					},
					error : function(xhr, textStatus, errorThrown) {
						$('.result').append('<span class="label label-important">' + 'timeout' + '</span> ');
	
					}
				});
			};
		});

	}); 
</script>
<script>
	    $(document).ready(function() {
       		$(".dt3").datepicker();
		})
</script>
<?php 
//print_r($list_negara)
?>

<div class="result"></div>