@extends('master.master')

@section('title', 'Dashboard')

@section('content')

<section class="section">
  <div class="row">
    <div class="col-lg-6 offset-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Add Supervisor</h5>
          <!-- Custom Styled Validation with Tooltips -->

          <form class="row g-3 needs-validation" novalidate method="POST"  action="{{ url('/backend/supervisor/user-create') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6 position-relative">
              <label for="company_id" class="form-label">Company ID</label>
              <input type="text" class="form-control" id="company_id" name="company_id" required>
            </div>

            <div class="col-md-6 position-relative">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="col-md-6 position-relative">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="col-md-6 position-relative">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="col-md-6 position-relative">
              <label for="mobile_no" class="form-label">Mobile No</label>
              <input type="text" class="form-control" id="mobile_no" name="mobile_no" required>
            </div>

            <div class="col-md-6 position-relative">
              <label for="location" class="form-label">Location</label>
              <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <!-- <div class="col-md-6 position-relative">
              <label for="type" class="form-label">Type</label>
              <select class="form-control" id="type" name="type" required>
                <option value="user">User</option>
                <option value="editor">Editor</option>
              </select>
            </div> -->
            <div class="col-md-12 position-relative">
              <label for="files" class="form-label">Image</label>
              <input type="file" class="form-control" id="files" name="file" required accept="image/*">
            </div>
            
            <div class="col-12 pt-3">
              <button class="btn btn-primary" type="submit">Create</button>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</section>
@endsection
