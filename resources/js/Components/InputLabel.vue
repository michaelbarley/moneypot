<script setup>
defineProps({
    value: String,
});
</script>

<template>
    <label class="text-[1.4em] text-[#715192] font-bold mb-20">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
