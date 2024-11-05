<?php
session_start(); // Start the session

// Check if the user is logged in by verifying the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Use the logged-in username
    $role = $_SESSION['role'];  // Fetch the user role from session
} else {
    $username = 'Guest'; // Default to 'Guest' if not logged in
    $role = null; // No role for guest users
}
?>


<?php

// Database connection
require_once('php/CreateDb.php');
$database = new CreateDb("shop", "Producttb");

// Fetch books by category
$main_books_query = "SELECT * FROM Producttb WHERE is_best_seller = FALSE AND is_featured = FALSE";
$main_books = $database->con->query($main_books_query);

$bestseller_books_query = "SELECT * FROM Producttb WHERE is_best_seller = TRUE";
$bestseller_books = $database->con->query($bestseller_books_query);

$featured_books_query = "SELECT * FROM Producttb WHERE is_featured = TRUE";
$featured_books = $database->con->query($featured_books_query);
?>

<?php

require_once ('php/component.php');

// create instance of Createdb class
$database = new CreateDb("shop", "Producttb");

if (isset($_POST['add'])){
    if (isset($_SESSION['cart'])){
        $item_array_id = array_column($_SESSION['cart'], "product_id");

        if (in_array($_POST['product_id'], $item_array_id)){
            // Update the product quantity in the cart if it already exists
            foreach ($_SESSION['cart'] as $key => $value) {
                if ($value['product_id'] == $_POST['product_id']) {
                    $_SESSION['cart'][$key]['quantity'] += 1;
                }
            }
            echo "<script>alert('Product quantity updated in the cart..!')</script>";
        } else {
            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id'],
                'quantity' => 1
            );
            $_SESSION['cart'][$count] = $item_array;
        }
    } else {
        $item_array = array(
            'product_id' => $_POST['product_id'],
            'quantity' => 1
        );
        $_SESSION['cart'][0] = $item_array;
    }
}
?>






<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage : Doosan</title>
    <link rel="stylesheet" href="css/styles.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap"
          rel="stylesheet">

    <!--    <script>-->
    <!--        document.addEventListener('DOMContentLoaded', function () {-->
    <!--            alert('Welcome ! This website offers a dark mode for a more comfortable viewing experience. Look for the toggle button (usually represented by a moon icon) to activate it.');-->
    <!--        });-->
    <!--    </script>-->


</head>

<body>

<?php
// Include the common header
require_once('php/header.php');
?>

<section id="home" class="home-section slider">
    <!-- Slider Wrapper -->
    <div class="slider-wrapper">
        <?php
        // Database connection
        require_once('php/CreateDb.php');
        $database = new CreateDb("shop", "Producttb");

        // Fetch featured books (limit to 3 for the slider)
        $slider_books_query = "SELECT * FROM Producttb WHERE is_featured = TRUE LIMIT 3";
        $slider_books = $database->con->query($slider_books_query);

        if ($slider_books && $slider_books->num_rows > 0) {
            while ($book = $slider_books->fetch_assoc()) {
                echo "
                <div class='slide'>
                    <div class='home-content'>
                        <h1>{$book['product_name']}</h1>
                        <p class='home-description'>{$book['product_description']}</p>
                        <!-- Add to Cart Button with Form -->
                        <form action='index_1.php' method='post'>
                            <input type='hidden' name='product_id' value='{$book['id']}'>
                            <button type='submit' name='add' class='btn'>Add to Cart ></button>
                        </form>
                    </div>
                    <img src='{$book['product_image']}' alt='{$book['product_name']}' class='profile-pic'>
                </div>
                ";
            }
        } else {
            echo "<div>No featured books found for the slider.</div>";
        }
        ?>
    </div>

    <!-- Previous Button with Arrow Image -->
    <button class="slider-btn prev-btn">
        <img src="images/left-arrow.png" alt="Previous">
    </button>
    <!-- Next Button with Arrow Image -->
    <button class="slider-btn next-btn">
        <img src="images/right-arrow.png" alt="Next">
    </button>
</section>





