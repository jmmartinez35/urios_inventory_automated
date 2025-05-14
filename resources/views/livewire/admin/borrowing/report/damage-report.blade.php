<div class="col-xl-12 col-md-12 col-sm-6 mb-xl-0 mb-4 ">
    @include('shared.offline')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="m-0 font-weight-bold text-muted">DAMAGE REPORT</h5>
                </div>
            </h4>
            <div class="row mt-2 g-3">

                <div class="col-lg-auto row">
                    <div class="col-auto">
                        <label class="form-control-plaintext">FILTER OPTIONS:</label>
                    </div>
                    <div class="col-auto">
                        <div class="input-group input-group-sm p-1">
                            <select class="form-select" id="dmonth1" style="width: 12em">
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
                        <select class="form-select" id="week1filter" style="width: 12em">
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
                        <select class="form-select" id="usertype1-filter" style="width: 12em">
                            <option value="all">All UserType</option>
                            <option value="student">Students</option>
                            <option value="teacher">Teacher</option>
                            <option value="staff">Staff</option>

                        </select>
                    </div>
                </div>
            </div>


            <div class="table-responsive">
                <table id="datatable_report1" class="table table-borderless w-100">
                    <thead class="bg-gradient-primary text-white">
                        <tr>
                            <th>Item</th>
                            <th>Damaged Quantity</th>
                            <th>Note</th>
                            <th>Borrower</th>
                            <th>Usertype</th>
                            <th>Date Reported</th>
                            <th class="d-none exclude-print">Date </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($damagedItems as $damage)
                            <tr>
                                <td>{{ $damage->item->name ?? 'N/A' }}</td>
                                <td>{{ $damage->quantity }}</td>
                                <td>{{ $damage->note }}</td>
                                <td>
                                    @php
                                        $user = $damage->borrowing->users->userDetail ?? null;
                                        $name = $user
                                            ? ucfirst($user->firstname) . ' ' . ucfirst($user->lastname)
                                            : 'N/A';
                                    @endphp
                                    {{ $name }}
                                </td>
                                <td>{{ $damage->borrowing->users->userDetail->position }}</td>

                                <td>{{ \Carbon\Carbon::parse($damage->created_at)->format('F d, Y') }}</td>
                                <td class="d-none">{{ $damage->created_at }}</td>
                            
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No damaged items found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
