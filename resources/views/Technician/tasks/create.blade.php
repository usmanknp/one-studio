@extends('master.master')

@section('title', 'Dashboard')

@section('content')

<section class="section">
  <div class="row">
    <div class="col-lg-8 offset-2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Add Task</h5>
          <!-- Custom Styled Validation with Tooltips -->
          <form class="row g-2 needs-validation" novalidate method="POST"  action="{{ url('/technician/tasks/create-task') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6 position-relative">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="col-md-6 position-relative">
              <label for="task_type" class="form-label">Types</label>
              <select class="form-control" id="task_type" name="task_type" required>
                @foreach($task_types as $type)
                <option value="{{$type->id}}">{{$type->label}}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6 position-relative">
              <label for="occurred_at" class="form-label">Occured At</label>
              <input type="text" class="form-control" id="datetime" name="occurred_at" required>
            </div>

            <div class="col-md-12 position-relative">
              <label for="description" class="form-label">Description</label>
              <textarea  class="form-control" id="description" name="description" rows="4"></textarea>
            </div>
    
            <div class="col-md-12 position-relative">
              <label for="files" class="form-label">Image</label>
              <input type="file" class="form-control" id="files[]" name="files[]" multiple accept="image/*">
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
