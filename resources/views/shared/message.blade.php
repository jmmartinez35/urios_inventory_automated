@if (session()->has('statusMessages'))
    @foreach (session('statusMessages') as $status => $message)
        <div class="alert alert-{{ $status }} alert-dismissible fade show" role="alert">

            @if ($status == 'success')
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
            @endif
            {{ $message }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach

@endif
