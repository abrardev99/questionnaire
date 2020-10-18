<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-header">Create Questions</div>
                    <div class="card-body">

                        <form wire:submit.prevent="save">
                               @for($questionIndex=1;  $questionIndex<=$questionsInputsCounter; $questionIndex++)
                                <div class="form-group row">
                                    <label for="type" class="col-sm-4 col-form-label">Question Type</label>
                                    <div class="col-sm-5">
                                        <select wire:model="questionType.{{ $questionIndex }}" wire:key="questionType{{ $questionIndex }}"
                                                id="type"
                                                class="custom-select custom-select">
                                            <option value="0">Select Question Type</option>
                                            @foreach(\App\Models\Question::TYPE as $value => $label )
                                                <option value="{{ $value }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        <div wire:key="questionTypeError{{ $questionIndex }}">
                                            @error('questionType.'.$questionIndex)
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                    @if($questionIndex > 1)
                                        <div class="col-sm-3">
                                            <button role="button" wire:click.prevent="deleteQuestion({{ $questionIndex }})"
                                                    class="btn btn-link text-danger">Delete
                                            </button>
                                        </div>
                                    @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="question" class="col-sm-4 col-form-label">Question</label>
                                    <div class="col-sm-8">
                                        <input wire:model.debounce.500ms="questionText.{{ $questionIndex }}"
                                               wire:key="questionText{{ $questionIndex }}"
                                               type="text" class="form-control"
                                               id="question" placeholder="Question">
                                        <div wire:key="questionTextError{{ $questionIndex }}">
                                            @error('questionText.'.$questionIndex)
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    @if($questionType[$questionIndex] == 1)
                                        @include('partials.answers.freetext')
                                    @elseif($questionType[$questionIndex] == 2)
                                        @include('partials.answers.singleoption')
                                    @elseif($questionType[$questionIndex] == 3)
                                        @include('partials.answers.multioption')
                                    @else
                                        <p></p>
                                    @endif
                                </div>


                                <hr>
                            @endfor

                            <div class="form-group row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4">
                                    <div class="btn-group" role="group">
                                        <button wire:click.prevent="addQuestionInputs" type="button"
                                                class="btn btn-sm btn-primary">Add New Question
                                        </button>
                                        <button type="submit" class="btn btn-sm btn-success">Save</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
