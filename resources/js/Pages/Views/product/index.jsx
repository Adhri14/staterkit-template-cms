<script setup>
const props  = defineProps({
    products: Object,
    title:String,
    trash:Boolean,
});
</script>
<template>
    <Head title="Dashboard" />
    <Admin>
       <div class="flex flex-wrap mt-4">
         <div class="w-full mb-12 px-4">
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
                <div class="rounded-t mb-0 px-6 py-4 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full max-w-full flex">
                            <div class="flex items-center">
                                <h3 class="font-bold text-lg">
                                    {{title}}
                                </h3>
                            </div>
                            <div class="ml-auto">
                              <SecondaryLink  :href="route('product.create')" class="px-3 py-1 rounded-none rounded-l-md">Create New</SecondaryLink>
                              <SecondaryLink  :href="route('product.index', {  trash:'1' })" class="px-3 py-1 rounded-none rounded-r-md bg-red-500">Trash</SecondaryLink>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                <table class="items-center w-full bg-transparent border-collapse">
                    <thead>
                    <tr class="hidden lg:table-row">
                        <Th>Title</Th>
                        <Th>Price</Th>
                        <Th>Discount</Th>
                        <Th>Stock</Th>
                        <Th>Published Date</Th>
                        <Th></Th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(product,index) in products.data" :key="index" class="hover:bg-gray-100 cursor-pointer relative py-3 block lg:py-0 lg:table-row border-t lg:border-0">
                        <Td>
                            <strong class="block lg:hidden">Title</strong>
                            <span>{{product.title ?? '-'}}</span>
                        </Td>
                        <Td>
                            <strong class="block lg:hidden">Price</strong>
                            <span>{{product.price ?? '-'}}</span>
                        </Td>
                        <Td>
                            <strong class="block lg:hidden">Discount</strong>
                            <span>{{product.discount ?? '-'}}</span>
                        </Td>
                        <Td>
                            <strong class="block lg:hidden">Stock</strong>
                            <span>{{product.stock ?? '-'}}</span>
                        </Td>
                        <Td>
                            <strong class="block lg:hidden">Published Date</strong>
                            <span>{{product.created_at ?? '-'}}</span>
                        </Td>
                        <Td>
                            <div v-if="trash">
                                <SecondaryLink v-tooltip="'Restore'" class="px-3 py-2 bg-green-500 rounded-none rounded-l-md" :href="route('product.restore', {product:product})" method="post" as="button">
                                    <i class="fas fa-rotate-right"></i>
                                </SecondaryLink>
                                <SecondaryLink v-tooltip="'Destroy'" class="px-3 py-2 bg-red-500 rounded-none rounded-r-md" :href="route('product.forceDelete', {product:product})" method="post" as="button">
                                    <i class="fas fa-trash-can"></i>
                                </SecondaryLink>
                            </div>
                            <div v-else>
                                <SecondaryLink v-tooltip="'Edit'" class="px-3 py-2 bg-indigo-500 rounded-none rounded-l-md" :href="route('product.edit', {product:product})">
                                    <i class="fas fa-pencil"></i>
                                </SecondaryLink>
                                <SecondaryLink v-tooltip="'Delete'"  class="px-3 py-2 bg-red-500 rounded-none rounded-r-md" :href="route('product.delete', {product:product})" method="post" as="button">
                                    <i class="fas fa-trash-can"></i>
                                </SecondaryLink>
                            </div>
                        </Td>
                    </tr>
                    </tbody>
                </table>
                 <pagination class="mt-6" :links="products.meta.links" />
                </div>
            </div>
         </div>
       </div>
   </Admin>
 </template>
