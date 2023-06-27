<script setup>
  import { useForm } from '@inertiajs/inertia-vue3';
  import TopBanner from '../../Components/TopBanner.vue';
  const form = useForm({
    name:"",
    description:"",
    goal:"",
    is_auto_closing: false,
    cover_photo_path:null,
    is_private: false,
    accent_colour: false,
    user_id: props.user.id,
});

let props = defineProps(
      {
        user: { type: Object, required: false }
      });

const submit =()=>{
    form.post(route('store pot'),{});
};
 </script>
 
<template>
  <TopBanner :showImages="true" customImageUrl="http://moneypot.test/Images/login_main.jpg" :borderColour="'#DE85BB'"/>
  <div class="flex flex-wrap justify-center pt-4 bg-no-repeat bg-cover bg-banner">
    <div class="relative flex items-center justify-center h-0 w-72" >
        <div class="text-center m-auto absolute w-full top-[85%]">
            <h1 class="text-[1.4em] text-[#715192] font-bold">Create a pot</h1>
        </div>
    </div>
  </div>


  <div class="flex justify-center pt-4 my-10">  
    <form @submit.prevent="submit" class="mx-2" type="multipart/form-data">
      <label class="font-bold"> Pot Name </label> <br>
      <input v-model="form.name" type="text" class="w-full px-3 py-2 border-none rounded bg-slate-100 bg-formInputGray" placeholder="Choose a name for your pot."  name="name" required>

      <label class="font-bold"> Pot description </label> <br>
      <input v-model="form.description" type="text" class="w-full px-3 py-2 border-none rounded bg-slate-100 bg-formInputGray"  placeholder="Describe what your pot is for."  name="description" required>

      <label class="font-bold"> Pot goal </label> <br>
      <input v-model="form.goal" type="number" class="w-full px-3 py-2 border-none rounded bg-slate-100 bg-formInputGray" min="0" max="1000000" required placeholder="Set a goal for your pot." name="goal">

      <label class="font-bold"> Auto Close Pot?</label><br>
      <input v-model="form.is_auto_closing" type="checkbox" class="ml-2 cursor-pointer" id="is_auto_closing" name="is_auto_closing" unchecked> <br>

      <label class="font-bold"> Pot Image: </label><br>
      <input type="file" @input="form.cover_photo_path = $event.target.files[0]" name="cover_photo_path"> <br>

      <label class="font-bold"> Is the pot private?</label><br>
      <input v-model="form.is_private" type="checkbox" class="ml-2 cursor-pointer" id="is_private" name="is_private" unchecked> <br>

      <label for="accent_colourColour" class="font-bold">Accent Colour</label>
      <br>
      <select v-model="form.accent_colour" name="accent_colour">
        <option selected>Choose a accent colour</option>
        <option value="pink">Pink</option>
        <option value="aqua">Aqua</option>
        <option value="blue">Blue</option>
        <option value="yellow">Yellow</option>
        <option value="red">Red</option>
      </select>
      <div class="my-6 md:flex md:items-center">
        <button
          type="submit"
          class="w-40 h-10 text-center text-white rounded-full cursor-pointer bg-darkPurple hover:bg-dpHover"
          >
          Create
          </button>
      </div>
    </form>
  </div>
</template>

 <style>
  label {
    color: #715191;
  }

 </style>