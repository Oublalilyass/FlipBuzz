<x-app-layout>

    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white leading-tight">
            {{ __('Create New Listing') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-r from-blue-800 via-indigo-700 to-orange-600">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <form method="POST" action="{{ route('listings.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-6">
                        <label for="title" class="block font-semibold text-gray-700">Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-input mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                        @error('title')
                        <p class="text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block font-semibold text-gray-700">Description</label>
                        <textarea id="description" name="description" class="form-textarea mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('description') }}</textarea>
                        @error('description')
                        <p class="text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="type" class="block font-semibold text-gray-700">Type</label>
                        <input type="text" id="type" name="type" value="{{ old('type') }}" class="form-input mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                        @error('type')
                        <p class="text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="site_age" class="block font-semibold text-gray-700">Site Age (years)</label>
                        <input type="number" id="site_age" name="site_age" value="{{ old('site_age') }}" class="form-input mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                        @error('site_age')
                        <p class="text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="monthly_profit" class="block font-semibold text-gray-700">Monthly Profit (USD)</label>
                        <input type="number" id="monthly_profit" name="monthly_profit" value="{{ old('monthly_profit') }}" class="form-input mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                        @error('monthly_profit')
                        <p class="text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="profit_margin" class="block font-semibold text-gray-700">Profit Margin (%)</label>
                        <input type="number" id="profit_margin" name="profit_margin" value="{{ old('profit_margin') }}" class="form-input mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                        @error('profit_margin')
                        <p class="text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="page_views" class="block font-semibold text-gray-700">Page Views (per month)</label>
                        <input type="number" id="page_views" name="page_views" value="{{ old('page_views') }}" class="form-input mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                        @error('page_views')
                        <p class="text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="profit_multiple" class="block font-semibold text-gray-700">Profit Multiple</label>
                        <input type="number" id="profit_multiple" name="profit_multiple" value="{{ old('profit_multiple') }}" class="form-input mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                        @error('profit_multiple')
                        <p class="text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="revenue_multiple" class="block font-semibold text-gray-700">Revenue Multiple</label>
                        <input type="number" id="revenue_multiple" name="revenue_multiple" value="{{ old('revenue_multiple') }}" class="form-input mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                        @error('revenue_multiple')
                        <p class="text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="images" class="block font-semibold text-gray-700">Image</label>
                        <input type="file" id="images" name="images" class="form-input mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" accept="images/*">
                        @error('images')
                        <p class="text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-center mt-6">
                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-orange-500 text-white font-bold rounded-lg shadow hover:from-indigo-600 hover:to-orange-600 focus:outline-none">
                            Create Listing
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>