<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Hospital Management System for managing appointments, patient records, and more.">
    <title>Hospital Management System</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<nav class="navbaritems" aria-label="Main navigation">
    <a href="#home" class="logoo">
        <img src="logo.jpg" alt="Hospital Logo" class="logo-image">
    </a>
    <ul>
        <li><a href="#home"><i class="fas fa-home"></i> Home</a></li>
        <li>
            <a href="#" onclick="toggleDropdown('patientDropdown')"><i class="fas fa-user-injured"></i> Patient <span class="arrow">&#9662;</span></a>
            <div class="dropdown" id="patientDropdown">
                <a href="emr_access.php">Electronic Medical Records</a>
                <a href="ip_management.html">IP Management</a>
            </div>
        </li>
        <li>
            <a href="#" onclick="toggleDropdown('doctorDropdown')"><i class="fas fa-user-md"></i> Doctor <span class="arrow">&#9662;</span></a>
            <div class="dropdown" id="doctorDropdown">
                <a href="shifts.html">Shifts</a>
                <a href="patient_data_entry.html">Patient Details Entry</a>
            </div>
        </li>
        <li>
            <a href="#" onclick="toggleDropdown('managementDropdown')"><i class="fas fa-chart-line"></i> Management <span class="arrow">&#9662;</span></a>
            <div class="dropdown" id="managementDropdown">
                <a href="pathology.html">Pathology/Radiology</a>
                <a href="blood.html">Blood Banking</a>
            </div>
        </li>
        <li>
            <a href="#" onclick="toggleDropdown('pharmacyDropdown')"><i class="fas fa-pills"></i> Pharmacy <span class="arrow">&#9662;</span></a>
            <div class="dropdown" id="pharmacyDropdown">
                <a href="pharmacy_management.html">Pharmacy Management</a>
            </div>
        </li>

        
        <?php if (isset($_SESSION['email'])): ?>
                <!-- If the user is logged in, show the email and Logout link -->
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                <li><a href="#">Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?></a></li>
            <?php else: ?>
                <!-- If the user is not logged in, show Login/Register link -->
                <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Login/Register</a></li>
            <?php endif; ?>
    </ul>
