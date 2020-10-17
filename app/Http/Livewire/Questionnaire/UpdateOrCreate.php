<?php

namespace App\Http\Livewire\Questionnaire;

use App\Models\Questionnaire;
use Illuminate\Validation\Rule;
use Livewire\Component;
use function PHPUnit\Framework\isEmpty;

class UpdateOrCreate extends Component
{
    public $editMode = false;
    public Questionnaire $questionnaire;

    public function rules()
    {
        return [
            'questionnaire.name' => ['required'],
            'questionnaire.duration_hour' => ['required', Rule::in(Questionnaire::HOUR)],
            'questionnaire.duration_min' => ['required', Rule::in(Questionnaire::MIN)],
            'questionnaire.can_resume' => ['required', Rule::in([true, false])],
            'questionnaire.published' => ['required', Rule::in([0,1])],
        ];
    }

    protected $validationAttributes = [
        'questionnaire.can_resume' => 'Can Resume',
        'questionnaire.duration_hour' => 'Hour Duration',
        'questionnaire.duration_min' => 'Minute Duration',
    ];

    public function mount($questionnaire = null)
    {
        $this->questionnaire = $this->getQuestionnaire($questionnaire);
    }

    public function getQuestionnaire($questionnaire)
    {
        if ($questionnaire !== null){
            $this->editMode = true;
            return $questionnaire;
        }
        return Questionnaire::make(['duration_hour' => 0, 'duration_min' => 0, 'can_resume' => 0, 'published' => 1]);
    }

    public function save()
    {
        $this->validate();
        auth()->user()->questionnaires()->save($this->questionnaire);
        session()->flash('status', 'Questionnaire Added Successfully');
        return redirect()->route('questionnaire.index');
    }
}
