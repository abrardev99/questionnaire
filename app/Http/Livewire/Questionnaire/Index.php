<?php

namespace App\Http\Livewire\Questionnaire;

use App\Models\Questionnaire;
use Livewire\Component;

class Index extends Component
{
     public function destroy($questionnaireId)
    {
        Questionnaire::find($questionnaireId)->delete();
    }

    public function render()
    {
        $questionnaires = Questionnaire::with('questions')->orderByDesc('id')->get();
        return view('livewire.questionnaire.index', compact('questionnaires'));
    }
}
