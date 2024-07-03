<script setup>
import { useForm } from '@inertiajs/inertia-vue3'
import { ref, watch } from 'vue'
import { Inertia } from '@inertiajs/inertia'

const props  = defineProps({
    users: Object,
    title:String,
    trash:Boolean,
});

const showPopup = ref(false);
const search = ref('');
const start_date = ref(null);
const end_date = ref(null);

const form = useForm({
    option: null,
    point: null,
    message: ''
});

const submit = (data) => {
    form.option = data.data.option;
    form.point = data.data.point;
    form.message = data.data.message;

    form.post(route('user.updatePoint', { 'user':data.data.user_id }), {
        preserveScroll: false,
        onFinish: () => {
            
        },
        onSuccess: () => {
            form.reset()
            showPopup.value = false
        }
    });
}

// watch(search, (value) => {
//     Inertia.get(
//         route('user.index'),
//         { 
//             search_fulname_username_email: value,
//         },
//         { preserveState: true },
//     )
// });
</script>

<template>
    <Head title="Dashboard" />
    <Admin>
      <div class="flex flex-wrap mt-4">
        <div class="w-full mb-12 px-4">
            <!-- <div class="relative flex flex-col min-w-0 break-words lg:w-1/2 w-full mb-6 shadow-lg rounded bg-white">
              <div class="block w-full p-4">
                <h2 class="font-bold mb-6">Export Data</h2>
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
                <a :href="route('user.export', {start_date, end_date})" class="w-full font-medium py-2 px-4 block text-center mb-3 rounded leading-5 text-gray-100 bg-green-500 border border-green-500 hover:text-white hover:bg-green-600 hover:ring-0 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:outline-none focus:ring-0">Export</a>
              </div>
            </div> -->
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
                <div class="rounded-t mb-0 px-6 py-4 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full max-w-full flex">
                            <div class="flex items-center">
                                <h3 class="font-bold text-lg">
                                    {{title}}
                                </h3>
                            </div>
                            <!-- <input v-model="search" type="text" class="ml-auto rounded-md border-slate-400 mr-2 text-sm w-1/4" placeholder="Search Fullname"> -->
                        </div>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                <table class="items-center w-full bg-transparent border-collapse">
                    <thead>
                    <tr class="hidden lg:table-row">
                        <Th>Fullname</Th>
                        <Th>Username</Th>
                        <Th>Email</Th>
                        <Th>Register Date</Th>
                        <!-- <Th></Th> -->
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(user,index) in users.data" :key="index" class="hover:bg-gray-100 cursor-pointer relative py-3 block lg:py-0 lg:table-row border-t lg:border-0">
                        <Td>
                            <strong class="block lg:hidden">Fullname</strong>
                            <span>{{user.fullname ?? '-'}}</span>
                        </Td>
                        <Td>
                            <strong class="block lg:hidden">Username</strong>
                            <span>@{{user.username ?? '-'}}</span>
                        </Td>
                        <Td>
                            <strong class="block lg:hidden">Email</strong>
                            <span>{{user.email ?? '-'}}</span>
                        </Td>
                        <Td>
                            <strong class="block lg:hidden">Register Date</strong>
                            <span>{{user.created_at ?? '-'}}</span>
                        </Td>
                        <!-- <Td>
                            <div v-if="trash">
                                <SecondaryLink v-tooltip="'Restore'" class="px-3 py-2 bg-green-500 rounded-none rounded-l-md" :href="route('user.restore', { user })" method="post" as="button">
                                    <i class="fas fa-rotate-right"></i>
                                </SecondaryLink>
                                <SecondaryLink v-tooltip="'Destroy'" class="px-3 py-2 bg-red-500 rounded-none rounded-r-md" :href="route('user.forceDelete', { user })" method="post" as="button">
                                    <i class="fas fa-trash-can"></i>
                                </SecondaryLink>
                            </div>
                            <div v-else>
                                <SecondaryLink v-tooltip="'View Detail'" class="px-3 py-2 bg-indigo-500 rounded-none rounded-l-md" :href="route('user.show', { user })">
                                    <i class="fas fa-eye"></i>
                                </SecondaryLink>
                                <SecondaryLink v-tooltip="'Edit User'" class="px-3 py-2 bg-blue-400 rounded-none" :href="route('user.edit', { user })">
                                    <i class="fas fa-edit"></i>
                                </SecondaryLink>
                            </div>
                        </Td> -->
                        <PopupModalManagePoint 
                            v-if="showPopup == user.id" 
                            @close="showPopup = false" 
                            :user="user" 
                            @save="submit" 
                            :errors="form.errors"
                        />
                    </tr>
                    </tbody>
                </table>
                <pagination class="mt-6" :links="users.meta.links" />
                </div>
            </div>
        </div>
      </div>
  </Admin>
</template>
