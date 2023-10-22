<?php
include("admin/conf/config.php");
/* Persisit System Settings On Brand */
$ret = "SELECT * FROM `iB_SystemSettings` ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
?>
    <!DOCTYPE html>
    <html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />

    <head>
        <!-- Add any necessary meta tags, CSS, and scripts -->
        <title>About </title>
        <link href="dist/css/robust.css" rel="stylesheet">
    </head>

    <body>

        <!-- Replace the navbar with an appropriate navigation menu for the "About" page -->
        <nav class="navbar navbar-lg navbar-expand-lg navbar-transparant navbar-dark navbar-absolute w-100">
            <div class="container">
                <!-- Update the branding link to the homepage or another appropriate page -->
                <a class="navbar-brand" href="index.php">Home</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Update the navigation links as needed -->
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="pages_about.php">About</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="admin/pages_index.php">Admin Portal</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="client/pages_client_index.php">Client Portal</a>
                        </li>
                    </ul>
                    <!-- Update the button to link to appropriate pages or remove it if not needed -->
                    <a class="btn btn-danger" href="client/pages_client_signup.php">Join Us</a>
                </div>
            </div>
        </nav>

        <!-- Add content for the "About" page -->
        <div class="intro py-5 py-lg-9 position-relative text-white">
            <div class="bg-overlay-gray">
                <img src="dist/bg.webp" class="img-fluid img-cover"/>
            </div>
            <div class="intro-content py-6 text-center">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-sm-10 col-md-8 col-lg-6 mx-auto text-center">
                            <!-- Replace the header and tagline with appropriate content -->
                            <h1 class="my-3 display-4 d-none d-lg-inline-block">About </h1> 
                            <p class="lead mb-3">
                                <?php echo $sys->sys_tagline; ?>
                            </p>
                            <br>
                            <!-- Add any additional information or call-to-action buttons as needed -->
                            <a class="btn btn-success btn-lg mr-lg-2 my-1" href="index.php" role="button">Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- About Essay -->
<div style="background-image: url('https://img.freepik.com/premium-photo/stack-black-money-coin-banking-currency-business-finance-cash-dollar-treasure-earnings-financial-profit-market-investment-stock-exchange-dark-3d-background-with-success-economy-income_79161-2032.jpg?w=2000'); background-color: rgba(0, 0, 0, 0.5); background-blend-mode: multiply;">
    <div class="container text-white" style="max-width: 8000px;">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <!-- Add the "About" essay content with justified text -->
                <h2 class="text-center">Introducing Our Futuristic Internet Banking Platform</h2>
                    <p class="text-justify">
                        In the ever-evolving digital landscape, the power of technology has unleashed endless possibilities, transforming
                        the way we conduct financial transactions. Today, we take immense pride in introducing our cutting-edge Internet
                        Banking Website – a secure, user-friendly, and innovative platform that brings banking convenience to your
                        fingertips. With a commitment to delivering unparalleled banking experiences, we invite you to explore the future
                        of banking through our state-of-the-art digital ecosystem.
                    </p class="text-justify">
                    <h2></h2>
                    <h2></h2>
                    <h2>Our Vision:</h2>
                    <p class="text-justify">
                        At the heart of our Internet Banking Website lies a profound vision: to redefine the banking experience for our
                        valued customers. Empowered by the latest advancements in technology, our platform aims to bridge the gap between
                        traditional banking practices and the demands of a dynamic, fast-paced world. Our vision is to become the leading
                        beacon of digital banking, setting new standards of excellence and efficiency in the industry.
                    </p class="text-justify">
                    <h2></h2>
                    <h2></h2>
                    <h2>Unrivaled Security:</h2>
                    <p class="text-justify">
                        We understand that security is paramount when it comes to handling your hard-earned money. Rest assured, our Internet
                        Banking Website employs the most robust security measures available, safeguarding your financial data from any potential
                        threats. With end-to-end encryption, multi-factor authentication, and constant monitoring, your transactions are
                        shielded within an impenetrable fortress, providing peace of mind in every digital interaction.
                    </p class="text-justify">
                    <h2></h2>
                    <h2></h2>
                    <h2>User-Friendly Interface:</h2>
                    <p class="text-justify">
                        Navigating the complexities of the banking world should never be a daunting task. That's why we've designed our Internet
                        Banking Website with a user-friendly interface, making it effortless for both tech-savvy individuals and novices alike.
                        With an intuitive layout, streamlined menus, and straightforward options, managing your finances has never been easier.
                        Embracing simplicity without compromising functionality, our platform offers an unrivaled banking experience.
                    </p class="text-justify">
                    <h2></h2>
                    <h2></h2>
                    <h2>Innovative Features:</h2>
                    <p class="text-justify">
                        Welcome to a world of innovation and endless possibilities. Our Internet Banking Website boasts an array of cutting-edge
                        features tailored to elevate your banking journey. From instant fund transfers and bill payments to comprehensive financial
                        insights, our platform offers an all-encompassing suite of services to cater to your diverse banking needs. With real-time
                        updates and personalized notifications, you'll always stay ahead of your financial game.
                    </p class="text-justify">
                    <h2></h2>
                    <h2></h2>
                    <h2>24/7 Accessibility:</h2>
                    <p class="text-justify">
                        Life operates beyond the confines of traditional banking hours, and so does our Internet Banking Website. Embracing the
                        concept of accessibility, our platform is available 24/7, enabling you to manage your finances at your convenience.
                        Whether you're on a business trip, enjoying a vacation, or simply relaxing at home, our Internet Banking Website empowers
                        you to take control of your finances wherever you are.
                    </p class="text-justify">
                    <h2> </h2>
                    <h2> </h2>
                    <h2>Customer-Centric Approach:</h2>
                    <p class="text-justify">
                        We recognize that our success is intrinsically linked to the satisfaction of our esteemed customers. Therefore, a
                        customer-centric approach is embedded within the core values of our Internet Banking Website. Our dedicated support team is
                        always ready to assist you, promptly addressing any queries or concerns. We prioritize feedback, continuously striving to
                        enhance our services based on your valuable input.
                    </p class="text-justify">
                    <h2> </h2>
                    <h2> </h2>
                </div>
            </div>
        </div>
    <script src="dist/js/bundle.js"></script>
</body>
</html>

<?php
} ?>