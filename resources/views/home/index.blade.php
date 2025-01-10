@extends('masterlayout.home')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
@endpush

@section('content')

    <div class="hero-section bg-dark text-white py-5 mb-5">
        <div class="container text-center">
            <h1 class="display-4 animated fadeIn">Discover Your Ideal Friend!</h1>
            <p class="lead animated fadeIn mt-3">
                Find friends who share their job expereinces. Explore, connect, and enjoy meaningful friendships.
            </p>
            <a href="{{ route('home.filter') }}" class="btn btn-success px-4 py-2 mt-4 animated fadeInUp">Start Now</a>
        </div>
    </div>

    <div class="search-bar bg-primary py-4">
        <div class="container">
            <form action="{{ route('filter.search') }}" method="POST">
                @csrf
                <div class="row align-items-center">
                    <div class="col-lg-4 mb-3">
                        <input type="text" name="name" id="search-name" class="form-control border-0"
                            placeholder="Enter Name" value="{{ request('name') }}">
                    </div>
                    <div class="col-lg-4 mb-3">
                        <select class="form-select border-0" name="gender" id="gender-filter">
                            <option disabled selected>Select Gender</option>
                            <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <select class="form-control" name="work[]" id="work-filter" multiple="multiple">
                            @foreach ($works as $work)
                                <option value="{{ $work->id }}"
                                    {{ in_array($work->id, request('work', [])) ? 'selected' : '' }}>{{ $work->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-dark px-5">Search</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Suggestions Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Friend Suggestions</h2>
        <div class="row">
            @forelse ($friendSuggestions as $friend)
                <div class="col-md-6 mb-4">
                    <div class="card p-3 shadow">
                        <div class="d-flex align-items-center">
                            <img src="{{ $friend->account_visible == 0 ? asset($friend->bear_image) : ($friend->profile_image ? asset('storage/' . $friend->profile_image) : asset('img/default-avatar.png')) }}" 
                                alt="Friend Profile" class="rounded-circle" style="width: 60px; height: 60px;">
                            <div class="ms-3">
                                <h5 class="mb-1">{{ $friend->name }}</h5>
                                <div class="d-flex flex-wrap">
                                    @foreach ($friend->works->take(3) as $work)
                                        <form action="{{ route('filter.search') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="work[]" value="{{ $work->id }}">
                                            <button class="badge bg-primary border-0 me-2">{{ $work->name }}</button>
                                        </form>
                                    @endforeach
                                    @if ($friend->work->count() > 3)
                                        <form action="{{ route('filter.search') }}" method="POST" class="d-inline">
                                            @csrf
                                            @foreach ($friend->works as $work)
                                                <input type="hidden" name="work[]" value="{{ $work->id }}">
                                            @endforeach
                                            <button class="badge bg-secondary border-0">+{{ $friend->works->count() - 3 }}</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <button class="btn btn-outline-danger me-2" onclick="handleLike({{ $friend->id }})">
                                <i class="fa-regular fa-heart" id="heart-icon-{{ $friend->id }}"></i>
                            </button>
                            <a href="{{ route('home.detail', $friend->id) }}" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">No suggestions available at the moment.</p>
            @endforelse
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        const likeUrlTemplate = `{{ route('friend.sendRequest', ['friend' => ':friendId']) }}`;

        $(document).ready(() => {
            $('#work-filter').select2({
                placeholder: 'Choose Jobs',
                allowClear: true
            });
        });

        async function handleLike(friendId) {
            const likeIcon = document.getElementById(`heart-icon-${friendId}`);
            const url = likeUrlTemplate.replace(':friendId', friendId);

            likeIcon.classList.add('fa-spinner', 'fa-spin');
            likeIcon.classList.remove('fa-heart');

            try {
                const response = await fetch(url, { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
                const result = await response.json();

                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: result.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                } else {
                    throw new Error(result.message);
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: error.message,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
            } finally {
                likeIcon.classList.remove('fa-spinner', 'fa-spin');
                likeIcon.classList.add('fa-heart');
            }
        }
    </script>
@endpush
