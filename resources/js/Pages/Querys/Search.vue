<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mostrando resultados para:   {{ search_field }}      {{ cached }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
                  <div v-for="game in games" :key="game.id">
                        <div class="title">
                               <a :href="route('querys.games', game.slug)" > <h2 class="text-3xl">{{ game.name }}</h2></a> 
                        </div>

                        <div v-if="game.rating" class="rating">
                            <h4>Rating: {{ Math.floor(game.rating) }}</h4> 
                        </div>
                  
                        <div class="cover">
                            <div v-for="portada in portadas" :key="portada.id">
                                <div v-if="portada.id == game.cover">
                                    <img :src="'https://images.igdb.com/igdb/image/upload/t_cover_big/' + portada.image_id  + '.jpg'" alt="Imágen de portada">  
                                </div>
                                
                            </div>
                        </div>

                        <div class="summary">
                            <div v-if="game.summary">
                                <em>{{ game.summary }}</em>
                            </div>

                        </div>

                        <div class="plataformas">
                            <br> 
                            <h4>Disponible en: </h4>
                            <div v-for="plataforma in plataformas" :key="plataforma.id">
                                <div v-if="plataforma != null && game.platforms != null && (game.platforms).includes(plataforma.id)">
                                    <li> {{ plataforma.abbreviation }}</li>
                                </div>
                            </div>
                            
                        </div>
                    <br><br>

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
            search_field: {
                default: 'error',
            },
            games: {
                Type: Array,
                required: false
            },
            cached: {
                default: 'cached'
            },
            games_cache: {
                Type: Array,
                required: false
            },
            portadas: {
                Type: Array,
                required: false            
                },
            plataformas: {
                Type: Array,
                required: false
            },

        },
        components: {
            AppLayout
            
         },
    }

</script>             