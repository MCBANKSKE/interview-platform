<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Candidate;

class CandidateWelcome extends Component
{
    public $candidate;

    public function mount()
    {
        $candidateId = session('candidate_id');
        if (!$candidateId) {
            return redirect()->route('candidate.login');
        }

        $this->candidate = Candidate::findOrFail($candidateId);
    }

    public function startTest()
    {
        return redirect()->route('candidate.exam'); // exam flow page (to build next)
    }

    public function render()
    {
        return view('livewire.candidate-welcome');
    }
}
