<x-layout>
    @php
        $allSessionsActived = collect($sessions)->every(function ($session) {
            return $session->status === 'actived';
        });
    @endphp
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
    

    <div class="container mt-5">
        <h1>Session Manager</h1>
        @if(session('effect') !== null)
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: #a8e6cf; color: #2c3e50; border-color: #81c784; border-radius: 1rem;">
                {{ session('effect') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Session</th>
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
                        <td>Session {{ $session->id }}</td>
                        <td>{{ $session->open }}</td>
                        <td>{{ $session->close }}</td>
                        <td>{{ $session->boost ? $session->boost : "-"}}</td>
                        <td>{{ $session->status }}</td>
                        <td>
                            @if ($session->status !== 'actived')
                                <form action="{{ route('penpos.changeSessionHandle', ['session' => $session->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Change to session {{ $session->id }} and validate session {{ $session->id - 1 }}</button>
                                </form>
                            @else
                                <button class="btn btn-success" disabled>Actived</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form id="validateScoreForm" action="{{ route('penpos.validateScore', ['session' => '4']) }}" method="post">
            @if ($allSessionsActived)
                <!-- Include CSRF token if using a framework like Laravel -->
                @csrf
                <button type="button" onclick="confirmValidationScore()" class="btn btn-primary w-100">Validate Final Score</button>
            @else
                <button type="button" class="btn btn-primary w-100" disabled>Validate Final Score</button>
            @endif
            
        </form>
        </div>
        <script>
            function confirmValidationScore() {
                Swal.fire({
                    title: 'Are you sure to validate score for this final session?',
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