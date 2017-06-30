<div ng-controller="application">
	<div class="col-md-12">
		<h1 style="text-align: center">Undergraduate TA/Grader Application</h1>
	</div>
	<div class="col-md-12" ng-show="section=='0'">	
		<h3 style="text-align: center">Application Deadline for Fall 2014: Friday May 9th, 2014</h3>
		<p style="text-align: justify">
			Welcome to the Department of Statistics application for instructional assistance. 
			We appreciate your interest and ask that you fill out the forms on the following 
			pages to be considered for a position in our department.
			<br><br>
			Please refer any questions on this application to our Academic Coordinator at acadcoord@stat.cmu.edu.
			<br><br>
			University policy states that non-native English speakers who do not earn a Restricted I or Pass 
			on the International TA Test may have limited interactions with students. 
			Therefore, if you are a non-native English speaker and have not earned a Restricted I 
			or Pass on the ITA exam, you will only be qualified for a grader position. 
			The department hires a number of graders each semester.
			<br>
			<br>
			Note: non-US Citizens (F-1 or J-1 visas) must obtain a Social Security Number before they can work. 
			<strong>If selected for a position within our Department, non-US Citizens should begin the SSN application process immediately!</strong>
			The SSN can be obtained by following the instructions <a href="http://www.studentaffairs.cmu.edu/oie/forscho/j1/ssn.html">here</a>.
			<br>
		</p>
		<button type="button" class="btn btn-info btn-right col-md-12" ng-click="section='1'">Start Now!</button> 
	</div>
	
	
	<div>
		<form class="form-horizontal" name="hiringApp" method="post">
			<!--   PERSONAL INFORMATION   -->
			<div class="col-md-12 personal" ng-show="section=='1'">
				<h3>Personal Information</h3>
				<p style="text-align: justify">Note: Non-US Citizens (F-1 or J-1 visas) must obtain a Social Security Number before they can work. 
				If you do not provide evidence (signed copy of your SSN application) at least two weeks prior to the 
				end of the semester before your position starts, you will not be eligible for employment. 
				The SSN can be obtained by doing the following:
				<ol type="1">
  					<li>Requesting the Social Security Number Form from the Department of Statistics</li>
  					<li>Taking the form to the CMU Office of International Education</li>
  					<li>Then taking the form to the Social Security Office to actually apply for a Social Security Number</li>
				</ol>
				If you do not currently have a Social Security Number, please leave the field as '0000'.
				</p>
				<div class="grid_4 messages" id="messges" ng-show="messages" ng-bind="messages"></div><br />

			<div class="form-group">
				<label class="col-sm-4 control-label required">First Name</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="first_name" id="first_name" ng-model="applicant.firstName" placeholder="First Name" required>
					<span style="color:red" ng-show="hiringApp.first_name.$dirty && hiringApp.first_name.$invalid">
      					<span ng-show="hiringApp.first_name.$error.required">First Name is Required!</span>
      			</span>
				</div>
			</div>
		
			<div class="form-group">
				<label class="col-sm-4 control-label required">Last Name</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="last_name" id="last_name" ng-model="applicant.lastName" placeholder="Last Name" required>
					<span style="color:red" ng-show="hiringApp.last_name.$dirty && hiringApp.last_name.$invalid">
      					<span ng-show="hiringApp.last_name.$error.required">Last Name is Required!</span>
      				</span>
				</div>
			</div>
		
			<div class="form-group">
				<div class="input-group">
					<label class="col-sm-4 control-label required">Andrew ID</label>
					<div class="col-sm-8">
						<div class="input-group">
  							<input type="text" class="form-control" name="andrew_id" id="andrew_id" ng-model="applicant.andrewID" placeholder="Andrew ID" required>
  							<span class="input-group-addon">@andrew.cmu.edu</span>
						</div>
						<span style="color:red" ng-show="hiringApp.andrew_id.$dirty && hiringApp.andrew_id.$invalid">
      						<span ng-show="hiringApp.andrew_id.$error.required">Andrew ID is Required!</span>
      					</span>
					</div>
				</div>
			</div>
		
			<div class="form-group">
				<label class="col-sm-4 control-label required">Address</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="address" id="address" ng-model="applicant.address" placeholder="Address" required>		
					<span style="color:red" ng-show="hiringApp.address.$dirty && hiringApp.address.$invalid">
     					<span ng-show="hiringApp.address.$error.required">Address is Required!</span>
 					</span>
				</div>
			</div>
			
			<div class="form-group">	
				<label class="col-sm-4 control-label required">Phone Number</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="phone" id="phone" ng-model="applicant.phone" placeholder="Phone Number" required>
					<span style="color:red" ng-show="hiringApp.phone.$dirty && hiringApp.phone.$invalid">
      					<span ng-show="hiringApp.phone.$error.required">Phone Number is Required!</span>
      				</span>
				</div>
			</div>
			
			<div class="form-group">	
				<label class="col-sm-4 control-label required">Class</label>
				<div class="col-sm-8">
					<select class="form-control" name="grad_year" ng-model="applicant.grad_year" ng-options="year.value as year.value for year in years" required>
					</select>
				</div>
			</div>
		
			<div class="form-group">	
				<label class="col-sm-4 control-label required">SSN (last 4 digits)</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="ssn" id="ssn" ng-model="applicant.ssn" placeholder="Social Security Number" required>
					<span style="color:red" ng-show="hiringApp.ssn.$dirty && hiringApp.ssn.$invalid">
      					<span ng-show="hiringApp.ssn.$error.required">Social Security Number is Required!</span>
      				</span>
				</div>
			</div>
			
			<div class="form-group">	
				<label class="col-sm-4 control-label required">Native Language</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="lang" id="lang" ng-model="applicant.language" placeholder="Language" required>
					<span style="color:red" ng-show="hiringApp.lang.$dirty && hiringApp.lang.$invalid">
      					<span ng-show="hiringApp.lang.$error.required">Language is Required!</span>
      				</span>
				</div>
			</div>
		
			<div class="form-group">	
				<label class="col-sm-4 control-label">
				IF your native language is NOT English, have you taken the ITA Exam? 
				</label>
				<div class="col-sm-8">
					<label class="radio-inline">
  						<input type="radio" name="ITA" id="yes" value="yes" ng-model="applicant.ITA"> Yes
					</label>
					<label class="radio-inline">
  						<input type="radio" name="ITA" id="no" value="no" ng-model="applicant.ITA"> No
					</label>
				</div>
			</div>
			
			<div class="form-group" ng-show="applicant.ITA=='yes'">
				<label class="col-sm-4 control-label">What level did you score</label>
				<div class="col-sm-8">
					<select class="form-control" name="ita_score" ng-model="applicant.ita_score" ng-options="score.value as score.value for score in scores">
					</select>
				</div>
			</div>
			<div class="form-group">	
				<label class="col-sm-4 control-label required">Major One</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="major_one" id="major_one" ng-model="applicant.majorOne" placeholder="First Major" required>
					<span style="color:red" ng-show="hiringApp.major_one.$dirty && hiringApp.major_one.$invalid">
      					<span ng-show="hiringApp.major_one.$error.required">At least one major is Required!</span>
      				</span>
				</div>
			</div>
			<div class="form-group">	
				<label class="col-sm-4 control-label">Major Two (optional)</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="major_two" id="major_two" ng-model="applicant.majorTwo" placeholder="Second Major">
				</div>
			</div>	
			<div class="form-group">	
				<label class="col-sm-4 control-label">Minor, if any</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="minor" id="minor" ng-model="applicant.minor" placeholder="Minor">
				</div>
			</div>
			<div class="form-group">	
				<label class="col-sm-4 control-label required">Academic Advisor</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="advisor" id="advisor" ng-model="applicant.advisor" placeholder="Advisor's Name" required>
					<span style="color:red" ng-show="hiringApp.advisor.$dirty && hiringApp.advisor.$invalid">
      					<span ng-show="hiringApp.advisor.$error.required">Academic Advisor is Required!</span>
      				</span>
				</div>
			</div>
			<div class="col-sm-4">
			</div>
			<div class="col-sm-8 paddingless">
				Fields marked with a <span style="color:red">*</span> are required.
				<button type="button" class="btn btn-info btn-right" ng-click="validateSection2()">Next</button>
			</div>
		</div>
		
		
		<!--   PRIOR STATS COURESES   -->
		<div class="col-md-12" ng-show="section == '2'">
			<div class="btn-group btn-right">
				<button type="button" class="btn btn-info" ng-click="section='1'">Previous</button>
  				<button type="button" class="btn btn-info" ng-click="section='3'">Next</button>
			</div>
			<h3>Prior Stats Courses</h3>
			<p>If you have ever taken a Statistics course, please fill in the following:</p>
			
			<div ng-show="errors">
				<div class="alert alert-warning" role="alert">
					<ul>
    					<li ng-repeat="error in errors">{{error}}</li>
    				</ul>
    			</div>
			</div>
			
  			<div class="form-group col-md-3">
    			<label for="classNum">Course (e.g. 36xxx)</label>
    			<input type="text" class="form-control" id="course" ng-model="classNum" placeholder="Course Number">
  			</div>
  			<div class="form-group col-md-3">
    			<label for="instructor">Instructor</label>
    			<input type="text" class="form-control" id="instructor" ng-model="instructor" placeholder="Instructor">
  			</div>
  			<div class="form-group col-md-2">
    			<label for="grade">Grade Received</label>
    			<select class="form-control" id="grade" ng-model="grade" ng-options="grade.value for grade in grades"></select>
  			</div>  
  			<div class="form-group col-md-5">
    			<label for="comments">&nbsp;&nbsp;Comments</label>
    			<input type="text" class="form-control" id="comments" ng-model="comment"  placeholder="Comments">
  			</div>
  			<div class="col-md-4 paddingless">
  				<button id="button" type="button" ng-click="addClass(priorStats)" class="btn btn-default">Add Course</button>
			</div>
			<div class="col-md-10 col-md-offset-1" ng-show="priorStats.length">
				<br>
				<br>
				<table class="table table-bordered">
      				<thead>
        				<tr>
          					<th>Course</th>
          					<th>Instructor</th>
          					<th>Grade</th>
          					<th>Comments</th>
        				</tr>
      				</thead>
      				<tbody>
        				<tr ng-repeat="class in priorStats">
        				  <td>{{class.class}}</th>
          				  <td>{{class.instructor}}</td>
          				  <td>{{class.grade}}</td>
        				  <td>{{class.comment}}</td>
        				</tr>
      				</tbody>
    			</table>
			</div>
		</div>
		
		<!--   RELEVANT NON-STATS COURESES   -->
		<div class="col-md-12" ng-show="section == '3'">
			<div class="btn-group btn-right">
				<button type="button" class="btn btn-info" ng-click="section='2'">Previous</button>
  				<button type="button" class="btn btn-info" ng-click="section='4'">Next</button>
			</div>
			<h3>Relevant Non-Stats Courses</h3>
			<p>If you have ever taken non-Statistics courses that you feel are relevant experience for a Grader, TA, or Lab Assistant position in Statistics, please fill in the following:</p>
 			<div class="form-group col-md-3">
    			<label for="classNum">Course (e.g. 36xxx)</label>
				<input type="text" class="form-control" id="classNum" ng-model="classNum" placeholder="Course Number">
			</div>
  			<div class="form-group col-md-3">
  				<label for="instructor">Instructor</label>
    			<input type="text" class="form-control" id="instructor" ng-model="instructor" placeholder="Instructor">
  			</div>
  			<div class="form-group col-md-2">
    			<label for="grade">Grade Received</label>
				<select class="form-control" id="grade" ng-model="grade" ng-options="grade.value for grade in grades"></select>
 			</div>
			<div class="form-group col-md-5">
   				<label for="comment">&nbsp;&nbsp;Comments</label>
   				<input type="text" class="form-control" id="comment" ng-model="comment"  placeholder="Comments">
			</div>
			
  			<div class="col-md-4 paddingless">
  				<button id="button" type="button" ng-click="addClass(nonStats)" class="btn btn-default">Add Course</button>	
			</div>
			<div class="col-md-8">
				<ul class="priornonstats">
					<li ng-repeat="class in nonStats">{{class.class}} || {{class.instructor}} || {{class.grade}} || {{class.comment}}</li>
				</ul>
			</div>
		</div>
		
		<!--   PRIOR EMPLOYMENT   -->
		<div class="col-md-12" ng-show="section == '4'">
  			<div class="btn-group btn-right">
    			<button type="button" class="btn btn-info" ng-click="section='3'">Previous</button>
  				<button type="button" class="btn btn-info" ng-click="section='5'">Next</button>
    		</div>
			<h3>Prior Employment by CMU</h3>
			<p>If you have ever been a Grader, TA or Lab Assistant, please fill in the following:</p>
			
			<div ng-show="priorErrors">
				<div class="alert alert-warning" role="alert">
					<ul>
    					<li ng-repeat="error in priorErrors">{{error}}</li>
    				</ul>
    			</div>
			</div>
			
 			<div class="form-group col-md-3">
    			<label for="classNum">Course (e.g. 36xxx)</label>
    			<input type="text" class="form-control" id="classNum" ng-model="priorClassNum" placeholder="Course Number">
  			</div>
  			<div class="form-group col-md-3">
    			<label for="instructor">Instructor</label>
    			<input type="text" class="form-control" id="instructor" ng-model="priorInstructor" placeholder="Instructor">
  			</div>
  			<div class="form-group col-md-2">
    			<label for="role">Position</label>
    			<select class="form-control" id="role" ng-model="position" ng-options="position.title for position in positions"></select>
  			</div>
  			<div class="form-group col-md-5">
    			<label for="responsibilities">&nbsp;&nbsp;Responsibilities/Comments</label>
    			<input type="text" class="form-control" id="responsibilities" ng-model="responsibilities"  placeholder="Responsibilities/Comments">
  			</div>
    		<div class="col-md-4 paddingless">
      			<button id="button" type="button" ng-click="addEmployment(employment)" class="btn btn-default">Add Course</button>
    		</div>
			<div class="col-md-10 col-md-offset-1" ng-show="employment.length">
				<br>
				<br>
				<table class="table table-bordered">
      				<thead>
        				<tr>
          					<th>Course</th>
          					<th>Instructor</th>
          					<th>Position</th>
          					<th>Responsibilities/Comments</th>
        				</tr>
      				</thead>
      				<tbody>
        				<tr ng-repeat="job in employment">
        				  <td>{{job.class}}</th>
          				  <td>{{job.instructor}}</td>
          				  <td>{{job.position}}</td>
        				  <td>{{job.responsibilities}}</td>
        				</tr>
      				</tbody>
    			</table>
			</div>
		</div>
		
		<!--   ADDITIONAL INFORMATION   -->
		<div class="col-md-12" ng-show="section == '5'">
			<button type="button" class="btn btn-info btn-right" ng-click="section='4'">Previous</button>
			<h3>Additional Information</h3>
			<div class="form-group">	
				<div class="col-md-4">
					<label class="control-label">Preferred Courses</label>
					<p class="help-block">If there are Statistics courses to which you would prefer to be assigned, 
					please list them in order of preference.</p>
				</div>
				<div class="col-sm-8">
					<textarea class="form-control" name="preferred" id="preferred" ng-model="applicant.preferred" cols="100" rows="4"></textarea>
				</div>
			</div>
		
			<div class="form-group">	
				<div class="col-md-4">
					<label class="control-label">Other Skills</label>
					<p class="help-block">please describe any other relevant experience or skills 
					(e.g., computer skills, work experience, etc.)</p>
				</div>
				<div class="col-sm-8">
					<textarea class="form-control" name="experience" id="experience" ng-model="applicant.experience" cols="100" rows="4"></textarea>
				</div>
			</div>
		
			<div class="form-group">
				<div class="col-md-4">
					<label class="control-label">References</label>
					<p class="help-block">If available</p>
				</div>
				<div class="col-sm-8">
					<textarea class="form-control" name="reference" id="reference" ng-model="applicant.reference" cols="100" rows="4"></textarea>
				</div>
			</div>
    		<div class="btn-right">
      			<button type="button" class="btn btn-default" ng-disabled="hiringApp.$invalid" ng-click="submitForm()">Submit</button>
    		</div>
    	</div>
  				
		</form>
		
		<div class="col-md-12" ng-show="section=='6'">
		<hr>
			<div class="alert alert-success" role="alert">
				<h3 style="text-align: center">Thank you for applying! Your application will be reviewed.</h3>
				<a href="http://www.stat.cmu.edu/~zgreen/SIS/index.html#/home">Return to Homepage</a> 
			</div>
		</div>
	</div>
</div>