@extends('main')
@section('title', 'Edit Award')

@section('content')

@include('partials._adminNav')

<div class="row">
    <div class="col-md-12">
        <h1>Edit Awards </h1>
		</div>
</div>

<table class="table table-striped table-bordered" style="width:75%">
      <tr>
        <th>Award Name</th>
        <th>Category</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
      <tr>
        @foreach ($awards as $award)
          <td>{{$award->category->name}} {{$award->name}}</td>
          <td>{{$award->category->name}}</td>
          <td>
            <form class="form-horizontal" action="{{url ('/admin/award/'.$award->id.'/edit') }}" method="GET">
              {{ csrf_field() }}
              <div class="form-group">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Edit</button>
                </div>
              </div>
            </form>
          </td>
          <td>
            <form class="form-horizontal" action="{{url ('/admin/award/destroy/'.$award->id)}}" method="POST">
              <input type="hidden" name="_method" value="DELETE">
              {{ csrf_field() }}
              <div class="form-group">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">Delete</button>
                </div>
              </div>
            </form>
          </td>
        </tr>
          @endforeach

</table>

<h3>Add new Award</h3>
  <form class="form-horizontal" action="{{url ('/admin/award/store') }}" method="POST">
    {{ csrf_field() }}

    <div class="form-group">
      <label class="control-label col-sm-2" for="name">Award Name*:</label>
      <div class="col-sm-4">
        <input type="textarea" class="form-control" id="name" placeholder="Enter Award Name" required  name="name">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="category">Award Category*:</label>
      <div class="col-sm-4">
        <select class="form-control" id="category" name="category">
          @foreach ($categories as $category)
            <option>{{$category->name}}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
    </div>
  </form>


  <script type="text/javascript">
    function confirmDelete() {
      var result = confirm('Are you sure you want to delete this award?')
      if (result) {
        return true;
      }
      else {
        return false;
      }
    }
  </script>
@endsection
