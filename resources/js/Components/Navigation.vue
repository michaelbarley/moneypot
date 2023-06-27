<template>
<nav class="bg-[#715192] text-white float-right relative z-10 p-1 rounded-bl-3xl">
    <Link class="mx-1 sm:mx-5 align-super" :href="route('pot.dashboard')" method="get" as="button">
        Pot Dashboard
    </Link>
    <Link class="align-super" :href="route('user.view')" method="get" as="button">
        Account Management
    </Link>
    <a class="mx-1 sm:mx-5 align-super" href="#">Contact Us</a>
    <Link :href="route('logout')" method="post" as="button">
        <img class="float-right w-[22px] mr-4 ml-2 mt-1" src="/images/logout.svg">
    </Link>
</nav>
</template>