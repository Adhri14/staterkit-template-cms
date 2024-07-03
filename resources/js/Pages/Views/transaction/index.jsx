<script setup>
import { ref } from 'vue';

const props  = defineProps({
    transactions: Object,
    title:String,
    trash:Boolean,
});

const start_date = ref();
const end_date = ref();

</script>
<template>
    <Head title="Dashboard" />
    <Admin>
       <div class="flex flex-wrap mt-4">
         <div class="w-full mb-12 px-4">
            <div class="relative flex flex-col min-w-0 break-words lg:w-1/2 w-full mb-6 shadow-lg rounded bg-white">
              <div class="block w-full p-4">
                <h2 class="font-bold mb-6">Export Excel Data</h2>
                <div class="flex gap-2 mb-2">
                    <div class="w-full">
                        <InputLabel for="start_date" value="Start Date" />
                        <TextInput class="w-full" v-model="start_date" type="date" format="dd/MM/yyyy" placeholder="Select Published Date" />
                    </div>
                    <div class="w-full">
                        <InputLabel for="end_date" value="End Date" />
                        <TextInput class="w-full" v-model="end_date" type="date" format="dd/MM/yyyy" placeholder="Select Published Date" />
                    </div>
                </div>
                <a :href="route('transaction.export', {start_date, end_date})" class="w-full font-medium py-2 px-4 block text-center mb-3 rounded leading-5 text-gray-100 bg-green-500 border border-green-500 hover:text-white hover:bg-green-600 hover:ring-0 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:outline-none focus:ring-0">Export</a>
              </div>
            </div>
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
                <div class="rounded-t mb-0 px-6 py-4 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full max-w-full flex">
                            <div class="flex items-center">
                                <h3 class="font-bold text-lg">
                                    {{title}}
                                </h3>
                            </div>
                            <!-- <div class="ml-auto">
                              <SecondaryLink  :href="route('product.create')" class="px-3 py-1 rounded-none rounded-l-md">Create New</SecondaryLink>
                              <SecondaryLink  :href="route('product.index', {  trash:'1' })" class="px-3 py-1 rounded-none rounded-r-md bg-red-500">Trash</SecondaryLink>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                <table class="items-center w-full bg-transparent border-collapse">
                    <thead>
                    <tr class="hidden lg:table-row">
                        <Th>Order Code</Th>
                        <Th>Type Transaction</Th>
                        <Th>Created Date</Th>
                        <Th></Th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(transaction,index) in transactions.data" :key="index" class="hover:bg-gray-100 cursor-pointer relative py-3 block lg:py-0 lg:table-row border-t lg:border-0">
                        <Td>
                            <strong class="block lg:hidden">Order Code</strong>
                            <span>{{transaction.order_code ?? '-'}}</span>
                        </Td>
                        <Td>
                            <strong class="block lg:hidden">Type Transaction</strong>
                            <span>{{transaction.type_transaction ?? '-'}}</span>
                        </Td>
                        <Td>
                            <strong class="block lg:hidden">Created Date</strong>
                            <span>{{transaction.created_at ?? '-'}}</span>
                        </Td>
                        <Td>
                            <div v-if="trash">
                                <SecondaryLink v-tooltip="'Restore'" class="px-3 py-2 bg-green-500 rounded-none rounded-l-md" :href="route('transaction.restore', {transaction:transaction})" method="post" as="button">
                                    <i class="fas fa-rotate-right"></i>
                                </SecondaryLink>
                                <SecondaryLink v-tooltip="'Destroy'" class="px-3 py-2 bg-red-500 rounded-none rounded-r-md" :href="route('transaction.forceDelete', {transaction:transaction})" method="post" as="button">
                                    <i class="fas fa-trash-can"></i>
                                </SecondaryLink>
                            </div>
                            <div v-else>
                                <SecondaryLink v-tooltip="'View Transaction'" class="px-3 py-2 bg-indigo-500 rounded-none rounded-l-md" :href="route('transaction.show', {transaction:transaction})">
                                    <i class="fas fa-eye"></i>
                                </SecondaryLink>
                                <SecondaryLink v-tooltip="'Refund Transaction'" class="px-3 py-2 bg-red-500 rounded-none rounded-r-md" :href="route('transaction.delete', {transaction:transaction})" method="post" as="button">
                                    <i class="fas fa-trash"></i>
                                </SecondaryLink>
                            </div>
                        </Td>
                    </tr>
                    </tbody>
                </table>
                 <pagination class="mt-6" :links="transactions.meta.links" />
                </div>
            </div>
         </div>
       </div>
   </Admin>
 </template>
