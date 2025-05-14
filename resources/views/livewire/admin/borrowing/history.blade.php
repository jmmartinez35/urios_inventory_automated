<div class="col-xl-12 col-md-12 col-sm-6 mb-xl-0 mb-4">
    @include('shared.offline')
    @include('livewire.admin.borrowing._modal')

    <div class="card">
        <div class="card-body p-3">
            <h4 class="card-title">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="m-0 font-weight-bold text-muted">BORROW MANAGEMENT / HISTORY</h5>
                </div>
            </h4>
            <div x-data="{
                activeTab: window.location.hash ? window.location.hash.substring(1).toUpperCase() : 'PENDING',
                changeTab(tab) {
                    this.activeTab = tab;
                    history.pushState(null, null, `#${tab.toLowerCase()}`);
                }
            }"> <!-- Responsive Tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-linkx" :class="{ 'active': activeTab === 'PENDING' }"
                       x-on:click="changeTab('PENDING')">PENDING</a>
                </li>
                <li class="nav-item">
                    <a class="nav-linkx" :class="{ 'active': activeTab === 'APPROVED' }"
                       x-on:click="changeTab('APPROVED')">APPROVED</a>
                </li>
                <li class="nav-item">
                    <a class="nav-linkx" :class="{ 'active': activeTab === 'CANCELLED' }"
                       x-on:click="changeTab('CANCELLED')">CANCELLED</a>
                </li>
                <li class="nav-item">
                    <a class="nav-linkx" :class="{ 'active': activeTab === 'COMPLETED' }"
                       x-on:click="changeTab('COMPLETED')">COMPLETED</a>
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
                    <div class="table-responsived">

                        @foreach ($tabs as $tabName => $borrowItems)
                            <div id="{{ $tabName }}" x-show="activeTab === '{{ $tabName }}'" x-transition>
                                <div class="table-responsive mt-2 w-100">
                                    @if ($borrowItems->isEmpty())
                                        <table id="datatable-{{ strtolower($tabName) }}"
                                            class="table table-borderless w-100">
                                            <thead class="bg-gradient-primary text-white">
                                                <tr class="table-head">
                                                    <th scope="col">Name</th>
                                                    <th>Code</th>
                                                    <th>User Type</th>
                                                    <th scope="col">Date Filed</th>
                                                    <th scope="col">View</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    @else
                                        <table id="datatable-{{ strtolower($tabName) }}"
                                            class="table table-borderless w-100">
                                            <thead class="bg-gradient-primary text-white">
                                                <tr class="table-head">
                                                    <th scope="col">Name</th>
                                                    <th>Code</th>
                                                    <th>User Type</th>
                                                    <th scope="col">Date Filed</th>
                                                    <th scope="col">View</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($borrowItems as $item)
                                                    <tr>
                                                        <td>
                                                            <p class="fs-6 m-0">
                                                                {{ Str::ucfirst($item->users->userDetail->firstname) . ' ' . Str::ucfirst($item->users->userDetail->middlename) . ' ' . Str::ucfirst($item->users->userDetail->lastname) }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            {{ $item->barcode_reference }}
                                                        </td>
                                                        <td>
                                                            <p class="fs-6 m-0">
                                                                {{ Str::ucfirst($item->users->userDetail->position) }}
                                                            </p>
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($item->date_filled)->format('F j, Y') }}
                                                        </td>

                                                        <td>
                                                            <button type="button"
                                                                wire:click="showBorrow({{ $item->id }}, {{ $item->status }})"
                                                                data-bs-toggle="modal" data-bs-target="#viewDetailModal"
                                                                class="btn btn-sm btn-warning "> <i
                                                                    class="far fa-eye"></i></button>

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
    </div>

</div>
