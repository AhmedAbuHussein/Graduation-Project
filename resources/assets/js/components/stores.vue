<template>

    <div class="card cardtable">

        <div class="card-heading p-2 bg-info form-parent">
        
            <div class="row">
                <div class="col-sm-4">
                    <input v-model="search" class="form-control input-primary" type="search"  placeholder="بحث باسم الصنف" />
                </div>
                <div class="col-sm-4">
                    <p class="text-center text-white m-0"> عنصر 
                        <bdi id="spancount" v-text="filterDate.length"></bdi>
                    </p>
                </div>
                <div class="col-sm-4">
                    <select 
                        v-if="user['role'] == 0"
                        class="form-control input-primary" 
                        id="storechoose" 
                        name="store"
                        v-model="store"
                    >
                        <option value="0">الكل</option>
                        <option v-for="store in stores" :value="store['id']" v-text="store['name']"></option>
                    </select>

                     <select 
                        v-else
                        class="form-control input-primary" 
                        id="storechoose" 
                        disabled
                        name="store"
                    >
                        <option v-for="store in stores" :value="store['id']" :selected="user['store_id'] == store['id']?'selected':''" v-text="store['name']"></option>
                    </select>
                    
                </div>
            </div> 
        </div>
    
        <div class="card-body">
            <table  class="table table-striped">
                <thead>
                    <tr>
                        <th>التسلسل</th>
                        <th>اسم الصنف</th>
                        <th>المخزن</th>
                        <th>الكميه الاساسيه</th>
                        <th>التحكم</th>
                    </tr>
                </thead>
                <tbody id="tableStore">
    
                    <tr v-for="d in filterDate">
                        <td>{{d['id']}}</td>
                        <td>{{d['name']}}</td>
                        <td>{{d['storename']}}</td>
                        <td>{{d['quantity']}}</td>
                        <td>
                            <a 
                                v-if="user['role'] == 0 || user['store_id'] == d['store_id']"
                                :href="'/details/'+d['id']" 
                                class="btn btn-success btn-sm ">
                                التفاصيل 
                                <i class="fa fa-edit"></i>
                            </a>
                            <p v-else class="disabled">Disabled</p>
                        </td>
    
                    </tr>
                </tbody>
            </table>
        
        </div>
    
        
    </div>                    
        
</template>

<script>
    import axios from 'axios';
    export default {
        props:[
            "user"
        ],
        data(){
            return{
                'datastore':[],
                'stores':[],
                'search':"",
                'store':0,
            };
        },
        computed:{
            filterDate(){
                var app = this;
                return this.datastore.filter(function(item){
                    if(app.store == 0){
                        return item.name.indexOf(app.search) !== -1
                    }
                    return (item.store_id == app.store && item.name.indexOf(app.search) !== -1);
                });
            }
        },
        methods:{
            getData:function(){
                axios.get("/stores").then(result => {
                    this.datastore = result.data.data;
                    this.stores = result.data.stores;
                }).catch((err) => {
                    console.log(err);
                });
            },
            
        },
        created(){
            this.getData();
        }
    }
</script>
<style>
    select,input{
        direction: rtl;
    }
</style>
