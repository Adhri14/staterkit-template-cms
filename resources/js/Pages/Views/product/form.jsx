<script setup>
import { useForm} from '@inertiajs/inertia-vue3';
import { ref } from 'vue'

const props  = defineProps({
    product: Object,
    method:String,
});

const form = useForm(props.product);

const submit = () => {
    if(props.method == 'store'){
        form.post(route('product.store',{'product':props.product.id}), {
            preserveScroll: false,
            onFinish: () => {

            },
            onSuccess: (res) => {
                form.reset()
            },
        });
    }
    if(props.method == 'update'){
        form.patch(route('product.update',{'product':props.product.id}), {
            preserveScroll: false,
            onFinish: () => {

            },
        });
    }
};

const tab = ref('content')
const changeTab = ( newtab) => {
    tab.value = newtab;
}
</script>

<template>
    <Head title="Content" />
    <Admin>
        <div class="px-4">
          <form class="flex flex-col lg:flex-row mt-4 gap-5"  @submit.prevent="submit">
            <div class="w-full">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded" >
                    <div class="block w-full overflow-x-auto">
                        <div class="rounded-t mb-5 px-5 border-1">
                            <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-blueGray-300">
                                <ul class="flex flex-wrap -mb-px">
                                    <li class="mr-2">
                                        <a @click="changeTab('content')" class="inline-block cursor-pointer font-bold p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-800 hover:border-gray-600 dark:hover:text-gray-600"
                                        :class="{'border-blue-600  text-blue-600 active dark:text-blue-500 dark:border-blue-500' : tab == 'content'}"
                                        aria-current="product">Content</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="block w-full overflow-x-auto px-7" :class="{hidden : tab != 'content'}">
                            <div class="block">
                                <InputLabel for="title" value="Title" />
                                <TextInput type="text" class="mt-1 block w-full" v-model="form.title"  />
                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>

                            <div class="block mt-4">
                                <InputLabel for="price" value="Price" />
                                <TextInput  type="text" class="mt-1 block w-full" :source="form.price" v-model="form.price"  />
                                <InputError class="mt-2 " :message="form.errors.price" />
                            </div>
                            <div class="block mt-4">
                                <InputLabel for="discount" value="Discount" />
                                <TextInput  type="text" class="mt-1 block w-full" :source="form.discount" v-model="form.discount"  />
                                <InputError class="mt-2 " :message="form.errors.discount" />
                            </div>
                            <div class="block mt-4">
                                <InputLabel for="stock" value="Stock" />
                                <TextInput  type="text" class="mt-1 block w-full" :source="form.stock" v-model="form.stock"  />
                                <InputError class="mt-2 " :message="form.errors.stock" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-10">
                        <PrimaryButton  @click="submit" class="w-full block text-center py-3 px-3 justify-center rounded-none rounded-b-md" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Save
                        </PrimaryButton>
                    </div>
                </div>
            </div>
          </form>
        </div>
    </Admin>
</template>
