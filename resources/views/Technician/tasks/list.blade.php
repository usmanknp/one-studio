@extends('master.master')

@section('title', 'Dashboard')

@section('content')
<section class="section">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body table-responsive" >

                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Tasks</h5>
                        <a href="{{ url('/technician/tasks/create-task') }}" class="btn btn-primary btn-sm">Add New</a>
                    </div>
                    <!-- Table with hoverable rows -->
                    <table class="table  table-bordered text-center" style="font-size:12px;">
                        <thead class="text-dark">
                            <tr>
                                <th width="1%"></th>
                                <th width="10%">Track ID</th>
                                <th width="25%">Title</th>
                                <th width="15%">Approval Status</th>
                                <th width="15%">Status</th>
                                <th width="15%">Created By</th>
                                <th width="20%">Created At</th>
                                <th width="2%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($records) === 0)
                            <tr>
                                <td colspan="10">No records found.</td>
                            </tr>
                            @else
                            @foreach($records as $record)
                            <tr>
                                <td style="background:{{ $record->task_type->color }}; text-align:center" title="{{ $record->task_type->label }}" >
                                    <i style="color: #fff; font-size:15px" class="bi {{ $record->task_type->icon }}"></i>
                                </td>
                                <td>
                                    @if ($record->approval_status == 'PENDING')
                                    {{ $record->track_id}}
                                    @else
                                    <a  href="{{ url('/technician/tasks/task-edit', $record->uuid) }}">{{ $record->track_id}}</a>
                                    @endif
                                </td>
                                <td>
                                    @if ($record->approval_status == 'PENDING')
                                    {{ $record->title}}
                                    @else
                                    <a  href="{{ url('/technician/tasks/task-edit', $record->uuid) }}">{{ $record->title}}</a>
                                    @endif
                                </td>
                                <td>
                                    @if ($record->approval_status == 'PENDING')
                                    <span class="label-c-style" style="background:#ce373c;border-color:#ffffff;color:#ffffff;font-weight: 500">
                                        Pending
                                    </span>
                                    @elseif ($record->approval_status == 'APPROVED')
                                    <span class="label-c-style" style="background:#0be20b;border-color:#ffffff;color:#ffffff;font-weight: 500">
                                        Approved
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($record->status == 'NEW')
                                    <span class="label-c-style" style="background:#ff7800;border-color:#ffffff;color:#ffffff;font-weight: 500">
                                        New
                                    </span>
                                    @elseif ($record->status == 'IN_PROGRESS')
                                    <span class="label-c-style" style="background:#80d998;border-color:#ffffff;color:#ffffff;font-weight: 500">
                                        In Progress
                                    </span>
                                    @elseif ($record->status == 'COMPLETED')
                                    <span class="label-c-style" style="background:#2d5635;border-color:#ffffff;color:#ffffff;font-weight: 500">
                                        Completed
                                    </span>
                                    @elseif ($record->status == 'IN_REVIEW')
                                    <span class="label-c-style" style="background:#5a0fc4;border-color:#ffffff;color:#ffffff;font-weight: 500">
                                        In Review
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    {{ $record->created_by_user->name }}
                                    @if($record->created_by_user->avatar != '')
                                    <img title="{{ $record->created_by_user->name }}"  src="{{$avatar_path}}/{{$record->created_by_user->avatar}}" style="width: 32px; height:32px;border-radius:50%;" class="img-fluid"/>
                                    @endif
                                </td>
                                <td>{{ $record->created_at }}</td>
                                <td>
                                    <div class="filter">
                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            @if ($record->approval_status != 'PENDING')
                                            <li>
                                                <a class="dropdown-item" href="{{ url('/technician/tasks/task-edit', $record->uuid) }}">
                                                    {{ in_array($record->status, ['IN_REVIEW', 'COMPLETED']) ? 'Info' : 'Edit' }}
                                                </a>
                                            </li>
                                            @endif
                                            @if($record->file != null)
                                            <li>
                                                <a class="dropdown-item" href="{{$record->file}}">Report</a>
                                            </li>
                                            @endif
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