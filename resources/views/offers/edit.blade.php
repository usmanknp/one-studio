@extends('master.master')

@section('title', 'Dashboard')

@section('content')

<section class="section">
  <div class="row">
    <div class="col-lg-8 offset-2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Update Offer</h5>
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


          <form class="row g-3 needs-validation" novalidate method="POST"  action="{{ url('offer-edit') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $record->uuid}}"/>
            <div class="col-md-12 position-relative">
              <label for="class_id" class="form-label">Class Name</label>
              <select class="form-control" name="class_id" id="class_id" >
                @if(count($classes) != 0)
                  <option value = "">Select</option>
                  @foreach ($classes as $class )
                    <option value="{{$class->id}}" @if($class->id == $record->class_id) selected @endif>{{$class->name}}</option>
                  @endforeach
                @else
                <option value = "">Select</option>
                @endif
              </select>
            </div>

            <div class="col-md-6 position-relative">
              <label for="offers" class="form-label">Offers</label>
              <input type="text" class="form-control" id="offers" name="offers" required value="{{ $record->offers }}">
            </div>

            <div class="col-md-6 position-relative">
              <label for="price" class="form-label">Price</label>
              <input type="text" class="form-control" id="price" name="price" required value="{{ $record->amount }}">
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
