<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Candidate;

class CandidateWelcome extends Component
{
    public $candidate;

    public function mount()
    {
        if (!session()->has('candidate_id')) {
            return redirect()->route('candidate.login');
        }

        $this->candidate = Candidate::find(session('candidate_id'));
    }

    public function startExam()
    {
        return redirect()->route('candidate.exam');
    }

    public function render()
    {
        return view('livewire.candidate-welcome');
    }
}
