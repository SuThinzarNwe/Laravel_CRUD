@extends('students.layout')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h2>Laravel 9 Crud</h2>
          <div class="row">
            <nav class="navbar navbar-expand-lg bg-primary-subtle">
              <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active border border-success rounded" aria-current="page" href="{{ route('student.create') }}">Add New</a>
                    </li>
                  </ul>
                  <form action="{{route('student')}}" method="GET" class="d-flex" role="search">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request()->get('search') }}" />
                    <button class="btn btn-outline-success" type="submit">
                      Search
                    </button>
                  </form>
                </div>
              </div>
            </nav>
          </div>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr class="text-center">
                  <th scope="col">No.</th>
                  <th scope="col">Name</th>
                  <th scope="col">Image</th>
                  <th scope="col">Place</th>
                  <th scope="col">Category</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <?php $i = $students->perPage() * ($students->currentPage() - 1) + 1; ?>
                @foreach($students as $key => $student)
                <tr>
                  <td scope="row">{{ $i++ }}</td>
                  <td>{{ $student->name }}</td>
                  <td class="w-25"> <img src=" {{asset('storage/images/'.$student->image)}}" alt="Student Image" class="img-fluid img-thumbnail w-25"> </td>
                  <td>
                    {{$student->place->name ?? ' '}}
                  </td>
                  <!-- <td class="w-25">
                    @foreach($student->category as $category)
                    {{ $category->name }}
                    @endforeach
                  </td> -->
                  <td class="w-25">
                    @foreach($student->category as $category)
                    {{$category->name}}
                    @endforeach
                  </td>
                  <td>
                    <a href="{{ route('student.show', $student->id)}}" title="View Student"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                    <a href=" {{ route('student.edit', $student->id)}}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                    <form method="POST" action="{{ route('student.destroy', [$student->id])  }}" accept-charset="UTF-8" style="display:inline">
                      @method("DELETE")
                      @csrf
                      <button type="submit" class="btn btn-danger btn-sm" title="Delete Student"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex justify-content-center">
              {!! $students->links() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection