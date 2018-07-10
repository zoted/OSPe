	
	<meta name="description" content="Full view calendar component for twitter bootstrap with year, month, week, day views.">
	<meta name="keywords" content="jQuery,Bootstrap,Calendar,HTML,CSS,JavaScript,responsive,month,week,year,day">
	<meta name="author" content="Serhioromano">
	<meta charset="UTF-8">
	

	<link rel="stylesheet" href="/OSP/calendar/components/bootstrap3/css/bootstrap.min.css">
	<link rel="stylesheet" href="/OSP/calendar/components/bootstrap3/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="/OSP/calendar/css/calendar.css">
	<script src='/OSP/js/admin_panel.js'></script>
	<link rel="stylesheet" href='/OSP/css/panel_admin.css' type='text/css'/> 
	<link rel='stylesheet' href='/OSP/css/fontello/fontello.css' type='text/css'/>

	
</head>

<body>
<button class='back_button'>Wróć</button>
<div class="container">
	<div class="jumbotron">
		<h1 class="calendar-logo">Kalendarz OSP</h1>
		<p class="calendar-logo">Zbiórki oraz dyżury</p>
	</div>

	<div class="page-header">

		<div class="pull-right form-inline">
			<div class="btn-group">
				<button class="btn btn-primary" data-calendar-nav="prev"><< Poprzedni</button>
				<button class="btn btn-default" data-calendar-nav="today">Dzisiaj</button>
				<button class="btn btn-primary" data-calendar-nav="next">Następny >></button>
			</div>
			<div class="btn-group">
				<button class="btn btn-warning" data-calendar-view="year">ROK</button>
				<button class="btn btn-warning active" data-calendar-view="month">Miesiąc</button>
				<button class="btn btn-warning" data-calendar-view="week">Tydzień</button>
				<button class="btn btn-warning" data-calendar-view="day">Dzień</button>
			</div>
		</div>
		<h3></h3>	
	</div>
		
	<div class="row">

		<div class="col-md-9">
			<div id="calendar"></div>
		</div>
		<div class="col-md-3">
			<div class="row">
			<h4>Events</h4>
			<small>Tutaj możemy umieścić jakieś ważne wydarzenia.</small>
			<ul id="eventlist" class="nav nav-list"></ul>
		</div>
	</div>

	<div class="clearfix"></div>
	<br><br>
	<div id="disqus_thread"></div>
	
	<script type="text/javascript" src="/OSP/calendar/components/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="/OSP/calendar/components/underscore/underscore-min.js"></script>
	<script type="text/javascript" src="/OSP/calendar/components/bootstrap3/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/OSP/calendar/components/jstimezonedetect/jstz.min.js"></script>
	<script type="text/javascript" src="/OSP/calendar/js/calendar.js"></script>
	<script type="text/javascript" src="/OSP/calendar/js/app.js"></script>


	<div class="modal fade" id="events-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title">Event</h3>
				</div>
				<div class="modal-body" style="height: 400px">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	
	

</div>
</body>
</html>
