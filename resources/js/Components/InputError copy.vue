<script setup>
defineProps(['message']);
</script>

<template>
    <div v-show="message">
        <p class="mb-2 text-sm text-red-600">
            {{ message }}
        </p>
    </div>
</template>
