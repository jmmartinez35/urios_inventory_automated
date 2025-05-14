<style>
    /* Scoped styles for borrow tabs */
    .borrow-tabs .nav-tabs {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }

    .borrow-tabs .nav-tabs .nav-item {
        flex: 1 1 auto;
        text-align: center;
    }

    .borrow-tabs .nav-tabs .nav-linkx {
        display: block;
        padding: 10px;
        text-align: center;
        width: 100%;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .borrow-tabs .nav-tabs {
            flex-wrap: wrap;
        }

        .borrow-tabs .nav-tabs .nav-item {
            flex: 1 1 50%;
            /* Two items per row */
        }

        .borrow-tabs .table-responsive {
            overflow-x: auto;
        }
    }
</style>

<div class="col-lg-9 borrow-tabs"> <!-- Added unique class here -->
    <div class="filter-button dash-filter dashboard">
        <button class="btn btn-solid-default btn-sm fw-bold filter-btn">Show Menu</button>
    </div>

    <div class="table-dashboard dashboard wish-list-section">
        <div class="box-head mb-3">
            <h3>My Borrowed</h3>
        </div>

        <div x-data="{
            activeTab: window.location.hash ? window.location.hash.substring(1).toUpperCase() : 'PENDING',
            changeTab(tab) {
                this.activeTab = tab;
                history.pushState(null, null, `#${tab.toLowerCase()}`);
            }
        }">
            <!-- Responsive Tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-linkx" :class="{ 'active': activeTab === 'PENDING' }"
                        x-on:click="activeTab = 'PENDING'">PENDING</a>
                </li>
                <li class="nav-item">
                    <a class="nav-linkx" :class="{ 'active': activeTab === 'APPROVED' }"
                        x-on:click="activeTab = 'APPROVED'">APPROVED</a>
                </li>
                <li class="nav-item">
                    <a class="nav-linkx" :class="{ 'active': activeTab === 'CANCELLED' }"
                        x-on:click="activeTab = 'CANCELLED'">CANCELLED</a>
                </li>
                <li class="nav-item">
                    <a class="nav-linkx" :class="{ 'active': activeTab === 'COMPLETED' }"
                        x-on:click="activeTab = 'COMPLETED'">COMPLETED</a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content">
                @php
                    $tabs = [
                        'PENDING' => $borrow_pending,
                        'APPROVED' => $borrow_approved,
                        'CANCELLED' => $borrow_cancel,
                        'COMPLETED' => $borrow_complete,
                    ];
                @endphp

                @foreach ($tabs as $tabName => $borrowItems)
                    <div id="{{ $tabName }}" x-show="activeTab === '{{ $tabName }}'" x-transition>
                        <div class="table-responsive mt-2">
                            @if ($borrowItems->isEmpty())
                                <div class="text-center p-4">
                                    <p class="text-muted">No {{ strtolower($tabName) }} borrow requests found.</p>
                                </div>
                            @else
                                <table class="table cart-table">
                                    <thead>
                                        <tr class="table-head">
                                            <th scope="col">Username</th>
                                            <th scope="col">Date Filed</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($borrowItems as $item)
                                            <tr>
                                                <td>
                                                    <p class="fs-6 m-0">{{ $item->users->username }}</p>
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($item->date_filled)->format('F j, Y') }}
                                                </td>
                                                <td>
                                                    @if ($item->status == 0)
                                                        <p class="warning-button btn btn-sm">PENDING</p>
                                                    @elseif($item->status == 2)
                                                        <p class="danger-button btn btn-sm">CANCELLED</p>
                                                    @elseif($item->status == 3)
                                                        <p class="success-button btn btn-sm">COMPLETED</p>
                                                    @else
                                                        <p class="success-button btn btn-sm">APPROVED</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('cart.status', ['uuid' => $item->uuid]) }}">
                                                        <i class="far fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex mt-3">
                                    {{ $borrowItems->links(data: ['scrollTo' => false]) }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
