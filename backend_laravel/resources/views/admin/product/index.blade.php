<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 ">
            {{ __('Products') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 ">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg ">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between ">
                        <h2 class="text-xl font-bold text-gray-800"></h2>
                        <a href="{{ route('product.create') }}">
                            <button
                                class="inline-flex items-center px-4 py-2 font-semibold text-white bg-gray-800 rounded-lg shadow cursor-pointer hover:bg-gray-900 focus:outline-none focus:shadow-outline">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                Create
                            </button>
                        </a>
                    </div>
                    <div class="w-full mt-8 mb-8 overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50 ">
                                        <th class="px-4 py-3">Id</th>
                                        <th class="px-4 py-3">Name</th>
                                        <th class="px-4 py-3">Price</th>
                                        <th class="px-4 py-3">Description</th>
                                        <th class="px-4 py-3">Discount</th>
                                        <th class="px-4 py-3">Discounted Price</th>
                                        <th class="px-4 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="mt-4 bg-white divide-y">
                                    @foreach ($products as $product)
                                        <tr class="mt-2 text-gray-700">
                                            <td class="px-4 py-3 text-sm">
                                                #{{ $product->id }}
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center text-sm">
                                                    <!-- Avatar with inset shadow -->
                                                    <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                        <img class="object-cover w-full h-full rounded-full"
                                                            src="{{ $product->image }}" alt="" loading="lazy" />
                                                        <div class="absolute inset-0 rounded-full shadow-inner"
                                                            aria-hidden="true"></div>
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold">{{ $product->name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                $ {{ $product->product_price }}
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ Str::limit($product->description, 80) }}
                                            </td>
                                            <td class="px-4 py-3 text-sm ">
                                                @isset($product->discount)
                                                    {{ $product->discount }}%
                                                @endisset
                                                @empty($product->discount)
                                                    {{ __('-') }}
                                                @endempty
                                            </td>
                                            <td class="px-4 py-3 text-sm ">
                                                @isset($product->product_discounted_price)
                                                    ${{ $product->product_discounted_price }}
                                                @endisset
                                                @empty($product->product_discounted_price)
                                                    {{ __('-') }}
                                                @endempty
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center space-x-4 text-sm">
                                                    <a href="{{ route('product.edit', $product->id) }}"
                                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg focus:outline-none focus:shadow-outline-gray"
                                                        aria-label="Edit">
                                                        <svg class="w-5 h-5" aria-hidden="true"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                    <form action='{{ route('product.destroy', $product->id) }}'
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                            aria-label="Delete">
                                                            <svg class="w-5 h-5" aria-hidden="true"
                                                                fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div
                            class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 sm:grid-cols-9 ">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
