
<div class="login-container">
    <div class="login-box">
        <div class="login-header">
            <h2><i class="fas fa-user-tie"></i> Candidate Login</h2>
            <p>Access your candidate portal with secure credentials</p>
        </div>
        
        <div class="login-body">
            @error('login')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $message }}</span>
                </div>
            @enderror
            
            <form wire:submit.prevent="login" class="space-y-4">
                <div class="input-group">
                    <label for="first_name">
                        <i class="fas fa-signature"></i> First Name
                    </label>
                    <input type="text" id="first_name" wire:model="first_name" placeholder="Enter your first name" required>
                    <i class="fas fa-user input-icon"></i>
                    @error('first_name')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="passport_number">
                        <i class="fas fa-passport"></i> Passport Number
                    </label>
                    <input type="text" id="passport_number" wire:model="passport_number" placeholder="Enter your passport number" required>
                    <i class="fas fa-file-alt input-icon"></i>
                    @error('passport_number')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <button type="submit" class="login-btn pulse" wire:loading.class="loading" wire:loading.attr="disabled">
                    <i class="fas fa-lock-open"></i>
                    <span wire:loading.remove>Login</span>
                    <span wire:loading wire:target="login">Authenticating...</span>
                </button>
            </form>
            
            <div class="divider">
                <span>Need help?</span>
            </div>
            
            <div class="footer">
                Contact support at <a href="mailto:support@careers.rmsystems.site">support@careers.rmsystems.site</a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        const loginForm = document.querySelector('form[wire\:submit]');
        
        // Add shake animation on validation errors
        Livewire.on('validationError', () => {
            loginForm.classList.add('shake');
            setTimeout(() => {
                loginForm.classList.remove('shake');
            }, 500);
        });
    });
</script>
@endpush
