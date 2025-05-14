<section class="breadcrumb-section section-b-space" style="padding-top:20px;padding-bottom:20px;">
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>{{  ucfirst($item->name) }}</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{ route('user.categories', ['slug' => $item->category->name]) }}" class="text-dark">
                                {{ ucfirst($item->category->name) }}
                            </a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
