<template>
    <div class="d-flex size-6">
        <nav class="d-flex">
            <router-link to="/">Home</router-link> |
            <router-link to="/contacts">Contacts</router-link> |
            <router-link to="/login">Login</router-link>
        </nav>
        <router-view />
    </div>
</template>

<style>
</style>
