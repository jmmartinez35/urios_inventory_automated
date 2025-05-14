<div class="col-lg-3 category-side col-md-4">
    <div class="category-option">
        <div class="button-close mb-3">
            <button class="btn p-0">
                <i data-feather="arrow-left"></i> Close
            </button>
        </div>
        <div class="accordion category-name" id="accordionExample">
            <div class="accordion-item category-rating">
                <h2 class="accordion-header" id="headingOne">
                    <button
                        class="accordion-button"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseSix"
                    >
                        Category
                    </button>
                </h2>
                <div
                    id="collapseSix"
                    class="accordion-collapse collapse show"
                    aria-labelledby="headingOne"
                >
                    <div class="accordion-body category-scroll">
                        <ul class="category-list">
                            <li>
                                <a href="{{ route('home') }}">
                                    <div
                                        class="form-check ps-0 custome-form-check"
                                    >
                                        <label class="form-check-label"
                                            >All Categories</label
                                        >
                                        <p class="font-light d-none">(7)</p>
                                    </div>
                                </a>
                            </li>
                            @foreach ($categories as $category)
                            <li>
                                <a
                                    href="{{ route('user.categories', ['slug' => $category->name]) }}"
                                >
                                    <div
                                        class="form-check ps-0 custome-form-check"
                                    >
                                        <label
                                            class="form-check-label"
                                            >{{ Str::ucfirst($category->name) }}</label
                                        >
                                        <p class="font-light d-none">(7)</p>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
