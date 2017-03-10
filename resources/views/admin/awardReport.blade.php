@extends('main')
@section('title', 'Award Report')

@section('content')

@include('partials._adminNav')



<div class="row">
    <div class="col-md-12">
        <h1>Awards Report</h1>
		</div>
</div>

<nav class="navbar navbar-default">

<div class="btn-group">
<button type="button" class="btn btn-default btn-sm dropdown-toggle"  data-toggle="dropdown">Year(s) <span class="caret"></span></button>
<span class="dropdown-menu" id= "uniqueYears">
  @foreach ($unique_Years as $unique_Year)
    <li><a href="#" class="small" data-value="{{$unique_Year->uniqueYears}}"+" tabIndex="-1"><input type="checkbox"/>&nbsp; <option>{{$unique_Year->uniqueYears}}</option></a></li>"
  @endforeach
</span></div>
    <button type="submit" class="btn btn-primary" onclick="myFilter()">Filter</button>
</nav>

<table class="table table-striped table-bordered" style="width:75%">
      <tr>
        <th>Award Name</th>
        <th>Category</th>
        <th>Count</th>
      </tr>

<tr>
        @foreach ($awards as $award )

          <td> {{$award->name}} </td>
            <td> {{$award->category}} </td>
          <td>
{{-- blade does not handle php assigmnets so will have to use php tags--}}
            <?php $theCount= 0  ?>
           @foreach ($countNoms as $countNom )
              @if ($countNom->award_id == $award->id)
              <?php $theCount =$countNom->countID ?>
              @endif
            @endforeach
            {{$theCount}}
      </td>
      </tr>
        @endforeach
</table>





  <script type="text/javascript">

  function myFilter() {

    var requestData = JSON.stringify(uniqueYears);
       console.log(requestData);
       //logs correct json object
    

       var request;
       console.log("test");
       request = $.ajax({
           url: "/admin/awardReport/filter",
           method: "GET",
           dataType: "JSON",
             data: {data : requestData}
       });
     }


  var uniqueYears = [];
  $( '#uniqueYears a' ).on( 'click', function( event ) {

   var $target = $( event.currentTarget ),
       val = $target.attr( 'data-value' ),
       $inp = $target.find( 'input' ),
       idx;

   if ( ( idx = uniqueYears.indexOf( val ) ) > -1 ) {
      uniqueYears.splice( idx, 1 );
      setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
   } else {    uniqueYears.push( val );
      setTimeout( function() { $inp.prop( 'checked', true ) }, 0); }

   $( event.target ).blur();

   console.log( uniqueYears );
   return false;
  });

  </script>
@endsection