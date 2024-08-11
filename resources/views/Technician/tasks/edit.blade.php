@extends('master.master')

@section('title', 'Dashboard')

@section('content')

<section class="section">
  <div class="row">
    <div class="col-lg-10 offset-1">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">
              {{ in_array($record->status, ['IN_REVIEW', 'COMPLETED']) ? 'Task Info' : 'Edit Task' }}
            </h5>
          <!-- Custom Styled Validation with Tooltips -->
          <form class="row g-2 needs-validation" novalidate method="POST" action="{{ url('/technician/tasks/task-edit') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="uuid" value="{{ $record->uuid}}" />

            <div class="col-md-6 position-relative">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" id="title" name="title" required value="{{$record->title}}"
              {{ in_array($record->status, ['IN_REVIEW', 'COMPLETED']) ? 'disabled' : '' }}
              >
            </div>
            @php
            $statuses = [
            'NEW' => 'New',
            'IN_PROGRESS' => 'In Progress',
            'IN_REVIEW' => 'In Review',
            // Add more statuses here
            ];
            @endphp

            <div class="col-md-6 position-relative">
              <label for="status" class="form-label">Status</label>
              <select class="form-control" id="status" name="status" required 
              {{ in_array($record->status, ['IN_REVIEW', 'COMPLETED']) ? 'disabled' : '' }}
              >
                @foreach($statuses as $key => $label)
                <option value="{{ $key }}" {{ $record->status == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6 position-relative">
              <label for="occurred_at" class="form-label">Occured At</label>
              <input type="text" class="form-control" id="datetime" disabled  value="{{$record->occurred_at}}">
            </div>

            <div class="col-md-6 position-relative">
              <label for="start_date" class="form-label">Start Date</label>
              <input type="text" class="form-control" id="datetime" name="start_date" value="{{$record->start_date}}"
              {{ in_array($record->status, ['IN_REVIEW', 'COMPLETED']) ? 'disabled' : '' }}
              >
            </div>

            <div class="col-md-6 position-relative">
              <label for="stop_date" class="form-label">Stop Date</label>
              <input type="text" class="form-control" id="datetime" name="end_date" value="{{$record->end_date}}" 
              {{ in_array($record->status, ['IN_REVIEW', 'COMPLETED']) ? 'disabled' : '' }}
              >
            </div>

            <div class="col-md-6 position-relative">
              <label class="form-label">Assigned To</label>
              <input type="text" class="form-control" value="{{isset($record->technician) ? $record->technician->name : 'N/A'}}" disabled>
            </div>

            <div class="col-md-6 position-relative">
              <label class="form-label">Created By </label>
              <input type="text" class="form-control" value="{{isset($record->created_by_user) ? $record->created_by_user->name : 'N/A'}}" disabled>
            </div>
            <div class="col-md-6 position-relative">
              <label class="form-label">Approved By </label>
              <input type="text" class="form-control" value="{{isset($record->task_approved_by) ? $record->task_approved_by->name : 'N/A'}}" disabled>
            </div>
            <div class="col-md-6 position-relative">
              <label for="approved_date" class="form-label">Approved Date</label>
              <input type="text" class="form-control" id="datetime"  value="{{$record->approved_date}}" disabled>
            </div>
            <div class="col-md-12 position-relative">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" id="description" name="description" rows="4"
              {{ in_array($record->status, ['IN_REVIEW', 'COMPLETED']) ? 'disabled' : '' }}
              >{{$record->description}}</textarea>
            </div>

            <div class="col-md-12">
              <h6>
                Used Spare Parts
                @if(($record->status != 'IN_REVIEW') && ($record->status != 'COMPLETED')) 
                  <span class="btn btn-success btn-sm" id="add-spare-part"><i class="bi bi-plus"></i></span>
                @endif
              </h6>
              
              <div id="spare-parts-wrapper">
                @foreach($record->task_spare_parts as $index => $sparePart)
                <div class="row mb-3 spare-part-item">
                  <!-- Spare Part Dropdown (6 columns) -->
                  <div class="col-md-4">
                    <select class="form-control" name="spare_parts[{{ $index }}][uuid]" required
                    {{ in_array($record->status, ['IN_REVIEW', 'COMPLETED']) ? 'disabled' : '' }}
                    >
                      <option value="" disabled>Select Spare Part</option>
                      @foreach($spare_parts as $part)
                      <option value="{{ $part->uuid }}" {{ $sparePart->spare_parts_id == $part->id ? 'selected' : '' }}>
                        {{ $part->name }} - {{ $part->code }}
                      </option>
                      @endforeach
                    </select>
                  </div>

                  <!-- Quantity Input (3 columns) -->
                  <div class="col-md-2">
                    <input type="number" name="spare_parts[{{ $index }}][quantity]" min="0" class="form-control" placeholder="Quantity" value="{{ $record->task_spare_parts[$index]['spare_parts_quantity'] }}" required
                    {{ in_array($record->status, ['IN_REVIEW', 'COMPLETED']) ? 'disabled' : '' }}
                    >
                  </div>

                  <div class="col-md-5">
                    <input type="text" name="spare_parts[{{ $index }}][description]" min="0" class="form-control" placeholder="Description" value="{{ $record->task_spare_parts[$index]['spare_parts_description'] }}" required
                    {{ in_array($record->status, ['IN_REVIEW', 'COMPLETED']) ? 'disabled' : '' }}
                    >
                  </div>
                  <!-- Remove Button (3 columns) -->
                  @if(($record->status != 'IN_REVIEW') && ($record->status != 'COMPLETED')) 
                  <div class="col-md-1">
                    <span  class="btn btn-danger remove-spare-part">
                    <i class="bi bi-x-circle"></i>
                    </span>
                  </div>
                  @endif
                  
                </div>
                @endforeach
              </div>
            </div>

            @if(count($record->media) > 0)
            <div class="col-md-12 position-relative">
              @foreach ($record->media as $img)
              <a href="{{$img->url}}" data-lightbox="{{$img->id}}">
                <img src="{{$img->url}}" class="img img-fluid" height="80px" width="80px">
              </a>
              @endforeach
            </div>
            @endif
            @if(($record->status != 'IN_REVIEW') && ($record->status != 'COMPLETED'))
            <div class="col-md-12 position-relative">
              <label for="files" class="form-label">Image</label>
              <input type="file" class="form-control" id="files[]" name="files[]" multiple accept="image/*">
            </div>
            @endif
            
            @if(($record->status != 'IN_REVIEW') && ($record->status != 'COMPLETED'))
            <div class="col-12 pt-3">
              <button class="btn btn-primary" type="submit">Update</button>
            </div>
            @endif
          </form>
        </div>
      </div>

    </div>
  </div>
</section>
<script>
  document.getElementById('add-spare-part').addEventListener('click', function() {
    const wrapper = document.getElementById('spare-parts-wrapper');
    const index = wrapper.children.length; // Get the current index based on the number of children

    const newSparePart = `
      <div class="row mb-3 spare-part-item">
        <div class="col-md-4">
          <select class="form-control" name="spare_parts[${index}][uuid]" >
            <option value="" disabled selected>Select Spare Part</option>
            @foreach($spare_parts as $spare_part)
              <option value="{{$spare_part->uuid}}">{{$spare_part->name}} - {{$spare_part->code}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-2">
          <input type="number" name="spare_parts[${index}][quantity]" min="0" class="form-control" placeholder="Quantity">
        </div>
        <div class="col-md-5">
          <input type="text" name="spare_parts[${index}][description]" class="form-control" placeholder="Description">
        </div>
        <div class="col-md-1">
          <span  class="btn btn-danger"><i class="bi bi-x-circle remove-spare-part"></i></span>
        </div>
      </div>
    `;
    wrapper.insertAdjacentHTML('beforeend', newSparePart);
  });

  // Event delegation to handle removing rows
  document.getElementById('spare-parts-wrapper').addEventListener('click', function(event) {
    if (event.target.classList.contains('remove-spare-part')) {
      event.target.closest('.spare-part-item').remove();
    }
  });
</script>
@endsection