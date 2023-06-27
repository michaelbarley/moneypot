<script setup>
    import { ref } from 'vue';
    import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
    import { Inertia } from '@inertiajs/inertia';

    
    let props = defineProps({
        showImages: Boolean,
        customImageUrl: String,
        borderColour: {
            type: String,
            default: '#715192'
        }
    });
    const dropdown = ref();
    const mobileDropdown = ref(false);
    const colour = ref(props.borderColour)
    const showDefaultBannerImages = (props.showImages)
    
    const toggle = () => {
        // dropdown.value.classList.toggle("hidden")
        mobileDropdown.value = !mobileDropdown.value;
    }
    const logout = () => {
        Inertia.post(route('logout'));
    };
    
    </script>
    <template>
    <nav class="bg-banner border-b-[15px] bg-no-repeat bg-cover bannerColour" :style="props.customImageUrl.length > 0 ? 'background-image: url(' + props.customImageUrl + ')' : null">
        <!-- Nav Menu -->
        <nav class="flex justify-end rounded-l rounded-bl-[2em]">
            <div class="hidden shadow-lg sm:flex bg-darkPurple rounded-bl-[2em]">
                <a href="/dashboard" class="inline p-2.5 bg-darkPurple hover:bg-dpHover text-white rounded-bl-[4em]">Pot Dashboard</a>
                <a href="/user/profile" class="inline p-2.5 bg-darkPurple hover:bg-dpHover text-white">Account Management</a>
                <a href="#" class="inline p-2.5 bg-darkPurple hover:bg-dpHover text-white">Contact Us</a>
                <form method="POST" @submit.prevent="logout" class="inline p-2.5 bg-darkPurple hover:bg-dpHover text-white">
                                <ResponsiveNavLink as="button">
                                    Log Out
                                </ResponsiveNavLink>
                            </form>
            </div>
            <!--Hamburger Menu-->
            <button @click="toggle"><svg xmlns="http://www.w3.org/2000/svg" class="flex w-14 sm:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg></button>
            <div ref="dropdown" class="z-10 hidden divide-y divide-gray-100 rounded shadow bg-darkPurple w-44 dark:bg-gray-700">
                <Teleport to="body">
                    <ul v-if="mobileDropdown == true" class="fixed inset-0 z-10 w-full h-full py-1 text-sm text-white bg-darkPurple">
                        <li><a href="/dashboard" class="block px-4 py-2">Pot Dashboard</a></li>
                        <li><a href="/user/profile" class="block px-4 py-2">My Account</a></li>
                        <li><a href="#" class="block px-4 py-2 ">Contact Us</a></li>
                        <li><a href="/logout" class="block px-4 py-2">Log Out</a></li>
                        <li @click="mobileDropdown = false" class="block px-4 py-2 cursor-pointer focus:ring focus:ring-lightPurple ">Close</li>
                    </ul>
                </Teleport>
                
            </div>
        </nav>
        
        <!-- Banner Images-->   
        <div class="grid grid-cols-2 gap-6 h-80" v-if="showDefaultBannerImages">
            <img class="pt-4 m-auto w-72" src="/Images/moneypotlogo.png"/>
            <img class="pt-4 w-72" src="/Images/pig_on_its_own.png" />
        </div>
        <div class="grid grid-cols-2 gap-6 h-80" v-if="!showDefaultBannerImages"></div>
    </nav>
    </template>
    <style scoped>
    .bannerColour {
        border-color: #715192;
    }
    .bg-darkPurple {
        background: #715192;
    }
    nav {
        background-repeat: no-repeat;
        background-position: center center;
    }
    </style>