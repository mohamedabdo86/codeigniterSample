<?php
$page_title = "home";
?>
<?php include("header.php"); 
$no_of_members = $db->numRows("select * from members");
$no_of_active_members = $db->numRows("select * from members where members_activated = 1");
$no_of_inactive_members = $db->numRows("select * from members where members_activated != 1");
$no_of_register_today = $db->numRows("select * from members WHERE members_addeddate >= CURDATE()");
$no_of_current_month = $db->numRows("SELECT * FROM members WHERE YEAR(members_addeddate) = YEAR(NOW()) AND MONTH(members_addeddate) = MONTH(NOW()) ");
$no_of_last_month = $db->numRows("select * from members WHERE YEAR(members_addeddate) = YEAR(NOW()) AND MONTH(members_addeddate) = (MONTH(NOW()) - 1) ");

$registerFromTu = $db->numRows("SELECT * FROM members WHERE `members_addeddate` BETWEEN '2015-12-28' AND '2016-1-10' ");
echo "<div style='padding-left: 20px;float: left;'>Register Today = ".$no_of_register_today."<br>";
echo "Total Current month = ".$no_of_current_month."<br>";
echo "Total Previous month = ".$no_of_last_month."<br></div>";
//echo "Total register From 28Mo-December To Now = ".$registerFromTu."<br></div>";
//echo "Total Members = ".$no_of_members."<br></div>";

?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1.1", {packages:["bar"]});
      google.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Members Type', 'Numbers'],
          ["Total Members", <?php echo $no_of_members; ?>],
          ["Total Active Members", <?php echo $no_of_active_members; ?>],
          ["Total Inactive Members", <?php echo $no_of_inactive_members; ?>],
          ["Total Register Today", <?php echo $no_of_register_today; ?>],
          ['Total Current Month', <?php echo $no_of_current_month; ?>],
		  ['Total Previous Month', <?php echo $no_of_last_month; ?>]
        ]);

        var options = {
          title: 'Members Statistics ',
          width: 900,
		  height: 700,
		  vAxis: {format: 'decimal'},
          legend: { position: 'none' },
          chart: { subtitle: 'FlowChart About Members' },
          axes: {
            x: {
              0: { side: 'top', label: 'Members'} // Top x-axis.
            }
          },
          bar: { groupWidth: "50%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
    </script>

<section id="main" class="column">

		
		<article class="module width_full">
			<header><h3>Stats</h3></header>
			<div class="module_content">
				<article class="stats_graph">
 
                  <div id="top_x_div" style="width: 600px; height: 700px;"></div>
					
				</article>
				
				<div class="clear"></div>
			</div>
		</article><!-- end of stats article -->

		<div class="spacer"></div>
	</section>


</body>

</html>
