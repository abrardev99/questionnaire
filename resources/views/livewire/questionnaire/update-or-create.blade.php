<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $editMode ? 'Edit' : 'New' }}</div>
                    <div class="card-body">
                        <form wire:submit.prevent="save">

                            <div class="form-group row">
                                <label for="questionnaire" class="col-sm-4 col-form-label">Questionnaire Name</label>
                                <div class="col-sm-8">
                                    <input wire:model.debounce.500ms="questionnaire.name" type="text" class="form-control"
                                           id="questionnaire" placeholder="Questionnaire">

                                    <div wire:key="error">
                                    @error('questionnaire.name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="duration" class="col-sm-4 col-form-label">Duration</label>
                                <div class="col-sm-4">
                                    <select wire:model="questionnaire.duration_hour" id="duration"
                                            class="custom-select custom-select-sm">
                                        <option value="0" disabled>Hours</option>
                                        @foreach(\App\Models\Questionnaire::HOUR as $value => $label )
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('questionnaire.duration_hour')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <select wire:model="questionnaire.duration_min" id="duration"
                                            class="custom-select custom-select-sm">
                                        <option value="0" disabled>Minutes</option>
                                        @foreach(\App\Models\Questionnaire::MIN as $value => $label )
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('questionnaire.duration_min')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-4 pt-0">Can Resume</legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input wire:model="questionnaire.can_resume" class="form-check-input"
                                                   type="radio" name="canResume" id="gridRadios1" value="1">
                                            <label class="form-check-label" for="gridRadios1">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input wire:model="questionnaire.can_resume" class="form-check-input"
                                                   type="radio" name="canResume" id="gridRadios2" value="0">
                                            <label class="form-check-label" for="gridRadios2">
                                                No
                                            </label>
                                        </div>
                                        @error('questionnaire.can_resume')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset>

                            <div class="form-group row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8">
                                    <div class="form-check">
                                        <input wire:model="questionnaire.published" class="form-check-input"
                                               type="checkbox" id="publish">
                                        <label class="form-check-label" for="publish">
                                            Publish Now
                                        </label>
                                    </div>
                                    @error('questionnaire.published')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
