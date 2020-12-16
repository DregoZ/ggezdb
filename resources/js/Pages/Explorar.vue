<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Explorar 
            </h2>
            <BasicInputForm />
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg grid grid-cols-5 gap-4">
                    
                    <Trending v-for="topgame in topgames" :key="topgame.id" :topgame="topgame"/>
                  
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
   // import Welcome from '@/Jetstream/Welcome'
    import BasicInputForm from '@/Pages/Forms/BasicInputForm'
    import Trending from '@/Pages/Querys/Trending'

    export default {
        props: {
            topgames: {
                Type: Array,
                required: false
            }
        },
            
        components: {
            AppLayout,
            Trending, 
            BasicInputForm
        },
        
    }
</script>
