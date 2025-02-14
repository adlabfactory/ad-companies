<div class="container">
    <div class="header">
        <img src="{{ asset($project->logo) }}" alt="Profile Picture" class="w-100 object-fit-cover" style="height: 20%;">
        <h1>{{ $project->slug }}</h1>
    </div>
    
    <div class="project-details">
        <p><strong>Company:</strong> {{ $project->company->company_name ?? 'Not defined' }}</p>
        <p><strong>Description:</strong> {{ $project->project_description }}</p>
        <p><strong>Estimated Budget:</strong> {{ number_format($project->estimated_budget, 2, ',', ' ') }} MAD</p>
        <p><strong>Status:</strong> {{ ucfirst($project->project_status) }}</p>
        <p><strong>Start Date:</strong> {{ $project->start_date->format('d/m/Y') }}</p>
        <p><strong>End Date:</strong> {{ $project->end_date?->format('d/m/Y') ?? 'Not defined' }}</p>
        
        <div class="colors">
            <strong>Colors:</strong>
            <ul>
                @foreach($project->colors as $color)
                    <li style="background-color: {{ $color }};"></li>
                @endforeach
            </ul>
        </div>

        <div class="files">
            <strong>Uploaded Files:</strong>
            <ul>
                @foreach($project->uploaded_files as $file)
                    <li><a href="{{ asset($file) }}" target="_blank">{{ $file }}</a></li>
                @endforeach
            </ul>
        </div>

        <a href="{{ route('projects.index') }}" class="btn btn-primary">Back</a>
    </div>
</div>

<style>
    .container {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .header {
        text-align: center;
        margin-bottom: 30px;
    }

    .logo {
        max-width: 150px;
        margin-bottom: 20px;
    }

    h1 {
        font-size: 28px;
        color: #333;
        margin: 0;
    }

    .project-details p {
        font-size: 16px;
        margin: 10px 0;
        color: #555;
    }

    .project-details strong {
        font-weight: bold;
        color: #333;
    }

    .colors ul {
        display: flex;
        gap: 10px;
        padding: 0;
        list-style: none;
    }

    .colors li {
        width: 30px;
        height: 30px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .files ul {
        list-style: none;
        padding: 0;
    }

    .files li {
        font-size: 14px;
        margin: 5px 0;
    }

    .files a {
        text-decoration: none;
        color: #007bff;
    }

    .files a:hover {
        text-decoration: underline;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        text-align: center;
        display: inline-block;
        text-decoration: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