<section id="skills">
    <div class="skill-item">
        <img src="images/icon-placeholder.png" alt="Technical Competencies">
        <h2>Technical Competencies</h2>
        <p>Proficient in programming languages, DevOps tools, and cloud services.</p>
        <a href="#learn-more-tech" class="btn-black">Learn More</a>
        <a href="assets/resume.pdf" target="_blank" classs="btn-black" download>Download CV</a>
    </div>
    <div class="skill-item">
        <img src="images/skills.png" alt="Skills & Expertise">
        <h2>Skills & Expertise</h2>
        <p>Experienced in various technical domains with a focus on DevOps and Agile</p>
        <a href="html/projects.html" class="btn-black">View Projects</a>
    </div>
    <div class="skill-item">
        <img src="images/timeline.png" alt="Timeline">
        <h2>Timeline</h2>
        <p>Highlighting key milestones and achievements throughout my career.</p>
        <a href="html/about-me.html" class="btn-black">About Me</a>
    </div>
</section>



<section class="section-background">
    <div class="section-content">
        <span>Experienced</span>
        <h1>Passionate DevOps Engineer Creating Innovative Solutions</h1>
    </div>
    <div class="section-highlight">
        <p>With a strong background in DevOps and a passion for creating innovative solutions, I have successfully
            implemented various projects that have streamlined processes and improved efficiency. My expertise
            includes cloud computing, automation, and continuous integration and deployment.</p>
        <a href="html/about-me.html" class="btn">Learn More</a>
        <a href="html/contact-me.html" class="btn">Contact Me</a>
    </div>
</section>


<!-- Main Category Books -->
<section id="projects">
    <h1>Notable Cloud Engineering Ebooks</h1>
    <p>Explore some of my noteworthy engineering projects.</p>

    <!-- First Projects Grid -->
    <div class="projects-grid">
        <?php
        // Fetch all books (limit to 8 for two sections)
        $books_query = "SELECT * FROM Producttb LIMIT 8";
        $books_result = $database->con->query($books_query);

        // Check if any books were fetched
        if ($books_result && $books_result->num_rows > 0) {
            $counter = 0;  // Initialize counter to split books between two grids

            // Loop through books
            while ($book = $books_result->fetch_assoc()) {
                // Display first 4 books in the first grid
                if ($counter < 4) {
                    echo "
                    <div class='project-item'>
                        <img src='{$book['product_image']}' alt='{$book['product_name']}'>
                        <h3>{$book['product_name']}</h3>
                        <p>{$book['product_description']}</p>
                        <div class='project-tags'>
                            <span>AWS</span>
                            <span>MUR {$book['product_price']}</span>
                            <span>Terraform</span>
                        </div>
                        <!-- Add to Cart Button with Form -->
                        <form action='index_1.php' method='post'>
                            <input type='hidden' name='product_id' value='{$book['id']}'>
                            <button type='submit' name='add' class='btn'>Add to Cart</button>
                        </form>
                    </div>
                    ";
                }
                $counter++;
            }
        } else {
            echo "<div>No books found in the database.</div>";
        }
        ?>
    </div>

    <!-- Second Projects Grid -->
    <div class="projects-grid">
        <?php
        // Reset the result set to display the next 4 books
        $counter = 0;  // Reset counter for the second grid

        // Loop through the remaining books (if any)
        if ($books_result && $books_result->num_rows > 0) {
            // Fetch books again for the second grid
            mysqli_data_seek($books_result, 4);  // Skip first 4 books

            while ($book = $books_result->fetch_assoc()) {
                // Display the next 4 books in the second grid
                if ($counter < 4) {
                    echo "
                    <div class='project-item'>
                        <img src='{$book['product_image']}' alt='{$book['product_name']}'>
                        <h3>{$book['product_name']}</h3>
                        <p>{$book['product_description']}</p>
                        <div class='project-tags'>
                            <span>AWS</span>
                            <span>MUR {$book['product_price']}</span>
                            <span>Terraform</span>
                        </div>
                        <!-- Add to Cart Button with Form -->
                        <form action='index_1.php' method='post'>
                            <input type='hidden' name='product_id' value='{$book['id']}'>
                            <button type='submit' name='add' class='btn'>Add to Cart</button>
                        </form>
                    </div>
                    ";
                }
                $counter++;
            }
        }
        ?>
    </div>

    <!-- View All Button -->
    <a href="search.php" class="btn-view-all">View all</a>
