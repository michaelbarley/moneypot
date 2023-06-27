<script setup>
  import TopBanner from '../../Components/TopBanner.vue';
  import FlowerProgressVue from '../../Components/FlowerProgressVue.vue';
  import moment from "moment";
  import { ref } from 'vue';
  
   let props = defineProps (
  {

      user: { type: Object, required: false },
      pot: { type: Object, required: false },
      contributors: { type: Object, required: false },
      base_url: { type: String, required: false },
      moment: { type: moment, required: false },
      userCanManage: { type: Boolean, required: false },
  })

  let calculatePercentage = (amount, goal) => Math.floor(amount / goal * 100);


  
  </script>
  
  <template>
  <TopBanner :showImages="false" :customImageUrl="props.base_url + '/' + props.pot.cover_photo_path" :style="{borderColour: props.pot.accent_colour}"/>
  <div class="flex flex-wrap justify-center pt-4 bg-no-repeat bg-cover bg-banner">
    <div class="absolute w-[14rem] h-[14rem] top-[18rem] bg-white border-4 border-moneyPot z-2 rounded-full left-[calc(50%_-_4.5rem)]" >
        <FlowerProgressVue :value="calculatePercentage(props.pot.amount, props.pot.goal)"></FlowerProgressVue>
        <div class="text-center my-13  absolute w-full top-[45%]">
            <p class="text-[1.4em] font-bold mb-20">{{calculatePercentage(props.pot.amount, props.pot.goal)}}% of total.</p>
        </div>
    </div>
  </div>  
  <br><br><br><br><br><br>
  <div class="flex flex-wrap justify-center pt-4 bg-no-repeat bg-cover bg-banner">
    <div class="relative flex items-center justify-center h-0 w-72" >
        <div class="text-center m-auto absolute w-full top-[85%]">
          <img class="relative z-50 float-left h-[3rem] w-[48px]" :style="{backgroundColor: props.pot.accent_colour}" style="maskImage: url('/images/coins-solid-pink.svg')">
          <p class="text-[1.2em] font-bold mb-20">You have raised <span :style="{color: props.pot.accent_colour}">£{{props.pot.amount}}</span> of <span :style="{color: props.pot.accent_colour}" >£{{props.pot.goal}}</span> target</p>
        </div>
    </div>
  </div>

  <div class="grid grid-cols-2 gap-12 px-8 pt-4 pb-8 my-10 sm:grid-cols-2">
    <div class="w-4/5 w-full m-auto max-w-96" style="width: 80%;margin-left: auto;">
        <h1 class="text-3xl font-bold text-pink" :style="{color: props.pot.accent_colour}">{{props.pot.name}}</h1>
        <p class="">{{props.pot.description}}</p> <br>
    </div>

    <div class="text-center">
      <div v-if="pot.status =='open'">
        <a :href="'/pots/'+props.pot.id + '/contributions/add'">
          <button :style="{backgroundColor: props.pot.accent_colour}" class="rounded-3xl p-2.5 w-[18.6rem] font-bold text-white mt-2" type="button"><img class="float-left w-[1.5rem]" src="/images/piggy-bank-solid.svg">Add to pot</button>
        </a>
      </div>

      <div>
        <a v-if="props.userCanManage == true" :href="'/pots/' + pot.id + '/edit'">
          <button :style="{backgroundColor: props.pot.accent_colour}" class="rounded-3xl p-2.5 w-[18.6rem] font-bold text-white mt-2" type="button"><img class="float-left w-[1.5rem]" src="/images/gear-solid.svg">Manage my pot</button>
        </a>
      </div>

      <p class="mt-4 mb-2 text-lg" :style="{color: props.pot.accent_colour}">Want to share?</p>
      <div class="w-1/2 p-5 m-auto">
          <div class="flex justify-center float-left w-16 h-16 mr-2 bg-gray-100 rounded-full">
              <img class="w-[25px] h-[40px] m-auto" src="/images/facebook-f-brands.svg">
          </div>
          <div class="flex justify-center float-left w-16 h-16 mr-2 bg-gray-100 rounded-full">
              <img class="w-[35px] h-[40px] m-auto" src="/images/instagram-brands.svg">
          </div>
          <div class="flex justify-center w-16 h-16 bg-gray-100 rounded-full">
              <img class="w-[37px] h-[37px] m-auto" src="/images/twitter-brands.svg">
          </div>
      </div>
    </div>
  </div>

  <div class="w-11/12 col-start-1 col-end-3 px-8 pt-4 m-auto">
        <ul>
          <h1 class="pt-8 text-3xl font-bold text-pink" :style="{color: props.pot.accent_colour}"> Pot Contributions </h1>
            <div class="grid grid-cols-1 gap-4 pt-8 sm:grid-cols-3">
 
                <li class="pb-4" v-for="item in props.contributors" :key="item">
                    <div class="relative grid grid-cols-4 gap-6 bg-cover no-repeat">
                        <div class="col-span-1">
                            <img class="inline-block border-4 rounded-full w-150 h-100 border-moneyPot" :src="`/${item.user.profile_photo_path}`"/>
                        </div>
                        <div class="col-span-3">
                          <div class="grid grid-cols-1 gap-4 pt-8 sm:grid-cols-3">
                            <div class="col-span-1">
                              <span class="inline" :style="{color: props.pot.accent_colour}" v-if="item.addition_or_withdrawal == 'add'">+</span><span class="inline" :style="{color: props.pot.accent_colour}" v-else>-</span><p class="inline font-bold" :style="{color: props.pot.accent_colour}">£{{item.amount}}</p>
                            </div>
                            <div class="col-span-1">
                              <p>{{ moment(item.created_at).format("Do MMMM") }}</p>
                            </div>
                          </div>
                            <p class="font-bold" v-if="item.user_id != null">{{ item.user.name }}</p>
                            <p class="font-bold" v-show="item.user == null">Guest Contributor</p>
                            <p class="my-5" v-if="item.reference != null">{{ item.reference }}</p>
                        </div>
                    </div>
                </li>
            </div>

            
        </ul> 
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