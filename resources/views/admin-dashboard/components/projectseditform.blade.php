<h1>Edit Project</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('projects.update', ['slug' => $project->slug]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Slug -->
    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $project->slug) }}" required>
    </div>

    <!-- Logo Upload -->
    <div class="mb-3">
        <label for="logo" class="form-label">Project Logo</label>
        <input type="file" class="form-control" id="logo" name="logo">
        @if($project->logo)
            <img src="{{ asset( $project->logo) }}" alt="Project Logo" class="img-thumbnail mt-2" width="100">
        @endif
    </div>

    <!-- Colors -->
    <div class="mb-3">
        <label for="colors" class="form-label">Project Colors</label>
        <input type="text" class="form-control" id="colors" name="colors" value="{{ old('colors', json_encode($project->colors)) }}" placeholder='["#E8BC05", "#17a2b8"]'>
    </div>

    <!-- Project Description -->
    <div class="mb-3">
        <label for="project_description" class="form-label">Description</label>
        <textarea class="form-control" id="project_description" name="project_description" rows="4" required>{{ old('project_description', $project->project_description) }}</textarea>
    </div>

    <!-- Estimated Budget -->
    <div class="mb-3">
        <label for="estimated_budget" class="form-label">Estimated Budget ($)</label>
        <input type="number" step="0.01" class="form-control" id="estimated_budget" name="estimated_budget" value="{{ old('estimated_budget', $project->estimated_budget) }}" required>
    </div>

    <!-- Uploaded Files -->
    <div class="mb-3">
        <label for="uploaded_files" class="form-label">Fichiers téléchargés</label>
        <input type="file" class="form-control" id="uploaded_files" name="uploaded_files[]" multiple>
        @if(!empty($uploadedFiles))
            <ul class="mt-2">
                @foreach($uploadedFiles as $file)
                    <li>
                        <a href="{{ asset('storage/' . $file) }}" target="_blank">{{ basename($file) }}</a>
                        <input type="checkbox" name="delete_files[]" value="{{ $file }}"> Supprimer
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- Project Status -->
    <div class="mb-3">
        <label for="project_status" class="form-label">Project Status</label>
        <select class="form-control" id="project_status" name="project_status">
            <option value="pending" {{ old('project_status', $project->project_status) == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="in_progress" {{ old('project_status', $project->project_status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
            <option value="completed" {{ old('project_status', $project->project_status) == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
    </div>

    <!-- Start Date -->
    <div class="mb-3">
        <label for="start_date" class="form-label">Start Date</label>
        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $project->start_date->format('Y-m-d')) }}" required>
    </div>

    <!-- End Date -->
    <div class="mb-3">
        <label for="end_date" class="form-label">End Date</label>
        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $project->end_date->format('Y-m-d')) }}" required>
    </div>

    <button type="submit" class="btn btn-success">
        <i class="fas fa-save"></i> Save
    </button>
    <a href="{{ route('projects.show', ['slug' => $project->slug]) }}" class="btn btn-secondary">Cancel</a>
</form>