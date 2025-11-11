<div>
    <div class="border border-dashed border-slate-400 m-4 p-2">
        <div class="border border-dashed border-slate-400 m-2 p-2">
            <h3>Carrito Livewire</h3>
        </div>

        <div class="border border-dashed border-slate-400 m-2 p-2">
            <a class="text-blue-600 underline" href="{{ route('welcome') }}">Volver</a>
        </div>

        <div class="border border-dashed border-slate-400 m-2 p-2">
            <div class="flex">
                <div>
                    <ul>
                        @forelse ($items as $item)
                        <li class="flex border border-dashed border-slate-400 m-2 p-2 gap-2 items-center min-h-16"
                            wire:key="{{ $item['purchasable_id'] }}">
                            <div>
                                @if (isset($item['product']['images'][0]['original_url']))
                                <img class="border border-slate-400 shadow rounded"
                                    src="{{ $item['product']['images'][0]['original_url'] }}" alt="Imagen" height="50"
                                    width="50">
                                @else
                                <img src="{{ asset('images/product_placeholder.png') }}" alt="Imagen" height="50"
                                    width="50">
                                @endif
                            </div>

                            <div class="w-1/2">
                                {{ $item['product']['name'] }}
                            </div>

                            <div class="flex">
                                <button wire:click="decrease({{ $item['purchasable_id'] }})"
                                    class="h-8 w-8 px-2 border border-solid rounded bg-blue-400 text-white cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                        class="size-4">
                                        <path d="M3.75 7.25a.75.75 0 0 0 0 1.5h8.5a.75.75 0 0 0 0-1.5h-8.5Z" />
                                    </svg>
                                </button>

                                <div class="px-4">{{ $item['quantity'] }}</div>

                                <button wire:click="increase({{ $item['purchasable_id'] }})"
                                    class="h-8 w-8 px-2 border border-solid rounded bg-blue-400 text-white cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                        class="size-4">
                                        <path
                                            d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
                                    </svg>
                                </button>
                            </div>

                            <div>
                                $ {{ number_format($item['product']['price'], 2) }}
                            </div>
                        </li>
                        @empty
                        <li>No hay items en el carrito todavía.</li>
                        @endforelse
                    </ul>
                </div>

                <div class="m-2 p-2 border border-dashed border-slate-400 flex-col space-y-4">
                    <h3 class="mb-4 font-bold">Resumen de la compra</h3>
                    <div>
                        <p>Total productos: {{ $cart_total_products }}</p>
                        <p>Envío: Gratis</p>
                        <p>Cupones: No</p>
                        <p>Total: {{ number_format($cart_total_amount, 2) }}</p>
                    </div>
                    <div>
                        <button type="button"
                            class="px-2 py-1 border border-solid rounded bg-blue-400 text-white cursor-pointer">
                            Continuar la compra
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
