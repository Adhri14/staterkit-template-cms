<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue'
import "toastify-js/src/toastify.css"

const s3_url = ref(import.meta.env.VITE_APP_S3_URL);

const props  = defineProps({
    transaction: Object,
    title:String,
    trash:Boolean,
});

const form = useForm({
  verification: true
});

const calculate = (val1, val2) => {
    return Number(val1) * Number(val2);
}

let IDR = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
});

</script>

<template>
    <Head title="Dashboard" />
    <Admin>
       <div class="flex flex-wrap mt-4">
         <div class="w-full mb-12 px-4">
            <div class="relative flex flex-col min-w-0 break-words lg:w-6/12 w-full mb-6 shadow-lg rounded bg-white">
                <div class="rounded-t mb-0 px-6 py-4 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full max-w-full flex">
                            <div class="flex justify-between w-full">
                                <h3 class="font-bold text-lg">
                                    {{title}}
                                </h3>
                                <p>Type : <span class="uppercase py-1 px-3 font-semibold text-white ml-4 bg-green-500 rounded-full text-xs">{{ transaction.type_transaction }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex">
                  <div class="bg-white overflow-hidden mb-8 w-full">
                    <div class="px-3">
                        <div class="w-full px-4">
                          <div class="bg-white w-full h-full">
                            <div class="border-t border-gray-200"></div>
                            <div class="mb-2 grid grid-cols-8 mt-5" v-for="(item, index) in transaction.transaction_detail" :key="index">
                                <p class="col-span-3 lg:text-base text-sm">{{ item.title }}</p>
                                <p class="col-span-1 text-center lg:text-base text-sm">x{{ item.qty }}</p>
                                <p class="col-span-2 text-right lg:text-base text-sm"><span :class="item.discount ? 'line-through text-gray-500' : ''">{{ IDR.format(item.price) }}</span> <span v-if="item.discount" class="font-bold">{{ IDR.format(item.discount) }}</span></p>
                                <p class="col-span-2 text-right lg:text-base text-sm">{{ IDR.format(calculate(item.discount || item.price, item.qty)) }}</p>
                            </div>
                            <div class="border-t border-gray-200 mt-5"></div>
                            <div class="mb-2 grid grid-cols-6 mt-10">
                                <div class="col-span-2"></div>
                                <h3 class="font-bold uppercase col-span-1 text-right">Subtotal</h3>
                                <p class="col-span-3 text-right">{{ IDR.format(transaction.grand_total) }}</p>
                            </div>
                            <div class="mb-2 grid grid-cols-6 mt-10">
                                <div class="col-span-2"></div>
                                <h3 class="font-bold uppercase col-span-1 text-right">Total</h3>
                                <p class="col-span-3 text-right">{{ IDR.format(transaction.grand_total) }}</p>
                            </div>
                            <div class="mb-2 grid grid-cols-6 mt-10">
                                <div class="col-span-2"></div>
                                <h3 class="font-bold uppercase col-span-1 text-right">Bayar</h3>
                                <p class="col-span-3 text-right">{{ IDR.format(transaction.cash) }}</p>
                            </div>
                            <div class="mb-2 grid grid-cols-6 mt-10">
                                <div class="col-span-2"></div>
                                <h3 class="font-bold uppercase col-span-1 text-right">Kembali</h3>
                                <p class="col-span-3 text-right">{{ IDR.format(transaction.refund) }}</p>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
         </div>
       </div>
   </Admin>
 </template>