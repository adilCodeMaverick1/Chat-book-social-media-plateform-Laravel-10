<x-app-layout>
<div class="container">
    <h2>Edit Resume</h2>
    <form action="{{ route('resume.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Basic Information -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->additionalInfo->phone) }}" required>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $user->additionalInfo->address) }}" required>
        </div>

        <div class="form-group">
            <label for="summary">Summary</label>
            <textarea name="summary" class="form-control" required>{{ old('summary', $user->additionalInfo->summary) }}</textarea>
        </div>

        <!-- Education -->
        <div class="form-group">
            <label>Education</label>
            @foreach($user->educations as $education)
                <div class="education-item">
                    <label for="degree">Degree</label>
                    <input type="text" name="educations[{{ $loop->index }}][degree]" class="form-control" value="{{ old('educations.'.$loop->index.'.degree', $education->degree) }}" required>

                    <label for="institution">Institution</label>
                    <input type="text" name="educations[{{ $loop->index }}][institution]" class="form-control" value="{{ old('educations.'.$loop->index.'.institution', $education->institution) }}" required>

                    <label for="year">Year</label>
                    <input type="text" name="educations[{{ $loop->index }}][year]" class="form-control" value="{{ old('educations.'.$loop->index.'.year', $education->year) }}" required>

                    <label for="description">Description</label>
                    <textarea name="educations[{{ $loop->index }}][description]" class="form-control" required>{{ old('educations.'.$loop->index.'.description', $education->description) }}</textarea>
                </div>
            @endforeach
        </div>

        <!-- Experience -->
        <div class="form-group">
            <label>Experience</label>
            @foreach($user->experiences as $experience)
                <div class="experience-item">
                    <label for="title">Title</label>
                    <input type="text" name="experiences[{{ $loop->index }}][title]" class="form-control" value="{{ old('experiences.'.$loop->index.'.title', $experience->title) }}" required>

                    <label for="company">Company</label>
                    <input type="text" name="experiences[{{ $loop->index }}][company]" class="form-control" value="{{ old('experiences.'.$loop->index.'.company', $experience->company) }}" required>

                    <label for="duration">Duration</label>
                    <input type="text" name="experiences[{{ $loop->index }}][duration]" class="form-control" value="{{ old('experiences.'.$loop->index.'.duration', $experience->duration) }}" required>

                    <label for="description">Description</label>
                    <textarea name="experiences[{{ $loop->index }}][description]" class="form-control" required>{{ old('experiences.'.$loop->index.'.description', $experience->description) }}</textarea>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Update Resume</button>
    </form>
</div>
</x-app-layout>