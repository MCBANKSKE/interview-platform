<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Completed Successfully</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/CSS/finish.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body>
    <div class="completion-container fade-in">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        
        <h2>Test Completed!</h2>
        
        <p class="message">
            Thank you for completing the test.  
            Your responses have been submitted successfully.  
            The results will be reviewed and shared with you via email.
        </p>
        
        <div class="details-box">
            <div class="detail-item">
                <span class="detail-label"><i class="fas fa-clipboard-list"></i> Test Name:</span>
                <span class="detail-value">English Proficiency Assessment</span>
            </div>
            <div class="detail-item">
                <span class="detail-label"><i class="fas fa-clock"></i> Completion Time:</span>
                <span class="detail-value" id="completion-time">--:--</span>
            </div>
            <div class="detail-item">
                <span class="detail-label"><i class="fas fa-calendar"></i> Date Submitted:</span>
                <span class="detail-value" id="current-date">{{ now()->format('F d, Y') }}</span>
            </div>
        </div>
        
        
        <div class="footer">
            <p>Questions? Contact <a href="mailto:support@careers.rmsystems.site">support@careers.rmsystems.site</a></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set current date if not already set by Livewire
            if (!document.getElementById('current-date').textContent) {
                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                document.getElementById('current-date').textContent = new Date().toLocaleDateString('en-US', options);
            }
            
            // Create confetti effect
            createConfetti();
            
            // Calculate and display completion time if available
            const startTime = sessionStorage.getItem('examStartTime');
            if (startTime) {
                const endTime = new Date().getTime();
                const duration = Math.floor((endTime - parseInt(startTime)) / 1000);
                const minutes = Math.floor(duration / 60);
                const seconds = duration % 60;
                document.getElementById('completion-time').textContent = 
                    `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                
                // Clear the start time from session storage
                sessionStorage.removeItem('examStartTime');
            }
            
            // Button interactions
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 200);
                });
            });
        });
        
        function createConfetti() {
            const container = document.querySelector('.completion-container');
            const colors = ['#ffeb3b', '#4f46e5', '#10b981', '#ef4444', '#8b5cf6'];
            
            for (let i = 0; i < 30; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.background = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.top = -20 + 'px';
                confetti.style.transform = 'rotate(' + Math.random() * 360 + 'deg)';
                container.appendChild(confetti);
                
                // Animate confetti
                setTimeout(() => {
                    confetti.style.transition = 'top 1.5s ease-out, opacity 1.5s ease-out';
                    confetti.style.top = Math.random() * 100 + '%';
                    confetti.style.opacity = '1';
                    
                    // Remove confetti after animation
                    setTimeout(() => {
                        confetti.style.opacity = '0';
                    }, 1500);
                }, 100);
            }
        }
    </script>
    @livewireScripts
</body>
</html>
