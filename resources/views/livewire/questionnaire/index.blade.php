<div>
    <div class="container">
        <div class="row mb-2 justify-content-end">
            <div class="col-1">
                <a href="{{ route('questionnaire.create') }}"><button type="button" class="btn btn-primary">New</button></a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-header">Questionnaire</div>
                    <div class="card-body">
                           <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col"># of Questions</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Resumeable</th>
                                    <th scope="col">Published</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($questionnaires as $questionnaire)
                                    <tr>
                                        <th scope="row">{{ $questionnaire->id }}</th>
                                        <td>{{ $questionnaire->name }}</td>
                                        <td>{{ $questionnaire->questions->count() }} | <a href="{{ route('question.create', $questionnaire->id) }}" type="button" class="btn btn-sm btn-link">Add</a></td>
                                        <td>{{ $questionnaire->duration_for_human }}</td>
                                        <td>{{ $questionnaire->resume_for_human }}</td>
                                        <td>{{ $questionnaire->published_for_human }}</td>
                                        <td><div class="btn-group" role="group">
                                                <a href="{{ route('questionnaire.create', $questionnaire->id) }}"><button type="button" class="btn btn-sm btn-primary">Edit</button></a>
                                                <button wire:click="destroy({{ $questionnaire->id }})" onclick="return confirm('Are you sure ?') || event.stopImmediatePropagation();" type="button" class="btn btn-sm btn-danger">Delete</button>
                                              </div></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7">No Data Found</td></tr>
                                @endforelse

                                </tbody>
                            </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
