<x-app-layout>
<!-- resources/views/resume/create.blade.php -->



<section id="resume-form" class="py-8">
    <div class="container mx-auto">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="text-4xl font-bold text-center mb-8">Create Your Resume</h2>
        <form action="{{ route('resume.store') }}" method="POST">
            @csrf

            <!-- User Details -->
            <div class="mb-8">
                <h3 class="text-2xl font-semibold mb-4">Personal Information</h3>
                    <!-- <div class="mb-4">
                        <label for="name" class="block text-lg font-medium">Name</label>
                        <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-lg font-medium">Email</label>
                        <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded" value="{{ old('email') }}" required>
                    </div> -->
                <div class="mb-4">
                    <label for="phone" class="block text-lg font-medium">Phone</label>
                    <input type="text" id="phone" name="phone" class="w-full p-2 border border-gray-300 rounded" value="{{ old('phone') }}" required>
                </div>
                <div class="mb-4">
                    <label for="address" class="block text-lg font-medium">Address</label>
                    <input type="text" id="address" name="address" class="w-full p-2 border border-gray-300 rounded" value="{{ old('address') }}" required>
                </div>
                <div class="mb-4">
                    <label for="summary" class="block text-lg font-medium">Summary</label>
                    <textarea id="summary" name="summary" class="w-full p-2 border border-gray-300 rounded" required>{{ old('summary') }}</textarea>
                </div>
            </div>

            <!-- Education Details -->
            <div class="mb-8">
                <h3 class="text-2xl font-semibold mb-4">Education</h3>
                <div id="education-section">
                    <div class="education-item mb-4">
                        <div class="mb-2">
                            <label for="degree" class="block text-lg font-medium">Degree</label>
                            <input type="text" id="degree" name="educations[0][degree]" class="w-full p-2 border border-gray-300 rounded" required>
                        </div>
                        <div class="mb-2">
                            <label for="institution" class="block text-lg font-medium">Institution</label>
                            <input type="text" id="institution" name="educations[0][institution]" class="w-full p-2 border border-gray-300 rounded" required>
                        </div>
                        <div class="mb-2">
                            <label for="year" class="block text-lg font-medium">Year</label>
                            <input type="text" id="year" name="educations[0][year]" class="w-full p-2 border border-gray-300 rounded" required>
                        </div>
                        <div class="mb-2">
                            <label for="description" class="block text-lg font-medium">Description</label>
                            <textarea id="description" name="educations[0][description]" class="w-full p-2 border border-gray-300 rounded" required></textarea>
                        </div>
                        <button type="button" class="remove-education bg-red-500 text-white px-4 py-2 rounded">Remove</button>
                    </div>
                </div>
                <button type="button" id="add-education" class="bg-green-500 text-white px-4 py-2 rounded">Add Education</button>
            </div>

            <!-- Experience Details -->
            <div class="mb-8">
                <h3 class="text-2xl font-semibold mb-4">Professional Experience</h3>
                <div id="experience-section">
                    <div class="experience-item mb-4">
                        <div class="mb-2">
                            <label for="title" class="block text-lg font-medium">Title</label>
                            <input type="text" id="title" name="experiences[0][title]" class="w-full p-2 border border-gray-300 rounded" required>
                        </div>
                        <div class="mb-2">
                            <label for="company" class="block text-lg font-medium">Company</label>
                            <input type="text" id="company" name="experiences[0][company]" class="w-full p-2 border border-gray-300 rounded" required>
                        </div>
                        <div class="mb-2">
                            <label for="duration" class="block text-lg font-medium">Duration</label>
                            <input type="text" id="duration" name="experiences[0][duration]" class="w-full p-2 border border-gray-300 rounded" required>
                        </div>
                        <div class="mb-2">
                            <label for="description" class="block text-lg font-medium">Description</label>
                            <textarea id="description" name="experiences[0][description]" class="w-full p-2 border border-gray-300 rounded" required></textarea>
                        </div>
                        <button type="button" class="remove-experience bg-red-500 text-white px-4 py-2 rounded">Remove</button>
                    </div>
                </div>
                <button type="button" id="add-experience" class="bg-green-500 text-white px-4 py-2 rounded">Add Experience</button>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
            </div>
        </form>
    </div>
</section>


@section('scripts')
<script>
    document.getElementById('add-education').addEventListener('click', function() {
        const educationSection = document.getElementById('education-section');
        const educationCount = educationSection.querySelectorAll('.education-item').length;
        const newEducation = `
            <div class="education-item mb-4">
                <div class="mb-2">
                    <label for="degree" class="block text-lg font-medium">Degree</label>
                    <input type="text" id="degree" name="educations[${educationCount}][degree]" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-2">
                    <label for="institution" class="block text-lg font-medium">Institution</label>
                    <input type="text" id="institution" name="educations[${educationCount}][institution]" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-2">
                    <label for="year" class="block text-lg font-medium">Year</label>
                    <input type="text" id="year" name="educations[${educationCount}][year]" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-2">
                    <label for="description" class="block text-lg font-medium">Description</label>
                    <textarea id="description" name="educations[${educationCount}][description]" class="w-full p-2 border border-gray-300 rounded" required></textarea>
                </div>
                <button type="button" class="remove-education bg-red-500 text-white px-4 py-2 rounded">Remove</button>
            </div>
        `;
        educationSection.insertAdjacentHTML('beforeend', newEducation);
    });

    document.getElementById('education-section').addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-education')) {
            event.target.closest('.education-item').remove();
        }
    });

    document.getElementById('add-experience').addEventListener('click', function() {
        const experienceSection = document.getElementById('experience-section');
        const experienceCount = experienceSection.querySelectorAll('.experience-item').length;
        const newExperience = `
            <div class="experience-item mb-4">
                <div class="mb-2">
                    <label for="title" class="block text-lg font-medium">Title</label>
                    <input type="text" id="title" name="experiences[${experienceCount}][title]" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-2">
                    <label for="company" class="block text-lg font-medium">Company</label>
                    <input type="text" id="company" name="experiences[${experienceCount}][company]" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-2">
                    <label for="duration" class="block text-lg font-medium">Duration</label>
                    <input type="text" id="duration" name="experiences[${experienceCount}][duration]" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-2">
                    <label for="description" class="block text-lg font-medium">Description</label>
                    <textarea id="description" name="experiences[${experienceCount}][description]" class="w-full p-2 border border-gray-300 rounded" required></textarea>
                </div>
                <button type="button" class="remove-experience bg-red-500 text-white px-4 py-2 rounded">Remove</button>
            </div>
        `;
        experienceSection.insertAdjacentHTML('beforeend', newExperience);
    });

    document.getElementById('experience-section').addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-experience')) {
            event.target.closest('.experience-item').remove();
        }
    });
</script>
</x-app-layout>