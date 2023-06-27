<script setup>
    import { useForm } from '@inertiajs/inertia-vue3';
    import TopBanner from '../../Components/TopBanner.vue';
    const form = useForm({
      amount:"",
      reference:"",
      pot: props.pot,
      method: props.method,
  });
  
  let props = defineProps(
        {
          pot: { type: Object, required: false },
          base_url: { type: String, required: false },
          user: { type: Object, required: false },
          method: { type: String, required: false },
        });
  
  const submit =()=>{
      form.post(`/pots/${props.pot.id}/contributions/${props.method}`),{};
  };
   </script>
   
  <template>
    <TopBanner :showImages="false" :customImageUrl="props.base_url + '/' + props.pot.cover_photo_path" :borderColour="'#DE85BB'"/>
    <div class="flex flex-wrap justify-center pt-4 bg-no-repeat bg-cover bg-banner">
      <div class="relative flex items-center justify-center h-0 w-72" >
          <div class="text-center m-auto absolute w-full top-[85%]">
              <h1 class="text-[1.4em] text-[#715192] font-bold">Create a {{props.method}} transaction for {{props.pot.name}} pot</h1>
          </div>
      </div>
    </div>
    <br>
  
    <div class="flex justify-center pt-4 my-10">  
      <form @submit.prevent="submit" class="mx-2">
        <label class="text-[1.4em] text-[#715192] font-bold mb-20">Amount</label> <br>
        <input v-model="form.amount" type="number" step="0.01"  class="w-full px-3 py-2 border-none rounded bg-slate-100 bg-formInputGray" min="0" max="1000000" required placeholder="Amount" name="amount">

        <label class="text-[1.4em] text-[#715192] font-bold mb-20">Reference</label> <br>
        <input v-model="form.reference" type="text" class="w-full px-3 py-2 border-none rounded bg-slate-100 bg-formInputGray"  placeholder="Optional reference"  name="reference">

        <label class="text-[1.4em] text-[#715192] font-bold mb-20">Card Number</label> <br>
        <input type="text" class="w-full px-3 py-2 border-none rounded bg-slate-100 bg-formInputGray"  placeholder="Card Number" required name="cardNumber">

        <label class="text-[1.4em] text-[#715192] font-bold mb-20">Sort Code</label> <br>
        <input type="text" class="w-full px-3 py-2 border-none rounded bg-slate-100 bg-formInputGray"  placeholder="Card Number" required name="sortCode">
        <div class="my-6 md:flex md:items-center">
          <button
            type="submit"
            class="w-40 h-10 text-center text-white rounded-full cursor-pointer"
            :style="{backgroundColor: '#715191'}">
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