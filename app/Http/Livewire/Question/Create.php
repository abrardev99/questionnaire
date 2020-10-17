<?php

namespace App\Http\Livewire\Question;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public Questionnaire $questionnaire;

    public int $questionsInputsCounter = 1;
    public int $choicesCounter = 2;
    public $questionType = [1 => 0];
    public $questionText;
    public $freeTextAns, $singleOptionAns, $multiOptionAns;
    public $singleCorrect, $multiCorrect;

    public function rules()
    {
        return [
            'questionType' => ['required'],
            'questionType.*' => ['required', Rule::in([1, 2, 3])],
            'questionText' => ['required',],
            'questionText.*' => ['required',],
        ];
    }

    public function addQuestionInputs()
    {
        $this->questionsInputsCounter++;
        array_push($this->questionType, 0);
    }

    public function addChoice(){$this->choicesCounter++;}

    public function deleteChoice()
    {
        unset($this->singleOptionAns[$this->choicesCounter]);
        $this->choicesCounter--;
    }

    public function deleteQuestion()
    {
        unset($this->questionText[$this->questionsInputsCounter]);
        $this->questionsInputsCounter--;
    }

    public function save()
    {
        $this->validate();

        foreach ($this->questionType as $key => $value) {
            $question = new  Question(['type' => $this->questionType[$key], 'question' => $this->questionText[$key]]);
            $this->questionnaire->questions()->save($question);

            $this->saveAnswers($key, $question);
        }

        session()->flash('status', 'Question(s) Added Successfully');
        return redirect()->route('questionnaire.index');
    }
    
    public function saveAnswers(int $key, Question $question): void
    {
//        save free text
        if ($this->questionType[$key] == 1) {
            $this->validate(
                [
                    'freeTextAns' => ['required'],
                    'freeTextAns.*' => ['required'],
                ]
            );
            foreach ($this->freeTextAns as $i => $val) {
                $answer = new Answer(['answer' => $this->freeTextAns[$i]]);
                $question->answers()->save($answer);
            }
        }

//        save single option
        if ($this->questionType[$key] == 2) {
            $this->validate(
                [
                    'singleOptionAns' => ['required'],
                    'singleOptionAns.*' => ['required'],
                ]
            );

            foreach (collect($this->singleOptionAns)->flatten() as $answer) {
                $question->answers()->save(new Answer(['answer' => $answer]));
            }
        }

//        save multiple option
        if ($this->questionType[$key] == 3) {
            $this->validate(
                [
                    'multiOptionAns' => ['required'],
                    'multiOptionAns.*' => ['required'],
                ]
            );

            foreach (collect($this->multiOptionAns)->flatten() as $answer) {
                $question->answers()->save(new Answer(['answer' => $answer]));
            }
        }
    }

}
