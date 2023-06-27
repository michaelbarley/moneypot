<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import TopBanner from "../../Components/TopBanner.vue";
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';


let props = defineProps({

    user: { type: Object, required: false },
    numberOfOpenPots: { type: Number, required: false },
    totalContributions: { type: Number, required: false },
    totalContributionsValue: { type: Number, required: false },
    openPots: { type: Number, required: false },
    finishedPots: { type: Number, required: false },
});

const form = useForm({
  email: props.user.email,
  password: "",
  name: props.user.name,
  id: props.user.id,
  profile_photo_path:null
});

const submit =()=>{
    form.post(route('update profile'));
};
</script>

<template>
  <TopBanner
    :showImages="true"
    customImageUrl="http://moneypot.test/Images/login_main.jpg"
    :borderColour="'#DE85BB'"
  />

  <img :v-if="props.user.profile_photo_path"
    class="absolute w-[9rem] h-[9rem] top-[18rem] bg-white border-4 border-moneyPot z-2 rounded-full left-[calc(50%_-_4.5rem)]"
    :src="`/${props.user.profile_photo_path}`"
  />
  <div class="grid grid-cols-2 gap-12 px-8 pt-4 pb-8 my-14 sm:grid-cols-2" >
    <div class="w-full max-w-96">
      <div class="px-8">
        <form @submit.prevent="submit" type="multipart/form-data" enctype="multipart/form-data">
          <div>
            <InputLabel for="name" value="Name" />
            <TextInput
              id="name"
              v-model="form.name"
              type="text"
              class="block w-full mt-1"
              autofocus
            />
            <InputError class="mt-2" :message="form.errors.email" />
          </div>

          <div>
            <InputLabel for="email" value="Email" />
            <TextInput
              id="email"
              v-model="form.email"
              type="email"
              class="block w-full mt-1"
              autofocus
            />
            <InputError class="mt-2" :message="form.errors.email" />
          </div>

          <div class="mt-4">
            <InputLabel for="password" value="Password" />
            <TextInput
              id="password"
              v-model="form.password"
              type="password"
              class="block w-full mt-1"
              autocomplete="current-password"
            />
            <InputError class="mt-2" :message="form.errors.password" />
          </div>

          <div class="mt-4">
            <InputLabel for="profile_photo_path" />
            <input type="file" @input="form.profile_photo_path = $event.target.files[0]" name="profile_photo_path"> <br>
          </div>



          <div class="my-6 md:flex md:items-center">
            <button
              type="submit"
              class="w-40 h-10 text-center text-white rounded-full cursor-pointer bg-darkPurple hover:bg-dpHover"
            >
              Save Changes
            </button>
          </div>
        </form>
      </div>
    </div>
    <div>
      <div class="w-full text-center max-w-96">
        <h1 class="text-[1.4em] text-[#715192] font-bold mb-20">{{ props.user.name }}</h1>
      </div>
      <div class="relative grid w-3/4 grid-cols-2 gap-12 pt-4 pb-12 m-auto px-14 my-14 sm:grid-cols-2">
        <div>
          <h1 class="text-[2em] text-[#715192] font-bold">{{props.openPots}}</h1>
            <h2>Open pots</h2>
        </div>
        <div>
          <h1 class="text-[2em] text-[#715192] font-bold">{{props.totalContributions}}</h1>
            <h2>Contributions</h2>
        </div>
      </div>

      <div class="relative grid w-3/4 grid-cols-2 gap-12 pt-4 pb-12 m-auto px-14 my-14 sm:grid-cols-2">
        <div>
          <h1 class="text-[2em] text-[#715192] font-bold">£{{props.totalContributionsValue}}</h1>
            <h2>Total raised</h2>
        </div>

        <div>
          <h1 class="text-[2em] text-[#715192] font-bold">{{props.finishedPots}}</h1>
            <h2>Finished pots</h2>
        </div>
      </div>
    </div>
    </div>
    

</template>
