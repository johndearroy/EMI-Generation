<template>
    <header class="flex justify-between items-center py-4 px-6 bg-white border-b-4 border-indigo-600">
        <div class="flex items-center">
            <button @click="isOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                <svg
                    class="h-6 w-6"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M4 6H20M4 12H20M4 18H11"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </button>
        </div>

        <div class="flex items-center">
            <div class="relative">
                <button @click="dropdownOpen = !dropdownOpen" class="relative z-10 block h-8 w-8 rounded-full overflow-hidden shadow focus:outline-none">
                    <img class="h-full w-full object-cover" src="https://i.pravatar.cc/300" alt="Your avatar"/>
                </button>

                <div v-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

                <div v-show="dropdownOpen" class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl z-20">
                    <a href="#" @click="logout()" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Log out</a>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
    import Helpers from '../helpers.js';
    export default {
        name: "AppHeader",
        data() {
            return {
                isOpen: false,
                dropdownOpen: false
            }
        },
        methods: {
            logout() {
                Helpers.api.post('/logout').then(res => {
                    if (res.status === 200 || res.status === 204) {
                        Helpers.notify('top-end', 'success', 'Successfully logout!');
                        window.location.reload();
                    }
                }).catch(e => console.log(e))
            }
        }
    }
</script>
