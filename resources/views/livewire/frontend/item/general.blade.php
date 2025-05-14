<section class="section-b-space">
    <div class="container">
        <div class="row">
            @include('frontend.items.collection.category')
            
            <div class="category-product col-lg-9 col-12 ratio_30">
                @include('frontend.items.collection.mini-navbar')
                <!-- label and featured section -->

                <!-- Prodcut setion -->
                @include('frontend.items.collection.product-section')

                {{-- Pagination --}}
                {{-- @include('frontend.product.collection.pagination-collection') --}}
            </div>
        </div>
    </div>
</section>