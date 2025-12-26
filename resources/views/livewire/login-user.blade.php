<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded shadow-md">
        <img src="/images/awe-assignment-logo.svg" alt="AWE Logo" class="mx-auto h-40 w-auto">
        <h2 class="text-2xl font-bold text-center text-gray-800">Login</h2>
        <form wire:submit.prevent="login" class="space-y-4">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" wire:model="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" autocomplete="email">
                @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" wire:model="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" autocomplete="current-password">
                @error('password') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow hover:bg-indigo-700 transition duration-200">Login</button>
        </form>
        @if (session()->has('error'))
            <div class="p-2 mt-4 text-red-700 bg-red-100 border border-red-300 rounded">
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>
