<template>
    <div class="container ">
        <div>
            <h4 class="h4">Liste des tâches</h4>
        </div>
        <add-item :apis="apis" v-on:reloadList="getAllItems()" />
        <list-items :apis="apis" :items="items" v-on:reloadList="getAllItems()" />
    </div>



</template>

<script>
import addItem from "./addItem";
import listItems from "./listItems";
export default {
    components: {
        addItem,
        listItems
    },
    created(){
        this.getUser();
        this.getAllItems();
    },
    data: function(){
        codeApi:''
        return{
            items: [],
            apis:[],
        }
    },
    methods: {
        getUser(){
            axios.get('userInfo').then(response => {
                 console.log(this.user);

                this.apis.name = response.data;
                this.codeApi = this.apis.name;
                this.getAllItems();
            }).catch(error => {
                console.log(error);
            })
        },
            getAllItems(){
            console.log(this.codeApi);
            axios.get(`api/items?api_token=`+this.codeApi).then(response => {
                this.items = response.data;
            }).catch(error => {
                console.log(error);
            })
        }
    }
}
</script>

<style scoped>
    .container{
        display: flex;
        width: 100%;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: #fafafc;
    }

    h2{
        font-size: 2rem;
    }
</style>
