@extends('layouts.user.index')

@section('content')
    @include('frontend.hero.index')
    @php
        $categoryName = request()->query('q', '');
    @endphp

    <section class="ratio_asos overflow-hidden">
        <div class="container p-sm-0">
            <div class="row m-0">
                <div class="col-12 p-0">
                    <div class="title-3 text-center">
                        <h2>
                            @if (!empty($categoryName))
                                Results for "{{ ucfirst($categoryName) }}" Available for Borrowing
                            @else
                                Available for Borrowing
                            @endif
                        </h2>

                        <h5 class="theme-color">Scroll Down</h5>
                    </div>
                </div>
            </div>
            <style>
                .r-price {
                    display: flex;
                    flex-direction: row;
                    gap: 20px;
                }

                .r-price .main-price {
                    width: 100%;
                }

                .r-price .rating {
                    padding-left: auto;
                }

                .product-style-3.product-style-chair .product-title {
                    text-align: left;
                    width: 100%;
                }

                @media (max-width:600px) {

                    .product-box p,
                    .product-box a {
                        text-align: left;
                    }

                    .product-style-3.product-style-chair .main-price {
                        text-align: right !important;
                    }
                }
            </style>
            <div class="row g-sm-4 g-3">
                <livewire:frontend.search.results />

              
            </div>
        </div>
    </section>
    <hr class="m-0">
    @include('frontend.mv.index')
   
@endsection
