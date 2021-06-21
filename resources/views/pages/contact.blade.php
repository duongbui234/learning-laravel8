@extends('layouts.master_home')

@section('home_content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{session('success')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Contact</h2>
            <ol>
                <li><a href="/">Home</a></li>
                <li>Contact</li>
            </ol>
        </div>

    </div>
</section>


<section id="contact" class="contact">
    <div class="container">
        <div class="row justify-content-center aos-init aos-animate" data-aos="fade-up">
            <div class="col-lg-10">
                <div class="info-wrap">
                    <div class="row">
                        <div class="col-lg-4 info">
                            <i class="icofont-google-map"></i>
                            <h4>Location:</h4>
                            <p>{{ $contact->address }}</p>
                        </div>

                        <div class="col-lg-4 info mt-4 mt-lg-0">
                            <i class="icofont-envelope"></i>
                            <h4>Email:</h4>
                            <p>{{ $contact->email }}</p>
                        </div>

                        <div class="col-lg-4 info mt-4 mt-lg-0">
                            <i class="icofont-phone"></i>
                            <h4>Call:</h4>
                            <p>+84 {{ $contact->phone }}</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="row mt-5 justify-content-center aos-init aos-animate">
            <div class="col-lg-10">
                <form action="{{ route('contact.form') }}" method="POST" class="php-email-form">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="name" class="form-control" placeholder="Your Name"
                                data-rule="minlen:4" data-msg="Please enter at least 4 chars">



                        </div>
                        <div class="col-md-6 form-group">
                            <input type="email" class="form-control" name="email" placeholder="Your Email">



                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="subject" placeholder="Subject">



                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="message" rows="5" placeholder="Message"></textarea>
                    </div>
                    <button class="btn btn-success" type="submit" style="color: whitesmoke">Send
                        message</button>
                </form>
            </div>

        </div>

    </div>
</section>

@endsection
