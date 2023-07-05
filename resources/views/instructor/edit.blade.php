@extends('master.master')

@section('title', 'Dashboard')

@section('content')

<section class="section">
  <div class="row">
    <div class="col-lg-8 offset-2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Edit Instructor</h5>
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


          <form class="row g-3 needs-validation" novalidate method="POST"  action="{{ url('instructor-edit') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $record->uuid}}"/>
            <div class="col-md-12 position-relative">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ $record->name }}" required>
            </div>

            <div class="col-md-12 position-relative">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" rows="4" cols="15" name="description" id="description" required>{{ $record->description }}</textarea>
            </div>

            <div class="col-md-12 position-relative">
              <label for="status" class="form-label">Status</label>
              <select name="status" id="status" class="form-control">
                    @if($record->status == 'ACTIVE')
                    <option value="{{ $record->status}}" Selected>{{ $record->status}}</option>
                    <option value="INACTIVE">INACTIVE</option>
                    @else
                    <option value="ACTIVE" >ACTIVE</option>
                    <option value="{{ $record->status}}" Selected>{{ $record->status}}</option>
                    @endif
                
              </select>
            </div>

            <div class="col-md-12 position-relative">
              <label for="image" class="form-label">Image</label>
              <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>
            
            <div class="col-12 pt-3">
              <button class="btn btn-primary" type="submit">Update</button>
            </div>
          </form><!-- End Custom Styled Validation with Tooltips -->

        </div>
      </div>

    </div>
  </div>
</section>
@endsection
