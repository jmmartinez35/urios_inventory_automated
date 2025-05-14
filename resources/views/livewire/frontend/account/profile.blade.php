<div class="col-lg-9">
    <div class="filter-button dash-filter dashboard">
        <button class="btn btn-solid-default btn-sm fw-bold filter-btn">Show Menu</button>
    </div>

    <div class=" dashboard-profile dashboard">
        @if (Session::has('status') && Session::has('message'))
            <div class="alert alert-{{ Session::get('status') }}">
                {{ Session::get('message') }}
            </div>
        @endif
        <div class="box-head">
            <h3>Profile
                <span
                    class="badge bg-{{ Auth::user()->status == 'incompleted' ? 'danger' : 'success' }}"><small>{{ Str::upper(Auth::user()->status) }}</small></span>

            </h3>
            <button type="button" wire:click="editUsersDetails({{ $users->usersDetails->id ?? 0 }})" class="btn btn-link"
                data-bs-toggle="modal" data-bs-target="#editProfile">Edit</button>
        </div>
        <ul class="dash-profile">
            <li>
                <div class="left">
                    <h6 class="font-light">Fullname</h6>
                </div>
                <div class="right">

                    <h6>{{ Str::ucfirst($users->firstname ?? '?') }} {{ Str::ucfirst($users->middlename ?? '') }}
                        {{ Str::ucfirst($users->lastname ?? '') }}</h6>
                </div>
            </li>



            <li>
                <div class="left">
                    <h6 class="font-light">Contact #</h6>
                </div>
                <div class="right">
                    <h6>{{ Str::ucfirst($users->contact ?? '?') }}</h6>
                </div>
            </li>
            <li>
                <div class="left">
                    <h6 class="font-light">User Type</h6>
                </div>
                <div class="right">
                    <h6>{{ Str::ucfirst($users->position ?? '?') }}</h6>
                </div>
            </li>

            <li>
                <div class="left">
                    <h6 class="font-light">Address</h6>
                </div>
                <div class="right">
                    <h6>{{ Str::ucfirst($users->address ?? '?') }}</h6>
                </div>
            </li>
        </ul>

        <div class="box-head mt-lg-5 mt-3">
            <h3>Login Details</h3>
            <button type="button" class="btn btn-link"
                wire:click="editLoginDetails({{ $users->usersDetails->id ?? 0 }})" data-bs-toggle="modal"
                data-bs-target="#editLogin">Edit</button>
        </div>

        <ul class="dash-profile">
            <li>
                <div class="left">
                    <h6 class="font-light">Email Address</h6>
                </div>
                <div class="right">
                    <h6>{{ $users->usersDetails->email ?? $users->email }}</h6>
                </div>

            </li>

            <li>
                <div class="left">
                    <h6 class="font-light">Username</h6>
                </div>
                <div class="right">
                    <h6>{{ $users->usersDetails->username ?? $users->username }}</h6>
                </div>

            </li>

            <li class="mb-0">
                <div class="left">
                    <h6 class="font-light">Password</h6>
                </div>
                <div class="right">
                    <h6>●●●●●●</h6>
                </div>

            </li>
        </ul>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form wire:submit.prevent="saveUserdetails">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Profile Information <span
                                class="badge bg-{{ Auth::user()->status == 'incompleted' ? 'danger' : 'success' }} "><small>{{ Str::upper(Auth::user()->status) }}</small></span>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('shared.loading')


                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="firstname" class="form-label">Firstname <span
                                            class="text-danger">*</span></label>
                                    <input type="text" wire:model="firstname" class="form-control" id="firstname">
                                    @error('firstname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="lastname" class="form-label">Lastname <span
                                            class="text-danger">*</span></label>
                                    <input type="text" wire:model="lastname" class="form-control" id="lastname">
                                    @error('lastname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="middlename" class="form-label">Middlename </label>
                                    <input type="text" wire:model="middlename" class="form-control" id="middlename">
                                    @error('middlename')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>



                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="contact" class="form-label">Contact # <span
                                            class="text-danger">*</span></label>
                                    <input type="text" wire:model="contact" class="form-control" id="contact">
                                    @error('contact')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>


                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="position" class="form-label">User Type <span
                                            class="text-danger">*</span></label>
                                    <select wire:model="position" id="position" class="form-control">
                                        <option value="">Select User Type</option>
                                        <option value="Student">Student</option>
                                        <option value="Teacher">Teacher</option>
                                        <option value="Staff">Staff</option>
                                    </select>
                                    @error('position')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Complete Address <span
                                    class="text-danger">*</span></label>
                            <input type="text" wire:model="address" class="form-control" id="address">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div wire:ignore.self class="modal fade" id="editLogin" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form wire:submit.prevent="saveLogindetails">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Login Information
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="firstname" class="form-label">Username <span
                                    class="text-danger">*</span></label>
                            <input type="text" wire:model="username" class="form-control" id="username" readonly>
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label for="firstname" class="form-label">Email</label>
                            <input type="text" wire:model="email" class="form-control" id="email" >
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <hr>
                        Change Password
                        <hr>
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Old Password</label>
                            <input type="password" wire:model="old_password" class="form-control" id="old_password">
                            @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="firstname" class="form-label">New Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" wire:model="password" class="form-control" id="password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
