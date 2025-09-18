<div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-green-400 to-blue-500">
    <div class="bg-white shadow-2xl rounded-xl p-8 w-full max-w-2xl text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">
            Welcome, {{ $candidate->first_name }} 🎉
        </h2>

        <p class="text-lg text-gray-600 mb-6">
            This test is designed to assess your <span class="font-semibold text-blue-600">English knowledge and skills</span>.  
            It is a crucial step since you will be working and communicating mostly in English.
        </p>

        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded">
            Please take your time and answer each question carefully.
        </div>

        <button wire:click="startExam"
            class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition shadow-md">
            Start Test →
        </button>
    </div>
</div>
