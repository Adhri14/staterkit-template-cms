<script setup>

import InputContentHowTo from '@/Admin/Components/Forms/InputContentHowTo.vue';
import {  useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue'

const props  = defineProps({
    page: Object,
});

const form = useForm(props.page);

const submit = () => {
    form.patch(route('page.update',{'page':props.page.id}), {
        preserveScroll: false,
        onFinish: () => form.reset(),
    });
};

const tab = ref('general')
const changeTab = ( newtab) => {
    tab.value = newtab;
}

</script>

<template>
    <Head title="Content" />
    <Admin>
        <div>
          <form class="flex flex-wrap mt-4">
            <div class="w-full px-4">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded" >
                    <div class="block w-full overflow-x-auto">
                        <div class="rounded-t mb-5 px-5 border-1">
                            <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-blueGray-300">
                                <ul class="flex flex-wrap -mb-px">
                                    <li class="mr-2">
                                        <a @click="changeTab('general')" class="inline-block cursor-pointer font-bold p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-800 hover:border-gray-600 dark:hover:text-gray-600"
                                        :class="{'border-blue-600  text-blue-600 active dark:text-blue-500 dark:border-blue-500' : tab == 'general'}"
                                        aria-current="page">General</a>
                                    </li>
                                    <li class="mr-2">
                                        <a @click="changeTab('content')" class="inline-block cursor-pointer font-bold p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-800 hover:border-gray-600 dark:hover:text-gray-600"
                                        :class="{'border-blue-600  text-blue-600 active dark:text-blue-500 dark:border-blue-500' : tab == 'content'}"
                                        aria-current="page">Content</a>
                                    </li>
                                    <li class="mr-2">
                                        <a @click="changeTab('content-section')"  class="inline-block cursor-pointer font-bold p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-800 hover:border-gray-600 dark:hover:text-gray-600"
                                        :class="{'border-blue-600  text-blue-600 active dark:text-blue-500 dark:border-blue-500' : tab == 'content-section'}"
                                        >Content Sections</a>
                                    </li>
                                    <li class="mr-2">
                                        <a @click="changeTab('seo')"  class="inline-block cursor-pointer font-bold p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-800 hover:border-gray-600 dark:hover:text-gray-600"
                                        :class="{'border-blue-600  text-blue-600 active dark:text-blue-500 dark:border-blue-500' : tab == 'seo'}"
                                        >SEO</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="block w-full overflow-x-auto px-7" :class="{hidden : tab != 'general'}">
                            <div class="block">
                                <InputLabel for="title" value="Title" />
                                <TextInput type="text" class="mt-1 block w-full" v-model="form.title"  />
                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>

                            <div class="block mt-4">
                                <InputLabel for="slug" value="Slug" />
                                <InputSlug  type="text" class="mt-1 block w-full" :source="form.title" v-model="form.slug"  />
                                <InputError class="mt-2" :message="form.errors.slug" />
                            </div>

                            <div class="block mt-4">
                                <InputLabel for="slug" value="Subtitle" />
                                <TextInput type="text" class="mt-1 block w-full" v-model="form.subtitle"  />
                                <InputError class="mt-2" :message="form.errors.subtitle" />
                            </div>

                            <div class="block mt-4">
                                <InputLabel for="summary" value="Summary" />
                                <TextAreaInput class="mt-1 block w-full" v-model="form.summary"  />
                                <InputError class="mt-2" :message="form.errors.summary" />
                            </div>
                        </div>
                        <div class="block w-full overflow-x-auto px-7" :class="{hidden : tab != 'content'}">
                            <InputContentHowTo v-model="form.contents" />
                        </div>
                        <div class="block w-full overflow-x-auto px-7" :class="{hidden : tab != 'content-section'}">
                            <SelectSection v-model="form.sections" @onsave="submit"></SelectSection>
                        </div>
                        <div class="block w-full overflow-x-auto px-7" :class="{hidden : tab != 'seo'}">
                                <div class="block">
                                    <InputLabel :for="form.meta.title" value="Meta Title" />
                                    <TextInput type="text" class="mt-1 block w-full" v-model="form.meta.title"  />
                                </div>

                                <div class="block mt-4">
                                    <InputLabel :for="form.meta.description" value="Meta Description" />
                                    <TextAreaInput  class="mt-1 block w-full" v-model="form.meta.description"  />
                                </div>

                                <div class="block mt-4">
                                    <InputLabel :for="form.meta.image" value="Meta Image" />
                                    <acit-jazz-upload
                                    class="mt-1 block w-full"
                                    title="meta"
                                    folder="tag"
                                    :limit="1"
                                    filetype="image/*"
                                    name="meta"
                                    v-model="form.meta.image"
                                    >
                                    </acit-jazz-upload>
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
