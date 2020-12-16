<template>

    
   <div v-if="topgame.id !=  509658"> <!-- filtra JustChatting -->
        <img  :src="topgame.box_art_url.replace('{width}', '264').replace('{height}', 374)">  
    </div> 

   
   
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
// por aquí se reciben los datos
    export default {
        props: {
           
            topgame: {
                default: 'error'
            }
        },
    }   
    
</script>