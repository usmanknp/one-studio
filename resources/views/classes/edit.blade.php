@extends('master.master')

@section('title', 'Dashboard')

@section('content')

<section class="section">
  <div class="row">
    <div class="col-lg-8 offset-2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Update Class</h5>
          <!-- Custom Styled Validation with Tooltips -->
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


          <form class="row g-3 needs-validation" novalidate method="POST"  action="{{ url('class-edit') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $record->uuid}}"/>
            <div class="col-md-4 position-relative">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" required value="{{ $record->name }}">
            </div>

            <div class="col-md-4 position-relative">
              <label for="instructor_id" class="form-label">Instructor</label>
              <select class="form-control" name="instructor_id" id="instructor_id" required>
                @if(count($instructors) != 0)
                  <option value = "">Select</option>
                  @foreach ($instructors as $instructor )
                    <option value="{{$instructor->id}}" @if($instructor->id == $record->instructor_id) selected @endif>{{$instructor->name}}</option>
                  @endforeach
                @else
                <option value = "">Select</option>
                @endif
              </select>
            </div>

            <div class="col-md-4 position-relative">
              <label for="type" class="form-label">Type</label>
              <select class="form-control" name="type" id="type" required>
                    <option value = "">Select</option>
                    @if($record->type == 'REFORMER')
                    <option value="{{ $record->type}}" Selected>{{ $record->type}}</option>
                    <option value="MAT">MAT</option>
                    @else
                    <option value="REFORMER" >REFORMER</option>
                    <option value="{{ $record->type}}" Selected>{{ $record->type}}</option>
                    @endif
              </select>
            </div>

            <div class="col-md-6 position-relative">
              <label for="start_date" class="form-label">Start</label>
              <input type="datetime-local" class="form-control" id="start_date" name="start_date" required value="{{ $record->start_date }}">
            </div>

            <div class="col-md-6 position-relative">
              <label for="end_date" class="form-label">End</label>
              <input type="datetime-local" class="form-control" id="end_date" name="end_date" required value="{{ $record->end_date }}">
            </div>

            <div class="col-md-12 position-relative">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" rows="4" cols="15" name="description" id="description" required>{{ $record->description }}</textarea>
            </div>

            <div class="col-12 pt-3">
              <button class="btn btn-primary" type="submit">Save</button>
            </div>
          </form><!-- End Custom Styled Validation with Tooltips -->

        </div>
      </div>

    </div>
  </div>
</section>
@endsection
