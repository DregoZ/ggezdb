<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Twitch
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <pre> {{ cached }} </pre>
                    
                     <div v-for="game in game_example" :key="game.id">
                  <pre>     {{ game }} </pre>
                  <p>************************************************************</p>
                    </div>

                    <div v-if="game_cache">
                        <p>HAY CACHE AMIJOS</p>
                        <div v-for="cache in game_cache" :key="cache.id">
                            <pre> {{ cache.name }}</pre>
                        </div>
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
            game_example: {
                Type: Array,
                required: false
            },
            cached: {
                default: 'cached'
            },
            game_cache: {
                Type: Array,
                default: null
            }
        },
        components: {
            AppLayout
            
         },
        
    }
</script>