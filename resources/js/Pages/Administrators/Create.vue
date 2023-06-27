<script setup>
  import { useForm } from '@inertiajs/inertia-vue3';
  import TopBanner from '../../Components/TopBanner.vue';
  const form = useForm({
    email:"",
    pot_id: props.pot.id,
});

let props = defineProps(
      {
        pot: Object,
        base_url: String,
        user: Object,
        administrators: Object,
      });

const submit =()=>{
    form.post(`/pots/${props.pot.id}/administrators/share/store`),{};
};
 </script>
 
<template>
  <TopBanner :showImages="false" :customImageUrl="props.base_url + '/' + props.pot.cover_photo_path" :borderColour="'#DE85BB'" />
  <div class="flex flex-wrap justify-center pt-4 bg-no-repeat bg-cover bg-banner">
    <div class="relative flex items-center justify-center h-0 w-72" >
        <div class="text-center m-auto absolute w-full top-[85%]">
            <h1 class="font-bold">Share access to "{{props.pot.name}}" pot</h1>
        </div>
    </div>
  </div>

  <div class="flex justify-center pt-4 my-10">  
    <form @submit.prevent="submit" class="mx-2">
      <label class="font-bold">Email Address</label> <br>
      <input v-model="form.email" type="email" class="w-full px-3 py-2 border-none rounded bg-slate-100 bg-formInputGray" required placeholder="Email Address" name="email">
      <div class="my-6 md:flex md:items-center">
          <button
              type="submit"
              class="w-40 h-10 text-center text-white rounded-full cursor-pointer"
              :style="{backgroundColor: '#715191'}">
              Invite
          </button>
      </div>
    </form>
  </div>
  <div class="flex justify-center pt-4 my-10"> 
    <ul class="p-2 mb-12 overflow-x-scroll overflow-y-hidden whitespace-nowrap no-scrollbar">
      <li v-for="item in props.administrators" :key="item" class="inline-block p-3 px-8 mx-1 border border-gray-200 rounded w-fit">{{item}}</li>

    </ul>
  </div>
  
</template>

 <style>
  label {
    color: #715191;
  }

 </style>