<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 ">
            {{ __('Orders') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 ">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg ">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-full mt-8 mb-8 overflow-x-scroll rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50 ">
                                        <th class="px-4 py-3">Id</th>
                                        <th class="px-4 py-3">Order Ref</th>
                                        <th class="px-4 py-3">User </th>
                                        <th class="px-4 py-3">Product</th>
                                        <th class="px-4 py-3">Total Paid</th>
                                        <th class="px-4 py-3">Created</th>
                                    </tr>
                                </thead>
                                <tbody class="mt-4 bg-white divide-y">
                                    @foreach ($orders as $order)
                                        <tr class="mt-2 text-gray-700">
                                            <td class="px-4 py-3 text-sm">
                                                #{{ $order->id }}
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center text-sm">
                                                    <!-- Avatar with inset shadow -->
                                                    <div>
                                                        <p class="font-semibold">{{ $order->order_ref }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ $order->user_id }}
                                            </td>
                                            <td class="px-4 py-3 text-sm ">
                                                {{ $order->product_id }}
                                            </td>
                                            <td class="px-4 py-3 text-sm ">
                                                {{ $order->total_payable }}
                                            </td>
                                            <td class="px-4 py-3 text-sm ">
                                                {{ $order->created_at }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div
                            class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 sm:grid-cols-9 ">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
