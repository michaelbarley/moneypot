<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

let props = defineProps({
    active: Boolean,
    href: String,
    as: String,
});


</script>

<template>
    <div>
        <button>
            <slot />
        </button>

    </div>
</template>
