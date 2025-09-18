<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Candidate;
use App\Models\Question;
use App\Models\Submission;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class CandidateExam extends Component
{
    use WithFileUploads;

    public $candidate;
    public $questions;
    public $currentIndex = 0;
    public $currentQuestion;
    public $answer_text;
    public $answer_file;
    public $timeLeft;
    public $examDuration = 45 * 60; 
    public $answeredQuestions;
    public $startTime;

    protected $listeners = ['questionChanged' => 'updateQuestion'];

    public function mount()
    {
        $candidateId = session('candidate_id');
        if (!$candidateId) {
            return redirect()->route('candidate.login');
        }

        $this->candidate = Candidate::findOrFail($candidateId);
        $this->questions = Question::all();
        
        // Initialize timer
        $this->startTime = session('exam_start_time', now()->timestamp);
        $elapsed = now()->timestamp - $this->startTime;
        $this->timeLeft = max(0, $this->examDuration - $elapsed);
        
        // Load answered questions
        $this->answeredQuestions = $this->candidate->submissions()->pluck('question_id');
        
        $this->loadQuestion();
    }

    public function loadQuestion()
    {
        $this->currentQuestion = $this->questions[$this->currentIndex] ?? null;
        
        // Load existing answer if any
        if ($this->currentQuestion) {
            $submission = Submission::where('candidate_id', $this->candidate->id)
                ->where('question_id', $this->currentQuestion->id)
                ->first();
                
            if ($submission) {
                $this->answer_text = $submission->answer_text;
                $this->answer_file = $submission->answer_file;
            } else {
                $this->answer_text = null;
                $this->answer_file = null;
            }
        }
    }

    public function updateTimer()
    {
        $elapsed = now()->timestamp - $this->startTime;
        $this->timeLeft = max(0, $this->examDuration - $elapsed);
        
        if ($this->timeLeft <= 0) {
            $this->submitExam();
        }
    }

    public function nextQuestion()
    {
        $this->saveAnswer();
        
        if ($this->currentIndex < $this->questions->count() - 1) {
            $this->currentIndex++;
            $this->loadQuestion();
            $this->dispatch('questionChanged');
        } else {
            $this->submitExam();
        }
    }
    
    public function previousQuestion()
    {
        if ($this->currentIndex > 0) {
            $this->saveAnswer();
            $this->currentIndex--;
            $this->loadQuestion();
            $this->dispatch('questionChanged');
        }
    }

    public function saveAnswer()
    {
        if (!$this->currentQuestion) {
            return;
        }

        $data = [
            'candidate_id' => $this->candidate->id,
            'question_id' => $this->currentQuestion->id,
        ];
        
        if ($this->currentQuestion->type === 'text') {
            $data['answer_text'] = $this->answer_text;
            // Clear file answer when switching to text
            $data['answer_file'] = null;
        } elseif ($this->currentQuestion->type === 'file' && $this->answer_file) {
            // Only process the file if it's a new upload (instance of UploadedFile)
            if (is_object($this->answer_file) && method_exists($this->answer_file, 'store')) {
                $data['answer_file'] = $this->answer_file->store('submissions', 'public');
            } elseif (is_string($this->answer_file)) {
                // If it's a string, it's likely already a stored file path
                $data['answer_file'] = $this->answer_file;
            }
        }

        $submission = Submission::updateOrCreate(
            [
                'candidate_id' => $this->candidate->id,
                'question_id' => $this->currentQuestion->id,
            ],
            $data
        );
        
        // Update the answer_file with the stored path after saving
        if ($this->currentQuestion->type === 'file' && isset($submission->answer_file)) {
            $this->answer_file = $submission->answer_file;
        }
        
        // Update answered questions
        $this->answeredQuestions = $this->candidate->submissions()->pluck('question_id');
    }
    
    public function submitExam()
    {
        $this->saveAnswer();
        session()->forget('exam_start_time');
        return redirect()->route('candidate.finish');
    }

    public function render()
    {
        return view('livewire.candidate-exam');
    }
}
