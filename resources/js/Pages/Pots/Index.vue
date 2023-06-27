<script setup>
import TopBanner from "../../Components/TopBanner.vue";
import FlowerProgressVue from "../../Components/FlowerProgressVue.vue";
let props = defineProps({
  userPots: { type: Object, required: false },
  
});
</script>

<template>
  <TopBanner
    :showImages="true"
    customImageUrl="http://moneypot.test/Images/login_main.jpg"
    :borderColour="'#DE85BB'"
  />
  <section
    class="grid w-4/5 w-full grid-cols-1 gap-6 px-8 py-8 pb-8 m-auto my-16 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
    <div class="relative flex items-center justify-center bg-cover no-repeat h-72 w-72">
      <div class="m-auto text-center">
        <a href="pots/create/new">
          <img src="/Images/new_pot.png" />
          <h1 class="text-[1.4em] text-[#715192] font-bold mb-20">Create Pot</h1>
        </a>
      </div>
    </div>
    <div v-for="pot in userPots" :key="pot">
      <div
        class="relative flex items-center justify-center bg-cover bg-pot no-repeat h-72 w-72"
      >
        <div class="relative flex items-center justify-center h-72 w-72">
          <FlowerProgressVue :value="(pot.amount / pot.goal) * 100"></FlowerProgressVue>
          <div class="text-center m-auto absolute w-full top-[45%]">
            <p v-if="pot.status == 'open'">
              <span class="text-[1.4em] font-bold mb-20">{{ pot.name }}</span><br />£{{ pot.amount }} of £{{ pot.goal }}
            </p>
            <p v-else>
              <span class="text-[1.4em] font-bold mb-20">{{ pot.name }}</span><br />CLOSED
            </p>

          </div>
        </div>
      </div>
      <div>
        <a :href="'pots/' + pot.id"
          ><button
            class="w-32 px-4 py-2 mr-2 text-white rounded-full cursor-pointer moneyPot-bg hover:bg-dpHover"
          >
            View Pot
          </button></a
        >
        <a :href="'pots/' + pot.id + '/edit'"
          ><button
            class="w-32 px-4 py-2 mr-2 text-white rounded-full cursor-pointer moneyPot-bg hover:bg-dpHover"
          >
            Manage Pot
          </button>
        </a>
      </div>
    </div>
  </section>
</template>

<style>
.moneyPot-border {
  border-block-color: #715191;
}

.moneyPot-bg {
  background: #715191;
}
</style>
