@auth
    @if (auth()->user()->user_status == 2)
        <p class="alert alert-danger text-danger p-2 m-0 d-flex align-items-center">
            <i class="fa fa-exclamation-triangle mr-2"></i>
            Your account has been restricted.
            @if (auth()->user()->restricted_until && \Carbon\Carbon::parse(auth()->user()->restricted_until)->isFuture())
                <span class="ms-2">
                    ({{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse(auth()->user()->restricted_until)) }} days left)
                </span>
            @else
                <span class="ms-2">(Restriction ongoing until you return the items.)</span>
            @endif
            &nbsp;Please resolve any outstanding issues to regain access.
        </p>
    @endif
@endauth
