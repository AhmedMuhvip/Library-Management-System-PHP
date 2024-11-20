<?php

require __DIR__.'/../session.php';
?>
<!doctype html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet"/>
    <title>Sign Up</title>
</head>
<body>
<section class=" h-full bg-gray-50 dark:bg-gray-900 ">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 ">
        <!--        <img class=" w-50 h-60 mx-auto mb-2" src="../images/bookshelf.png" alt="logo">-->
        <div class="w-full bg-white rounded-lg shadow dark:border sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Create an account
                </h1>

                <form class="space-y-4 md:space-y-6" action="../controllers/signup_contr.php" method="POST"
                      enctype="multipart/form-data">
                    <?php
                    if (isset($errors['empty_inputs'])): ?>
                        <p class="text-red-500"><?php
                            echo $errors['empty_inputs']; ?></p>
                    <?php
                    endif;
                    ?>
                    <div>
                        <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                            Name</label>
                        <input type="text" name="fname" id="fname" value="<?php
                        echo htmlspecialchars($formData['fname'] ?? ''); ?>"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>

                    <div>
                        <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                            Name</label>
                        <input type="text" name="lname" id="lname" value="<?php
                        echo htmlspecialchars($formData['lname'] ?? ''); ?>"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            email</label>
                        <input type="email" name="email" id="email" value="<?php
                        echo htmlspecialchars($formData['email'] ?? ''); ?>"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <?php
                        if (isset($errors['invalid_email']) && ! isset($errors['empty_inputs'])): ?>
                            <p class="text-red-500"><?php
                                echo $errors['invalid_email']; ?></p>
                        <?php
                        endif; ?>

                        <?php
                        if ( ! isset($errors['invalid_email']) && isset($errors["email_is_registered"])): ?>
                            <p class="text-red-500"><?php
                                echo $errors['email_is_registered']; ?></p>
                        <?php
                        endif; ?>
                    </div>

                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <?php
                        if (isset($errors['invalid_password']) && ! isset($errors['empty_inputs']) && ! isset($errors['invalid_email'])): ?>
                            <p class="text-red-500"><?php
                                echo $errors['invalid_password']; ?></p>
                        <?php
                        endif; ?>
                    </div>
                    <div>


                        <label class="block mb-3 text-sm font-medium text-gray-900 dark:text-white" for="image_input">Upload
                            file</label>
                        <input class=" block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                               id="image_input" type="file" name="image">


                    </div>
                    <button type="submit"
                            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-3 text-center transition-transform transform hover:scale-105 shadow-lg hover:shadow-xl dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Create an account
                    </button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Already have an account? <a href="/"
                                                    class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login
                            here</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