</nav>


    <header id="home">
        
    </header>

    <section id="why-hms">
        <h1 style="margin-top: 5%;text-align: center;">Welcome To HOSPITAL MANAGEMENT SYSTEM</h1>
        <h2 style="margin-top: 2%; text-align: center;">Why Choose a SMART VIDHYA?</h2>
        

        <div class="why-hms-container">
            <div class="why-hms-block">
                <h3>1. Streamlined Operations</h3>
                <p>An HMS automates various administrative and clinical processes, significantly reducing manual tasks. This streamlining improves the efficiency of hospital operations, allowing staff to focus more on patient care rather than paperwork.</p>
            </div>
            <div class="why-hms-block">
                <h3>2. Improved Patient Care</h3>
                <p>With an HMS, healthcare providers have immediate access to patient information, including medical histories, treatment plans, and medication records. This accessibility leads to better-informed decisions and enhances the quality of care provided to patients.</p>
            </div>
            <div class="why-hms-block">
                <h3>3. Enhanced Communication</h3>
                <p>An HMS facilitates better communication among various departments (e.g., billing, nursing, and pharmacy) within a hospital. This interdepartmental communication helps ensure that everyone is on the same page, reducing errors and improving patient outcomes.</p>
            </div>
            <div class="why-hms-block">
                <h3>4. Efficient Appointment Scheduling</h3>
                <p>An HMS allows for easy appointment booking and management, reducing wait times for patients and optimizing staff schedules. Patients can book appointments online, receive reminders, and check-in digitally, improving their overall experience.</p>
            </div>
            <div class="why-hms-block">
                <h3>5. Multi-Language Support</h3>
                <p>The chatbot supports multiple languages, ensuring that all patients can communicate effectively.</p>
            </div>
            <div class="why-hms-block">
                <h3>6. Symptom Checker</h3>
                <p>Utilizes a machine learning model to analyze symptoms and predict potential diseases, aiding in timely consultations.</p>
            </div>
        </div>
    </section>
    


    <div style="text-align: center; margin-top: 20px;">
        <h1 style="font-size: 2.5em; margin-top: 10%; color: #005662;">Symptoms Checker</h1>
        <div style="display: flex; align-items: flex-start; justify-content: center; margin-top: 10px">
            <img src="checker2.png"  style="max-width: 100%;margin-bottom:10%; height: auto; ">
            <div style="flex: 1; padding-left: 20px; text-align: left;margin-top:7%;">
                <p style="font-size: 1.2em; line-height: 1.6; color: #333;">
                    Welcome to the Symptoms Checker, a vital tool designed to help you assess your health based on the symptoms you report. By inputting your symptoms, our system utilizes advanced algorithms to analyze your responses and suggest potential health conditions. This empowers you to make informed decisions about seeking medical attention or further evaluation.
                </p>
                <p style="font-size: 1.2em; line-height: 1.6; color: #333;">
                    Our tool is built to provide quick insights into your health, allowing for early detection and timely interventions. Please take a moment to select your symptoms from the list provided, and click the button below to receive personalized insights tailored to your input.
                </p>
                <p style="font-size: 1.2em; line-height: 1.6; color: #333;">
                    Remember, while this tool can guide you, it is not a substitute for professional medical advice. Always consult with a healthcare provider for a thorough evaluation and diagnosis.
                </p>
                <button onclick="window.location.href='http://localhost:5000/symptoms-checker';">Symptom Checker</button>




            </div>
        </div>
    </div>
    
    <div class="contact-social-section">
    <div>
        <p><center>Contact Details</center></p>
        <p>Phone Number : +91 123-456-7890</p>
        <p>Email : jp3@gmail.com</p>
        <p>Address : Andhra pradesh,Vijayawada,Krishna district</p>
    </div>
    <div class="social-media">
        <h3>Follow Us</h3>

        <a href="https://instagram.com" target="_blank">Instagram</a> |
        <a href="https://linkedin.com" target="_blank">LinkedIn</a>
    </div>
    </div>

    <footer>
        <p>&copy; 2024 Hospital Management System</p>
    </footer>

    <!-- Chatbot Icon -->
    <div id="chatbot-icon" onclick="toggleChatbot()">
        <i class="fas fa-comments"></i>
    </div>

    <!-- Chatbot Window -->
<div id="chatbot">
    <div class="chat-header">
        <strong>Chatbot</strong>
    </div>
    <div id="chat-content" class="chat-content"></div>
    <div class="language-selection">
        <p>Select the language for appointment:</p> <!-- New instruction -->
        <button class="language-button" onclick="setLanguage('english')">English</button>
        <button class="language-button" onclick="setLanguage('telugu')">Telugu</button>
        <button class="language-button" onclick="setLanguage('hindi')">Hindi</button>
    </div>
    <div class="chat-input">
        <input type="text" id="user-input" placeholder="Type your message..." />
        <button onclick="sendMessage()">Send</button>
    </div>
