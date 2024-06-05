<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- lies css bootrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <!-- hhhh -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">



    <!-- lien texte -->
    <!-- linkfonte -->


    <!-- IMAGE Use Swiper from CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- lien css -->
    <link rel="stylesheet" href="css/common.css">
    <title>Document</title>
    <style>
    :root {
        --teal: #2ec1ac;
        --teal_hover: #279e8c;
    }


    * {
        font-family: 'Poppins', sans-serif;
    }


    .h-font {
        font-family: 'Meriend', cursive;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }


    .custom-bg {
        background-color: var(--teal);
        border: 1px solid --teal
    }

    .custom-bg:hover {
        background-color: var(--teal_hover);
        border-color: var(--teal_hover);
    }


    .h-line {
        width: 150px;
        margin: 0 auto;
        height: 1.7px;
    }


    .pop:hover {
        border-top-color: #2ec1ac !important;
        transform: scale(1.03);
        transition: all 0.3s;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <!-- cards -->
            <dic class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin:auto;">
                    <img src="images/rooms/1.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Simple Room Name</h5>
                        <h6 class="mb-4">DH 200 per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>

                        </div>
                        <div class="d-flex justify-content-evenly mb-2 ">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-non ">Book Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-non ">More
                                details</a>
                        </div>
                    </div>
                </div>
            </dic>
            <!-- cards -->
            <dic class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin:auto;">
                    <img src="images/rooms/1.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Simple Room Name</h5>
                        <h6 class="mb-4">DH 200 per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>

                        </div>
                        <div class="d-flex justify-content-evenly mb-2 ">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-non ">Book Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-non ">More
                                details</a>
                        </div>
                    </div>
                </div>
            </dic>
            <!-- cards -->
            <dic class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin:auto;">
                    <img src="images/rooms/1.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Simple Room Name</h5>
                        <h6 class="mb-4">DH 200 per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>

                        </div>
                        <div class="d-flex justify-content-evenly mb-2 ">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-non ">Book Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-non ">More
                                details</a>
                        </div>
                    </div>
                </div>
            </dic>
            <div class="col-lg-12 text-center mt-5">
                <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms > > > </a>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">

            <!-- scale 2 -->
            <div class="col-lg-4 col-md-6 mb-5 px-4 ">
                <div class="bg-white rounded  shadow p-4 border-top border-3 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="$path/$row[icon]" width="40px" alt="">
                        <h5 class="m-0 ms-3">
                            كرة اليد</h5>
                    </div>
                    <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
                </div>
            </div>
            <!-- scale 2 -->
            <div class="col-lg-4 col-md-6 mb-5 px-4 ">
                <div class="bg-white rounded  shadow p-4 border-top border-3 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="$path/$row[icon]" width="40px" alt="">
                        <h5 class="m-0 ms-3">
                            كرة السلة</h5>
                    </div>
                    <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi
                    </p>
                </div>
            </div>
            <!-- scale 2 -->
            <div class="col-lg-4 col-md-6 mb-5 px-4 ">
                <div class="bg-white rounded  shadow p-4 border-top border-3 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="$path/$row[icon]" width="40px" alt="">
                        <h5 class="m-0 ms-3">
                            كرة القدم</h5>
                    </div>
                    <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi

                    </p>
                </div>
            </div>

        </div>
    </div>






    <!-- lien Bundle nav-bar -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>