</section>





<!-- Bestseller Books -->
<section id="blog">
    <h1>Explore the Bestsellers Cloud Ebooks</h1>
    <p>Stay updated with the latest DevOps practices and insights.</p>
    <div class="blog-grid">
        <?php
        // Database connection
        require_once('php/CreateDb.php');
        $database = new CreateDb("shop", "Producttb");

        // Fetch 3 bestsellers
        $bestseller_books_query = "SELECT * FROM Producttb WHERE is_best_seller = TRUE LIMIT 3";
        $bestseller_books = $database->con->query($bestseller_books_query);

        // Check if there are any bestseller books
        if ($bestseller_books && $bestseller_books->num_rows > 0) {
            while ($book = $bestseller_books->fetch_assoc()) {
                // Display each bestseller
                echo "
                <div class='blog-entry'>
                    <img src='{$book['product_image']}' alt='{$book['product_name']}'>
                    <h3>{$book['product_name']}</h3>
                    <p>{$book['product_description']}</p>
                    <div class='blog-meta'>
                        <span>{$book['author']}</span><br>
                        <span>" . date('d F Y', strtotime($book['date_of_publication'])) . " • 9 min read</span>
                    </div>
                    <!-- Add to Cart Button with Form -->
                    <form action='index_1.php' method='post'>
                        <input type='hidden' name='product_id' value='{$book['id']}'>
                        <button type='submit' name='add' class='btn'>Add to Cart</button>
                    </form>
                </div>
                ";
            }
        } else {
            echo "<div>No bestseller books found.</div>";
        }
        ?>
    </div>
    <!-- View All Button -->
    <a href="html/projects.html" class="btn-view-all">View all</a>
</section>






<section id="testimonials">
    <div class="testimonial-container">
        <!-- The navigation buttons -->
        <button class="testimonial-nav previous" aria-label="Previous" onclick="previousTestimonial()">
            <img src="images/left-arrow.png" alt="Previous">
        </button>
        <button class="testimonial-nav next" aria-label="Next" onclick="nextTestimonial()">
            <img src="images/right-arrow.png" alt="Next">
        </button>

        <!--testimonial 1-->
        <div class="testimonial-item">
            <div class="testimonial-rating">
                ★★★★★
            </div>
            <blockquote class="testimonial-quote">
                "In my 20 years in the tech industry, I have yet to encounter a DevOps Engineer as proficient and
                dedicated as Doosan. Their seamless integration of our development and operations has catapulted our
                product delivery cycles from monthly to weekly without sacrificing quality. Doosan's expertise in
                automation and their proactive approach to system reliability are simply unmatched."
            </blockquote>
            <div class="testimonial-author">
                <img class="testimonial-profile-pic" src="images/profile-placeholder.png" alt="John Doe">
                <div>
                    <p>Jordan S.</p>
                    <p>VP of Engineering at TechSphere</p>
                    <img class="testimonial-company-logo" src="images/location.png" alt="Webflow">
                </div>
            </div>
        </div>
        <!--testimonial 2-->
        <div class="testimonial-item">
            <div class="testimonial-rating">
                ★★★★
            </div>
            <blockquote class="testimonial-quote">
                "Doosan's contribution to our cloud infrastructure overhaul has been nothing short of revolutionary.
                Their knowledge of Kubernetes and cloud-native technologies is profound, and their commitment to
                security best practices has greatly fortified our systems. Doosan's leadership during our digital
                transformation journey has been a guiding light for the whole team."
            </blockquote>
            <div class="testimonial-author">
                <img class="testimonial-profile-pic" src="images/profile-placeholder.png" alt="John Doe">
                <div>
                    <p>Casey P.</p>
                    <p>Chief Information Officer at CloudNet Solutions</p>
                    <img class="testimonial-company-logo" src="images/insurance-company-2.png" alt="Webflow">
                </div>
            </div>
        </div>
        <!--testimonial 3-->
        <div class="testimonial-item">
            <div class="testimonial-rating">
                ★★★
            </div>
            <blockquote class="testimonial-quote">
                "Working alongside Doosan has been an eye-opening experience. His grasp of CI/CD pipelines and
                monitoring systems is exceptional. Doosan's innovative strategies have significantly reduced our
                downtime and improved our team's efficiency. They're not only a technical wizard but also a patient
                mentor to our junior staff."
            </blockquote>
            <div class="testimonial-author">
                <img class="testimonial-profile-pic" src="images/profile-placeholder.png" alt="John Doe">
                <div>
                    <p>Riley C.</p>
                    <p>Product Manager at Innovatech</p>
                    <img class="testimonial-company-logo" src="images/insurance-company.png" alt="Webflow">
                </div>
            </div>
        </div>
    </div>
    <!-- The indicators for multiple testimonials -->
    <div class="testimonial-indicators">
        <span class="testimonial-indicator"></span>
        <span class="testimonial-indicator"></span>
        <span class="testimonial-indicator"></span>
        <!-- Repeat the above span for as many testimonials we may have -->
    </div>
