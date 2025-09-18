<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Candidate;

class CandidateFinish extends Component
{
    public $candidate;

    public function mount()
    {
        if (!session()->has('candidate_id')) {
            return redirect()->route('candidate.login');
        }

        $this->candidate = Candidate::find(session('candidate_id'));
    }

    public function logout()
    {
        session()->forget('candidate_id');
        return redirect()->route('candidate.login');
    }

    public function render()
    {
        return view('livewire.candidate-finish');
    }
}
