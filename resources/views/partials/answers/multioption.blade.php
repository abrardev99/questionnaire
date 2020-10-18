<div>
    @for($choiceIndex=1;  $choiceIndex<=$multiChoicesCounter[$questionIndex]; $choiceIndex++)
        <div  wire:key="main{{ $questionIndex }}{{ $choiceIndex }}">
        <div class="form-group row">
            <label for="multiOptionAns"
                   class="col-sm-4 col-form-label">Enter Choice {{ $choiceIndex }}</label>
            <div class="col-sm-5">
                <input wire:model.debounce.500ms="multiOptionAns.{{ $questionIndex }}.{{ $choiceIndex }}"
                       wire:key="multiOptionAns{{ $questionIndex }}{{ $choiceIndex }}"
                       type="text" class="form-control"
                       id="multiOptionAns" placeholder="Choice {{ $choiceIndex }}">
                <div wire:key="multiOptionAns{{ $questionIndex }}{{ $choiceIndex }}">
                    @error('multiOptionAns.'.$questionIndex.$choiceIndex)
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-1">
                <div class="form-check">
                    <input wire:model="multiCorrect.{{ $questionIndex }}.{{ $choiceIndex }}" wire:key="check{{ $questionIndex }}{{ $choiceIndex }}" class="form-check-input"
                           type="checkbox" id="multicheck" name="single">
                    <label class="form-check-label" for="multicheck">
                        Correct
                    </label>
                </div>
                <div wire:key="multicorrecterror{{ $questionIndex }}{{ $choiceIndex }}">
                    @error('multiCorrect.'.$questionIndex.$choiceIndex)
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-2">
                @if($choiceIndex > 2)
                    <div class="form-check">
                        <div class="form-check-label">
                            <button role="button"
                                    wire:click.prevent="deleteMultiChoice({{ $questionIndex}}, {{ $choiceIndex }})"
                                    class="btn btn-link text-danger">Delete
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        </div>
    @endfor
    <div class="form-group row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="btn-group" role="group">
                <button wire:click.prevent="addMultiChoice({{ $questionIndex }})" type="button"
                        class="btn btn-link">Add New Choice
                </button>
            </div>
        </div>
    </div>
</div>
