<?php
//echo '<pre>';
//print_r($ctrl);
//echo '</pre>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>MySocStats</title>
        <!-- Le styles -->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.css" rel="stylesheet"> 
        <link href="<?php echo base_url(); ?>assets/css/docs.css" rel="stylesheet">
       	<link href="<?php echo base_url(); ?>assets/css/datepicker.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/google-code-prettify/prettify.css" rel="stylesheet">
        <script src="<?php echo base_url(); ?>assets/js/jquery-2.0.3.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.10.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
       <script src="<?php echo base_url(); ?>assets/js/bootstrap-collapse.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-tooltip.js"></script>
     <script>
       $(".collapse").collapse();
        $("[data-toggle=tooltip]").tooltip();
     </script>
    </head>
    <body style="background-color: #f5f5f5; margin-top: -60px;"  >
        <div class="navbar navbar-inverse navbar-static-top">
            <div class="navbar-inner">
                <center><a class="brand" href="<?php echo base_url(); ?>administrator">MySocStats</a></center>
            </div>
			
        </div>
        </br>
        <!--</header>-->
		<div class="span12">
                    <div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
      <div class="container-fluid">
        <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a href="<?php echo base_url(); ?>administrator" class="brand">My Soccer Stats</a>
        <div class="nav-collapse">
          <ul class="nav">
			<li class="<?php echo ($active == 'input') ? 'active' : ''; ?>"><?php echo anchor('administrator/inputnegara', 'Input Data', 'title="Input"'); ?></li>
			<li class="<?php echo ($active == 'listcountry') ? 'active' : ''; ?>"><?php echo anchor('administrator/listcountry', 'List Country', 'title="List Country"'); ?></li>
			<li class="<?php echo ($active == 'listteam') ? 'active' : ''; ?>"><?php echo anchor('administrator/list_team?order=team', 'List Team', 'title="List Team"'); ?></li>
			<li class="<?php echo ($active == 'listcompetition') ? 'active' : ''; ?>"><?php echo anchor('administrator/listcompetition', 'List Competition', 'title="List Competition"'); ?></li>
			<li class="<?php echo ($active == 'xtp') ? 'active' : ''; ?>"><?php echo anchor('administrator/extratimelist', 'ET / PEN <span class="badge badge-info">' . $et . '</span>', 'title="ET / PEN"'); ?></li>
            <li class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">Statistic <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="dropdown-submenu">
                  <?php echo anchor('administrator/rekap?order=team', 'Statistic Odd/Even', 'title="Statistic O/E"'); ?>
                  <ul class="dropdown-menu">
                    <li><?php echo anchor('administrator/rekaphalf?order=team', 'Half Time', 'title="Statistic O/E"'); ?></li>
                    <li><?php echo anchor('administrator/rekap?order=team', 'Full Time', 'title="Statistic O/E"'); ?></li>
                  </ul>
                </li>
				<li class="dropdown-submenu">
                  <?php echo anchor('administrator/rekapou?order=team', 'Statistic Over/Under', 'title="Statistic O/U"'); ?>
                  <ul class="dropdown-menu">
                    <li><?php echo anchor('administrator/rekapouhalf?order=team', 'Half Time', 'title="Statistic O/U"'); ?></li>
                    <li><?php echo anchor('administrator/rekapou?order=team', 'Full Time', 'title="Statistic O/U"'); ?></li>
                  </ul>
                </li>
				<li class="dropdown-submenu">
                  <?php echo anchor('administrator/rekapox?order=team', 'Statistic Draw/Outcome', 'title="Statistic X/O"'); ?>
                  <ul class="dropdown-menu">
                    <li><?php echo anchor('administrator/rekapoxhalf?order=team', 'Half Time', 'title="Statistic X/O"'); ?></li>
                    <li><?php echo anchor('administrator/rekapox?order=team', 'Full Time', 'title="Statistic X/O"'); ?></li>
                  </ul>
                </li>
				<li class="dropdown-submenu">
                  <?php echo anchor('administrator/rekapte?order=team', 'Statistic Two-Three/Else', 'title="Statistic T/E"'); ?>
                  <ul class="dropdown-menu">
                    <li><?php echo anchor('administrator/rekaptehalf?order=team', 'Half Time', 'title="Statistic T/E"'); ?></li>
                    <li><?php echo anchor('administrator/rekapte?order=team', 'Full Time', 'title="Statistic T/E"'); ?></li>
                  </ul>
                </li>
              </ul>
            </li>
			<li class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">Match History <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="dropdown-submenu">
                  <?php echo anchor('administrator/summary/0', 'Summary Odd/Even', 'title="Statistic O/E"'); ?>
                </li>
				<li class="dropdown-submenu">
                  <?php echo anchor('administrator/summaryou/0', 'Summary Outcome/Under', 'title="Summary O/U"'); ?>
                </li>
				<li class="dropdown-submenu">
                  <?php echo anchor('administrator/summaryox/0', 'Summary Draw/Outcome', 'title="Summary X/O"'); ?>
                </li>
				<li class="dropdown-submenu">
                  <?php echo anchor('administrator/summaryte/0', 'Summary Two-Three/Else', 'title="Summary T/E"'); ?>
                </li>
              </ul>
            </li>
			<li class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">Summary <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="dropdown-submenu">
                  <?php echo anchor('administrator/historyoe', 'History Odd/Even', 'title="History O/E"'); ?>
                  <ul class="dropdown-menu">
                    <li><?php echo anchor('administrator/historyoehalf', 'Half Time', 'title="History O/E"'); ?></li>
                    <li><?php echo anchor('administrator/historyoe', 'Full Time', 'title="History O/E"'); ?></li>
                  </ul>
                </li>
				<li class="dropdown-submenu">
                  <?php echo anchor('administrator/historyou', 'History Outcome/Under', 'title="History O/U"'); ?>
                  <ul class="dropdown-menu">
                    <li><?php echo anchor('administrator/historyouhalf', 'Half Time', 'title="History O/U"'); ?></li>
                    <li><?php echo anchor('administrator/historyou', 'Full Time', 'title="History O/U"'); ?></li>
                  </ul>
                </li>
				<li class="dropdown-submenu">
                  <?php echo anchor('administrator/historyox', 'History Draw/Outcome', 'title="History X/O"'); ?>
                  <ul class="dropdown-menu">
                    <li><?php echo anchor('administrator/historyoxhalf', 'Half Time', 'title="History X/O"'); ?></li>
                    <li><?php echo anchor('administrator/historyox', 'Full Time', 'title="History X/O"'); ?></li>
                  </ul>
                </li>
				<li class="dropdown-submenu">
                  <?php echo anchor('administrator/historyte', 'History Two-Three/Else', 'title="History T/E"'); ?>
                  <ul class="dropdown-menu">
                    <li><?php echo anchor('administrator/historytehalf', 'Half Time', 'title="History T/E"'); ?></li>
                    <li><?php echo anchor('administrator/historyte', 'Full Time', 'title="History T/E"'); ?></li>
                  </ul>
                </li>
              </ul>
            </li>
			<li class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">Options <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="dropdown-submenu">
                  <?php echo anchor('administrator/setting', 'Setting', 'title="Setting"'); ?>
                </li>
				<li class="dropdown-submenu">
                  <a href="<?php echo site_url('administrator/backup/0'); ?>">Full Back-up</a>
                </li>
				<li class="dropdown-submenu">
                  <a href="<?php echo site_url('login/logout'); ?>">Log Out</a>
                </li>
              </ul>
            </li>
          </ul>
          </div><!-- /.nav-collapse -->
      </div>
  </div>
