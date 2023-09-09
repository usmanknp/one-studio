@extends('master.master')

@section('title', 'Dashboard')

@section('content')

<section class="section">
  <div class="row">
    <div class="col-lg-6 offset-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Edit Coupon</h5>
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


          <form class="row g-3 needs-validation" novalidate method="POST"  action="{{ url('coupon-edit') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $record->id}}"/>
            <div class="col-md-12 position-relative">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" required value="{{ $record->name }}">
            </div>

            <div class="col-md-12 position-relative">
              <label for="price" class="form-label">Price</label>
              <input type="text" class="form-control" id="price" name="price" required value="{{ $record->price }}">
            </div>
            
            <div class="col-md-12 position-relative">
              <label for="status" class="form-label">Status</label>
              <select class="form-control" id="status" name="status" required>
                    @if($record->status == 1)
                    <option value="{{ $record->status}}" Selected>Active</option>
                    <option value="0">Inactive</option>
                    @else
                    <option value="1" >Active</option>
                    <option value="{{ $record->status}}" Selected>Inactive</option>
                    @endif
              </select>
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
