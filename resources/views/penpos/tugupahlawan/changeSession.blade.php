<x-layout>
    @if(session('status') !== null)
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "{{ session('status') ? 'Success' : 'Failed' }}",
                    text: "{{ session('status') ? 'Change session successful.' : 'Change failed. Internal server error 500!' }}",
                    icon: "{{ session('status') ? 'success' : 'error' }}",
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif
    @if(session('effect') !== null)
        <p>{{ session('effect') }}</p>
    @endif
    <div class="container mt-5">
        <h1>Session Manager</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Open</th>
                    <th>Close</th>
                    <th>Boost</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sessions as $session)
                    <tr>
                        <td>{{ $session->id }}</td>
                        <td>{{ $session->open }}</td>
                        <td>{{ $session->close }}</td>
                        <td>{{ $session->boost ? $session->boost : "-"}}</td>
                        <td>{{ $session->status }}</td>
                        <td>
                            @if ($session->status !== 'active')
                                <form action="{{ route('penpos.changeSessionHandle', ['session' => $session->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Change Session</button>
                                </form>
                            @else
                                <button class="btn btn-success" disabled>Active</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form id="validateScoreForm" action="{{ route('penpos.validateScore') }}" method="post">
            <!-- Include CSRF token if using a framework like Laravel -->
            @csrf
            <button type="button" onclick="confirmValidationScore()" class="btn btn-primary w-100">Validate Score</button>
        </form>
        </div>
        <script>
            function confirmValidationScore() {
                Swal.fire({
                    title: 'Are you sure to validate score now?',
                    text: "This action cannot be reversed!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Validate Now!',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('validateScoreForm').submit();
                    }
                })
            }
        </script>
</x-layout>