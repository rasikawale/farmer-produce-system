@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">📩 Contact Requests</h4>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>User ID</th>
                        <th>Role</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $contact->user_id }}</td>
                        <td>
                            <span class="badge bg-info">{{ ucfirst($contact->role) }}</span>
                        </td>
                        <td>{{ $contact->subject }}</td>
                        <td>
                            @if($contact->status === 'open')
                                <span class="badge bg-warning">Open</span>
                            @else
                                <span class="badge bg-success">Replied</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#reply{{ $contact->id }}">
                                View / Reply
                            </button>
                        </td>
                    </tr>

                    <!-- Reply Modal -->
                    <div class="modal fade" id="reply{{ $contact->id }}">
                        <div class="modal-dialog modal-lg">
                            <form method="POST"
                                  action="{{ route('admin.contacts.reply', $contact->id) }}">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5>{{ $contact->subject }}</h5>
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <p class="text-muted">{{ $contact->message }}</p>

                                        <label class="fw-semibold mt-3">Admin Reply</label>
                                        <textarea name="admin_reply"
                                            class="form-control"
                                            rows="4"
                                            required>{{ $contact->admin_reply }}</textarea>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-success">
                                            Send Reply
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
