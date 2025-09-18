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

        $candidate = Candidate::whereRaw('LOWER(first_name) = ?', [strtolower($this->first_name)])
            ->where('passport_number', $this->passport_number)
            ->first();

        if ($candidate) {
            session(['candidate_id' => $candidate->id]);
            return redirect()->route('candidate.welcome');
        }

        $this->addError('login', 'Invalid credentials. Please try again.');
    }

    public function render()
    {
        return view('livewire.candidate-login');
    }
}
