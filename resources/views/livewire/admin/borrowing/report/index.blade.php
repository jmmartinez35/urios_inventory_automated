<div x-data="{
    activeTab: window.location.hash ? window.location.hash.substring(1) : 'borrowing-report',
    changeTab(tab) {
        this.activeTab = tab;
        history.pushState(null, null, `#${tab}`);
    }
}">


    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-linkx" :class="{ 'active': activeTab === 'borrowing-report' }"
                x-on:click="changeTab('borrowing-report')">Borrowing Report</a>
        </li>
        <li class="nav-item">
            <a class="nav-linkx" :class="{ 'active': activeTab === 'frequently-borrowed' }"
                x-on:click="changeTab('frequently-borrowed')">Most Frequently Borrowed Items</a>
        </li>
        <li class="nav-item">
            <a class="nav-linkx" :class="{ 'active': activeTab === 'defects-issues' }"
                x-on:click="changeTab('defects-issues')">Item Defects & Issues</a>
        </li>
    </ul>


    <div class="tab-content">
        <div x-show="activeTab === 'borrowing-report'">
            <div class="col-xl-12 col-md-12 col-sm-6 mb-xl-0 mb-4 ">
                @include('shared.offline')

                <div class="card">
                    <div class="card-body p-3">
                        <h4 class="card-title">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="m-0 font-weight-bold text-muted">BORROWING REPORT</h5>
                            </div>
                        </h4>
                        <div class="row mt-2 g-3">
                            <div class="col-auto row">
                                <div class="col-auto">
                                    <label class="form-control-plaintext">FILTER OPTIONS:</label>
                                </div>
                                <div class="col-auto">
                                    <div class="input-group input-group-sm p-1 d-none">
                                        <select class="form-select" id="filter-status" style="width: 12em">
                                            <option value="all">All Status</option>
                                            <option value="cancelled">Cancelled</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-auto row">
                                <div class="col-auto">
                                    <div class="input-group input-group-sm p-1">
                                        <select class="form-select" id="month" style="width: 12em">
                                            <option value="all">All Month</option>
                                            @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                                <option value="{{ $month }}">{{ $month }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-auto row">
                                <div class="input-group input-group-sm p-1">
                                    <select class="form-select" id="week-filter" style="width: 12em">
                                        <option value="all">All Weeks</option>
                                        <option value="1">Week 1</option>
                                        <option value="2">Week 2</option>
                                        <option value="3">Week 3</option>
                                        <option value="4">Week 4</option>
                                        <option value="5">Week 5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-auto row">
                                <div class="input-group input-group-sm p-1">
                                    <select class="form-select" id="usertype-filter" style="width: 12em">
                                        <option value="all">All UserType</option>
                                        <option value="student">Students</option>
                                        <option value="teacher">Teacher</option>
                                        <option value="staff">Staff</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsived">
                            <table id="datatable_report" class="table table-borderless w-100">
                                <thead class="bg-gradient-primary text-white">
                                    <tr>
                                        <th>ITEM BORROWED</th>
                                        <th>DATE OF USAGE (FROM - TO)</th>
                                        <th>DATE RETURNED</th>
                                        <th class="d-none exclude-print">DATE RETURNED RAW</th>
                                        <th class="d-none exclude-print">STATUS</th>
                                        <th>USERTYPE</th>
                                        <th>BORROWER</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($borrowings as $data)
                                        {{-- @dd($data->borrowingCarts) --}}
                                        <tr>
                                            <td>
                                                @forelse ($data->borrowingCarts as $borrowingCart)
                                                    @if ($borrowingCart->cart && $borrowingCart->cart->item)
                                                        <div class="text-truncate" style="max-width: 200px;"
                                                            title="{{ $borrowingCart->cart->item->name }} (Qty: {{ $borrowingCart->cart->quantity }})">
                                                            {{ Str::ucfirst($borrowingCart->cart->item->name) }} (Qty:
                                                            {{ $borrowingCart->cart->quantity }})
                                                        </div>
                                                    @endif
                                                @empty
                                                    <div class="text-truncate" style="max-width: 200px;">No items</div>
                                                @endforelse
                                            </td>
                                            </td>
                                            <td>{{ $data?->start_date ? \Carbon\Carbon::parse($data->start_date)->translatedFormat('F d, Y') : 'N/A' }}
                                                -
                                                {{ $data?->end_date ? \Carbon\Carbon::parse($data->end_date)->translatedFormat('F d, Y') : 'N/A' }}
                                            </td>
                                            <td>
                                                @forelse ($data->borrowingReturns ?? [] as $return)
                                                    @php
                                                        $returnDate = $return->returned_at
                                                            ? \Carbon\Carbon::parse(
                                                                $return->returned_at,
                                                            )->translatedFormat('F d, Y')
                                                            : 'Not returned';
                                                    @endphp
                                                    <span
                                                        data-date="{{ $return->returned_at ? \Carbon\Carbon::parse($return->returned_at)->toISOString() : '' }}">
                                                        {{ $returnDate }}
                                                    </span>
                                                    @if (!$loop->last)
                                                        <br>
                                                    @endif
                                                @empty
                                                    Not returned
                                                @endforelse

                                            </td>
                                            <td class="d-none">
                                                {{ $data->borrowingReturn->returned_at }}
                                            </td>
                                            <td class="d-none">
                                                @switch($data->status ?? null)
                                                    @case(2)
                                                        <span class="text-danger">Cancelled</span>
                                                    @break

                                                    @case(3)
                                                        <span class="text-success">Completed</span>
                                                    @break

                                                    @default
                                                        {{ $data->status ?? 'N/A' }}
                                                @endswitch
                                            </td>
                                            <td>{{ $data->users->userDetail->position }}</td>
                                            <td>
                                                @php
                                                    $userName = 'N/A';
                                                    if ($data->users->userDetail ?? false) {
                                                        $firstName = Str::ucfirst(
                                                            $data->users->userDetail->firstname ?? '',
                                                        );
                                                        $middleName = Str::ucfirst(
                                                            $data->users->userDetail->middlename ?? '',
                                                        );
                                                        $lastName = Str::ucfirst(
                                                            $data->users->userDetail->lastname ?? '',
                                                        );
                                                        $userName =
                                                            trim("{$firstName} {$middleName} {$lastName}") ?: 'N/A';
                                                    }
                                                @endphp
                                                {{ $userName }}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div x-show="activeTab === 'frequently-borrowed'">
            <div class="card">
                <livewire:admin.borrowing.report.graph />
            </div>
        </div>
        <div x-show="activeTab === 'defects-issues'">
            <div class="card">
                <livewire:admin.borrowing.report.damage-report />
            </div>
        </div>
    </div>



</div>
