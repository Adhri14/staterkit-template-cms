<script setup>
import { useForm} from '@inertiajs/inertia-vue3';
import { ref } from 'vue'

const props  = defineProps({
    user: Object,
    title: String,
    method: String,
});

const form = useForm(props.user);

const submit = () => {
    if(props.method == 'store'){
        form.post(route('user.store',{'user':props.user.id}), {
            preserveScroll: false,
            onFinish: () => {

            },
            onSuccess: (res) => {
                form.reset()
            },
        });
    }
    if(props.method == 'update'){
        form.patch(route('user.update',{'user':props.user.id}), {
            preserveScroll: false,
            onFinish: () => {

            },
        });
    }
};

console.log('cek : ', props.user.dob);

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
                                            aria-current="event">Content</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="block w-full overflow-x-auto px-7" :class="{hidden : tab != 'content'}">
                                <div class="block">
                                    <InputLabel for="first_name" value="First Name" />
                                    <TextInput type="text" class="mt-1 block w-full" v-model="form.first_name"  />
                                    <InputError class="mt-2" :message="form.errors.first_name" />
                                </div>

                                <div class="block mt-4">
                                    <InputLabel for="last_name" value="Last Name" />
                                    <TextInput type="text" class="mt-1 block w-full" v-model="form.last_name"  />
                                    <InputError class="mt-2" :message="form.errors.last_name" />
                                </div>
                                <div class="block mt-4">
                                    <InputLabel for="email" value="Email" />
                                    <TextInput type="text" disabled class="mt-1 block w-full" :value="form.email"  />
                                </div>
                                <div class="block mt-4">
                                    <InputLabel for="dob" value="Date of Birth" />
                                    <TextInput type="date" v-model="form.dob" format="dd/MM/yyyy" class="mt-1 block w-full" placeholder="Select Date of Birth" />
                                    <InputError class="mt-2" :message="form.errors.dob" />
                                </div>
                                <div class="block mt-4">
                                    <InputLabel for="telephone" value="Telephone" />
                                    <TextInput type="number" class="mt-1 block w-full" v-model="form.phone"  />
                                    <InputError class="mt-2" :message="form.errors.phone" />
                                </div>
                                <div class="block mt-4">
                                    <InputLabel for="address" value="Address" />
                                    <TextInput type="text" class="mt-1 block w-full" v-model="form.address"  />
                                    <InputError class="mt-2" :message="form.errors.address" />
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
            <!-- <div class="w-4/12">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded p-5" >
                    <div class="block">
                        <InputLabel for="featured" value="Set As Featured" />
                        <Checkbox  class="mt-1" v-model="form.featured"  :checked="form.featured == 1" />
                        <InputError class="mt-2" :message="form.errors.featured" />
                    </div>
                    <div class="block mt-4">
                        <InputLabel for="scan_point" value="Scan Point" />
                        <TextInput type="number" class="mt-1 block w-full" v-model="form.scan_point"  />
                        <InputError class="mt-2" :message="form.errors.scan_point" />
                    </div>
                    <div class="block mt-4">
                        <InputLabel for="ticket_url" value="Ticket Url" />
                        <TextInput type="text" class="mt-1 block w-full" v-model="form.ticket_url"  />
                        <InputError class="mt-2" :message="form.errors.ticket_url" />
                    </div>
                    <div class="block mt-4">
                        <InputLabel for="latitude" value="Latitude" />
                        <TextInput type="text" class="mt-1 block w-full" v-model="form.latitude"  />
                        <InputError class="mt-2" :message="form.errors.latitude" />
                    </div>
                    <div class="block mt-4">
                        <InputLabel for="longitude" value="Longitude" />
                        <TextInput type="text" class="mt-1 block w-full" v-model="form.longitude"  />
                        <InputError class="mt-2" :message="form.errors.longitude" />
                    </div>
                    <div class="block mt-4">
                        <InputLabel for="location" value="Location" />
                        <TextInput type="text" class="mt-1 block w-full" v-model="form.location"  />
                        <InputError class="mt-2" :message="form.errors.location" />
                    </div>
                    <div class="block mt-4">
                        <InputLabel for="published_at" value="Published Date" />
                        <TextInput type="date"  v-model="form.published_at" format="dd/MM/yyyy" placeholder="Select Published Date" />
                        <InputError class="mt-2" :message="form.errors.published_at" />
                    </div>
                    <div class="block mt-4">
                        <InputLabel for="started_at" value="Started Date" />
                        <TextInput type="datetime-local" v-model="form.started_at" format="dd/MM/yyyy hh:mm" placeholder="Select Started Date" />
                        <InputError class="mt-2" :message="form.errors.started_at" />
                    </div>
                    <div class="block mt-4">
                        <InputLabel for="ended_at" value="Ended Date" />
                        <TextInput type="datetime-local" v-model="form.ended_at" format="dd/MM/yyyy hh:mm" placeholder="Select Ended Date" />
                        <InputError class="mt-2" :message="form.errors.ended_at" />
                    </div>
                    <div class="block mt-4">
                        <InputLabel :for="form.image" value="Thumbnail" />
                        <acit-jazz-upload
                        class="mt-1 block w-full"
                        title="thumbnail"
                        folder="event"
                        :limit="1"
                        filetype="image/*"
                        name="thumbnail"
                        v-model="form.image"
                        >
                        </acit-jazz-upload>
                    </div>
                </div>

            </div> -->
            </form>
        </div>
    </Admin>
</template>