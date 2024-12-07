<?php

require __DIR__.'/../session.php';
if ( ! isset($_SESSION['logged'])) {
    header('Location: /');
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Sign Up</title>
</head>
<body>
<section>
    <div class="relative mx-10">
        <div class="container mx-auto">
            <nav class="block w-full max-w-screen-2xl rounded-xl py-4 px-8 shadow-md backdrop-saturate-200 backdrop-blur-2xl bg-opacity-80 border-white/80 bg-white text-white relative z-50 mt-6 border-0">
                <div class="container flex items-center justify-between mx-auto">
                    <p class="block antialiased font-sans text-blue-900 text-lg font-bold">Hello <?php
                        if (isset($username)) {
                            echo $username;
                        } ?>
                        ,Welcome To Our Library</p>
                    <ul class="items-center hidden gap-8 ml-10 lg:flex">
                        <?php
                        if (isset($role) && $role === 'admin'):
                            ?>
                            <li><a href="/bookmangement"
                                   class="antialiased font-sans text-base leading-relaxed flex items-center gap-2 font-medium text-gray-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                         aria-hidden="true" data-slot="icon" class="w-5 h-5">
                                        <path d="M5.566 4.657A4.505 4.505 0 0 1 6.75 4.5h10.5c.41 0 .806.055 1.183.157A3 3 0 0 0 15.75 3h-7.5a3 3 0 0 0-2.684 1.657ZM2.25 12a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3v-6ZM5.25 7.5c-.41 0-.806.055-1.184.157A3 3 0 0 1 6.75 6h10.5a3 3 0 0 1 2.683 1.657A4.505 4.505 0 0 0 18.75 7.5H5.25Z"></path>
                                    </svg>
                                    Book Management</a></li>
                        <?php
                        endif; ?>
                        <?php
                        if (isset($role) && $role === 'admin'):
                            ?>
                            <li><a href="/dashboard"
                                   class="antialiased font-sans text-base leading-relaxed flex items-center gap-2 font-medium text-gray-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                         aria-hidden="true" data-slot="icon" class="w-5 h-5">
                                        <path d="M5.566 4.657A4.505 4.505 0 0 1 6.75 4.5h10.5c.41 0 .806.055 1.183.157A3 3 0 0 0 15.75 3h-7.5a3 3 0 0 0-2.684 1.657ZM2.25 12a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3v-6ZM5.25 7.5c-.41 0-.806.055-1.184.157A3 3 0 0 1 6.75 6h10.5a3 3 0 0 1 2.683 1.657A4.505 4.505 0 0 0 18.75 7.5H5.25Z"></path>
                                    </svg>
                                    User Managements</a></li>
                        <?php
                        endif; ?>
                        <li><a href="/books"
                               class="antialiased font-sans text-base leading-relaxed flex items-center gap-2 font-medium text-gray-900">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                     aria-hidden="true" data-slot="icon" class="w-5 h-5">
                                    <path d="M5.566 4.657A4.505 4.505 0 0 1 6.75 4.5h10.5c.41 0 .806.055 1.183.157A3 3 0 0 0 15.75 3h-7.5a3 3 0 0 0-2.684 1.657ZM2.25 12a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3v-6ZM5.25 7.5c-.41 0-.806.055-1.184.157A3 3 0 0 1 6.75 6h10.5a3 3 0 0 1 2.683 1.657A4.505 4.505 0 0 0 18.75 7.5H5.25Z"></path>
                                </svg>
                                Books</a></li>
                        <li><a href="/me"
                               class="antialiased font-sans text-base leading-relaxed flex items-center gap-2 font-medium text-gray-900">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                     aria-hidden="true" data-slot="icon" class="w-5 h-5">
                                    <path fill-rule="evenodd"
                                          d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                My Profile</a></li>

                    </ul>
                </div>
                <div class="block w-full basis-full overflow-hidden" style="height:0" data-projection-id="3">
                    <div class="container px-2 pt-4 mx-auto mt-3 border-t border-gray-200">

                        <div class="flex items-center gap-4 mt-6 mb-4">
                            <button class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg text-gray-900 hover:bg-gray-900/10 active:bg-gray-900/20"
                                    type="button">Log in
                            </button>
                            <button class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                                    type="button">buy now
                            </button>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="!flex h-[90vh] w-full items-center justify-between px-10"><img
                src="/images/Library_Background.jpg"
                alt="bg-img"
                class="absolute inset-0 ml-auto h-auto w-full  object-center object-center"/>
        <div class="container mx-auto lg:mt-0 ">
            <div class="grid grid-cols-12 text-center lg:text-left">
                <div class="relative flex flex-col bg-clip-border text-gray-700 px-6 py-10 border border-white shadow-lg col-span-full rounded-xl bg-white/90 shadow-black/10 backdrop-blur-sm backdrop-saturate-200 xl:col-span-7">
                    <h1 class="block antialiased tracking-normal font-sans font-semibold text-blue-gray-900 text-3xl !leading-snug lg:text-5xl">
                        Welcome to Our Library!</h1>
                    <p class="block antialiased font-sans text-xl font-normal leading-relaxed text-inherit mb-10 mt-6 !text-gray-900">
                        Discover a world of knowledge, stories, and inspiration at your fingertips. Whether you're a
                        curious learner, an avid reader, or simply looking for a quiet escape, our library offers a
                        diverse collection of books across all genres. Step in and explore a treasure trove of resources
                        for everyone!</p>
                    <div class="flex justify-center gap-4 mb-8 lg:justify-start">
                        <a href="../logout.php"
                           class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                           type="button">Log Out
                        </a>
                        <a href="mailto:AhnedMuhammed0031@gmail.com"
                           class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]"
                           type="button">
                            Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
</body>
</html>

