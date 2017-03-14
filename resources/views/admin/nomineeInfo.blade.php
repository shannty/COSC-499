@extends('main')
@section('title', 'Nominee Information')
@section('content')
@include('partials._adminNav')

<script type="text/javascript">

$(document).ready(function() {
    $('#myTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );

</script>


<div class="row">
    <div class="col-md-12">
        <h1>Nominee Information</h1>
  </div>
</div>
<br>



    <table id="myTable" class="table table-striped table-bordered" style="width:75%">
<thead>
      <tr>
        <th>Student Number</th>
        <th>Student Name</th>
        <th>Email</th>
        <!-- <th>Delete</th> -->
        <th>Edit</th>

        </tr>
      </thead>
<tbody>
          <tr>
          @foreach ($nominees as $nominee)
            <td>{{$nominee->studentNumber}}</td>
            <td>{{$nominee->firstName}} {{$nominee->lastName}}</td>
            <td>{{$nominee->email}}</td>
            <td>
               <form class="form-horizontal" action="{{url ('/admin/nomineeInfo/'.$nominee->studentNumber.'/edit') }}" method="GET">
                 {{ csrf_field() }}
                 <div class="form-group">
                   <div class="col-sm-10">
                     <button type="submit" class="btn btn-primary">Edit</button>
                   </div>
                 </div>
               </form>
             </td>

          </tr>
          @endforeach

</tbody>

    </table>
    </div>

{{--using a new view to send email--}}
<form class="form-horizontal" action="{{url ('/admin/nomineeInfo/email') }}" method="GET">
	<div class="form-group">
		<div class="col-sm-10">
			 <button type="submit" class="btn btn-primary">Send Emails</button>
		</div>
	</div>
</form>

@endsection