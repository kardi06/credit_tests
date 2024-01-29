<template>
    <Head title="Get Loan" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Get Loan</h2>
        </template>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="p-4 col-span-2">
                <div>
                    <!-- Header Section -->
                    <div class="max-w-3xl  mx-auto sm:px-3 lg:px-1">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <header class="bg-blue-500 p-4 text-white">
                                <div class="container mx-auto">
                                <h1 class="text-2xl font-semibold">Fill Form Below</h1>
                                </div>
                            </header>
                            <div class="p-6 text-gray-900">
                                <form class="w-full max-w-lg mx-auto">
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full px-3 mb-6 md:mb-0">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                                Date
                                            </label>
                                            <!-- Use vue3-datepicker for date input -->
                                            <datepicker v-model="loan.date" id="date" name="date" class="w-full" placeholder="Select date" :disabled="true"></datepicker>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full px-3">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                                Amount
                                            </label>
                                        <!-- Use vue-currency-input for currency input -->
                                        <CurrencyInput v-model="loan.amount" :options="{ currency: 'IDR' }" class="w-full"/>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full px-3">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                                Term
                                            </label>
                                            <input v-model="loan.term" id="term" type="number" class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 mb-3 leading-tight" @change="genTerm">
                                        </div>
                                    </div>
                                    <!-- Generate inputs based on date and term -->
                                    <!-- <div v-for="i in parseInt(loan.term)" :key="i" class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full px-3">
                                        <label :for="'input-' + i" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                            Term - {{ i }}
                                        </label>
                                        <input :id="'input-' + i" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" :value="generateDate(i)">
                                        </div>
                                    </div> -->
                                    <div class="flex justify-center">
                                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-5">
                                            Submit Loan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="p-4" v-if="isTerm">
                <div v-for=" i in termLoop" :key="i" class="mb-4">
                    <!-- Header Section -->
                    <div class="mx-auto sm:px-3 lg:px-1">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <header class="bg-blue-500 p-4 text-white">
                                <div class="container mx-auto">
                                <h1 class="text-2xl font-semibold">Term - {{i}}</h1>
                                </div>
                            </header>
                            <div class="p-6 text-gray-900">
                                <div class="w-full max-w-lg mx-auto">
                                    <div class="flex flex-wrap -mx-3 mb-1">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                                Date
                                            </label>
                                            <input class="appearance-none block w-full  border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Jane" :value="genTermDate(i)">
                                        </div>
                                        <div class="w-full md:w-1/2 px-3">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                                Amount
                                            </label>
                                            <input class="appearance-none block w-full  border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Doe" :value="genTermAmount()">
                                        </div>
                                    </div>
                                    <!-- Generate inputs based on date and term -->
                                    <!-- <div v-for="i in parseInt(loan.term)" :key="i" class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full px-3">
                                        <label :for="'input-' + i" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                            Term - {{ i }}
                                        </label>
                                        <input :id="'input-' + i" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" :value="generateDate(i)">
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
    </AuthenticatedLayout>
</template>
<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm} from '@inertiajs/vue3';
import { ref } from 'vue';
import CurrencyInput from "../../Components/CurrencyInput.vue";
import DatePicker from 'vue3-datepicker';

export default{
    components:{
        AuthenticatedLayout,
        Head,
        Datepicker: DatePicker,
        CurrencyInput
    },
    data(){
        return{
            isTerm : false,
            termLoop : 0,
        }
    },
    methods:{
        genTerm(){
            if(this.loan.term == 0 || this.loan.term > 20){
                this.isTerm = false;
                this.termLoop = 0;
            }else{
                this.isTerm = true;
                this.termLoop = this.loan.term;
            }

        },
        formatDate(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        },
        genTermDate(i){
            const date = new Date(this.loan.date);
            date.setDate(date.getDate() + i * 7); // Assuming weeks
            return this.formatDate(date);
        },
        genTermAmount(){
           const nilai = this.loan.amount / this.loan.term;
           return nilai;
        }
    },
    setup(props){
        // Initialize the vue-currency-input plugin
        // CurrencyInput.install();

        const loan = useForm({
            date: new Date(),
            amount: 0,
            term: 0,
        });

        // const generateDate = (index) => {
        //     // Add logic to generate date based on the provided index and loan.date
        //     // This is just a placeholder, you should implement your own logic
        //     const date = new Date(loan.date);
        //     date.setDate(date.getDate() + index * 7); // Assuming weeks
        //     return date.toLocaleDateString('en-US');
        // };

        return {
            loan,
        };
    }
}
</script>
