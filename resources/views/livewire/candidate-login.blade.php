<div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 to-indigo-600">
    <div class="bg-white shadow-xl rounded-lg p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold mb-2 text-center text-gray-800">Candidate Login</h2>
        <p class="text-gray-600 text-center mb-6">Enter your details to start the test</p>

        @error('login')
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                {{ $message }}
            </div>
        @enderror

        <form wire:submit.prevent="login" class="space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" wire:model="first_name"
                       class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300" />
                @error('first_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Passport Number</label>
                <input type="text" wire:model="passport_number"
                       class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300" />
                @error('passport_number') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Login
            </button>
        </form>
    </div>
</div>
