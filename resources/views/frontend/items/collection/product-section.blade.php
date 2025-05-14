@php
    use Illuminate\Support\Facades\Storage;
@endphp

<div
    class="row g-sm-4 g-3 row-cols-lg-4 row-cols-md-3 row-cols-2 mt-1 custom-gy-5 product-style-2 ratio_asos product-list-section">
    @forelse ($items as $item)
        <div class="col">
            <div class="product-box">
                <div class="img-wrapper">
                    <div class="front">
                        @php
                            $imagePath =
                                $item->image_path && Storage::exists($item->image_path)
                                    ? 'storage/' . $item->image_path
                                    : 'images/not_available.jpg';
                        @endphp

                        <a href="{{ route('user.item', ['uuid' => $item->uuid]) }}">
                            <img src="{{ $item->image_path ? asset('storage/' . $item->image_path) : asset('images/not_available.jpg') }}" class="bg-img blur-up lazyload" alt="Item Image">
                        </a>
                    </div>
                </div>
                <div class="product-details">
                    <div class="d-flex justify-content-between">
                        <h3 class="theme-color">{{ Str::ucfirst($item->name) }}</h3>
                        <span class="text-primary">{{ $item->quantity }}</span>
                    </div>

                    @php
                        $statusMap = [
                            0 => ['label' => 'Available', 'class' => 'bg-success'],
                            1 => ['label' => 'Borrowed', 'class' => 'bg-warning'],
                            2 => ['label' => 'Damaged', 'class' => 'bg-danger'],
                        ];
                        $status = $statusMap[$item->status] ?? ['label' => 'Unknown', 'class' => 'bg-secondary'];
                    @endphp

                    <div class="status mt-2">
                        <span class="badge {{ $status['class'] }}">
                            {{ $status['label'] }}
                        </span>
                    </div>

                    <div class="main-price mt-2">
                        <a href="{{ route('user.item', ['uuid' => $item->uuid]) }}"
                            class="btn listing-content {{ $item->status !== 0 ? 'disabled' : '' }}">
                            Reserve Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <h4 class="text-center">No available items found.</h4>
        </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="mt-4">
    {{-- {{ $items->links() }} --}}
</div>
