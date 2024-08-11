@extends('master.master')

@section('title', 'Dashboard')

@section('content')
    <section class="section">
      <div class="row">
        <div class="col-lg-10 offset-1">
          <div class="card">
            <div class="card-body">

            <div class="d-flex justify-content-between align-items-center">
              <h5 class="card-title">Supervisor List</h5>
              <a href="{{ url('/backend/supervisor/user-create') }}" class="btn btn-primary btn-sm">New</a>
            </div>
              <!-- Table with hoverable rows -->
              <table class="table  table-bordered text-center"  style="font-size:12px;">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                @if(count($records) === 0)
                <tr>
                  <td colspan="5">No records found.</td>
                </tr>
                @else
                  @foreach($records as $record)
                    <tr >
                        <td>{{ $record->name }}</td>
                        <td>{{ $record->email }}</td>
                        <td>
                            @if($record->status == 1)
                            <i class="fa fa-check text-success"></i>
                            @else
                            <i class="fa fa-times text-danger"></i>
                            @endif
                        </td>
                        <td>
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li>
                                        <a class="dropdown-item" href="{{ url('/backend/supervisor/user-edit', $record->uuid) }}">
                                            Edit
                                        </a>
                                    </li>
                                    <!-- <li>
                                      <form action="{{ url('instructor-delete', $record->uuid) }}" method="POST">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn text-danger btn-sm">
                                              <i class="fa fa-trash text-danger"></i> Delete
                                          </button>
                                      </form>
                                    </li> -->
                                </ul>
                            </div>
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

