@extends('master.master')

@section('title', 'Dashboard')

@section('content')

<section class="section">
  <div class="row">
    <div class="col-lg-6 offset-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">New User</h5>
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


          <form class="row g-3 needs-validation" novalidate method="POST"  action="{{ url('user-create') }}">
            @csrf
            <div class="col-md-12 position-relative">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="col-md-12 position-relative">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="col-md-12 position-relative">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            
            <div class="col-md-12 position-relative">
              <label for="type" class="form-label">Type</label>
              <select class="form-control" id="type" name="type" required>
                <option value="user">User</option>
                <option value="editor">Editor</option>
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
