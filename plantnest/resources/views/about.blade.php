@extends('frontend_partials.main_layout')
@section('front_title', 'About')

@section('main_content')
<div class="container-fliud">
    <div class="row d-flex shop flex-row justify-content-center align-items-center py-5 fw-bolder fs-1">
        About
    </div>
</div>

<div class="container p-5 d-flex flex-column justify-content-center align-items-center gap-3">
    <h1 class='text-success fw-bolder fs-1'>Our Company History</h1>
    <p class="text-base-50 w-50 text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo autem
        consequuntur cumque saepe voluptates voluptatum quidem vel minima nobis possimus, deleniti numquam deserunt
        blanditiis reiciendis debitis architecto natus ipsa eum.</p>
</div>

<div class="container">
    <div class="row">
        <div class="col col-12 col-md-4">
            <div class='w-75'>
                <h3 class='text-success fw-bold text-center'>2020-22</h3>
                <p class='text-base-50 text-center'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium
                    laboriosam, assumenda corrupti perferendis officia dolores.</p>
            </div>
        </div>
        <div class="col col-12 col-md-4 ">
            <div class='w-75'>
                <h3 class='text-success fw-bold text-center'>2022-23</h3>
                <p class='text-base-50 text-center'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium
                    laboriosam, assumenda corrupti perferendis officia dolores.</p>
            </div>
        </div>
        <div class="col col-12 col-md-4">
            <div class='w-75'>
                <h3 class='text-success fw-bold text-center'>2023-25</h3>
                <p class='text-base-50 text-center'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium
                    laboriosam, assumenda corrupti perferendis officia dolores.</p>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row p-5">
        <div class="col col-12 col-md-8">
            <h1 class='fw-bolder fs-1 text-success'>What we Offer</h1>
            <p class='text-base-50'>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam dolor eum
                asperiores perspiciatis quo necessitatibus culpa ratione quaerat possimus molestias, laborum soluta
                voluptate doloremque architecto laudantium fugit veritatis obcaecati minima?Lorem ipsum, dolor sit amet
                consectetur adipisicing elit. Nulla tenetur est deleniti aspernatur, provident obcaecati corrupti,
                voluptas quam illum repudiandae modi aut, saepe ullam rerum ut maxime impedit nesciunt distinctio.</p>
        </div>
        <div class="col col-12 col-md-4">
            <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSJzxdFw9TWeAgaqOdY_iPKNVL-c3M5_60-lEtO-d-DaXN45Boi"
                class='img-fliud w-100 rounded-5' alt="">
        </div>
    </div>
</div>

<div class="container-fliud my-5 p-5" style="background-color: rgb(211, 225, 211);">
    <div class="row">
        <div class="text-center">
            <h1 class='fw-bolder fs-1 text-success'>Our Team</h1>
            <p class='fw-semibold fs-5'>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        </div>
        <div class="d-flex justify-content-evenly align-items-center flex-column flex-md-row my-3">
            <div class="card border-0 bg-transparent" style="width: 12rem;">
                <img class="card-img-top img-profile rounded-circle shadow"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmVq-OmHL5H_5P8b1k306pFddOe3049-il2A&s"
                    alt="Card image cap">
                <div class="card-body text-center">

                    <p class="card-text fs-4 fw-bold text-success">Arham Azeem</p>
                    <p class="card-text fs-5 fw-semibold text-dark">Developer</p>
                </div>
            </div>
            <div class="card border-0 bg-transparent" style="width: 12rem;">
                <img class="card-img-top img-profile rounded-circle shadow"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmVq-OmHL5H_5P8b1k306pFddOe3049-il2A&s"
                    alt="Card image cap">
                <div class="card-body text-center">

                    <p class="card-text fs-4 fw-bold text-success">Ahmed Ali</p>
                    <p class="card-text fs-5 fw-semibold text-dark">Developer</p>
                </div>
            </div>
            <div class="card border-0 bg-transparent" style="width: 12rem;">
                <img class="card-img-top img-profile rounded-circle shadow"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmVq-OmHL5H_5P8b1k306pFddOe3049-il2A&s"
                    alt="Card image cap">
                <div class="card-body text-center">

                    <p class="card-text fs-4 fw-bold text-success">A.Rehman</p>
                    <p class="card-text fs-5 fw-semibold text-dark">Developer</p>
                </div>
            </div>
            <div class="card border-0 bg-transparent" style="width: 12rem;">
                <img class="card-img-top img-profile rounded-circle shadow"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmVq-OmHL5H_5P8b1k306pFddOe3049-il2A&s"
                    alt="Card image cap">
                <div class="card-body text-center">

                    <p class="card-text fs-4 fw-bold text-success">Wasiq Ali</p>
                    <p class="card-text fs-5 fw-semibold text-dark">Developer</p>
                </div>
            </div>
        </div>
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
        <div class="col col-12 col-md-8 px-5">
        <div class="accordion accordion-flush " id="accordionFlushExample" style="width:100%">
    <!-- The accordion items will be injected dynamically using JavaScript -->
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const faqData = [
            { "question": "What is plant care?", "answer": "Plant care involves providing the necessary conditions for a plant to thrive, including watering, sunlight, soil, and nutrients." },
            { "question": "How often should I water my plants?", "answer": "The frequency of watering depends on the type of plant, its size, and the environment. Generally, it's best to water when the top inch of soil feels dry." },
            { "question": "What is the best soil for indoor plants?", "answer": "Indoor plants typically thrive in a well-draining potting mix that contains organic matter and perlite or vermiculite." },
            { "question": "How do I know if my plant needs more sunlight?", "answer": "Plants may show signs of insufficient sunlight, such as yellowing leaves or slow growth. Most plants need bright, indirect light to thrive." },
            { "question": "What should I do if my plant is infested with pests?", "answer": "Isolate the affected plant and treat it with appropriate pesticides or natural remedies, such as neem oil or insecticidal soap." },
            { "question": "How can I fertilize my plants effectively?", "answer": "Fertilize plants according to their specific needs using a balanced, water-soluble fertilizer. Avoid over-fertilizing, as this can harm the plant." },
            { "question": "When should I repot my plants?", "answer": "Repot plants when they outgrow their current container, usually every 1-2 years or when roots are visible at the bottom of the pot." }
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