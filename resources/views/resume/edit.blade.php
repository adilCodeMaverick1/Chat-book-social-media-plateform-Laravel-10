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

            <div class="flex justify-center">
                <button type="submit" class="flex items-center bg-lime-500 hover:bg-lime-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    <svg viewBox="0 -0.5 25 25" height="20px" width="20px" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                        <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" d="M18.507 19.853V6.034C18.5116 5.49905 18.3034 4.98422 17.9283 4.60277C17.5532 4.22131 17.042 4.00449 16.507 4H8.50705C7.9721 4.00449 7.46085 4.22131 7.08577 4.60277C6.7107 4.98422 6.50252 5.49905 6.50705 6.034V19.853C6.50737 20.1208 6.59163 20.3816 6.7495 20.5988C6.90738 20.8159 7.1306 20.9784 7.38634 21.059C7.64208 21.1396 7.91612 21.1337 8.168 21.041L12.507 19.404L16.846 21.041C16.9365 21.0723 17.0312 21.0871 17.126 21.0854C17.3432 21.0854 17.5532 21.0009 17.7128 20.8477C17.8724 20.6945 17.9707 20.4855 17.989 20.2602L18.507 19.853Z"/>
                    </svg>
                    Update Resume
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
