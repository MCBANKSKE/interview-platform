

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-600 to-purple-600 p-4">
    <div class="welcome-container fade-in">
        <div class="header-section">
            <div class="profile-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <h2>Welcome, <span class="candidate-name">{{ $candidate->first_name }}!</span></h2>
            <p class="welcome-message">We're excited to have you take our assessment</p>
        </div>
        
        <div class="content-section">
            <div class="info-box">
                <div class="info-title">
                    <i class="fas fa-info-circle"></i>
                    <span>About This Test</span>
                </div>
                <p class="info-content">
                    This test is designed to evaluate your knowledge and understanding of the English language.  
                    Since you will be dealing mostly with English-speaking individuals, it is crucial to perform well.  
                    Please take your time and answer the questions carefully.
                </p>
            </div>
            
            <div class="info-box">
                <div class="info-title">
                    <i class="fas fa-list-check"></i>
                    <span>Test Instructions</span>
                </div>
                <ul class="instructions-list">
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>This test contains multiple-choice questions</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>You will have 45 minutes to complete the assessment</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Answers are final once submitted and cannot be changed</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Ensure you have a stable internet connection throughout</span>
                    </li>
                </ul>
            </div>
            
            <button wire:click="startTest" class="start-button pulse" wire:loading.attr="disabled">
                <i class="fas fa-play-circle"></i>
                <span wire:loading.remove>Start Test Now</span>
                <span wire:loading wire:target="startTest">Preparing Your Test...</span>
            </button>
            
            <div class="footer-section">
                <p>Need assistance? Contact <a href="mailto:support@careers.rmsystems.site">support@careers.rmsystems.site</a></p>
                <p>© {{ date('Y') }} Language Proficiency Testing</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        // Add any client-side interactivity here if needed
    });
</script>
@endpush
