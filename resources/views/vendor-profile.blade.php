<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .profile-header {
            background-color: #333;
            color: white;
            text-align: center;
            height: 30vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-picture-container {
            display: flex;
            justify-content: center;
            margin-top: -50px;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid white;
        }

        .separator {
            border: none;
            border-top: 2px solid #ccc;
            margin: 20px 0;
        }

        .car-display-card {
            background-color: white;
            padding: 20px;
            margin: 0 auto;
            max-width: 600px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            border-radius: 10px;
        }

        .car-image img {
            width: 150px;
            height: 100px;
            border-radius: 10px;
            object-fit: cover;
            margin-right: 20px;
        }

        .car-details h2 {
            margin: 0;
            font-size: 24px;
        }

        .car-details p {
            margin: 5px 0;
            color: #555;
        }
    </style>
</head>

<body>
    <header class="profile-header">
        <h1>Profile Header</h1>
    </header>

    <div class="profile-picture-container">
        <img src="profile-picture.jpg" alt="Profile Picture" class="profile-picture">
    </div>

    <hr class="separator">

    <div class="car-display-card">
        <div class="car-image">
            <img src="car-image.jpg" alt="Car Image">
        </div>
        <div class="car-details">
            <h2>Car Name</h2>
            <p>Price: $20,000</p>
            <p>Kilometers: 50,000 KM</p>
            <p>Year: 2015</p>
            <p>Fuel Type: Petrol</p>
        </div>
    </div>
</body>

</html>
