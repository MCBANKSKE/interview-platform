<div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-green-400 to-blue-500">
    <div class="bg-white shadow-xl rounded-xl p-8 max-w-2xl text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">
            🎉 Congratulations, {{ $candidate->first_name }}!
        </h2>

        <p class="text-lg text-gray-600 mb-6">
            You have successfully completed your English assessment.  
            Our team will carefully review your answers and send the results to your email:
            <span class="font-semibold text-blue-600">{{ $candidate->email ?? 'your registered email' }}</span>.
        </p>

        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            Thank you for your effort and time. We wish you the best of luck!
        </div>

        <button wire:click="logout"
            class="bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700 transition shadow-md">
            Exit Portal
        </button>
    </div>
</div>
