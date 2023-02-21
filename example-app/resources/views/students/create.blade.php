@extends('students.layout')
@section('content')

@if (Session::has('success'))
<div class="alert alert-success">
  {{Session::get('success')}}<br><br>
  @php
  Session::forget('success');
  @endphp
</div>
@endif
<div class="container w-75">
  <div class="card mt-5">
    <div class="card-header bg-success-subtle">Create Student Page</div>
    <div class="card-body">
      <form action="{{ route('student') }}" method="post" enctype="multipart/form-data">
        @csrf

        <label>Name</label></br>
        <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">

        @if($errors->has('name'))
        <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
        <br>
        <br>

        <label>Image</label>
        <img src="" alt="" id="file-preview">
        <input type="file" name="image" id="image" class="form-control" onchange="showPreview(event)">

        @if($errors->has('image'))
        <span class="text-danger">{{ $errors->first('image') }}</span>
        @endif
        <br>
        <br>

        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
          <div class="form-group">
            <select name="place_id" class="block w-full mt-1 rounded-md form-control">
              <option value="">Select Place</option>
              @foreach ($places as $place)
              <option value="{{$place->id}}">{{$place->name}}</option>
              @endforeach
            </select>
            @error('place_id')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
          <div class="form-group">
            <!-- <select name="" multiple="multiple" class="block w-full mt-1 rounded-md form-control" required>
              <option value="">Select Category</option>
              @foreach ($categories as $category)
              <option value="{{$category->name}}">{{$category->name}}</option>
              @endforeach
            </select> -->
            <label><strong>Category :</strong></label><br>
            @foreach ($categories as $category)
            <label><input type="checkbox" name="cat[]" value="{{$category->name}}"> {{$category->name}}</label>
            @endforeach
            @error('category_id')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <br><br>
        <button type="submit" value="Save" class="btn btn-success">Save</button>
      </form>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js">
</script>

<script type="text/javascript">
  $(document).ready(function(e) {
    $('#image').change(function() {
      let reader = new FileReader();
      reader.onload = (e) => {
        $('#image').attr('src', e.target.result);
      }
      reader.readAsDataURL(this.files[0]);

    });

  });
</script>
<!-- <script>
  $(document).ready(function() {
    $('#example-getting-started').multiselect({
      buttonClass: 'form-select',
      templates: {
        button: '<button type="button" class="multiselect dropdown-toggle" data-bs-toggle="dropdown"><span class="multiselect-selected-text"></span></button>',
      }
    });
  });
</script> -->
@stop