<?php
    include ('minicalendar.inc.php');
    include ('../get/inc/db.php');
 //moved php code to events.php
?>

<div lang="en" ng-controller="CalendarCtrl" id="top">
	<div class="col-md-4">
		<div class="head">TA Schedule</div>
		<div class="caveat">It is the responsibility of the students to verify appointment
			times and provide the correct information on this page. 
		</div>
		<h3>Sort By Class:</h3>
		<select ng-model="selectedClass" ng-options="course.courseNumber for course in courses" ng-change="classSearch()"></select>
		<br />
		<?php
			$tz = date_default_timezone_set('America/New_York');
			$datetime = new DateTime();
			$monthone = $datetime->format('n');
			$yearone = $datetime->format('Y');
		
			$datetime->modify("+1 month");
			$monthtwo = $datetime->format('n');
			$yeartwo = $datetime->format('Y');
		
			$datetime->modify("+1 month");
			$monththree = $datetime->format('n');
			$yearthree = $datetime->format('Y');
		
			echo generate_calendar($yearone, $monthone) . "<br />";
			echo generate_calendar($yeartwo, $monthtwo) . "<br />";
			echo generate_calendar($yearthree, $monththree) . "<br />";
		?>
		<br /> 		
	</div>
	<div class="col-md-8">
		<div class="add-time">
			<a ng-class="{ on: isAddTime }" class="btn btn-warning btn-lg button-right" role="button" href="#/addTime">Add Timeslot</a>
		</div>
	</div>
	<div ng-controller="CalendarCtrl">
		<div class="col-md-8">	
			
			  <h2 class="text-center">{{calendarTitle}}</h2>

			  <div class="row">

				<div class="col-md-6">
				  <div class="btn-group">

					<button
					  class="btn btn-primary"
					  mwl-date-modifier
					  date="viewDate"
					  decrement="calendarView">
					  Previous
					</button>
					<button
					  class="btn btn-default"
					  mwl-date-modifier
					  date="viewDate"
					  set-to-today>
					  Today
					</button>
					<button
					  class="btn btn-primary"
					  mwl-date-modifier
					  date="viewDate"
					  increment="calendarView">
					  Next
					</button>
				  </div>
				</div>
				<br>
			  </div>

			  <br>
		
		<div class="col-md-12"> 
			<mwl-calendar
				view="calendarView"
				view-date="viewDate"
				events="events"
				view-title="calendarTitle"
				on-view-change-click="false"
				on-event-click="eventClicked(calendarEvent)"
				cell-is-open="true">
			</mwl-calendar>
<!--
			 <h3 id="event-editor">
				Edit events
				<button
				  class="btn btn-primary pull-right"
				  ng-click="events.push({title: 'New event', type: 'important', draggable: true, resizable: true})">
				  Add new
				</button>
				<div class="clearfix"></div>
			  </h3>

			  <table class="table table-bordered">

				<thead>
				  <tr>
					<th>Title</th>
					<th>Type</th>
					<th>Starts at</th>
					<th>Ends at</th>
					<th>Remove</th>
				  </tr>
				</thead>

				<tbody>
				  <tr ng-repeat="event in events track by $index">
					<td>
					  <input
						type="text"
						class="form-control"
						ng-model="event.title">
					</td>
					<td>
					  <select ng-model="event.type" class="form-control">
						<option value="important">Important</option>
						<option value="warning">Warning</option>
						<option value="info">Info</option>
						<option value="inverse">Inverse</option>
						<option value="success">Success</option>
						<option value="special">Special</option>
					  </select>
					</td>
					<td>
					  <p class="input-group" style="max-width: 250px">
						<input
						  type="text"
						  class="form-control"
						  readonly
						  uib-datepicker-popup="dd MMMM yyyy"
						  ng-model="event.startsAt"
						  is-open="event.startOpen"
						  close-text="Close" >
						<span class="input-group-btn">
						  <button
							type="button"
							class="btn btn-default"
							ng-click="toggle($event, 'startOpen', event)">
							<i class="glyphicon glyphicon-calendar"></i>
						  </button>
						</span>
					  </p>
					  <uib-timepicker
						ng-model="event.startsAt"
						hour-step="1"
						minute-step="15"
						show-meridian="true">
					  </uib-timepicker>
					</td>
					<td>
					  <p class="input-group" style="max-width: 250px">
						<input
						  type="text"
						  class="form-control"
						  readonly
						  uib-datepicker-popup="dd MMMM yyyy"
						  ng-model="event.endsAt"
						  is-open="event.endOpen"
						  close-text="Close">
						<span class="input-group-btn">
						  <button
							type="button"
							class="btn btn-default"
							ng-click="toggle($event, 'endOpen', event)">
							<i class="glyphicon glyphicon-calendar"></i>
						  </button>
						</span>
					  </p>
					  <uib-timepicker
						ng-model="event.endsAt"
						hour-step="1"
						minute-step="15"
						show-meridian="true">
					  </uib-timepicker>
					
					</td>
					<td>
					  <button
						class="btn btn-danger"
						ng-click="events.splice($index, 1)">
						Delete
					  </button>
					</td>
				  </tr>
				</tbody>

			  </table>
-->			
		</div>
	</div>
</div>
