<div class="container mt-5 d-flex justify-content-center">
    <div class="card" style="width: 45%; max-width: 950px; border-radius: 20px; box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2); margin-bottom: 40px;">
        <div class="card-header text-center text-white" style="border-radius: 20px 20px 0 0; background-image: url('{{ asset($project->logo) }}'); background-size: cover; background-position: center; height: 200px;"></div>
        
        <div class="card-body text-center">
            <div class="project-details">
                <h6 class="text-shadow" style="font-size: 26px;">{{ $project->slug }}</h6>
                <p style="font-size: 18px;"><strong>Company:</strong> {{ $project->company->company_name ?? 'Not defined' }}</p>
                <p style="font-size: 18px;"><strong>Description:</strong> {{ $project->project_description }}</p>
                <p style="font-size: 18px;"><strong>Budget:</strong> {{ number_format($project->estimated_budget, 2, ',', ' ') }} MAD</p>
                <p style="font-size: 18px;"><strong>Status:</strong> {{ ucfirst($project->project_status) }}</p>
                <p style="font-size: 18px;"><strong>Start:</strong> {{ $project->start_date->format('d/m/Y') }}</p>
                <p style="font-size: 18px;"><strong>End:</strong> {{ $project->end_date?->format('d/m/Y') ?? 'Not defined' }}</p>
            </div>
            
            <div class="d-flex flex-column align-items-center mb-3" style="font-size: 18px;">
                <strong>Colors:</strong>
                <div class="d-flex gap-2 mt-2">
                    @foreach($project->colors as $color)
                        <span class="color" style="width: 40px; height: 40px; border-radius: 50%; background-color: {{ $color }}; border: 1px solid #ddd;"></span>
                    @endforeach
                </div>
            </div>
            
            <div class="d-flex flex-column align-items-center mb-4" style="font-size: 18px;">
                <strong>Files:</strong>
                <div class="d-flex gap-3 mt-2">
                    @foreach($project->uploaded_files as $index => $file)
                        <a href="{{ asset($file) }}" target="_blank" class="text-decoration-none text-primary">Fichier {{ $index + 1 }}</a>
                    @endforeach
                </div>
            </div>
            
            <a href="{{ route('projects.index') }}" class="btn btn-warning w-100" style="font-size: 18px;">Back</a>
        </div>
    </div>
</div>

<style>
    .container {
        font-family: Arial, sans-serif;
        background-color: #f4f6f9;
        padding: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .card {
        margin-bottom: 40px;
    }

    .card-body {
        font-size: 18px;
        color: #333;
    }

    .project-details p {
        font-size: 18px;
        margin: 12px 0;
    }

    .colors span {
        width: 40px;
        height: 40px;
    }

    .files a:hover {
        text-decoration: underline;
    }

    .btn-warning {
        background-color: #f39c12;
        border-color: #e67e22;
        padding: 14px 24px;
        border-radius: 10px;
        font-size: 18px;
    }

    .btn-warning:hover {
        background-color: #e67e22;
        border-color: #f39c12;
    }
</style>
