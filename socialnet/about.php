<?php
require_once '../db.php';
// Public page - no login required
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SocialNet - About Us</title>
    <style>
        /* Shared Styles */
        html, body {
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        /* Dark MenuBar matching your other pages */
        nav {
            background-color: #555; 
            padding: 15px 0;
            text-align: center;
            width: 100%;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 20px;
            font-size: 16px;
            font-weight: bold;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 40px 20px;
        }

        .about-card {
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
            border-top: 5px solid #444;
        }

        h1 {
            color: #1c1e21;
            margin-bottom: 30px;
        }

        h3 {
            color: #444;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-top: 0;
        }

        .details p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }

        .details strong {
            color: #1c1e21;
            width: 120px;
            display: inline-block;
        }

        .footer-note {
            margin-top: 20px;
            font-size: 13px;
            color: #888;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <h1>About the Project</h1>

        <div class="about-card">
            <h3>Student Information</h3>
            <div class="details">
                <p><strong>Full Name:</strong> Vu Ha Anh</p>
                <p><strong>Student ID:</strong> 1695324</p>
		<p><strong>Major:</strong> Computer Science </p>
                <p><strong>University:</strong> Hanoi University Science of Technology</p>
            </div>
            
            <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
            
            <h3>Project Scope</h3>
            <p style="color: #666; font-size: 14px;">
                SocialNet is a web application developed for cybersecurity laboratory purposes, 
                focusing on common web vulnerabilities like SQL Injection and Cross-Site Scripting (XSS).
            </p>
        </div>

        <div class="footer-note">
            © 2026 SocialNet
        </div>
    </div>
</body>
</html>
