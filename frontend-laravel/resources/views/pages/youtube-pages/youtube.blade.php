@extends('layout.navbar')
<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
        <a href="/
            " class="navbar-brand d-flex d-lg-none me-4">
            <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
        </a>
        <a href="#" class="sidebar-toggler flex-shrink-0">
            <i class="fa fa-bars"></i>
        </a>
        <div class="navbar-nav align-items-center ms-auto">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                    <span class="d-none d-lg-inline-flex">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
    
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Search Start -->
    <div class="search-bar">
        <form action="youtube-crawl" method="GET">
            @csrf
            <div class="font">
                <label for="video_id" class="form-label">Your YouTube link !</label>
            </div>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon3">https://www.youtube.com/watch?v=</span>
                <input type="text" class="form-control" id="video_id" name="video_id" aria-describedby="basic-addon3">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <br>
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
    </div>
    <!-- Search End -->

    <!-- Analysis Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-9">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Detail Analysis</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Comment</th>
                                    <th scope="col">Sentiment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($youtube as $index => $data)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $data['updated_at'] }}</td>
                                    <td>{{ $data['comment'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xl-3">
                <div class="col">
                    <div class="bg-light rounded h-80 p-4">
                        <h6 class="mb-4">Doughnut Chart</h6>
                        <canvas id="doughnut-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Analysis End -->
</div>
<!-- Content End -->