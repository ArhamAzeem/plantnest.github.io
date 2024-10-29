@extends('frontend_partials.main_layout')
@section('front_title', 'Contact Us | Feed Back')

@section('main_content')

<div class="container-fliud">
    <div class="row d-flex shop text-center flex-row justify-content-center align-items-center py-5">
        <h1 class=' fw-bolder fs-1'>Contact Us <i class="fa-regular fa-comment"></i></h1>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container p-5 d-flex flex-column justify-content-center align-items-center gap-3">
    <h1 class='text-success fw-bolder fs-1'>Our Contact Details</h1>
    <p class="text-base-50 w-50 text-center">For Any Inquiries Contact Us and Provide Us with your Precious feed Using
        the Form below.</p>
</div>

<div class="container my-5 p-5 rounded-5" style="background-color: rgb(237, 235, 235);">
    <div class="row text-center text-center gx-4 gx-md-5" id="payment">
        <div class="col-md-4 mb-4">
            <div class="d-flex flex-column align-items-center">
                <i class="fa-solid fa-phone mb-3 fs-2 text-success"></i>
                <h5 class="mb-2">Give Us A Call</h5>
                <p class="mb-0 text-muted fw-semibold fs-4">92 300 000 0000</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="d-flex flex-column align-items-center">
                <i class="fa-solid fa-location-dot mb-3 fs-2 text-success"></i>
                <h5 class="mb-2">Visit Us</h5>
                <p class="mb-0 text-muted fw-semibold fs-4">Aptech Metro Star Gate</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="d-flex flex-column align-items-center">
                <i class="fa-regular fa-envelope mb-3 fs-2 text-success"></i>
                <h5 class="mb-2">Send Us a Mail</h5><a href="mailto:MSG-404@testmail.com" class=' text-decoration-none'>
                    <p class="mb-0 text-muted fw-semibold fs-4">MSG-404@testmail.com</p>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container my-5 p-5 rounded-5" style="background-color: rgb(237, 235, 235);">
    <div class="row">
        <div class="col col-12 col-md-6">

        <form action="{{ route('feedback.store') }}" method="POST" novalidate>
    @csrf
    <div class="form-group">
        <label for="name" class='fw-semibold fs-4 my-2'>Name</label>
        <input type="text" name="name" class="form-control rounded-pill p-3" id="name"
            placeholder="Enter your Name ..." pattern="[A-Za-z\s]{2,}"
            title="Name should contain at least 2 letters and only letters and spaces" required>
        <div class="invalid-feedback">
            Please enter a valid name (only letters and spaces, at least 2 characters).
        </div>
    </div>
    <div class="form-group">
        <label for="email" class='fw-semibold fs-4 my-2'>Email address</label>
        <input type="email" name="email" class="form-control rounded-pill p-3" id="email"
            placeholder="Enter your Email ..." pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}"
            title="Please enter a valid email address" required>
        <div class="invalid-feedback">
            Please enter a valid email address.
        </div>
    </div>
    <div class="form-group">
        <label for="message" class='fw-semibold fs-4 my-2'>Provide Us with Your Feedback</label>
        <textarea name="message" class="form-control rounded-5 p-3" id="message" rows="3"
            placeholder="Leave your Feedback ..." style="height:30vh" minlength="10"
            title="Feedback should be at least 10 characters long" required></textarea>
        <div class="invalid-feedback">
            Please provide feedback with at least 10 characters.
        </div>
    </div>
    <button type="submit" class="btn btn-success rounded-pill mt-3 fs-4 w-100">Submit</button>
</form>

<script>
    // JavaScript to handle form validation feedback
    (function() {
        'use strict';

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('form');

        // Loop over them and prevent submission if invalid
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
    })();
</script>

        </div>
        <div class="col col-12 col-md-6">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQLTABqvI_E0lMYWv-ViRoOn8G1vdQhCXSRafNqB6yFCEHH7o5iN4BGEiLYPRZ26omwGe8&usqp=CAU"
                class='img-fliud w-100 rounded-5' alt="" style="height:100%;">
        </div>
    </div>
</div>


<div class="container-fliud my-5">
    <div class="row d-flex flex-row justify-content-center align-items-center py-5 fw-bolder fs-1 text-success">
        Our Location
    </div>
    <div class="row">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14477.256537922056!2d67.1518249!3d24.8872643!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb339999415e0c3%3A0x36742eee0fd9c291!2sAptech%20Metro%20Star%20Gate!5e0!3m2!1sen!2s!4v1724668345924!5m2!1sen!2s"
            width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>



<!-- FAQS -->

<div class="container">
    <div class="row d-flex flex-row justify-content-center align-items-center py-5 fw-bolder fs-1 text-success">
        Frequently Asked Questions
    </div>
    <div class="row">
        <div class="col col-12 col-md-4">
            <img src="https://img.freepik.com/free-photo/monstera-deliciosa-plant-pot_53876-133119.jpg"
                class='img-fliud w-100 rounded-5' alt="" style="height:100%;">

        </div>
        <div class="col col-12 col-md-8 px-5 p-1">
            <div class="accordion accordion-flush " id="accordionFlushExample" style="width:100%">
                <!-- The accordion items will be injected dynamically using JavaScript -->
            </div>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const faqData = [{
                        "question": "What is plant care?",
                        "answer": "Plant care involves providing the necessary conditions for a plant to thrive, including watering, sunlight, soil, and nutrients."
                    },
                    {
                        "question": "How often should I water my plants?",
                        "answer": "The frequency of watering depends on the type of plant, its size, and the environment. Generally, it's best to water when the top inch of soil feels dry."
                    },
                    {
                        "question": "What is the best soil for indoor plants?",
                        "answer": "Indoor plants typically thrive in a well-draining potting mix that contains organic matter and perlite or vermiculite."
                    },
                    {
                        "question": "How do I know if my plant needs more sunlight?",
                        "answer": "Plants may show signs of insufficient sunlight, such as yellowing leaves or slow growth. Most plants need bright, indirect light to thrive."
                    },
                    {
                        "question": "What should I do if my plant is infested with pests?",
                        "answer": "Isolate the affected plant and treat it with appropriate pesticides or natural remedies, such as neem oil or insecticidal soap."
                    },
                    {
                        "question": "How can I fertilize my plants effectively?",
                        "answer": "Fertilize plants according to their specific needs using a balanced, water-soluble fertilizer. Avoid over-fertilizing, as this can harm the plant."
                    },
                    {
                        "question": "When should I repot my plants?",
                        "answer": "Repot plants when they outgrow their current container, usually every 1-2 years or when roots are visible at the bottom of the pot."
                    }
                ];

                const accordionContainer = document.getElementById('accordionFlushExample');

                faqData.forEach((item, index) => {
                    const accordionItem = document.createElement('div');
                    accordionItem.className = 'accordion-item';
                    accordionItem.innerHTML = `
                <h2 class="accordion-header" id="flush-heading${index}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse${index}" aria-expanded="false" aria-controls="flush-collapse${index}">
                        ${item.question}
                    </button>
                </h2>
                <div id="flush-collapse${index}" class="accordion-collapse collapse" aria-labelledby="flush-heading${index}" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        ${item.answer}
                    </div>
                </div>
            `;
                    accordionContainer.appendChild(accordionItem);
                });
            });
            </script>

        </div>
    </div>
</div>
</div>

@endsection