</div>

</ul>

                </div>
        <!--<div class="container-fluid" >
            <div class="row-fluid">
                <div class="span3">
                    <div class="well sidebar-nav" style="background-color: white">
                        <ul class="nav nav-list">
                            <li class="nav-header">Menu</li>
                            <li class="<?php echo ($active == 'input') ? 'active' : ''; ?>"><?php echo anchor('administrator/inputnegara', 'Input Data', 'title="Input"'); ?></li>
                            <li class="<?php echo ($active == 'listcountry') ? 'active' : ''; ?>"><?php echo anchor('administrator/listcountry', 'List Country', 'title="List Country"'); ?></li>
                            <li class="<?php echo ($active == 'listteam') ? 'active' : ''; ?>"><?php echo anchor('administrator/list_team?order=team', 'List Team', 'title="List Team"'); ?></li>
                            <li class="<?php echo ($active == 'listcompetition') ? 'active' : ''; ?>"><?php echo anchor('administrator/listcompetition', 'List Competition', 'title="List Competition"'); ?></li>
                            <li class="<?php echo ($active == 'xtp') ? 'active' : ''; ?>"><?php echo anchor('administrator/extratimelist', 'ET / PEN <span class="badge badge-info">' . $et . '</span>', 'title="ET / PEN"'); ?></li>
                          
                            <li id="myAccordion" class="accordion">
                                <a href="#collapseStats" data-parent="#myAccordion" data-toggle="collapse" class="accordion-toggle">Statistic </a>
                                <div class="accordion-body collapse <?php echo ($active == '#collapseStats') ? 'active' : ''; ?> in" id="collapseStats">
                                    <ul>
                                        <li class="<?php echo ($active == 'rekap') ? 'active' : ''; ?>" style="list-style: none"><?php echo anchor('administrator/rekap?order=team', 'Statistic O/E', 'title="Statistic O/E"'); ?></li>
                                        <li class="<?php echo ($active == 'rekaphalf') ? 'active' : ''; ?>" style="list-style: none"><?php echo anchor('administrator/rekaphalf?order=team', 'Statistic O/E Halftime', 'title="Statistic O/E"'); ?></li>
                                        <li class="<?php echo ($active == 'rekapou') ? 'active' : ''; ?>" style="list-style: none"><?php echo anchor('administrator/rekapou?order=team', 'Statistic O/U', 'title="Statistic O/U"'); ?></li>
                                        <li class="<?php echo ($active == 'rekapouhalf') ? 'active' : ''; ?>" style="list-style: none"><?php echo anchor('administrator/rekapouhalf?order=team', 'Statistic O/U Halftime', 'title="Statistic O/U"'); ?></li>
                                        <li class="<?php echo ($active == 'rekapox') ? 'active' : ''; ?>" style="list-style: none"><?php echo anchor('administrator/rekapox?order=team', 'Statistic X/O', 'title="Statistic X/O"'); ?></li>
                                        <li class="<?php echo ($active == 'rekapoxhalf') ? 'active' : ''; ?>" style="list-style: none"><?php echo anchor('administrator/rekapoxhalf?order=team', 'Statistic X/O Halftime', 'title="Statistic X/O"'); ?></li>
                                        <li class="<?php echo ($active == 'rekapte') ? 'active' : ''; ?>" style="list-style: none"><?php echo anchor('administrator/rekapte?order=team', 'Statistic T/E', 'title="Statistic T/E"'); ?></li>
                                        <li class="<?php echo ($active == 'rekaptehalf') ? 'active' : ''; ?>" style="list-style: none"><?php echo anchor('administrator/rekaptehalf?order=team', 'Statistic T/E Halftime', 'title="Statistic T/E"'); ?></li>
                                    </ul>
                                </div>
                                <a href="#collapseSummary" data-parent="#myAccordion" data-toggle="collapse" class="accordion-toggle">Summary </a>
                                <div class="accordion-body collapse <?php echo ($active == '#collapseStats') ? 'active' : ''; ?> in" id="collapseSummary">
                                    <ul>
                                        <li class="<?php echo ($active == 'summary') ? 'active' : ''; ?>" style="list-style: none"><?php echo anchor('administrator/summary/0', 'Summary O/E', 'title="Summary O/E"'); ?></li>
                                        <li class="<?php echo ($active == 'summaryou') ? 'active' : ''; ?>" style="list-style: none"><?php echo anchor('administrator/summaryou/0', 'Summary O/U', 'title="Summary O/U"'); ?></li>
                                        <li class="<?php echo ($active == 'summaryox') ? 'active' : ''; ?>" style="list-style: none"><?php echo anchor('administrator/summaryox/0', 'Summary X/O', 'title="Summary X/O"'); ?></li>
                                        <li class="<?php echo ($active == 'summaryte') ? 'active' : ''; ?>" style="list-style: none"><?php echo anchor('administrator/summaryte/0', 'Summary T/E', 'title="Summary T/E"'); ?></li>
                                    </ul>
                                </div>
                                <a href="#collapseHistory" data-parent="#myAccordion" data-toggle="collapse" class="accordion-toggle">History </a>
                                <div class="accordion-body collapse <?php echo ($active == '#collapseStats') ? 'active' : ''; ?> in" id="collapseHistory">
                                    <ul>
                                        <li class="<?php echo ($active == 'history') ? 'active' : 'historyoe'; ?>" style="list-style: none"><?php echo anchor('administrator/historyoe', 'History O/E', 'title="History O/E"'); ?></li>
                                        <li class="<?php echo ($active == 'historyhalf') ? 'active' : 'historyoe'; ?>" style="list-style: none"><?php echo anchor('administrator/historyoehalf', 'History O/E Half-time', 'title="History O/E Half-time"'); ?></li>
                                        <li class="<?php echo ($active == 'hsitoryou') ? 'active' : ''; ?>" style="list-style: none"><?php echo anchor('administrator/historyou', 'History O/U', 'title="History O/U"'); ?></li>
                                        <li class="<?php echo ($active == 'hsitoryouhalf') ? 'active' : ''; ?>" style="list-style: none"><?php echo anchor('administrator/historyouhalf', 'History O/U Half-time', 'title="History O/U Half-time"'); ?></li>
                                        <li class="<?php echo ($active == 'historyoxhalf') ? 'active' : ''; ?>" style="list-style: none"><?php echo anchor('administrator/historyox', 'History X/O', 'title="History X/O"'); ?></li>
                                        <li class="<?php echo ($active == 'historyoxhalf') ? 'active' : ''; ?>" style="list-style: none"><?php echo anchor('administrator/historyoxhalf', 'History X/O Half-time', 'title="History X/O Half-time"'); ?></li>
                                         <li class="<?php echo ($active == 'historyte') ? 'active' : ''; ?>" style="list-style: none"><?php echo anchor('administrator/historyte', 'History T/E', 'title="History T/E"'); ?></li>
                                         <li class="<?php echo ($active == 'historytehalf') ? 'active' : ''; ?>" style="list-style: none"><?php echo anchor('administrator/historytehalf', 'History T/E Half-time', 'title="History T/E Half-time"'); ?></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="<?php echo ($active == 'setting') ? 'active' : ''; ?>"><?php echo anchor('administrator/setting', 'Setting', 'title="Setting"'); ?></li>
                            <hr />
                        </ul>
                        <div class="container">
                            <a class="btn btn-warning btn-small" href="<?php echo site_url('login/logout'); ?>"><i class="icon-off"></i> Logout</a>
                            <a class="btn btn-info btn-small" href="<?php echo site_url('administrator/backup/0'); ?>"><i class="icon-inbox"></i> Backup</a>
                        </div>
                    </div><!--/.well -->
                </div>
                <div class="span12">
                    <div class="well" style="padding: 20px; background-color: white; ">
                        <?php $this->load->view('admin/' . $ctrl['page']); ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>