<div class="col-md-6">
    {{-- @if (!$item->isEmpty()) --}}
        <div class="col-sm-12 table-responsive" x-data="{ editMode: false }">
            <form wire:submit.prevent="changeQty">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Items</h2>

                  

                </div>
                <table class="table  cart-table table-borderless">
                    <thead>
                        <tr>
                            <th>
                                <p class="font-light">Name</p>
                            </th>
                            <th>
                                <p class="font-light">Quantity</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item as $cartlist)
                            <tr class="table-order">
                                
                                <td class="d-flex align-items-center">
                                    <img src="{{ asset($cartlist->cart->item->image_path ? 'storage/' . $cartlist->cart->item->image_path : 'images/not_available.jpg') }}"
                                        alt="{{ $cartlist->cart->item->name }}" class="img-thumbnail me-2"
                                        style="width: 50px; height: 50px; object-fit: cover;">
                                    <span title="{{ ucfirst($cartlist->cart->item->name) }}">
                                        {{ Str::limit(ucfirst($cartlist->cart->item->name), 20, '...') }}
                                    </span>
                                </td>
                                <td>
                                    <h5 class="text-center" x-show="!editMode">{{ $cartlist->cart->quantity }}</h5>


                                 
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex mt-3">
                    {{ $item->links(data: ['scrollTo' => false]) }}
                </div>
            </form>
        </div>
    {{-- @endif --}}


</div>