@extends('students.layout')
@section('content')
<div class="container w-50">
  <div class="card mt-5">
    <div class="card-header bg-success-subtle">Students Detail Page</div>
    <div class="card-body">
      <p class="card-title">Name : {{ $students->name }}</p>
      <br>
      <p class="card-text">Image : <img src=" {{asset('storage/images/'.$students->image)}}" alt="Student Image" class="img-fluid img-thumbnail w-25">
        <br>
      <p class="card-title">Place : {{ $students->place->name }}</p>
      <br>
      </p>
      <br>
      <p class="card-title">Category :
        @foreach($students->category as $category)
        {{$category->name}}
        @endforeach
      </p>
      <!-- <p class="card-title">Category : {{ $students->$cats->name }}</p> -->
      <br>
      </p>
    </div>
    </hr>
  </div>
</div>
</div>