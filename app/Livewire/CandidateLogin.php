<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Candidate;

class CandidateLogin extends Component
{
    public $first_name;
    public $passport_number;

    public function login()
    {
        $this->validate([
            'first_name' => 'required|string',
            'passport_number' => 'required|string',
        ]);

        $candidate = Candidate::where('first_name', $this->first_name)
            ->where('passport_number', $this->passport_number)
            ->first();

        if ($candidate) {
            session(['candidate_id' => $candidate->id]);
            return redirect()->route('candidate.welcome'); // exam page (we’ll build next)
        }

        $this->addError('login', 'Invalid details. Please try again.');
    }

    public function render()
    {
        return view('livewire.candidate-login');
    }
}
