<div class="flex flex-col justify-center sm:h-screen p-4">
    <div class="max-w-md w-full mx-auto p-8 space-y-6 bg-white rounded shadow-md">
         
        <img src="/images/awe-assignment-logo.svg" alt="AWE Logo" class="mx-auto h-40 w-auto">
        
        <h2 class="text-2xl font-bold text-center text-gray-800">Register</h2>
        <form wire:submit.prevent="register" class="space-y-4">
            <div class="space-y-6">
                <label for="name" class="text-slate-900 text-sm font-medium mb-2 block">Name</label>
                <input type="text" id="name" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" autocomplete="name">
                @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="email" class="text-slate-900 text-sm font-medium mb-2 block">Email</label>
                <input type="email" id="email" wire:model="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" autocomplete="email">
                @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="password" class="text-slate-900 text-sm font-medium mb-2 block">Password</label>
                <input type="password" id="password" wire:model="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" autocomplete="new-password">
                @error('password') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="password_confirmation" class="text-slate-900 text-sm font-medium mb-2 block">Confirm Password</label>
                <input type="password" id="password_confirmation" wire:model="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" autocomplete="new-password">
            </div>
            <div class="mt-12">
                <button type="submit" class="w-full py-3 px-4 text-sm tracking-wider font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none cursor-pointer">Register</button>
            </div>
        </form>
        @if (session()->has('message'))
            <div class="p-2 mt-4 text-green-700 bg-green-100 border border-green-300 rounded">
                {{ session('message') }}
            </div>
        @endif
    </div>
</div>
