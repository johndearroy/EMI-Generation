<template>
    <div class="flex h-screen bg-gray-200 font-roboto">

        <sidebar />

        <div class="flex-1 flex flex-col overflow-hidden">

            <app-header />

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container mx-auto px-6 py-8">

                    <div class="overflow-x-auto">
                        <div class="min-w-screen min-h-screen bg-gray-100 flex justify-center bg-gray-100 font-sans overflow-hidden">
                            <div class="w-full m-5">
                                <div class="bg-white shadow-md rounded my-6 p-5">
                                    <button @click="showModal = true" type="button" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg flex items-center float-right mb-5">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                        </svg>
                                        Apply for Loan
                                    </button>

                                    <not-found v-if="applications.length === 0"/>

                                    <table v-if="applications.length > 0" class="min-w-max w-full table-auto">
                                        <thead>
                                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                            <th class="py-3 px-6 text-left">User</th>
                                            <th class="py-3 px-6 text-left">Amount</th>
                                            <th class="py-3 px-6 text-center">Duration</th>
                                            <th class="py-3 px-6 text-center">Interest Rate</th>
                                            <th class="py-3 px-6 text-center">Status</th>
                                            <th class="py-3 px-6 text-center">Application Date</th>
                                            <th class="py-3 px-6 text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-gray-600 text-sm font-light">
                                        <tr v-for="(item, index) in applications" :key="index" class="border-b border-gray-200 hover:bg-gray-100">
                                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="font-medium">{{ item.amount }}</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-6 text-left">
                                                {{ item.amount }}
                                            </td>
                                            <td class="py-3 px-6 text-left">
                                                {{ item.duration }}
                                            </td>
                                            <td class="py-3 px-6 text-left">
                                                {{ item.interest_rate }}
                                            </td>
                                            <td class="py-3 px-6 text-center">
                                                <span :class="getStatusClass(item.status)">
                                                    {{ item.status }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-6 text-left">
                                                {{ getDate(item.created_at, 'll') }}
                                            </td>
                                            <td class="py-3 px-6 text-center">
                                                <div class="flex item-center justify-center">
                                                    <button v-if="!isAdmin && item.status === 'Approved' && item.emi_details" type="button"
                                                            class="focus:outline-none text-blue-600 text-xs py-2.5 px-5 rounded-md hover:bg-blue-100"
                                                            @click="viewApplication(item)"
                                                    >View</button>
                                                    <button v-if="isAdmin && item.status !== 'Approved'" type="button"
                                                            class="focus:outline-none text-green-600 text-xs py-2.5 px-5 rounded-md hover:bg-blue-100"
                                                            @click="updateApplication(item.id,'Approved')"
                                                    >Approve</button>
                                                    <button v-if="isAdmin && item.status !== 'Rejected'" type="button"
                                                            class="focus:outline-none text-red-600 text-xs py-2.5 px-5 rounded-md hover:bg-blue-100"
                                                            @click="updateApplication(item.id,'Rejected')"
                                                    >Reject</button>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>

        <!-- // New loan Application Modal //  -->
        <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto" v-if="showModal">
            <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3 mx-2 sm:mx-auto mt-10 mb-24 opacity-100">
                <div class="relative bg-white shadow-lg rounded-lg text-gray-900 z-20">
                    <header class="flex flex-col justify-center items-center p-3 text-blue-600">
                        <h2 class="font-semibold text-2xl">Apply for Loan</h2>
                    </header>
                    <main class="p-3">
                        <form @submit.prevent>
                            <div class="mb-6">
                                <label for="amount" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Amount</label>
                                <input v-model="form.amount" type="text" name="amount" id="amount" placeholder="Amount of loan" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                            </div>
                            <div class="mb-6">
                                <label for="duration" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Duration (in month)</label>
                                <input v-model="form.duration" type="number" name="duration" id="duration" min="1" max="12" placeholder="Duration in month" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                            </div>
                            <div class="mb-6">
                                <label for="interest_rate" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Interest Rate</label>
                                <input v-model="form.interest_rate" type="number" name="interest_rate" id="interest_rate" placeholder="Interest rate" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                            </div>
                        </form>
                    </main>
                    <footer class="flex justify-center bg-transparent">
                        <button class="bg-red-600 font-semibold text-white py-3 w-full rounded-bl-md hover:bg-blue-700 focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300" @click="showModal = false">
                            Cancel
                        </button>
                        <button class="bg-blue-600 font-semibold text-white py-3 w-full rounded-br-md hover:bg-blue-700 focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300" @click="applyLoan()">
                            Save
                        </button>
                    </footer>
                </div>
            </div>
        </div>

        <!-- // Showing EMI Details Modal // -->
        <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto" v-if="showDetailsModal">
            <div class="relative sm:w-3/5 md:w-3/5 lg:w-3/5 mx-2 sm:mx-auto mt-10 mb-24 opacity-100">
                <div class="relative bg-white shadow-lg rounded-lg text-gray-900 z-20">
                    <header class="flex flex-col justify-center items-center p-3 text-blue-600">
                        <h2 class="font-semibold text-2xl">EMI Details</h2>
                    </header>
                    <main class="p-3">

                        <div class="grid grid-cols-3 gap-4 m-4">
                            <div><strong>Amount:</strong> {{ emiDetails.amount }}</div>
                            <div><strong>Duration:</strong> {{ emiDetails.duration }}</div>
                            <div><strong>Interest rate:</strong> {{ emiDetails.interest_rate }}</div>
                            <div><strong>EMI:</strong> {{ emiDetails.emi }}</div>
                            <div><strong>Monthly interest:</strong> {{ emiDetails.monthly_interest }}</div>
                            <div><strong>Monthly principal amount:</strong> {{ emiDetails.monthly_principal_amount }}</div>
                            <div><strong>Total interest:</strong> {{ emiDetails.total_interest }}</div>
                            <div><strong>Status:</strong>
                                <span :class="getStatusClass(emiDetails.status)">
                                    {{ emiDetails.status }}
                                </span>
                            </div>
                        </div>

                        <table v-if="emiDetails.emi_details.length > 0" class="min-w-max w-full table-auto">
                            <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Serial</th>
                                <th class="py-3 px-6 text-left">Title</th>
                                <th class="py-3 px-6 text-center">Total Amount</th>
                                <th class="py-3 px-6 text-center">Payment Date</th>
                                <th class="py-3 px-6 text-center">Payment End Date</th>
                            </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                            <tr v-for="(item, index) in emiDetails.emi_details" :key="index" class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{ item.serial }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    {{ item.title }}
                                </td>
                                <td class="py-3 px-6 text-left">
                                    {{ item.total_amount }}
                                </td>
                                <td class="py-3 px-6 text-left">
                                    {{ getDate(item.payment_date, 'll') }}
                                </td>
                                <td class="py-3 px-6 text-left">
                                    {{ getDate(item.payment_end_date, 'll') }}
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </main>
                    <footer class="flex justify-center bg-transparent">
                        <button class="bg-red-600 font-semibold text-white py-3 w-full rounded-bl-md hover:bg-blue-700 focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300" @click="showDetailsModal = false">
                            Close
                        </button>
                    </footer>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
    import Sidebar from '../layouts/sidebar.vue';
    import AppHeader from '../layouts/header.vue';
    import NotFound from '../components/not-found.vue';
    import Helpers from "../helpers";
    export default {
        name: "Applications",
        components: {
            Sidebar,
            AppHeader,
            NotFound
        },
        props: ['applications', 'isAdmin'],
        data() {
            return {
                showModal: false,
                showDetailsModal: false,
                form: {
                    amount: null,
                    duration: null,
                    interest_rate: null
                },
                emiDetails: {}
            }
        },
        methods: {
            getStatusClass(status) {
                if (status === 'Approved') {
                    return "bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs";
                }
                if (status === 'Rejected') {
                    return "bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs";
                }
                return "bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs";
            },
            getDate(date, format) {
                return Helpers.formatByMoment(date, format || 'DD-MM-YYYY hh:mm:ss');
            },
            applyLoan() {
                if (this.form.duration <= 0 || this.form.duration > 12) {
                    Helpers.notify('top-end', 'error', 'Duration should be in 12 months!');
                    return false;
                }
                if (this.form.amount && this.form.duration && this.form.interest_rate) {
                    Helpers.api.post('/applications', this.form).then(res => {
                        if (res.status === 200) {
                            Helpers.notify('top-end', 'success', 'Successfully submitted!');
                            this.showModal = false;
                            window.location.reload();
                        }
                    }).catch(e => {
                        console.log(e)
                    })
                } else {
                    Helpers.notify('top-end', 'error', 'All fields are required!');
                    return false;
                }
            },
            updateApplication(applicationId, status) {
                if (applicationId && status) {
                    Helpers.api.put(`/applications/${applicationId}`, {status}).then(res => {
                        if (res.status === 200) {
                            Helpers.notify('top-end', 'success', 'Application approved!');
                            window.location.reload();
                        }
                    }).catch(e => {
                        console.log(e)
                    })
                }
            },
            viewApplication(item) {
                if (item.emi_details) {
                    this.emiDetails = item;
                    this.showDetailsModal = true;
                }
            }
        }
    };
</script>
