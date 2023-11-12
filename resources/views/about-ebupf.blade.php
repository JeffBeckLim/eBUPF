@extends('home-components.home-layout')

@section('content')
<div class="container mt-5">
    <div style="height: 90vh" class="get-to-know">
        <div class="row">
            <div class="col-md-6 fs-3 fw-bold mb-3" style="color: #00638D;">
                Get to know how <span style="color: #FF6F18;">e</span>BUPF system started and had been developed.
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div id="imageSlider" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" style="width: 100%; height: auto; object-fit: cover;">
                        <div class="carousel-item active">
                            <img src="{{asset('assets/picture-1.png')}}" class="d-block w-100" alt="Image 1">
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('assets/picture-1.png')}}" class="d-block w-100" alt="Image 2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('assets/picture-1.png')}}" class="d-block w-100" alt="Image 3">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 fs-5 p-3" style="text-align: justify;">
                &emsp;&emsp; &emsp; eBUPF began as an idea offered by our capstone advisor Mr. Noli B. Lucila in February 2023. What initially began as an idea evolved into our Capstone Project following with the approval of the Executive Director of BUPF Atty. Loyd P. Casasis. Throughout the development journey, the indispensable contributions of the BUPF staff Ma’am Shirlyn A. Villanueva and Ma’am Kathy Mae D. Galicia played a pivotal role, ensuring the system's design and functionality aligned seamlessly with the unique needs of the organization. This collaborative effort transformed an initial concept into a practical and efficient tool that promises to enhance the loan management processes for the BUPF.
            </div>
        </div>
    </div>

    <div>
        <div class="text-center mt-5 mb-2">
            <img src="{{asset('assets/our-team.svg')}}" alt="Our Team" width="180px">
        </div>
        <div class="d-flex justify-content-center text-center">
            <div style="width: 80%;" class="fs-5">
                Meet the team behind the development of the eBUPF System, where passion, expertise, and collaboration converge to shape the future of financial services at BUPF.
            </div>
        </div>
        <div class="row mt-4 mb-5">
            <div class="col-md-6">
                <div class="text-center">
                    <img src="{{asset('assets/jeff.svg')}}" alt="Jeff" width="65%">
                </div>
                <div class="reveal fade-left">
                    <p class="text-center fs-4 fw-bold" style="color: #00638D;">Jeff</p>
                    <p class="text-center fs-6 fw-bold text-dark">Project Manager <br> & <br> Full-Stack Developer</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-center">
                    <img src="{{asset('assets/aaron.svg')}}" alt="Jeff" width="65%">
                </div>
                <div class="reveal fade-right">
                    <p class="text-center fs-4 fw-bold" style="color: #00638D;">Aaron</p>
                    <p class="text-center fs-6 fw-bold text-dark">Full-Stack Developer</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-center">
                    <img src="{{asset('assets/kim.svg')}}" alt="Jeff" width="65%">
                </div>
                <div class="reveal fade-left">
                    <p class="text-center fs-4 fw-bold" style="color: #00638D;">Kim</p>
                    <p class="text-center fs-6 fw-bold text-dark">Manuscript Author</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-center">
                    <img src="{{asset('assets/mhel.svg')}}" alt="Jeff" width="65%">
                </div>
                <div class="reveal fade-right">
                    <p class="text-center fs-4 fw-bold" style="color: #00638D;">Mhel</p>
                    <p class="text-center fs-6 fw-bold text-dark">Manuscript Author</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Activate the carousel and set the interval for sliding
    $(document).ready(function(){
        $('#imageSlider').carousel({
            interval: 3000 // Set the interval in milliseconds (3 seconds in this example)
        });
    });
</script>
@endsection
