<script setup>
    import TopBanner from '../../Components/TopBanner.vue';
    import { useForm } from '@inertiajs/inertia-vue3';
    import FlowerProgressVue from '../../Components/FlowerProgressVue.vue';
    import moment from "moment";
    import { ref } from 'vue';
    
     let props = defineProps (
    {
        user: { type: Object, required: false },
        pot: { type: Object, required: false },
        base_url: { type: String, required: false },
        userCanCloseAndWithdraw: { type: Boolean, required: false },
    })
    
    const form = useForm({
        name:props.pot.name,
        description:props.pot.description,
        goal:props.pot.goal,
        is_auto_closing: props.pot.is_auto_closing == 1 ? true : false,
        cover_photo_path:null,
        is_private: props.pot.is_private == 1 ? true : false,
        accent_colour: props.pot.accent_colour,
        user_id: props.user.id,
    });

    const submit =()=>{
        form.put(route('update pot', {'pot':props.pot.id}),{});
    };
    
    let calculatePercentage = (amount, goal) => Math.floor(amount / goal * 100);

    </script>
    
    <template>
        <TopBanner :showImages="false" :customImageUrl="props.base_url + '/' + props.pot.cover_photo_path" :borderColour="'#DE85BB'"/>
        <div class="flex flex-wrap justify-center pt-4 bg-no-repeat bg-cover bg-banner">
            <div class="relative flex items-center justify-center h-42 w-72" ></div>
        </div>


        <div class="grid grid-cols-2 gap-12 px-8 pt-4 pb-8 my-14 sm:grid-cols-2">
            <div class="w-full max-w-96">
                <form @submit.prevent="submit" class="mx-2" type="multipart/form-data w-3/4 m-auto">
                    <label class="text-[1.4em] text-[#715192] font-bold mb-20" :style="{color: props.pot.accent_colour}"> Pot Name </label> <br>
                    <input v-model="form.name" type="text" class="w-full px-3 py-2 border-none rounded bg-slate-100 bg-formInputGray" placeholder="Choose a name for your pot."  name="name" required>

                    <label class="text-[1.4em] text-[#715192] font-bold mb-20" :style="{color: props.pot.accent_colour}"> Pot description </label> <br>
                    <input v-model="form.description" type="text" class="w-full px-3 py-2 border-none rounded bg-slate-100 bg-formInputGray"  placeholder="Describe what your pot is for."  name="description" required>

                    <label class="text-[1.4em] text-[#715192] font-bold mb-20" :style="{color: props.pot.accent_colour}"> Pot goal </label> <br>
                    <input v-model="form.goal" type="number" class="w-full px-3 py-2 border-none rounded bg-slate-100 bg-formInputGray" min="0" max="1000000" required placeholder="Set a goal for your pot." name="goal">

                    <label class="text-[1.4em] text-[#715192] font-bold mb-20" :style="{color: props.pot.accent_colour}"> Auto Close Pot?</label><br>
                    <input v-model="form.is_auto_closing" type="checkbox" class="ml-2 cursor-pointer" id="is_auto_closing" name="is_auto_closing" unchecked> <br>

                    <label class="text-[1.4em] text-[#715192] font-bold mb-20" :style="{color: props.pot.accent_colour}"> Pot Image: </label><br>
                    <div class="col-span-1">
                    Current: 
                        <img class="inline object-cover w-20 align-middle border-none shadow h-25"  :src="'/' + pot.cover_photo_path"/><br><br>
                    </div>
                    <input type="file" @input="form.cover_photo_path = $event.target.files[0]" name="cover_photo_path"> <br>

                    <label class="text-[1.4em] text-[#715192] font-bold mb-20" :style="{color: props.pot.accent_colour}"> Is the pot private?</label><br>
                    <input v-model="form.is_private" type="checkbox" class="ml-2 cursor-pointer" id="is_private" name="is_private" unchecked> <br>

                    <label for="accent_colourColour" class="text-[1.4em] text-[#715192] font-bold mb-20" :style="{color: props.pot.accent_colour}">Accent Colour</label>
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
                            class="w-40 h-10 text-center text-white rounded-full cursor-pointer"
                            :style="{backgroundColor: props.pot.accent_colour}">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
            <div class="m-auto">
                <div class="relative w-[20rem] h-[20rem] top-[-5rem] bg-white border-4 border-moneyPot z-2 rounded-full" >
                    <FlowerProgressVue :value="calculatePercentage(props.pot.amount, props.pot.goal)"></FlowerProgressVue>
                    <div class="text-center m-auto absolute w-full top-[45%]">
                        <p class="text-[1.4em] font-bold mb-20">{{calculatePercentage(props.pot.amount, props.pot.goal)}}% of total.</p>
                    </div>
                </div>
                <div class="flex flex-wrap justify-center bg-no-repeat bg-cover bg-banner">
                <div class="relative flex items-center justify-center h-0 w-72" >
                    <div class="absolute w-full m-auto text-center" style="z-index: -1;"><br>
                        <h1 class="text-[1.2em] font-bold mb-10">You have raised <span class="text-pink" :style="{color: props.pot.accent_colour}">£{{props.pot.amount}}</span><br>of <span class="text-pink" :style="{color: props.pot.accent_colour}">£{{props.pot.goal}}</span> target</h1><br><br>
                    </div>
                </div>                
            </div>
                <div v-if="props.userCanCloseAndWithdraw == true" class="my-10">
                    <div class="ml-15">
                        <a :href="'/pots/'+props.pot.id + '/contributions/withdraw'">
                            <button :style="{backgroundColor: props.pot.accent_colour}" class="rounded-3xl p-2.5 w-[18.6rem] font-bold text-white mt-2" type="button"><img class="float-left w-[1.5rem]" src="/images/gear-solid.svg">Withdraw from pot</button>
                        </a>
                    </div>
                    <div>
                        <a :href="'/pots/'+props.pot.id + '/administrators/share/create'">
                            <button :style="{backgroundColor: props.pot.accent_colour}" class="rounded-3xl p-2.5 w-[18.6rem] font-bold text-white mt-2" type="button"><img class="float-left w-[1.5rem]" src="/images/gear-solid.svg">Manage shared access</button>
                        </a>
                    </div>
                    <div v-if="pot.status !== 'closed'">
                        <a :href="'/pots/' + pot.id + '/suspend'">
                            <button :style="{backgroundColor: props.pot.accent_colour}" class="rounded-3xl p-2.5 w-[18.6rem] font-bold text-white mt-2" type="button"><img class="float-left w-[1.5rem]" src="/images/gear-solid.svg">Suspend</button>
                        </a>
                    </div>
                    <div v-else>
                        <a :href="'/pots/' + pot.id + '/unsuspend'">
                            <button :style="{backgroundColor: props.pot.accent_colour}" class="rounded-3xl p-2.5 w-[18.6rem] font-bold text-white mt-2" type="button"><img class="float-left w-[1.5rem]" src="/images/gear-solid.svg">Unsuspend</button>
                        </a>
                    </div>
                    <div>
                        <a :href="'/pots/' + pot.id + '/close'">
                            <button :style="{backgroundColor: props.pot.accent_colour}" class="rounded-3xl p-2.5 w-[18.6rem] font-bold text-white mt-2" type="button"><img class="float-left w-[1.5rem]" src="/images/gear-solid.svg">Close pot</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </template>
  
    <style>
    .text-pink {
      color: #DE85BB;
    }
    .bg-pink {
      background: #DE85BB;
    }
  
    </style>