<style>
    
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .form-container {
        max-width: 600px;
        margin: 50px auto;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .form-header {
        text-align: center;
        padding: 20px;
    }

    .form-header img {
        max-width: 150px;
        height: auto;
        display: block;
        margin: 0 auto 15px;
    }

    .form-title {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .form-body {
        padding: 20px;
    }

    .form-control {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border: 1px solid #ced4da;
        border-radius: 8px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:hover,
    .form-control:focus {
        border-color: #ffda40;
        box-shadow: 0 0 5px rgba(255, 218, 64, 0.5);
        outline: none;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #333;
    }

    .color-box {
        width: 50px;
        height: 50px;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-right: 10px;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .color-box:hover {
        transform: scale(1.1);
    }

    .btn-primary {
        background: #ffda40;
        color: #000;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-primary:hover {
        background: #e0c800;
        transform: scale(1.05);
    }

    .text-danger {
        color: #dc3545;
        font-size: 14px;
    }
    #color-container {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .color-input-container {
        position: relative;
        display: inline-block;
    }

    .color-box {
        width: 40px;
        height: 40px;
        border: none;
        padding: 0;
        border-radius: 5px;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .add-btn {
        margin-top: 10px;
        padding: 8px 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }

    .add-btn:hover {
        background-color: #45a049;
    }

    .remove-btn {
        position: absolute;
        top: -8px;
        right: -8px;
        width: 20px;
        height: 20px;
        background-color: #FF6347;
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        font-size: 16px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .remove-btn:hover {
        background-color: #FF4500;
    }
</style>
@if(session('success'))
    <script>
        Swal.fire({
            title: "Good job!",
            text: "{{ session('success') }}",
            icon: "success",
            confirmButtonText: "Ok"
        });
    </script>
@endif

<div class="form-container">
    <div class="form-header">
        <!-- Logo -->
        <img src="https://adlabfactory.com/wp-content/uploads/2024/12/Adlab-dark-Logo-siteweb.png" alt="Adlab Factory Logo">
        <!-- Titre -->
        <h class="form-title">Add New Project</h>
    </div>
    <div class="form-body">
        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Slug -->
            <div>
                <label for="slug">Slug <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="Enter Slug" value="{{ old('slug') }}" required>
                @error('slug')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Logo -->
            <div>
                <label for="logo">Logo <span class="text-danger">*</span></label>
                <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" required>
                @error('logo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Colors -->
            <div>
                <label>Colors</label>
                <div id="color-container" style="display: flex; gap: 10px; flex-wrap: wrap; align-items: center;">
                    <div class="color-input-container">
                        <input type="color" class="color-box form-control-color" name="colors[]" title="Choose your color">
                    </div>
                    <!-- Bouton "+" placé dans la même ligne -->
                    <button type="button" id="add-color-btn" class="add-btn btn btn-warning" style="height: 40px; width: 40px; padding: 0; font-size: 24px; text-align: center; cursor: pointer; display: flex; align-items: center; justify-content: center;">+</button>
                </div>
            </div>

            <!-- Project Description -->
            <div>
                <label for="project_description">Project Description <span class="text-danger">*</span></label>
                <textarea class="form-control @error('project_description') is-invalid @enderror" id="project_description" name="project_description" rows="4">{{ old('project_description') }}</textarea>
                @error('project_description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Estimated Budget -->
            <div>
                <label for="estimated_budget">Estimated Budget</label>
                <input type="number" step="0.01" class="form-control @error('estimated_budget') is-invalid @enderror" id="estimated_budget" name="estimated_budget" value="{{ old('estimated_budget') }}">
                @error('estimated_budget')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Uploaded Files -->
            <div>
                <label for="uploaded_files">Uploaded Files</label>
                <input type="file" multiple class="form-control @error('uploaded_files.*') is-invalid @enderror" id="uploaded_files" name="uploaded_files[]">
                @error('uploaded_files.*')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Start Date -->
            <div>
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}">
                @error('start_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- End Date -->
            <div>
                <label for="end_date">End Date</label>
                <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date') }}">
                @error('end_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div style="text-align: center;">
                <button type="submit" class="btn-primary">Add Project</button>
            </div>
        </form>
    </div>
</div>
<script>
    const addButton = document.getElementById('add-color-btn');
    const colorContainer = document.getElementById('color-container');

    addButton.addEventListener('click', function() {
        const colorInputs = colorContainer.getElementsByTagName('input');
        if (colorInputs.length < 6) {
            const newInputContainer = document.createElement('div');
            newInputContainer.style.position = 'relative';

            const newInput = document.createElement('input');
            newInput.type = 'color';
            newInput.classList.add('color-box', 'form-control-color');
            newInput.name = 'colors[]';
            newInput.title = 'Choose your color';
            newInput.style.border = 'none';
            newInput.style.width = '40px';
            newInput.style.height = '40px';
            newInput.style.cursor = 'pointer';

            const removeButton = document.createElement('button');
            removeButton.innerHTML = '×';
            removeButton.style.position = 'absolute';
            removeButton.style.top = '-5px';
            removeButton.style.right = '-5px';
            removeButton.style.border = 'none';
            removeButton.style.backgroundColor = 'transparent';
            removeButton.style.color = 'red';
            removeButton.style.fontSize = '20px';
            removeButton.style.cursor = 'pointer';

            removeButton.addEventListener('click', function() {
                newInputContainer.remove();
                if (colorInputs.length <= 6) {
                    addButton.disabled = false;
                }
            });

            newInputContainer.appendChild(newInput);
            newInputContainer.appendChild(removeButton);
            colorContainer.insertBefore(newInputContainer, addButton);
        }

        if (colorInputs.length >= 6) {
            addButton.disabled = true;
        }
    });
</script>