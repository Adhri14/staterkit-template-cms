<script setup>
const props  = defineProps({
    log_user: Object,
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
                    <tr class="lg:table-row">
                        <tr>
                          <Td>User</Td>
                          <Td>: {{ log_user.user?.full_name ?? '-' }}</Td>
                        </tr>
                        <tr>
                          <Td>Email</Td>
                          <Td>: {{ log_user.user?.email ?? '-' }}</Td>
                        </tr>
                        <tr>
                          <Td>Activity</Td>
                          <Td>: {{ log_user.activity ?? '-' }}</Td>
                        </tr>
                        <tr>
                          <Td>Module</Td>
                          <Td>: {{ log_user.module ?? '-' }}</Td>
                        </tr>
                        <tr>
                          <Td>Action</Td>
                          <Td>: {{ log_user.action ?? '-' }}</Td>
                        </tr>
                        <tr>
                          <Td>URL</Td>
                          <Td class="text-blue-500">: {{ log_user.url ?? '-' }}</Td>
                        </tr>
                        <tr>
                          <Td>Method</Td>
                          <Td>:
                            <span v-if="log_user.method === 'POST'" class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{log_user.method ?? '-'}}</span>
                            <span v-if="log_user.method === 'PUT' || log_user.method === 'PATCH'" class="bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{log_user.method ?? '-'}}</span>
                            <span v-if="log_user.method === 'DELETE'" class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{log_user.method ?? '-'}}</span>
                          </Td>
                        </tr>
                        <tr>
                          <Td>IP Address</Td>
                          <Td>: {{ log_user.ip_address ?? '-' }}</Td>
                        </tr>
                        <tr>
                          <Td>User Agent</Td>
                          <Td>: {{ log_user.agent ?? '-' }}</Td>
                        </tr>
                        <tr>
                          <Td>Created Date</Td>
                          <Td>: {{ log_user.created_at ?? '-' }}</Td>
                        </tr>
                    </tr>
                  </table>
                </div>
            </div>
         </div>
       </div>
   </Admin>
 </template>