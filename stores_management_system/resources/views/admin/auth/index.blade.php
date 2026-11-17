@extends('layouts.admin')

@section('title', 'Registered Users')

@section('content')
    <div class="container-fluid px-4">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-gray-800 font-weight-bold">Registered Users</h1>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">
                    <i class="fas fa-sign-out-alt mr-1"></i> Logout
                </button>
            </form>
        </div>

        <!-- Users Table Card -->
        <div class="card shadow border-0 rounded-lg">
            <div class="card-header bg-gradient-primary text-white py-3">
                <h6 class="m-0 font-weight-bold">All Registered Users</h6>
            </div>
            <div class="card-body p-4"> <!-- Increased padding from p-0 to p-4 -->
                <div class="table-responsive rounded-lg"> <!-- Added rounded-lg to table-responsive -->
                    <table class="table table-hover table-bordered mb-0" id="usersTable" width="100%" cellspacing="0">
                        <thead class="bg-light text-dark">
                            <tr>
                                <th class="py-3 px-4">ID</th>
                                <th class="py-3 px-4">Name</th>
                                <th class="py-3 px-4">Email</th>
                                <th class="py-3 px-4">Role</th>
                                <th class="py-3 px-4">Created At</th>
                                <th class="py-3 px-4 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="transition-all hover:bg-gray-50">
                                    <td class="py-3 px-4">{{ $user->id }}</td>
                                    <td class="py-3 px-4 font-weight-medium">{{ $user->name }}</td>
                                    <td class="py-3 px-4 text-muted">{{ $user->email }}</td>
                                    <td class="py-3 px-4">
                                        @php
                                            $badgeClass = match($user->role) {
                                                'Admin' => 'badge-success',
                                                'Manager' => 'badge-info',
                                                'Stock Keeper' => 'badge-warning',
                                                'User' => 'badge-primary',
                                                'Management Assistance' => 'badge-secondary',
                                                'Technician' => 'badge-dark',
                                                default => 'badge-light',
                                            };
                                        @endphp

                                        <span class="badge badge-pill {{ $badgeClass }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-muted">{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                    <td class="py-3 px-4 text-center">
                                        @if (auth('admin')->check() && auth('admin')->user()->role === 'Admin')
                                            <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm btn-icon" title="Delete User">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted small">Restricted</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-4 text-center text-muted">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- DataTables Initialization -->
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                "pageLength": 10,
                "order": [[0, "asc"]],
                "language": {
                    "search": "Filter:",
                    "lengthMenu": "Show _MENU_ entries"
                },
                "dom": '<"row mb-3"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>'
            });
        });
    </script>
@endsection

<style>
    /* Ensure card corners are fully rounded */
    .card {
        border-radius: 15px !important; /* Override any inherited styles */
        overflow: hidden; /* Ensure content respects border-radius */
    }

    /* Add padding to card-body to prevent table from touching edges */
    .card-body {
        padding: 1rem !important; /* Consistent padding */
    }

    /* Ensure table-responsive respects card's border-radius */
    .table-responsive {
        border-radius: 12px; /* Slightly less than card to fit inside */
        overflow: hidden; /* Prevent table overflow from cutting corners */
    }

    /* Optional: Adjust table styling */
    .table {
        margin-bottom: 0; /* Already set, kept for clarity */
        border-collapse: separate; /* Ensure borders don’t interfere with radius */
    }

    /* Fix thead corners */
    .table thead th:first-child {
        border-top-left-radius: 12px;
    }
    .table thead th:last-child {
        border-top-right-radius: 12px;
    }
</style>