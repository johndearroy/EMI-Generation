<template>
    <div class="flex">
        <!-- Backdrop -->
        <div
            :class="isOpen ? 'block' : 'hidden'"
            @click="isOpen = false"
            class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"
        ></div>
        <!-- End Backdrop -->

        <div
            :class="isOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
            class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0"
        >
            <div class="flex items-center justify-center mt-8">
                <div class="flex items-center">
                    <span class="text-white text-2xl mx-2 font-semibold">EMI-Generation</span>
                </div>
            </div>

            <nav class="mt-10">
                <a class="flex items-center duration-200 mt-4 py-2 px-6 border-l-4" :class="getClass('/home')" href="/home">
                    <span class="mx-4">Dashboard</span>
                </a>
                <a class="flex items-center duration-200 mt-4 py-2 px-6 border-l-4" :class="getClass('/applications')" href="/applications">
                    <span class="mx-4">Applications</span>
                </a>
            </nav>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Sidebar",
        data() {
            return {
                isOpen: false,
                activeClass: "bg-gray-600 bg-opacity-25 text-gray-100 border-gray-100",
                inactiveClass: "border-gray-900 text-gray-500 hover:bg-gray-600 hover:bg-opacity-25 hover:text-gray-100"
            }
        },
        methods: {
            getClass(pathname) {
                return pathname === window.location.pathname ? this.activeClass : this.inactiveClass;
            }
        }
    }
</script>
