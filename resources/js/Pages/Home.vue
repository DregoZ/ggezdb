<template>
    <app-layout>
    <template #header>
         
            <BasicInputForm />
            
    </template>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              
                <Trending v-for="topgame in topgames" :key="topgame.id" :topgame="topgame"/>

            </div>
        </div>
    </div>



    </app-layout>
</template>


<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Trending from '@/Pages/Querys/Trending'
    import BasicInputForm from '@/Pages/Forms/BasicInputForm'

    //import Presentacion from '@/Pages/Components/Presentacion'

// por aquí se reciben los datos
    export default {
        props: {
             topgames: {
                Type: Array,
                required: false
            }
        },

        components: {
            AppLayout, 
            BasicInputForm,
            Trending,
            //Presentacion

        },
        
    }
</script>