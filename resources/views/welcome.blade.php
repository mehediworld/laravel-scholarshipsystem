<x-navbar>
    <div id="landing-page" class="container-fluid" style="margin-top: 60px; height: 100vh;">
        <div class="row">
            <div class="col-6" style="margin-top: 100px">

                <div class="mt-5 text-center" style="color: #2f4550">
                    <h1 style="font-size: 45px;"><strong>SEARCH <span
                                style="color: #ffc53a; font-size: 50px">SCHOLARSHIP</span> <br> OPPORTUNITIES AROUND
                            <br> YOUR CITY</strong></h1>
                </div>
                <div class="text-dark text-center">
                    <h4><i>Pursue your dreams and make your dreams come true!</i></h4>
                </div>
                @if (Auth::user())
                    <div class="d-flex justify-content-center">
                        <div>
                            <a href="/apply" class="btn mt-4" style="background-color: #ffc53a;">
                                <b>Apply Now!</b>
                            </a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center ms-3 mt-2">
                        @php
                                $application = Illuminate\Support\Facades\DB::table('applications')
                            ->where('status', 'On-going')
                            ->first();
                            if (!$application == null) {
                            echo "<p class='fw-bold text-dark text-decoration-none mt-4'>"."Open: " . date('F j, Y', strtotime($application->start_date))
                                ."<br>Until: ". date('F j, Y', strtotime($application->end_date )). "</p>";
                            }else {
                                echo "<p class='fw-bold text-danger text-decoration-none mt-4 me-3'>Closed</p>";
                            }
                        @endphp
                    </div>

                @else
                    <div class="d-flex justify-content-center">
                        <div>
                            <a href="" class="btn mt-4" data-bs-toggle="modal" data-bs-target="#signinModal" style="background-color: #ffc53a;">
                                <b>Apply Now!</b>
                            </a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center ms-3 mt-2">
                        @php
                                $application = Illuminate\Support\Facades\DB::table('applications')
                            ->where('status', 'On-going')
                            ->first();
                            if (!$application == null) {
                            echo "<p class='fw-bold text-dark text-decoration-none mt-4'>"."Open: " . date('F j, Y', strtotime($application->start_date))
                                ."<br>Until: ". date('F j, Y', strtotime($application->end_date )). "</p>";
                            }else {
                                echo "<p class='fw-bold text-danger text-decoration-none mt-4 me-3'>Closed</p>";
                            }
                        @endphp
                    </div>
                @endif

            </div>
            <div class="col-6" style="margin-top: 100px">

                <div>
                    <img class="float-end ms-3" src="{{ asset('storage/img/banner-img.png') }}" alt="">
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid mt-5 h-100">
        <div class="row">
            <div class="col-6">

            </div>
            <div class="col-6">
                <div class="container">
                    <p style="font-size: 20px">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex perferendis
                        tempore molestiae minima? Corrupti vel odio tempore ipsam ipsum quasi cum culpa. Omnis optio
                        porro enim eos cumque iste dolorem velit, fugit quis delectus inventore aspernatur ratione quasi
                        aut cum. Labore inventore nemo minima nam laboriosam numquam magni assumenda. Ipsa. Lorem ipsum,
                        dolor sit amet consectetur adipisicing elit. Veritatis, fugiat?</p>
                </div>

            </div>
        </div>
        <div class="row" style="margin-top: 100px">
            <div class="col-6">
                <div class="container">
                    <p style="font-size: 20px">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex perferendis
                        tempore molestiae minima? Corrupti vel odio tempore ipsam ipsum quasi cum culpa. Omnis optio
                        porro enim eos cumque iste dolorem velit, fugit quis delectus inventore aspernatur ratione quasi
                        aut cum. Labore inventore nemo minima nam laboriosam numquam magni assumenda. Ipsa.</p>
                </div>
            </div>
            <div class="col-6">


            </div>
        </div>
        <div class="row">
            <div class="col-6">

            </div>
            <div class="col-6">
                <div class="container">
                    <p style="font-size: 20px">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex perferendis
                        tempore molestiae minima? Corrupti vel odio tempore ipsam ipsum quasi cum culpa. Omnis optio
                        porro enim eos cumque iste dolorem velit, fugit quis delectus inventore aspernatur ratione quasi
                        aut cum. Labore inventore nemo minima nam laboriosam numquam magni assumenda. Ipsa. Lorem ipsum,
                        dolor sit amet consectetur adipisicing elit. Veritatis, fugiat?</p>
                </div>

            </div>
        </div>

</x-navbar>