</div>


    <script>
        let currentLanguage = 'english';

        const translations = {
            english: {
                name: "Name:",
                age: "Age:",
                gender: "Gender:",
                phone: "Phone:",
                date: "Appointment Date:",
                time: "Appointment Time:",
                genderOptions: {
                    male: "Male",
                    female: "Female",
                    other: "Other"
                },
                bookAppointment: "Book Appointment"
            },
            telugu: {
                name: "పేరు:",
                age: "వయసు:",
                gender: "లింగం:",
                phone: "ఫోన్:",
                date: "నియామకం తేదీ:",
                time: "నియామకం సమయం:",
                genderOptions: {
                    male: "ఆడ",
                    female: "మగ",
                    other: "ఇతర"
                },
                bookAppointment: "నియమనం బుక్ చేయండి"
            },
            hindi: {
                name: "नाम:",
                age: "उम्र:",
                gender: "लिंग:",
                phone: "फोन:",
                date: "अपॉइंटमेंट की तारीख:",
                time: "अपॉइंटमेंट का समय:",
                genderOptions: {
                    male: "पुरुष",
                    female: "महिला",
                    other: "अन्य"
                },
                bookAppointment: "अपॉइंटमेंट बुक करें"
            }
        };

        function toggleChatbot() {
            const chatbot = document.getElementById('chatbot');
            chatbot.style.display = chatbot.style.display === 'none' || chatbot.style.display === '' ? 'block' : 'none';
        }

        function setLanguage(lang) {
            currentLanguage = lang;
            document.getElementById('chat-content').innerHTML = ''; // Clear chat content
            showAppointmentForm(); // Show the form with the selected language
        }

        function sendMessage() {
            const input = document.getElementById('user-input');
            const userMessage = input.value.trim();
            if (userMessage) {
                document.getElementById('chat-content').innerHTML += `<div>User: ${userMessage}</div>`;
                input.value = '';
                processMessage(userMessage); // Process user message
            }
        }

        function processMessage(message) {
            const lowerMessage = message.toLowerCase();
            let response = "How can I assist you?"; // Default response
        
            if (lowerMessage.includes("appointment")) {
                response = "Would you like to book an appointment? Please fill out the form.";
                showAppointmentForm();
            } else if (lowerMessage.includes("services")) {
                response = "We offer various services including appointment booking, EMR, and more. How can I help you further?";
            } else if (lowerMessage.includes("bill status")) {
                response = "You can check your bill status in the billing section of our website.";
            }
        
            document.getElementById('chat-content').innerHTML += `<div>Chatbot: ${response}</div>`;
        }
        

        <!-- Modify the showAppointmentForm function -->
function showAppointmentForm() {
    const chatContent = document.getElementById('chat-content');
    const lang = translations[currentLanguage];
    chatContent.innerHTML += `
        <div class="appointment-form">
            <form id="appointmentForm" onsubmit="handleFormSubmit(event)">
                <label for="name">${lang.name}</label>
                <input type="text" id="name" name="name" required /><br/>
                <label for="age">${lang.age}</label>
                <input type="number" id="age" name="age" required /><br/>
                <label for="gender">${lang.gender}</label>
                <select id="gender" name="gender" required>
                    <option value="" disabled selected>${lang.gender}</option>
                    <option value="male">${lang.genderOptions.male}</option>
                    <option value="female">${lang.genderOptions.female}</option>
                    <option value="other">${lang.genderOptions.other}</option>
                </select><br/>
                <label for="phone">${lang.phone}</label>
                <input type="tel" id="phone" name="phone" required /><br/>
                <label for="date">${lang.date}</label>
                <input type="date" id="date" name="date" required /><br/>
                <label for="time">${lang.time}</label>
                <input type="time" id="time" name="time" required /><br/>
                <button type="submit">${lang.bookAppointment}</button>
            </form>
        </div>
    `;
}

// Handle the form submission
function handleFormSubmit(event) {
    event.preventDefault(); // Prevent the default form submission

    // Here you can gather the data if needed
    const name = document.getElementById('name').value;
    const age = document.getElementById('age').value;
    const gender = document.getElementById('gender').value;
    const phone = document.getElementById('phone').value;
    const date = document.getElementById('date').value;
    const time = document.getElementById('time').value;

    // Clear the form after submission
    document.getElementById('appointmentForm').reset();

    // Display a success message in the chatbot
    const successMessage = `Thank you, ${name}! Your appointment has been successfully booked for ${date} at ${time}.`;
    document.getElementById('chat-content').innerHTML += `<div>Chatbot: ${successMessage}</div>`;
}


        function navigate(page) {
            window.location.href = page; // Redirect to the chosen page
        }

        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>
</html>