</section>



<section id="cta">
    <div class="cta-content">
        <h2>Transform your projects with DevOps</h2>
        <p>Unlock the power of DevOps for your business</p>
    </div>
    <div class="cta-buttons">
        <button class="btn btn-black">Hire me</button>
        <button class="btn btn-black">Read More</button>
    </div>
</section>


<footer class="footer">
    <div class="container">
        <div class="footer-logo">
            <a href="#"><img src="images/devops.png" alt="devOps"></a>
        </div>
        <div class="footer-column">
            <h4>About Me</h4>
            <ul>
                <li><a href="#">Projects</a></li>
                <li><a href="#">Contact Me</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Download CV</a></li>
                <li><a href="#">View Portfolio</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Professional Highlights</h4>
            <ul>
                <li><a href="#">Skills & Expertise</a></li>
                <li><a href="#">Technical Competencies</a></li>
                <li><a href="#">Timeline</a></li>
                <li><a href="#">Innovation Management</a></li>
                <li><a href="#">Project Leadership</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>DevOps Insights</h4>
            <ul>
                <li><a href="#">Industry Trends</a></li>
                <li><a href="#">Case Studies</a></li>
                <li><a href="#">Tool Reviews</a></li>
                <li><a href="#">Best Practices</a></li>
                <li><a href="#">Thought Leadership</a></li>
            </ul>
        </div>
        <div class="footer-subscribe">
            <h4>Subscribe</h4>
            <p>Join my community to receive updates and exclusive offers.</p>
            <form action="#" method="post">
                <label>
                    <input type="email" name="email" placeholder="Enter your email">
                </label>
                <button type="submit">Subscribe</button>
            </form>
            <p class="footer-privacy">By subscribing, you agree to our Privacy Policy and consent to receive updates
                from us.</p>
        </div>
    </div>

    <div class="footer-social">
        <a href="https://www.facebook.com" class="social-icon"><img src="images/facebook.png" alt="Facebook"
                                                                    target="_blank"></a>
        <a href="https://www.instagram.com/" class="social-icon"><img src="images/instagram.png" alt="Instagram"
                                                                      target="_blank"></a>
        <a href="https://twitter.com/" class="social-icon"><img src="images/xing.png" alt="Xing"
                                                                target="_blank"></a>
        <a href="https://www.linkedin.com/" class="social-icon"><img src="images/linkedin.png" alt="LinkedIn"
                                                                     target="_blank"></a>
        <a href="https://www.yotube.com/" class="social-icon"><img src="images/youtube.png" alt="YouTube"
                                                                   target="_blank"></a>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2024 Doosan. All rights reserved.</p>
        <a href="#">Privacy Policy</a> |
        <a href="#">Terms of Service</a> |
        <a href="#">Cookie Settings</a>

        <p>
            <a href="http://jigsaw.w3.org/css-validator/check/referer">
                <img style="border:0;width:88px;height:31px"
                     src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!" />
            </a>
        </p>
    </div>
</footer>

<script src="js/testimonial.js"></script>
<script src="js/slider.js"></script>
<script src="js/theme.js"></script>


<script>
    const darkModeToggle = document.querySelector('.dark-mode-toggle');

    darkModeToggle.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
    });
</script>



</body>

</html>