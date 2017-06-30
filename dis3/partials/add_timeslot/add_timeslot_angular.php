<div ng-controller = "addTimeSlot">	
	<div class="col-md-12 heading">
		<div class="col-md-4 col-md-offset-4">
			<h2>Add Time Slot</h2>
		</div>
	</div>
	<div class="col-md-12">
		<div ng-show="success">
			<div class="alert alert-success" role="alert">{{ success }}</div>
		</div>
		<div ng-show="error">
			<div class="alert alert-warning" role="alert">{{ error }}</div>
		</div>
	</div>
	<div class="col-md-6 col-md-offset-2">
		<form class="form-horizontal" name="addTime">

			<div class="form-group">
				<label class="col-sm-4 control-label">User:</label>
				<div class="col-sm-8">
					<select class="form-control" name="name" ng-model="slotInsert.name" ng-options="user.id as user.name for user in users"></select>
					<span style="color:red" ng-show="addTime.name.$dirty && addTime.name.$invalid">
						<span ng-show="addTime.name.$error.required">Please select your name</span>
					</span>
				</div>
			</div>
	
			<div class="form-group">
				<label class="col-sm-4 control-label">Course:</label>
				<div class="col-sm-8">
					<select class="form-control" name="course_selection" ng-model="slotInsert.course" ng-options="course.id as course.courseNumber for course in courses"></select>
					<span style="color:red" ng-show="addTime.courseId.$dirty && addTime.courseId.$invalid">
						<span ng-show="addTime.courseId.$error.required">Please select a course</span>
					</span>
				</div>
			</div>
	
			<div class="form-group">		
				<label class="col-sm-4 control-label">Start Time:</label>
				<div class="col-sm-8">
					<a class="dropdown-toggle my-toggle-select-3" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="">	
						<div class="input-group">
							<input type="text" class="form-control" name="start_time" id="start_time" ng-model="slotInsert.startTime" placeholder="Start Time" required>
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
						<datetimepicker data-ng-model="slotInsert.startTime" data-datetimepicker-config="{ dropdownSelector: '.my-toggle-select-3', minView: 'minute' }"></datetimepicker>
					</ul>
					<span style="color:red" ng-show="addTime.startTime.$dirty && addTime.startTime.$invalid">
						<span ng-show="addTime.startTime.$error.required">Please enter a start time!</span>
					</span>
				</div>
			</div>
	
			<div class="form-group">
				<label class="col-sm-4 control-label">End Time:</label>
				
				<div class="col-sm-8">
					<a class="dropdown-toggle my-toggle-select-4" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="">	
						<div class="input-group">
							<input type="text" class="form-control" name="end_time" id="end_time" ng-model="slotInsert.endTime" placeholder="End Time" required>
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
						<datetimepicker data-ng-model="slotInsert.endTime" data-datetimepicker-config="{ dropdownSelector: '.my-toggle-select-4', minView: 'minute' }"></datetimepicker>
					</ul>
					<span style="color:red" ng-show="addTime.endTime.$dirty && addTime.endTime.$invalid">
						<span ng-show="addTime.endTime.$error.required">Please select an end time!</span>
					</span>
				</div>
			</div>
	
			<div class="form-group">
				<label class="col-sm-4 control-label">Room:</label>
				<div class="col-sm-8">
					<select class="form-control" name="room" ng-model="slotInsert.room" ng-options="room.roomID as room.roomNumber for room in rooms"></select>
					<span style="color:red" ng-show="addTime.room.$dirty && addTime.room.$invalid">
						<span ng-show="addTime.room.$error.required">Please select a room</span>
					</span>
				</div>
			</div>
	
			<div class="form-group">
				<div class="col-sm-4"></div>
				<div class="col-sm-8">
					<button type="submit" class="btn btn-default" ng-disabled="addTime.$invalid" ng-click="submitForm()">Submit</button>
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-12">
		<div class="col-md-4"></div>
		<div class="col-md-4">
				<a href="#/schedule" class="btn btn-info btn-right col-md-12" role="button">Return To Schedule</a>
		</div>
	</div>
</div>