
<div class="row g-4">
    <!-- label and featured section -->
    <div class="col-md-12">
        <ul class="short-name">


        </ul>
    </div>

    <div class="col-12">
        <div class="filter-options">
            <div class="select-options">
                <div class="page-view-filter">
                    <div class="dropdown select-featured d-none">
                        <select class="form-select" name="orderby" id="orderby">
                            <option value="-1" selected="">Default</option>
                            <option value="1">Available</option>
                            <option value="2">Reserved</option>

                        </select>
                    </div>
                </div>
               
            </div>
            <div class="grid-options d-sm-inline-block d-none">
                <ul class="d-flex">
                    <li class="two-grid">
                        <a href="javascript:void(0)">
                            <img src="{{ asset('assets_users/svg/grid-2.svg') }}"
                                class="img-fluid blur-up lazyload" alt="">
                        </a>
                    </li>
                    <li class="three-grid d-md-inline-block d-none">
                        <a href="javascript:void(0)">
                            <img src="{{ asset('assets_users/svg/grid-3.svg') }}"
                                class="img-fluid blur-up lazyload" alt="">
                        </a>
                    </li>
                    <li class="grid-btn active d-lg-inline-block d-none">
                        <a href="javascript:void(0)">
                            <img src="{{ asset('assets_users/svg/grid.svg') }}"
                                class="img-fluid blur-up lazyload" alt="">
                        </a>
                    </li>
                    {{-- <li class="list-btn">
                        <a href="javascript:void(0)">
                            <img src="{{ asset('assets_users/svg/list.svg') }}"
                                class="img-fluid blur-up lazyload" alt="">
                        </a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
</div>
