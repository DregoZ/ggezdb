<template>
    <form name="search" @submit.prevent="submit">
     <div class="form-group">   
        <input class="form-busqueda form-input rounded-md shadow-sm" type="text" name="search" v-model="form.busqueda" placeholder="¡A buscar!" minlength="1" maxlength="20" size="20" >
    </div>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    busqueda: null
                },
            }
        },
       
        methods: {
            submit() {
                this.$inertia.post('/busqueda', this.form)
            },
        }
    }
</script>