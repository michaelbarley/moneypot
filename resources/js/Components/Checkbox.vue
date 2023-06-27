<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

let props = defineProps({
    checked: {
        type: [Array, Boolean],
        default: false,
        required: false,
    },
    value: {
        type: String,
        default: null,
        required: false,
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>


<template>
    <input
        v-model="proxyChecked"
        type="checkbox"
        :value="value"
        class="text-indigo-600 border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    >
</template>
