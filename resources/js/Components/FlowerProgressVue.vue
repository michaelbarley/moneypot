<script setup>
    import { onMounted, ref } from 'vue';
    
    defineProps({
        value: Number
    });
    
    </script>
    
    <template>
        <svg viewBox="-10 -10 120 120">    
            <circle cx="50" cy="50" r="50" fill="#f3f3f3" />
            <!-- 12 -->
            <path d="M -3 0 C -3 -3 -1 -5 0 -7 C 1 -5 3 -3 3 0 C 3 3 1 5 0 7 C -1 5 -3 3 -3 0 Z" transform="translate(50, 0)" v-bind:fill="[value >= 100 ? '#fab726' : '#b9b6b0']"/>
            <path d="M -3 0 C -3 -3 -1 -5 0 -7 C 1 -5 3 -3 3 0 C 3 3 1 5 0 7 C -1 5 -3 3 -3 0 Z" transform="rotate(18,50,50) translate(50, 0)" v-bind:fill="[value > 5 ? '#047842' : '#b9b6b0']"/>
            <path d="M -3 0 C -3 -3 -1 -5 0 -7 C 1 -5 3 -3 3 0 C 3 3 1 5 0 7 C -1 5 -3 3 -3 0 Z" transform="rotate(36,50,50) translate(50, 0) " v-bind:fill="[value > 10 ? '#715293' : '#b9b6b0']"/>
            <path d="M -3 0 C -3 -3 -1 -5 0 -7 C 1 -5 3 -3 3 0 C 3 3 1 5 0 7 C -1 5 -3 3 -3 0 Z" transform="rotate(54,50,50) translate(50, 0) " v-bind:fill="[value > 15 ? '#fab726' : '#b9b6b0']"/>
            <path d="M -3 0 C -3 -3 -1 -5 0 -7 C 1 -5 3 -3 3 0 C 3 3 1 5 0 7 C -1 5 -3 3 -3 0 Z" transform="rotate(72,50,50) translate(50, 0) " v-bind:fill="[value > 20 ? '#1f99d7' : '#b9b6b0']"/>
            <!-- 3 -->
            <path d="M -3 0 C -3 -3 -1 -5 0 -7 C 1 -5 3 -3 3 0 C 3 3 1 5 0 7 C -1 5 -3 3 -3 0 Z" transform="rotate(90,50,50) translate(50, 0) " v-bind:fill="[value > 25 ? '#de85bb' : '#b9b6b0']"/>
            <path d="M -3 0 C -3 -3 -1 -5 0 -7 C 1 -5 3 -3 3 0 C 3 3 1 5 0 7 C -1 5 -3 3 -3 0 Z" transform="rotate(108,50,50) translate(50, 0) " v-bind:fill="[value > 30 ? '#114389' : '#b9b6b0']"/>
            <path d="M -3 0 C -3 -3 -1 -5 0 -7 C 1 -5 3 -3 3 0 C 3 3 1 5 0 7 C -1 5 -3 3 -3 0 Z" transform="rotate(126,50,50) translate(50, 0) " v-bind:fill="[value > 35 ? '#715293' : '#b9b6b0']"/>
            <path d="M -3 0 C -3 -3 -1 -5 0 -7 C 1 -5 3 -3 3 0 C 3 3 1 5 0 7 C -1 5 -3 3 -3 0 Z" transform="rotate(144,50,50) translate(50, 0) " v-bind:fill="[value > 40 ? '#fab726' : '#b9b6b0']"/>
            <path d="M -3 0 C -3 -3 -1 -5 0 -7 C 1 -5 3 -3 3 0 C 3 3 1 5 0 7 C -1 5 -3 3 -3 0 Z" transform="rotate(162,50,50) translate(50, 0) " v-bind:fill="[value > 45 ? '#047840' : '#b9b6b0']"/>
            <!-- 6 -->
            <path d="M -3 0 C -3 -3 -1 -5 0 -7 C 1 -5 3 -3 3 0 C 3 3 1 5 0 7 C -1 5 -3 3 -3 0 Z" transform="rotate(180,50,50) translate(50, 0) " v-bind:fill="[value > 50 ? '#de85bb' : '#b9b6b0']"/>
            <path d="M -3 0 C -3 -3 -1 -5 0 -7 C 1 -5 3 -3 3 0 C 3 3 1 5 0 7 C -1 5 -3 3 -3 0 Z" transform="rotate(198,50,50) translate(50, 0) " v-bind:fill="[value > 55 ? '#114389' : '#b9b6b0']"/>
            <path d="M -3 0 C -3 -3 -1 -5 0 -7 C 1 -5 3 -3 3 0 C 3 3 1 5 0 7 C -1 5 -3 3 -3 0 Z" transform="rotate(216,50,50) translate(50, 0) " v-bind:fill="[value > 60 ? '#047840' : '#b9b6b0']"/>
            <path d="M -3 0 C -3 -3 -1 -5 0 -7 C 1 -5 3 -3 3 0 C 3 3 1 5 0 7 C -1 5 -3 3 -3 0 Z" transform="rotate(234,50,50) translate(50, 0) " v-bind:fill="[value > 65 ? '#715293' : '#b9b6b0']"/>
            <path d="M -3 0 C -3 -3 -1 -5 0 -7 C 1 -5 3 -3 3 0 C 3 3 1 5 0 7 C -1 5 -3 3 -3 0 Z" transform="rotate(252,50,50) translate(50, 0) " v-bind:fill="[value > 70 ? '#fab726' : '#b9b6b0']"/>
            <!-- 9 -->
            <path d="M -3 0 C -3 -3 -1 -5 0 -7 C 1 -5 3 -3 3 0 C 3 3 1 5 0 7 C -1 5 -3 3 -3 0 Z" transform="rotate(270,50,50) translate(50, 0) " v-bind:fill="[value > 75 ? '#c5184b' : '#b9b6b0']"/>
            <path d="M -3 0 C -3 -3 -1 -5 0 -7 C 1 -5 3 -3 3 0 C 3 3 1 5 0 7 C -1 5 -3 3 -3 0 Z" transform="rotate(288,50,50) translate(50, 0) " v-bind:fill="[value > 80 ? '#047842' : '#b9b6b0']"/>
            <path d="M -3 0 C -3 -3 -1 -5 0 -7 C 1 -5 3 -3 3 0 C 3 3 1 5 0 7 C -1 5 -3 3 -3 0 Z" transform="rotate(306,50,50) translate(50, 0) " v-bind:fill="[value > 85 ? '#de85bb' : '#b9b6b0']"/>
            <path d="M -3 0 C -3 -3 -1 -5 0 -7 C 1 -5 3 -3 3 0 C 3 3 1 5 0 7 C -1 5 -3 3 -3 0 Z" transform="rotate(324,50,50) translate(50, 0) " v-bind:fill="[value > 90 ? '#114389' : '#b9b6b0']"/>
            <path d="M -3 0 C -3 -3 -1 -5 0 -7 C 1 -5 3 -3 3 0 C 3 3 1 5 0 7 C -1 5 -3 3 -3 0 Z" transform="rotate(342,50,50) translate(50, 0) " v-bind:fill="[value > 95 ? '#715293' : '#b9b6b0']"/>
            <!-- <text x="25" y="55" fill="Back" font-size="2em">{{value}} %</text> -->
        </svg>
    </template>
    