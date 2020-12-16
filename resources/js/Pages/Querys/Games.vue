<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ gameweb.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="title">
                        <h2 class="text-3xl"> {{ gameweb.name }} </h2>
                    </div>
                   
                   <div class="rating">
                        <h4 class="text-xl">Rating: {{ Math.floor(gameweb.rating) }}</h4> 
                    </div>

                    <div class="cover">
                        <div v-if="portada.image_id">
                            <img :src="'https://images.igdb.com/igdb/image/upload/t_cover_big/' + portada.image_id +'.jpg'" alt="Imágen de portada">  
                        </div>
                        <div v-else>
                                <img src="https://via.placeholder.com/264x374.png?text=No+hay+portada+disponible" alt="No hay portada">
                        </div>
                    </div>

                    <div v-if="gameweb.summary" class="summary">
                       <br> <em> {{ gameweb.summary  }} </em>
                    </div>             
                    <div v-else>
                        <p>No hay resumen disponible</p>
                    </div>

                    <div v-if="plataformas" class="plataformas">
                        <br><h4 class="text-xl">Disponible en:</h4>  
                            <ul>
                                <li v-for="plataforma in plataformas" :key="plataforma.id">{{ plataforma.abbreviation }}</li>
                            </ul>
                    </div>
                    <div v-else>
                      <br>  <p>No hay plataformas disponibles</p> 
                    </div>
                
                    <br>  <h2>Screenshots</h2>
                    <div class="screenshots">
                        <div class="grid grid-cols-3 gap-4" v-if="screenshots">
                            <div v-for="screenshot in screenshots" :key="screenshot.image_id" > 
                                <img :src="'https://images.igdb.com/igdb/image/upload/t_screenshot_big/' + screenshot.image_id + '.jpg'" alt=""> 
                            </div>    
                        </div>
                    </div> 

                    <div class="videos">
                       <br> <h2>Videos</h2>
                        <div v-if="videos" class="grid grid-cols-3 gap-4">
                            <div v-for="video in videos" :key="video.video_id"> 
                                <iframe width="420" height="315" 
                                    :src="'https://youtube.com/embed/' + video.video_id +'?controls=1'" type="video/webm">     
                                </iframe>
                            </div>
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
            slug: {
                default: 'no-slug'
            },
            gameweb: {
                Type: Array,
                required: false
            },
            portada: {
                Type: Array,
                required: false
            },
            plataformas: {
                Type: Array,
                required: false
            },
            screenshots: {
                Type: Array,
                required: false
            },
            videos: {
                Type: Array,
                required: false
            },
            cached: {
                default: 'cached'
            }
        
        },
        components: {
            AppLayout
            
         },
        
    }
</script>
