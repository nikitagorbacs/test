<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <div class="flex shadow-md my-10">
            <div class="w-3/4 bg-white px-10 py-10">
                <div class="flex justify-between border-b pb-8">
                    <h1 class="font-semibold text-2xl">Shopping Cart</h1>
                    <h2 class="font-semibold text-2xl" name="qty" min="1">{{ Cart::getTotalQuantity() }}
                        Items</h2>
                </div>
                <div class="flex mt-10 mb-5">
                    <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 ">Quantity</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 ">Price</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 ">Total</h3>
                </div>
                @if (empty($cartItems->items))
                @endif
                <form action="{{ route('cart.buy') }}" method="POST">
                    @csrf
                    @foreach ($cartItems as $item)
                        <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5 product-data">
                            <div class="flex w-2/5">
                                <div class="w-20">
                                    <img class="h-24" src="{{ $item->attributes->img_path }}" alt="">
                                </div>
                                <div class="flex flex-col justify-between ml-4 flex-grow">
                                    <span class="font-bold text-sm">{{ $item->name }}</span>
                                    <span class="text-red-500 text-xs">Color: {{ $item->color }}</span>
                                    <button name="remove" type="button"
                                        class="text-left font-semibold hover:text-red-500 text-gray-500 text-xs"
                                        onclick="location.href = '/remove/{{ $item->id }}';">Remove</button>
                                </div>
                            </div>
                            <div class="input-group quantity flex justify-center w-1/5">
                                <input type="button" value="-" class="decrement-btn text-gray-600 w-3"
                                    style="cursor: pointer">
                                <input name="quantity_{{ $item->id }}"
                                    class="quantity-input qty-input mx-2 border text-center w-10" type="number"
                                    value="{{ $item->quantity }}">
                                <input type="button" class="increment-btn text-gray-600 w-3" value="+">
                            </div>
                            <span class="text-center w-1/5 font-semibold text-sm">{{ $item->price }} EUR</span>
                            <span
                                class="total-price text-center w-1/5 font-semibold text-sm">{{ $item->price * $item->quantity }}
                                EUR</span>
                        </div>
                    @endforeach
                    <a href="{{ 'products' }}" class="flex font-semibold text-black text-sm mt-10">
                        <svg class="fill-current mr-2 text-black w-4" viewBox="0 0 448 512">
                            <path
                                d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                        </svg>
                        Continue Shopping
                    </a>
            </div>
            <div id="summary" class="w-1/4 px-8 py-10">
                <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
                <div class="flex justify-between mt-10 mb-5">
                    <span class="font-semibold text-sm uppercase">Items:</span>
                    <span class="font-semibold text-sm">{{ Cart::getTotalQuantity() }}</span>
                </div>
                <div>
                    <label class="font-medium inline-block mb-3 text-sm uppercase">Shipping</label>
                    <select class="block p-2 text-gray-600 w-full text-sm">
                        <option>Standard shipping - 5.00 EUR</option>
                    </select>
                </div>
                <div class="border-t mt-8">
                    <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                        <span>Total:</span>
                        <span>{{ Cart::getTotal() + 5 }} EUR </span>
                    </div>
                    <button name="checkout"
                        class="bg-black font-semibold hover:bg-gray-700 py-3 text-sm text-white uppercase w-full">Checkout</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $(".increment-btn").click(function() {
                var currentVal = parseInt($(this).next(".quantity-input").val());
                if (currentVal != NaN) {
                    $(this).next(".quantity-input").val(currentVal + 1);
                }
            });

            $(".decrement-btn").click(function() {
                var currentVal = parseInt($(this).prev(".quantity-input").val());
                if (currentVal != NaN) {
                    if (currentVal > 1) {
                        $(this).prev(".quantity-input").val(currentVal - 1);
                    }
                }
            });

        });
    </script>
</body>

</html>
<script src="{{ url('js/add.js') }}"></script>
