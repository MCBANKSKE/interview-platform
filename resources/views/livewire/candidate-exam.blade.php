@section('styles')
<style>
    #progress {
        width: 0%;
        transition: width 0.3s ease;
    }
</style>
@endsection

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-600 to-purple-600 p-4">
    <div class="assessment-container fade-in">
        <div class="header-section">
            <div class="question-counter">
                <i class="fas fa-clipboard-list"></i>
                Question <span id="current">{{ $currentIndex + 1 }}</span> of <span id="total">{{ $questions->count() }}</span>
            </div>
            <div class="timer" wire:poll.1000ms="updateTimer">
                <i class="fas fa-clock"></i>
                <span id="time">{{ gmdate('i:s', $timeLeft) }}</span>
            </div>
        </div>
        
        <div class="progress-container" x-data="{ progress: 0 }" x-init="progress = ({{ $currentIndex }} + 1) / {{ $questions->count() }} * 100">
            <div class="progress-bar">
                <div class="progress-fill" x-bind:style="'width: ' + progress + '%'"></div>
            </div>
        </div>
        
        <div class="content-section">
            @if($currentQuestion)
                <p class="question-text">{{ $currentQuestion->text }}</p>
                
                <div class="answer-section">
                    @if($currentQuestion->type === 'text')
                        <div class="text-answer">
                            <textarea 
                                wire:model.defer="answer_text"
                                placeholder="Type your answer here..."
                                rows="5"
                            ></textarea>
                        </div>
                    @elseif($currentQuestion->type === 'file')
                        <div class="file-answer">
                            <input type="file" id="file-upload-{{ $currentQuestion->id }}" wire:model.defer="answer_file">
                            <label for="file-upload-{{ $currentQuestion->id }}">
                                <div class="file-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div class="file-text">Click to upload or drag and drop</div>
                                <div class="file-hint">PDF, DOC, DOCX (Max 5MB)</div>
                            </label>
                            @if($answer_file)
                                <div class="selected-file">
                                    <i class="fas fa-file-pdf"></i>
                                    <span>{{ $answer_file->getClientOriginalName() }}</span>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
                
                <div class="question-dots">
                    @foreach($questions as $index => $question)
                        <div class="dot {{ $index === $currentIndex ? 'active' : '' }} {{ $answeredQuestions->contains($question->id) ? 'answered' : '' }}">
                        </div>
                    @endforeach
                </div>
                
                <div class="navigation-buttons">
                    <button 
                        type="button" 
                        class="nav-btn prev {{ $currentIndex === 0 ? 'invisible' : '' }}"
                        wire:click="previousQuestion"
                        {{ $currentIndex === 0 ? 'disabled' : '' }}>
                        <i class="fas fa-arrow-left"></i>
                        Previous
                    </button>
                    
                    <button 
                        type="button" 
                        class="nav-btn next"
                        wire:click="nextQuestion">
                        {{ $currentIndex < $questions->count() - 1 ? 'Next Question' : 'Submit Assessment' }}
                        <i class="fas {{ $currentIndex < $questions->count() - 1 ? 'fa-arrow-right' : 'fa-check-circle' }}"></i>
                    </button>
                </div>
            @else
                <p class="text-center text-gray-600">No questions available.</p>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        // Handle file upload preview
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                const fileName = this.files[0]?.name;
                const selectedFile = this.parentElement.querySelector('.selected-file');
                
                if (fileName) {
                    if (!selectedFile) {
                        const newSelectedFile = document.createElement('div');
                        newSelectedFile.className = 'selected-file';
                        newSelectedFile.innerHTML = `
                            <i class="fas fa-file-pdf"></i>
                            <span>${fileName}</span>
                        `;
                        this.parentElement.appendChild(newSelectedFile);
                    } else {
                        selectedFile.querySelector('span').textContent = fileName;
                        selectedFile.style.display = 'flex';
                    }
                } else if (selectedFile) {
                    selectedFile.style.display = 'none';
                }
            });
        });
        
        // Auto-save when changing questions
        Livewire.on('questionChanged', () => {
            // Scroll to top of the question
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });
</script>
@endpush
