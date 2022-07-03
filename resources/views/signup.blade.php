<x-navbar>
    <x-layout>
        <div class="container" style="width: 500px; margin-top: 100px">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h2>Sign up</h2>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form action="/users" method="post">
                                @csrf

                                <div>
                                    <label for="username">
                                        <h6>Username</h6>
                                    </label>
                                    <input class="form-control form-control" type="text" id="username"
                                        name="username" value="{{ old('username') }}">

                                    @error('username')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email">
                                        <h6>Email</h6>
                                    </label>
                                    <input class="form-control form-control" type="text" id="email"
                                        name="email" value="{{ old('email') }}">

                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password">
                                        <h6>Password</h6>
                                    </label>
                                    <input class="form-control form-control" type="password" id="password"
                                        name="password" value="{{ old('password') }}">

                                    @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password_confirmation">
                                        <h6>Confirm Password</h6>
                                    </label>
                                    <input class="form-control form-control" type="password" id="password_confirmation"
                                        name="password_confirmation" value="{{ old('password_confirmation') }}">

                                    @error('password_confirmation')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div>
                                        <button type="submit" class="btn btn-primary form-control form-control-lg mt-3">
                                            Sign up
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- LINK OF COORDINATOR REGISTRATION FORM, THIS SHOULD BE HIDDEN --}}
                    {{-- <a href="/coordinator">Coordinator Form</a> --}}

                </div>
            </div>
        </div>
    </x-layout>
</x-navbar>
<x-footer/>
