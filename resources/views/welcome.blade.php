<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATMS - Automated Transport Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">ATMS</h1>
            <ul class="hidden md:flex space-x-6">
                <li><a href="#" class="hover:underline">Home</a></li>
                <li><a href="#about" class="hover:underline">About</a></li>
                <li><a href="#timeline" class="hover:underline">Project Timeline</a></li>
                <li><a href="#team" class="hover:underline">Our Team</a></li>
                <li><a href="{{ route('login') }}" class="bg-white text-blue-600 px-4 py-2 rounded shadow hover:bg-gray-200">Get Started</a></li>
            </ul>
            <button class="md:hidden text-white text-2xl">☰</button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-blue-600 text-white text-center py-20">
        <h1 class="text-4xl font-bold">Automated Transport Management System</h1>
        <p class="mt-4 text-lg">Efficient. Safe. Smart Transportation for Educational Institutions.</p>
        <a href="{{ route('login') }}" class="mt-6 inline-block bg-white text-blue-600 px-6 py-3 rounded-lg shadow-lg hover:bg-gray-200">Start Now</a>
    </section>

    <!-- About Section -->
    <section id="about" class="container mx-auto py-16 px-6">
        <h2 class="text-3xl font-bold text-center">About the Project</h2>
        <div class="mt-8 bg-white p-6 rounded-lg shadow-lg">
            <p><strong>Problem Statement:</strong> Educational institutions struggle with inefficient route planning, manual attendance tracking, and lack of real-time updates, leading to delays and safety concerns.</p>
            <p class="mt-4"><strong>Solution:</strong> Our ATMS platform integrates GPS for real-time tracking, barcode-based automated attendance, and notification alerts, providing a smart and efficient student transportation system.</p>
            <p class="mt-4"><strong>Mission:</strong> To revolutionize student transportation by ensuring efficiency, safety, and seamless communication.</p>
        </div>
    </section>

    <!-- Project Timeline -->
    <section id="timeline" class="container mx-auto py-16 px-6">
    <h2 class="text-3xl font-bold text-center mb-6">Project Timeline</h2>
    <ol class="border-l-2 border-blue-600 relative">
        <li>
            <div class="md:flex items-center">
                <div class="w-6 h-6 bg-blue-600 flex items-center justify-center rounded-full absolute -ml-3 md:left-1/2 transform md:-translate-x-1/2">
                    <svg aria-hidden="true" focusable="false" class="text-white w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path fill="currentColor" d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm64-192c0-8.8 7.2-16 16-16h288c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16v-64zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path>
                    </svg>
                </div>
                <div class="block p-6 shadow-lg bg-gray-100 max-w-md mb-10 md:ml-auto md:mr-6">
                    <h3 class="text-xl font-semibold">User Management Module</h3>
                    <p class="text-gray-600">Handles student, driver, and admin accounts with role-based access.</p>
                </div>
            </div>
        </li>
        <li>
            <div class="md:flex items-center">
                <div class="w-6 h-6 bg-blue-600 flex items-center justify-center rounded-full absolute -ml-3 md:left-1/2 transform md:-translate-x-1/2">
                    <svg aria-hidden="true" focusable="false" class="text-white w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path fill="currentColor" d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm64-192c0-8.8 7.2-16 16-16h288c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16v-64zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path>
                    </svg>
                </div>
                <div class="block p-6 shadow-lg bg-gray-100 max-w-md mb-10 md:mr-auto md:ml-6">
                    <h3 class="text-xl font-semibold">Real-Time Route Visualization</h3>
                    <p class="text-gray-600">Provides live tracking of transport routes using GPS.</p>
                </div>
            </div>
        </li>
        <li>
            <div class="md:flex items-center">
                <div class="w-6 h-6 bg-blue-600 flex items-center justify-center rounded-full absolute -ml-3 md:left-1/2 transform md:-translate-x-1/2">
                    <svg aria-hidden="true" focusable="false" class="text-white w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path fill="currentColor" d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm64-192c0-8.8 7.2-16 16-16h288c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16v-64zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path>
                    </svg>
                </div>
                <div class="block p-6 shadow-lg bg-gray-100 max-w-md mb-10 md:ml-auto md:mr-6">
                    <h3 class="text-xl font-semibold">Automated Attendance Tracking</h3>
                    <p class="text-gray-600">Uses barcode scanning for automated attendance marking.</p>
                </div>
            </div>
        </li>
        <li>
            <div class="md:flex items-center">
                <div class="w-6 h-6 bg-blue-600 flex items-center justify-center rounded-full absolute -ml-3 md:left-1/2 transform md:-translate-x-1/2">
                    <svg aria-hidden="true" focusable="false" class="text-white w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path fill="currentColor" d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm64-192c0-8.8 7.2-16 16-16h288c8.8 0 16 7.2 16 16v64c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16v-64zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path>
                    </svg>
                </div>
                <div class="block p-6 shadow-lg bg-gray-100 max-w-md mb-10 md:mr-auto md:ml-6">
                    <h3 class="text-xl font-semibold">Notification and Alert Module</h3>
                    <p class="text-gray-600">Sends real-time alerts to students, parents, and administrators.</p>
                </div>
            </div>
        </li>
    </ol>
</section>

    <!-- Team Section -->
    <section id="team" class="container mx-auto py-16 px-6">
        <h2 class="text-3xl font-bold text-center">Our Team</h2>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <img src="https://via.placeholder.com/120" alt="Team Member" class="w-24 h-24 rounded-full mx-auto">
                <h3 class="mt-4 text-xl font-semibold">Abinayasri B</h3>
                <p class="text-gray-600">730421104001</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <img src="https://via.placeholder.com/120" alt="Team Member" class="w-24 h-24 rounded-full mx-auto">
                <h3 class="mt-4 text-xl font-semibold">Jayaprakash M</h3>
                <p class="text-gray-600">730421104032</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <img src="https://via.placeholder.com/120" alt="Team Member" class="w-24 h-24 rounded-full mx-auto">
                <h3 class="mt-4 text-xl font-semibold">Kannan M</h3>
                <p class="text-gray-600">730421104034</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white text-center py-6 mt-12">
        <p>&copy; 2024 ATMS. All rights reserved.</p>
    </footer>

</body>
</html>
