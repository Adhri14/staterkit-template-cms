<script setup>
const props  = defineProps({
    log_users: Object,
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
                        </div>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                <table class="items-center w-full bg-transparent border-collapse">
                    <thead>
                    <tr class="hidden lg:table-row">
                        <Th>Name</Th>
                        <Th>Email</Th>
                        <Th>Activity</Th>
                        <Th>Module</Th>
                        <Th>Action</Th>
                        <Th>IP Address</Th>
                        <Th>Created At</Th>
                        <Th></Th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(log_user,index) in log_users.data" :key="index" class="hover:bg-gray-100 cursor-pointer relative py-3 block lg:py-0 lg:table-row border-t lg:border-0">
                        <Td>
                            <strong class="block lg:hidden">Admin</strong>
                            <span>{{log_user.user?.full_name ?? '-'}}</span>
                        </Td>
                        <Td>
                            <strong class="block lg:hidden">Admin</strong>
                            <span>{{log_user.user?.email ?? '-'}}</span>
                        </Td>
                        <Td>
                            <strong class="block lg:hidden">Activity</strong>
                            <span>{{log_user.activity ?? '-'}}</span>
                        </Td>
                        <Td>
                            <strong class="block lg:hidden">Module</strong>
                            <span>{{log_user.module ?? '-'}}</span>
                        </Td>
                        <Td>
                            <strong class="block lg:hidden">Action</strong>
                            <span>{{log_user.action ?? '-'}}</span>
                        </Td>
                        <Td>
                            <strong class="block lg:hidden">IP Address</strong>
                            <span>{{log_user.ip_address ?? '-'}}</span>
                        </Td>
                        <Td>
                            <strong class="block lg:hidden">Created At</strong>
                            <span>{{log_user.created_at ?? '-'}}</span>
                        </Td>
                        <Td>
                            <div v-if="trash">
                                <SecondaryLink v-tooltip="'Restore'" class="px-3 py-2 bg-green-500 rounded-none rounded-l-md" :href="route('log-user.restore', { log_user })" method="post" as="button">
                                    <i class="fas fa-rotate-right"></i>
                                </SecondaryLink>
                                <SecondaryLink v-tooltip="'Destroy'" class="px-3 py-2 bg-red-500 rounded-none rounded-r-md" :href="route('log-user.forceDelete', { log_user })" method="post" as="button">
                                    <i class="fas fa-trash-can"></i>
                                </SecondaryLink>
                            </div>
                            <div v-else>
                                <SecondaryLink v-tooltip="'View Detail'" class="px-3 py-2 bg-indigo-500 rounded-none rounded-l-md" :href="route('log-user.show', { log_user })">
                                    <i class="fas fa-eye"></i>
                                </SecondaryLink>
                            </div>
                        </Td>
                    </tr>
                    </tbody>
                </table>
                 <pagination class="mt-6" :links="log_users.meta.links" />
                </div>
            </div>
         </div>
       </div>
   </Admin>
 </template>
