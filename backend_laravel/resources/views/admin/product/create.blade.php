<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create Product') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="px-4 py-3 mb-8  ">
                        <form class="w-full "
                            action="{{ isset($product) ? route('product.update', $product) : route('product.store') }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @if (isset($product))
                                @method('PATCH')
                            @endif
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2  mb-8 w-full ">
                                <div class="w-full  px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="grid-first-name">
                                        Product Name
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        id="grid-first-name" type="text" placeholder="name" name="name"
                                        value="{{ isset($product) ? $product->name : '' }}">
                                    @error('name')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full  px-3 mb-6 md:mb-0 ml-2">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="price">
                                        Product Price
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        id="price" type="number" placeholder="price" name="price"
                                        value="{{ isset($product) ? $product->price : '' }}">
                                    @error('price')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mb-6 mt-8">
                                <div class="w-full  px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="grid-first-name">
                                        Is Product Discountable?
                                    </label>
                                    <select
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        name="is_discountable" id="is_discountable">
                                        <option value="0" @isset($product) @if ($product->is_discountable == 0) selected @endif
                                            @endisset>False</option>
                                        <option value="1" @isset($product) @if ($product->is_discountable == 1) selected @endif
                                            @endisset>True</option>
                                    </select>
                                    @error('is_discountable')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full  px-3 mb-6 md:mb-0 ml-2">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="discount">
                                        Product Discount in %
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        id="discount" type="number" placeholder="discount" name="discount"
                                        value="{{ isset($product) ? (isset($product->discount) ? $product->discount : '0.00') : '0.00' }}">
                                    @error('discount')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex flex-wrap  mb-6 mt-8">
                                <div class="w-full  px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="grid-first-name">
                                        Product Description
                                    </label>
                                    <textarea
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        id="grid-first-name" type="text" placeholder="Description" name="description"
                                        value="{{ isset($product) ? $product->name : '' }}">{{ isset($product) ? $product->description : '' }}</textarea>
                                    @error('description')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex justify-end mt-8">
                                <x-button type="submit" class="">
                                    {{ __('Save') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
