<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-center">
                <div class="flex items-center mb-4 sm:mb-0">
                    <div class="bg-blue-100 p-2 rounded-lg mr-4">
                        <i class="fas fa-tasks text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">Question <span class="text-blue-600">{{ $currentIndex + 1 }}</span> of {{ $questions->count() }}</h2>
                        <p class="text-sm text-gray-500">Complete all questions to finish the assessment</p>
                    </div>
                </div>
                <div class="flex items-center bg-blue-50 px-4 py-2 rounded-lg">
                    <i class="fas fa-clock text-blue-600 mr-2"></i>
                    <span class="font-mono text-lg font-bold text-gray-800" id="time" wire:poll.1000ms="updateTimer">
                        {{ gmdate('i:s', $timeLeft) }}
                    </span>
                </div>
            </div>
            
            <!-- Progress Bar -->
            <div class="px-6 py-4 bg-gray-50">
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div 
                        class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2.5 rounded-full transition-all duration-500 ease-in-out" 
                        style="width: {{ ($currentIndex + 1) / $questions->count() * 100 }}%">
                    </div>
                </div>
                <div class="flex justify-between mt-2 text-sm text-gray-500">
                    <span>{{ round(($currentIndex / $questions->count()) * 100) }}% Complete</span>
                    <span>{{ $questions->count() - $currentIndex - 1 }} questions remaining</span>
                </div>
            </div>
        </div>

        <!-- Question Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8 transform transition-all duration-300 hover:shadow-xl">
            <div class="p-6 sm:p-8">
                @if($currentQuestion)
                    <div class="flex items-center mb-6">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 text-blue-600 font-bold mr-4">
                            Q{{ $currentIndex + 1 }}
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Question</h3>
                    </div>
                    
                    <div class="prose max-w-none mb-8">
                        <p class="text-gray-700 text-lg leading-relaxed">
                            {{ $currentQuestion->text }}
                        </p>
                    </div>
                
                    <!-- Answer Section -->
                    <div class="answer-section mb-8">
                        @if($currentQuestion->type === 'text')
                            <div class="mb-4">
                                <label for="answer_text" class="block text-sm font-medium text-gray-700 mb-2">
                                    Your Answer
                                </label>
                                <textarea 
                                    id="answer_text"
                                    wire:model.defer="answer_text"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                    placeholder="Type your detailed answer here..."
                                    rows="6"
                                ></textarea>
                            </div>
                        @elseif($currentQuestion->type === 'file')
                            <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="file-upload-{{ $currentQuestion->id }}" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Upload a file</span>
                                            <input id="file-upload-{{ $currentQuestion->id }}" name="file-upload" type="file" class="sr-only" wire:model.defer="answer_file">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PDF, DOC, DOCX up to 5MB
                                    </p>
                                    @if($answer_file)
                                        <div class="mt-4 flex items-center justify-center">
                                            <div class="flex items-center">
                                                <i class="fas fa-file-pdf text-red-500 text-2xl mr-2"></i>
                                                <span class="text-sm font-medium text-gray-900 truncate max-w-xs">
                                                    {{ is_string($answer_file) ? basename($answer_file) : $answer_file->getClientOriginalName() }}
                                                </span>
                                                <button type="button" class="ml-2 text-red-600 hover:text-red-800" wire:click="$set('answer_file', null)">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Question Navigation Dots -->
                    <div class="flex justify-center space-x-2 mb-8">
                        @foreach($questions as $index => $question)
                            <button 
                                type="button"
                                wire:click="$set('currentIndex', {{ $index }})"
                                class="w-3 h-3 rounded-full transition-all duration-200 {{ $index === $currentIndex ? 'bg-blue-600 scale-125' : ($answeredQuestions->contains($question->id) ? 'bg-green-500' : 'bg-gray-300') }}"
                                title="Question {{ $index + 1 }}">
                            </button>
                        @endforeach
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                        <button 
                            type="button"
                            wire:click="previousQuestion"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
                            {{ $currentIndex === 0 ? 'disabled' : '' }}>
                            <i class="fas fa-arrow-left mr-2"></i>
                            Previous
                        </button>
                        
                        <button 
                            type="button"
                            wire:click="nextQuestion"
                            class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            {{ $currentIndex < $questions->count() - 1 ? 'Next Question' : 'Submit Assessment' }}
                            <i class="fas {{ $currentIndex < $questions->count() - 1 ? 'fa-arrow-right ml-2' : 'fa-check-circle ml-2' }}"></i>
                        </button>
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-exclamation-circle text-gray-400 text-5xl mb-4"></i>
                        <p class="text-gray-600">No questions available at the moment.</p>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        // Handle file upload preview with better feedback
        const handleFileInput = (input) => {
            const container = input.closest('.border-dashed');
            const fileName = input.files[0]?.name;
            const fileSize = input.files[0]?.size;
            const maxSize = 5 * 1024 * 1024; // 5MB
            
            // Remove any existing error messages
            const existingError = container.querySelector('.file-error');
            if (existingError) {
                existingError.remove();
            }
            
            // Check file size if file exists
            if (fileSize > maxSize) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'file-error mt-2 text-sm text-red-600';
                errorDiv.innerHTML = 'File size exceeds 5MB limit. Please choose a smaller file.';
                container.appendChild(errorDiv);
                input.value = ''; // Clear the input
                return;
            }
            
            // Update file name display if file is valid
            if (fileName) {
                const fileType = fileName.split('.').pop().toLowerCase();
                const fileIcons = {
                    'pdf': 'file-pdf',
                    'doc': 'file-word',
                    'docx': 'file-word',
                    'txt': 'file-alt',
                    'jpg': 'file-image',
                    'jpeg': 'file-image',
                    'png': 'file-image',
                };
                
                const fileIcon = fileIcons[fileType] || 'file';
                
                let preview = container.querySelector('.file-preview');
                if (!preview) {
                    preview = document.createElement('div');
                    preview.className = 'file-preview mt-4 p-3 bg-blue-50 rounded-lg border border-blue-100 flex items-center justify-between';
                    container.appendChild(preview);
                }
                
                preview.innerHTML = `
                    <div class="flex items-center">
                        <i class="fas fa-${fileIcon} text-blue-500 text-xl mr-3"></i>
                        <div class="truncate max-w-xs">
                            <p class="text-sm font-medium text-gray-900 truncate">${fileName}</p>
                            <p class="text-xs text-gray-500">${(fileSize / 1024 / 1024).toFixed(2)} MB</p>
                        </div>
                    </div>
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="this.closest('.file-preview').remove(); this.closest('.border-dashed').querySelector('input[type=file]').value = '';">
                        <i class="fas fa-times"></i>
                    </button>
                `;
            }
        };
        
        // Initialize for existing file inputs
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', (e) => handleFileInput(e.target));
        });
        
        // Auto-save when changing questions with animation
        Livewire.on('questionChanged', () => {
            // Smooth scroll to top with offset for better UX
            const questionCard = document.querySelector('.question-card');
            if (questionCard) {
                questionCard.classList.add('opacity-0', 'transform', 'scale-95');
                
                setTimeout(() => {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    
                    questionCard.classList.remove('opacity-0', 'scale-95');
                    questionCard.classList.add('opacity-100', 'scale-100');
                }, 150);
            }
        });
        
        // Add keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft' && {{ $currentIndex }} > 0) {
                @this.call('previousQuestion');
            } else if (e.key === 'ArrowRight' && {{ $currentIndex }} < {{ $questions->count() - 1 }}) {
                @this.call('nextQuestion');
            }
        });
    });
    
    // Handle drag and drop file upload
    document.addEventListener('DOMContentLoaded', () => {
        const dropZones = document.querySelectorAll('.border-dashed');
        
        const preventDefaults = (e) => {
            e.preventDefault();
            e.stopPropagation();
        };
        
        const highlight = (e) => {
            preventDefaults(e);
            e.currentTarget.classList.add('border-blue-400', 'bg-blue-50');
        };
        
        const unhighlight = (e) => {
            preventDefaults(e);
            e.currentTarget.classList.remove('border-blue-400', 'bg-blue-50');
        };
        
        const handleDrop = (e) => {
            unhighlight(e);
            const dt = e.dataTransfer;
            const files = dt.files;
            const input = e.currentTarget.querySelector('input[type="file"]');
            if (files.length > 0) {
                input.files = files;
                const event = new Event('change', { bubbles: true });
                input.dispatchEvent(event);
            }
        };
        
        dropZones.forEach(zone => {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                zone.addEventListener(eventName, preventDefaults, false);
            });
            
            ['dragenter', 'dragover'].forEach(eventName => {
                zone.addEventListener(eventName, highlight, false);
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                zone.addEventListener(eventName, unhighlight, false);
            });
            
            zone.addEventListener('drop', handleDrop, false);
        });
    });
</script>
@endpush
