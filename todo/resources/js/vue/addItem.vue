<template>
    <div class="addItemContainer">
        <!-- <input type="text" class="inputForm" aria-label="input Item" aria-describedby="input Item" placeholder="Saisir votre tâche..." v-model="item.name"> -->
        <div class="form-group row">
            <div class="col-sm-6">
                <input type="text" class="form-control inputForm" aria-label="input Item" placeholder="Saisir votre tâche..."  aria-describedby="basic-addon1" v-model="item.name">
            </div>
            <div class="col-sm-6 ">
                <input type="text" class="form-control inputForm" aria-label="input Item" placeholder="Niveau de la tâche"  aria-describedby="basic-addon1" v-model="item.level">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-offset-4 mx-auto">
                <font-awesome-icon icon="plus-circle" :class="[item.name ? 'active' : 'inactive', 'plus']" @click="addItem()" />
            </div>
         </div>
                
       
    </div>

</template>

<script>
export default {
    data: function () {
        return {
            item: {
                name: ""
            }
        }
    },
    methods:{
        addItem() {
            if(this.item.name === ''){
                return;
            }

            axios.post('api/item/store', {
                item: this.item
            }).then(response => {
                if(response.status == 201){
                    this.item.name = "";
                    this.$emit('reloadList');
                }
            }).catch(error => {
                console.log(error);
            })
        }
    }
}
</script>

<style scoped>
.addItemContainer{
    display: flex;
}
.inputForm{
    min-width: 100%;
    height: 2rem;
    border: none;
    border-bottom: 1px solid #ccc;
    outline: none;
    color: #5C5D67;
}

.plus{
    font-size: 2rem;
    margin-left: 1rem;
    cursor: pointer;
}
.active{
    color: #3E885B;
}

.inactive{
    color: #5C5D67;
}
</style>

