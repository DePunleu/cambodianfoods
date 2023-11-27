    <!-- Essential javascripts for application to work-->
    <script src="{{url('backend/docs/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{url('backend/docs/js/popper.min.js')}}"></script>
    <script src="{{url('backend/docs/js/bootstrap.min.js')}}"></script>
    <script src="{{url('backend/docs/js/main.js')}}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{url('backend/docs/js/plugins/pace.min.js')}}"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="{{url('backend/docs/js/plugins/chart.js')}}"></script>
	{{-- Custom check current password --}}
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="{{url('backend/docs/js/custom.js')}}"></script>

    <script type="text/javascript">
		var data = {
			labels: ["January", "February", "March", "April", "May"],
			datasets: [
				{
					label: "My First dataset",
					fillColor: "rgba(220,220,220,0.2)",
					strokeColor: "rgba(220,220,220,1)",
					pointColor: "rgba(220,220,220,1)",
					pointStrokeColor: "#fff",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(220,220,220,1)",
					data: [65, 59, 80, 81, 56]
				},
				{
					label: "My Second dataset",
					fillColor: "rgba(151,187,205,0.2)",
					strokeColor: "rgba(151,187,205,1)",
					pointColor: "rgba(151,187,205,1)",
					pointStrokeColor: "#fff",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(151,187,205,1)",
					data: [28, 48, 40, 19, 86]
				}
			]
		};
		var pdata = [
			{
				value: 300,
				color: "#46BFBD",
				highlight: "#5AD3D1",
				label: "Complete"
			},
			{
				value: 50,
				color:"#F7464A",
				highlight: "#FF5A5E",
				label: "In-Progress"
			}
		]
		
		var ctxl = $("#lineChartDemo").get(0).getContext("2d");
		var lineChart = new Chart(ctxl).Line(data);
		
		var ctxp = $("#pieChartDemo").get(0).getContext("2d");
		var pieChart = new Chart(ctxp).Pie(pdata);
    </script>
    
	<!-- Data table plugin (search user table)-->
    <script type="text/javascript" src="{{url('backend/docs/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('backend/docs/js/plugins/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
	<!-- jQuery code to sort the various columns of the table-->
	<script>
		$(function(){
			$('#keywords').tablesorter(); 
			});
	</script>

	
    <!-- Google analytics script (search user table)-->
    <script type="text/javascript">
		if(document.location.hostname == 'pratikborsadiya.in') {
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			ga('create', 'UA-72504830-1', 'auto');
			ga('send', 'pageview');
		}
    </script>
	
	<!-- User Chart script-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
    <script>
		var ctx = document.getElementById('chart').getContext('2d');
		var userChart = new Chart(ctx,{
			type:'bar',
			data:{
				labels:{ !! json_encode($labels) !!},
				datasets: { !!json_encode($datasets) !!}
			},
		});
	</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.10.2/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>

