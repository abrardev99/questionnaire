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
    public int $questionsInputsCounter = Answer::InitialQuestions;
    public $singleChoicesCounter = [];
    public $multiChoicesCounter = [];
    public $questionType = [1 => 0];
    public $questionText = [1 => ''];
    public $freeTextAns, $singleOptionAns, $multiOptionAns;
    public $singleCorrect;
    public $multiCorrect = [1 => [1=>false, 2=>false]];

    public function rules()
    {
        return [
            'questionType' => ['required'],
            'questionType.*' => ['required', Rule::in([1, 2, 3])],
            'questionText' => ['required',],
            'questionText.*' => ['required',],
        ];
    }

    public function mount()
    {
        $this->multiChoicesCounter[$this->questionsInputsCounter] = Answer::InitialChoices;
        $this->singleChoicesCounter[$this->questionsInputsCounter] = Answer::InitialChoices;
    }

    public function addQuestionInputs()
    {
        $this->questionsInputsCounter++;
        array_push($this->questionType, 0);
        array_push($this->questionText, '');
        $this->multiCorrect[$this->questionsInputsCounter] = [1=>false, 2=>false];
        $this->multiChoicesCounter[$this->questionsInputsCounter] = Answer::InitialChoices;
        $this->singleChoicesCounter[$this->questionsInputsCounter] = Answer::InitialChoices;
    }

    public function deleteQuestion($questionIndex)
    {
        unset($this->questionText[$questionIndex]);
        $this->questionType = array_values($this->questionType);
        unset($this->questionType[$questionIndex]);
        $this->questionType = array_values($this->questionType);
        unset($this->multiCorrect[$questionIndex]);
        $this->multiCorrect = array_values($this->multiCorrect);
        $this->questionsInputsCounter--;
    }

    public function addChoice($questionIndex){
        $this->singleChoicesCounter[$questionIndex] = $this->singleChoicesCounter[$questionIndex] + 1;
    }

    public function deleteChoice($questionIndex)
    {
        unset($this->singleOptionAns[$this->singleChoicesCounter[$questionIndex]]);
        $this->singleChoicesCounter[$questionIndex] = $this->singleChoicesCounter[$questionIndex] - 1;

    }

    public function addMultiChoice($questionIndex){
        $this->multiCorrect[$questionIndex][$this->multiChoicesCounter[$questionIndex]] = false;
        $this->multiChoicesCounter[$questionIndex] = $this->multiChoicesCounter[$questionIndex] + 1;
    }

    public function deleteMultiChoice($questionIndex, $choiceIndex)
    {
        unset($this->multiCorrect[$questionIndex][$this->multiChoicesCounter[$questionIndex]]);
        $this->multiCorrect = array_values($this->multiCorrect);
        unset($this->multiOptionAns[$questionIndex][$this->multiChoicesCounter[$choiceIndex]]);
        $this->multiChoicesCounter[$questionIndex] = $this->multiChoicesCounter[$questionIndex] - 1;
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
                    'multiCorrect' => ['required'],
                ]
            );

            foreach (collect($this->multiOptionAns[$key])->flatten() as $key => $answer) {
                $question->answers()->save(new Answer(
                    [
                        'answer' => $answer, 'is_correct' => collect($this->multiCorrect)->flatten()[$key]

                    ]));
            }
        }
    }

}
