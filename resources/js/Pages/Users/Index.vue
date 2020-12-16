<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <pre> Current user: {{ $page.user.name }}</pre>

                    <div v-for="user in users" :key="user.id">
                        {{ user.name }}
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
// por aquí se reciben los datos
    export default {
        props: {
            users: {
                type: Array,
                required: true
            }

        },
        components: {
            AppLayout
            
        },
    }
</script>
