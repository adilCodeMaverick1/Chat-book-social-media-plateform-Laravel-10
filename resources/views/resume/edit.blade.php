<x-app-layout>
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4 text-center">Edit Resume</h2>
        <form action="{{ route('resume.update', $user) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')

            <!-- Basic Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div class="form-group">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                    <input type="text" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="form-group">
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Phone</label>
                    <input type="text" name="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('phone', $user->additionalInfo->phone) }}" required>
                </div>
                <div class="form-group">
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Address</label>
                    <input type="text" name="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('address', $user->additionalInfo->address) }}" required>
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="summary" class="block mb-2 text-sm font-medium text-gray-900">Summary</label>
                <textarea name="summary" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>{{ old('summary', $user->additionalInfo->summary) }}</textarea>
            </div>

            <!-- Education -->
            <div class="mb-4">
                <h3 class="text-xl font-bold mb-2">Education</h3>
                @foreach($user->educations as $education)
                <input type="hidden" name="educations[{{ $loop->index }}][id]" value="{{ $education->id }}">
                <div class="education-item mb-4 p-4 bg-gray-100 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
                        <div>
                            <label for="degree" class="block mb-2 text-sm font-medium text-gray-900">Degree</label>
                            <input type="text" name="educations[{{ $loop->index }}][degree]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('educations.'.$loop->index.'.degree', $education->degree) }}" required>
                        </div>
                        <div>
                            <label for="institution" class="block mb-2 text-sm font-medium text-gray-900">Institution</label>
                            <input type="text" name="educations[{{ $loop->index }}][institution]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('educations.'.$loop->index.'.institution', $education->institution) }}" required>
                        </div>
                        <div>
                            <label for="year" class="block mb-2 text-sm font-medium text-gray-900">Year</label>
                            <input type="text" name="educations[{{ $loop->index }}][year]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('educations.'.$loop->index.'.year', $education->year) }}" required>
                        </div>
                    </div>
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                        <textarea name="educations[{{ $loop->index }}][description]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>{{ old('educations.'.$loop->index.'.description', $education->description) }}</textarea>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Experience -->
            <div class="mb-4">
                <h3 class="text-xl font-bold mb-2">Experience</h3>
                @foreach($user->experiences as $experience)
                <input type="hidden" name="experiences[{{ $loop->index }}][id]" value="{{ $experience->id }}">
                <div class="experience-item mb-4 p-4 bg-gray-100 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
                        <div>
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                            <input type="text" name="experiences[{{ $loop->index }}][title]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('experiences.'.$loop->index.'.title', $experience->title) }}" required>
                        </div>
                        <div>
                            <label for="company" class="block mb-2 text-sm font-medium text-gray-900">Company</label>
                            <input type="text" name="experiences[{{ $loop->index }}][company]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('experiences.'.$loop->index.'.company', $experience->company) }}" required>
                        </div>
                        <div>
                            <label for="duration" class="block mb-2 text-sm font-medium text-gray-900">Duration</label>
                            <input type="text" name="experiences[{{ $loop->index }}][duration]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('experiences.'.$loop->index.'.duration', $experience->duration) }}" required>
                        </div>
                    </div>
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                        <textarea name="experiences[{{ $loop->index }}][description]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>{{ old('experiences.'.$loop->index.'.description', $experience->description) }}</textarea>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
