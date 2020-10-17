<div class="form-group row">
    <label for="freetext" class="col-sm-4 col-form-label">Answer</label>
    <div class="col-sm-8">
        <input wire:model.debounce.500ms="freeTextAns.{{ $questionIndex }}"
               wire:key="freetext{{ $questionIndex }}"
               type="text" class="form-control"
               id="freetext" placeholder="Free Text Answer">
        <div wire:key="freetextError{{ $questionIndex }}">
            @error('freeTextAns.'.$questionIndex)
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
