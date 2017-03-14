@extends('main')
@section('title', 'Create Nomination')
@section('content')

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>Create New Nomination</h1>
      @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
         @foreach ($errors ->all() as $error)
         <li>{{$error}}</li>
         @endforeach
       </ul>
      </div>
     @endif

      <form class="form-horizontal" action="{{url ('/nominations') }}" method="POST">
        {{ csrf_field() }}

        <div class="form-group">
          <label class="control-label col-sm-2" for="award">Award*:</label>
          <div class="col-sm-8">
            <select class="form-control" id="award" name="award">
              @foreach ($awards as $award)
                <option>{{$award->name}}  {{$award->category->name}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="studentNumber">Student Number*:</label>
          <div class="col-sm-8">
            <input type="textarea" class="form-control" id="studentNumber" placeholder="Enter Student Number" required pattern='[0-9]{8}' name="studentNumber">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="studentFirstName">First Name*:</label>
          <div class="col-sm-8">
            <input type="textarea" class="form-control" id="studentFirstName" placeholder="Enter First Name" required name = "studentFirstName">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="studentLastName">Last Name*:</label>
          <div class="col-sm-8">
            <input type="textarea" class="form-control" id="studentLastName" placeholder="Enter Last Name" required name = "studentLastName">
          </div>
        </div>

        <div class="form-group" id="askGrad">
          <label class="control-label col-sm-4" for="checkbox">Also nominate for Distinguished Graduating student?:</label>
          <div class="checkbox" >
            <label><input type="checkbox" id ="checkForDis" name="askGrad" onclick="toggle(confirmGradNom, $(this))">Yes</label>
            </div>

        </div >

{{--                             grid starts  --}}
        <div class="container-fluid form-group">
            <div class="row clearfix">
                <div class="col-md-10 column">
                    <table class="table table-bordered table-hover" id="tab_logic">
                        <thead>
                            <tr >
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">
                                    Course Name
                                </th>
                                <th class="text-center">
                                    Course Number
                                </th>
                                <th class="text-center">
                                    Section Number
                                </th>
                                <th class="text-center" title="This or predicted grade" >
                                    Final Grade
                                </th>
                                <th class="text-center" title="This or final grade">
                                    Predicted Grade
                                </th>

                                <th class="text-center">
                                    Class Rank
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id='addr0'>
                                <td>
                                1
                                </td>
                                <td>
                                <input type="text" name='courseName0'  placeholder='Eg. COSC'  required class="form-control"/>
                                </td>
                                <td>
                                <input type="text" name='courseNumber0' placeholder='Eg. 499' required name = "courseNumber0" class="form-control"/>
                                </td>
                                <td>
                                <input type="text" name='sectionNumber0' placeholder='Eg. 001' required pattern='[0-9]{3}' class="form-control"/>
                                </td>
                                <td title="This or predicted grade">
                                <input type="text" name='finalGrade0' placeholder='Eg. 98' pattern='[0-9]|[1-9][0-9]|[1][0-9][0-9]$' class="form-control"/>
                                </td>
                                <td title="This or final grade">
                                <input type="text" name='estimatedGrade0' placeholder='Eg.90' pattern='[0-9]|[1-9][0-9]|[1][0-9][0-9]$' class="form-control"/>
                                </td>
                                <td>
                                <input type="text" name='rank0' placeholder='Eg. 1' class="form-control"/>
                                </td>
                            </tr>
                            <tr id='addr1'></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <a id="add_row" class="btn btn-default pull-left" title="Max 6">Add Course </a><a id='delete_row' class="btn btn-default pull-left">Delete Course</a>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="description">Description:</label>
          <div class="col-sm-8">
            <textarea rows='4' cols='80'class="form-control" id="description" placeholder="Enter Description" name = "description"></textarea>
          </div>
        </div>

        <div class="form-group" id="confirmGradNom" >

            <div class="form-group">
              <label class="control-label col-sm-2" for="gradDescription">Distinguished Graduate Student Award Description:</label>
              <div class="col-sm-8">
                <textarea rows='4' cols='80'class="form-control" id="gradDescription" placeholder="Please explain the reason for nominating this student for The distinguished graduating student award. The award in Unit 5 is given to a student who has: excelled academically as evidenced by their outstanding GPA, shown exceptional promise in research as evidenced by their contributions to published work and/or research recognition, has contributed service to the unit, usually in the form of teaching, and is a recognition of the student’s overall performance.  " name = "gradDescription"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-10" >This student will be nominated for the distinguished graduating student award as well</label>
            </div>


        </div>

        <div class="form-group">
          <div class="col-sm-8">
            <button type="submit" class="btn btn-primary">Nominate!</button>
          </div>
        </div>
      </form>

  </fieldset>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script>
  window.onload = function(){
  // your code here

  $(confirmGradNom).hide()
  $(askGrad).hide()
};

  //function for adding and removing rows, limited to 6 rows total
  var i=1;
  $("#add_row").click(function(){
    if (i<6) {

  $('#addr'+i).html("<td>"+ (i+1) +"</td><td><input name='courseName"+i+"' type='text' placeholder='Eg. COSC' class='form-control input-md'  /></td><td><input  name='courseNumber"+i
  +"' type='text' placeholder='Eg. 499'  class='form-control input-md'></td><td><input  name='sectionNumber"+i
  +"' type='text' placeholder='Eg. 001' required pattern='[0-9]{3}'  class='form-control input-md'></td><td><input  name='finalGrade"+i
  +"' type='text' placeholder='Eg. 98' pattern='[0-9]|[1-9][0-9]|[1][0-9][0-9]$' class='form-control input-md' title='This or predicted grade'></td><td><input  name='estimatedGrade"+i
  +"' type='text' placeholder='Eg. 98' pattern='[0-9]|[1-9][0-9]|[1][0-9][0-9]$' class='form-control input-md' title='This or final grade'></td><td><input  name='rank"+i
  +"' type='text' placeholder='Eg. 1' class='form-control input-md'></td>");

  $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
  i++;}
  });

  $("#delete_row").click(function(){
     if(i>1){
     $("#addr"+(i-1)).html('');
     i--;
     }
  });

  function toggle(className, obj) {
    var $input = $(obj);
    if ($input.prop('checked')) $(className).show();
    else {
         $(className).hide();
     $(confirmGradNom).hide() ;

      }
};


// only runs when doc is loaded and ready
$(document).ready(function(){

  // for hover option put its <a title="string"> in tag and it will show in hover
    $('[data-toggle="tooltip"]').tooltip();

    // to check if a grad award has beeen selected
    document.getElementById('award').addEventListener('change',function(){
    if ( ($('#award option:selected').text().toLowerCase().indexOf("graduating")>-1) || ($('#award option:selected').text().toLowerCase().indexOf("graduate")>-1)) {
      //show
    $(askGrad).show()

    } else if (($('#award option:selected').text().toLowerCase().indexOf("distinguished")>-1)) {
      //hide if distinguish grad
      $(askGrad).hide()

    }
    else {
      // hide if not grad
      $(confirmGradNom).hide()
      $(askGrad).hide()
      $(checkForDis).prop('checked', false)
    }
  })


});








  </script>

</body>
@endsection
