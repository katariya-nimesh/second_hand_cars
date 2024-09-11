<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .profile-page {
            font-family: Arial, sans-serif;
            color: #333;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .profile-header {
            height: 190px;
            background-color: #4476fb;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding-top: 40px;
            position: relative;
        }

        .profile-picture {
            display: flex;
            justify-content: center;
        }

        .profile-picture img {
            border-radius: 50%;
            width: 120px;
            height: 120px;
            margin-bottom: 10px;
            border: 5px solid #fff;
            position: absolute;
            top: 77px;
            transform: translateY(-50%);
        }

        .profile-info {
            text-align: center;
            margin-top: 100px;
        }

        .profile-info h2 {
            color: #fff;
            margin: 0;
            font-size: 24px;
        }

        .profile-info p {
            color: #fff;
            margin: 5px 0;
        }

        .separator {
            border: none;
            border-top: 2px solid #ddd;
            margin: 20px 0;
        }

        .car-cards-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            flex-grow: 1;
            padding: 0 10px 10px;
        }

        .car-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .car-card img,
        video {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .car-details {
            text-align: center;
        }

        .car-details h3 {
            margin: 10px 0;
            font-size: 18px;
        }

        .car-details p {
            margin: 5px 0;
            font-size: 14px;
        }

        .price {
            font-weight: bold;
            color: #4476fb;
            font-size: 16px;
        }

        .car-details {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        .car-details p {
            display: table-cell;
            padding: 10px;
            text-align: left;
            vertical-align: middle;
        }

        .price {
            font-weight: bold;
            color: #4476fb;
        }

        i {
            color: #4476fb;

        }

        .custom-slider {
            position: relative;
            width: 100%;
            overflow: hidden;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .slider-wrapper {
            display: flex;
            transition: transform 0.5s ease-in-out;
            width: 100%;
        }

        .slider-slide {
            min-width: 100%;
            box-sizing: border-box;
            flex: 0 0 100%;
        }

        .slider-slide img,
        .slider-slide video {
            width: 100%;
            border-radius: 8px;
        }

        .slider-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 100;
            border-radius: 50%;
        }

        .prev-button {
            left: 10px;
        }

        .next-button {
            right: 10px;
        }


        @media (max-width: 1024px) {
            .car-cards-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .car-cards-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="profile-page">
        <header class="profile-header">
            <div class="profile-picture">
                <img src="{{ $vendor->image }}" alt="Profile Picture">
            </div>
            <div class="profile-info">
                <h2>{{ $vendor->name }}</h2>
                <p>Contact: {{ $vendor->phoneno }}</p>
                <p>Location: {{ $vendor->location }}</p>
            </div>
        </header>

        <hr class="separator">

        <div class="car-cards-container">
            @forelse ($cars as $car)
                <div class="car-card">
                    @if (count($car->car_image))
                        <div class="custom-slider">
                            <div class="slider-wrapper">
                                @foreach ($car->car_image as $image)
                                    <div class="slider-slide">
                                        @if ($image->type == 'image')
                                            <img src="{{ $image->image }}" alt="Car Image" height="310">
                                        @elseif ($image->type == 'video')
                                            <video height="310" controls>
                                                <source src="{{ $image->image }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <button class="slider-button prev-button">&#10094;</button>
                            <button class="slider-button next-button">&#10095;</button>
                        </div>
                    @else
                        <img alt="Car Image" height="310">
                    @endif

                    <div style="align-self: normal; display: flex; justify-content: space-between;">
                        <h3>{{ $car->car_brand->name }} {{ $car->car_varient->name }} {{ $car->car_fuel_varient->name }}</h3>
                        <p class="price">₹ {{ number_format($car->price) }}</p>
                    </div>
                    <div class="car-details">
                        <p><i class="fas fa-gas-pump"></i> {{ $car->car_fuel_type->fuel_type }}</p>
                        <p><i class="fas fa-wave-square"></i> {{ $car->transmission }}</p>
                        <p><i class="fas fa-car"></i> {{ $car->car_varient_type->name }}</p>
                        <p><i class="fas fa-tachometer-alt"></i> {{ $car->car_kilometer->start_km }} -
                            {{ $car->car_kilometer->end_km }} km</p>
                        <p><i class="fas fa-user-friends"></i> {{ $car->car_owner->name }} </p>
                    </div>
                </div>
            @empty
                <div>
                    <h2>No cars added! Please add!</h2>
                </div>
            @endforelse
        </div>


    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sliders = document.querySelectorAll('.custom-slider');

            sliders.forEach((slider) => {
                const wrapper = slider.querySelector('.slider-wrapper');
                const slides = slider.querySelectorAll('.slider-slide');
                const nextButton = slider.querySelector('.next-button');
                const prevButton = slider.querySelector('.prev-button');
                let currentIndex = 0;

                function showSlide(index) {
                    wrapper.style.transform = `translateX(-${index * 100}%)`;
                }

                nextButton.addEventListener('click', function () {
                    currentIndex = (currentIndex + 1) % slides.length;
                    showSlide(currentIndex);
                });

                prevButton.addEventListener('click', function () {
                    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
                    showSlide(currentIndex);
                });

                // Initial display
                showSlide(currentIndex);
            });
        });
    </script>
</body>

</html>
