<div>
    @for($choiceIndex=1;  $choiceIndex<=$singleChoicesCounter[$questionIndex]; $choiceIndex++)
        <div class="form-group row">
            <label for="single"
                   class="col-sm-4 col-form-label">Enter Choice {{ $choiceIndex }}</label>
            <div class="col-sm-5">
                <input wire:model.debounce.500ms="singleOptionAns.{{ $questionIndex }}.{{ $choiceIndex }}"
                       wire:key="single{{ $questionIndex }}{{ $choiceIndex }}"
                       type="text" class="form-control"
                       id="single" placeholder="Choice {{ $choiceIndex }}">
                <div wire:key="singleError{{ $questionIndex }}{{ $choiceIndex }}">
                    @error('singleOptionAns.'.$questionIndex.$choiceIndex)
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-1">
                <div class="form-check">
                    <input wire:model="singleCorrect"  wire:key="check{{ $questionIndex }}{{ $choiceIndex }}" class="form-check-input"
                           type="radio" name="canResume" id="gridRadios1" value="{{ $choiceIndex }}">
                    <label class="form-check-label" for="gridRadios1">
                        Correct
                    </label>
                </div>
            </div>
            <div class="col-sm-2">
                @if($choiceIndex > 2)
                    <div class="form-check">
                        <div class="form-check-label">
                            <button role="button"
                                    wire:click.prevent="deleteChoice({{ $questionIndex }})"
                                    class="btn btn-link text-danger">Delete
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endfor
    <div class="form-group row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="btn-group" role="group">
                <button wire:click.prevent="addChoice({{ $questionIndex }})" type="button"
                        class="btn btn-link">Add New Choice
                </button>
            </div>
        </div>
    </div>
</div>
