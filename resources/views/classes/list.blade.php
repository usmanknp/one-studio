@extends('master.master')

@section('title', 'Dashboard')

@section('content')
    <section class="section">
      <div class="row">
        <div class="col-lg-10 offset-1">
          <div class="card">
            <div class="card-body">
            
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="card-title">Classes List </h5>
              <a href="{{ url('class-create') }}" class="btn btn-primary btn-sm">Add New</a>
            </div>

              @if(session('error'))
              <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            @if(session('message'))
              <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
              <!-- Table with hoverable rows -->
              <table class="table table-hover table-bordered" style="font-size:13px;">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Instructor</th>
                    <th scope="col">Description</th>
                    <th scope="col">Type</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col" colspan="2">Actions</th>
                  </tr>
                </thead>
                <tbody>
                @if(count($records) === 0)
                <tr>
                  <td colspan="6">No records found.</td>
                </tr>
                @else
                  @foreach($records as $key => $record)
                    <tr>
                    <th scope="row">{{  $key+1 }}</th>
                    <td>{{ $record->name }}</td>
                    <td>{{$record->instuctors->name}}</td>
                    <td>{{ $record->description }}</td>
                    <td>{{ $record->type }}</td>
                    <td>{{ $record->start_date }}</td>
                    <td>{{ $record->end_date }}</td>
                    <td>
                      <a href="{{ url('class-edit', $record->uuid) }}" >
                        <i class="fa fa-edit text-primary"></i>
                      </a>
                    </td>
                    <td>
                      <form action="{{ url('class-delete', $record->uuid) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-danger">
                                <i class="fa fa-trash text-danger"></i>
                            </button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>
              <!-- End Table with hoverable rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
@endsection
