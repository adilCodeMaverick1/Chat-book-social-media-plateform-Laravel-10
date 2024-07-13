<x-app-layout>
<div class="container mx-auto mt-10">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        <div class="card mb-4 mb-lg-0">
            <div class="card-body p-0">
                <form action="{{ route('social-links.update', $socialLinks->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <ul class="list-group list-group-flush rounded-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <i class="fas fa-globe fa-lg text-warning"></i>
                            <input type="text" name="website" value="{{ $socialLinks->website ?? '' }}" class="form-control" placeholder="Website Link">
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                            <input type="text" name="github" value="{{ $socialLinks->github ?? '' }}" class="form-control" placeholder="GitHub Link">
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                            <input type="text" name="twitter" value="{{ $socialLinks->twitter ?? '' }}" class="form-control" placeholder="Twitter Link">
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                            <input type="text" name="instagram" value="{{ $socialLinks->instagram ?? '' }}" class="form-control" placeholder="Instagram Link">
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                            <input type="text" name="facebook" value="{{ $socialLinks->facebook ?? '' }}" class="form-control" placeholder="Facebook Link">
                        </li>
                    </ul>
                    <div class="flex items-center justify-between p-3">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Save Links
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>