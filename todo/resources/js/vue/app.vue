<template>
    <div class="container ">
        <div>
            <h4 class="h4">Liste des tâches</h4>
        </div>
        <add-item v-on:reloadList="getAllItems()" />
        <list-items :items="items" v-on:reloadList="getAllItems()" />
    </div>



</template>

<script>
import addItem from "./addItem";
import listItems from "./listItems";
console.log('fd');
export default {
    components: {
        addItem,
        listItems
    },
    data: function(){
        return{
            items: [],
            userInfos:[],
        }
    },
    methods: {
        getUser(){
            axios.get('userInfo').then(response => {
                this.userInfos = response.data;
                console.log(this.userInfos['api_token']);
            }).catch(error => {
                console.log(error);
            })
        },
            getAllItems(){
            axios.get('api/items?api_token=aaaaaaaaaaa').then(response => {
                this.items = response.data;
            }).catch(error => {
                console.log(error);
            })
        }
    },
    created(){
        this.getUser();
        this.getAllItems();
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
