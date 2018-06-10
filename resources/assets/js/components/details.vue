<template>
  
<div>
<div class="card mt-4 cardtable">
        <div class="card-heading bg-primary p-2 text-right text-white">
            <div class="row pr-4 pl-4">
                <div class="col-sm-6">
                    <input style="direction:rtl;" type="search" v-model="search" placeholder="بحث بالمصدر" class="form-control form-control-sm">
                </div>
                
                <div class="col-sm-6">
                    <bdi>الاضافات التي تمت علي <span class="font-weight-bold">{{itemname}}</span></bdi></div>
                </div>
                

            </div>
            
        <div class="card-body pt-0 pb-0">
            <table class="table table-striped" style="direction:rtl">
                <thead>
                    <tr>
                        <th>التسلسل</th>
                        <th>المصدر</th>
                        <th>الكميه</th>
                        <th>السعر</th>
                        <th>اذن التوريد</th>
                        <th>الموظف</th>
                    </tr>
                </thead>
                <tbody>
                        <tr v-for="item in filters" :key="item['id']">
                            <td>{{item['id']}}</td>
                            <td>{{item['source']}}</td>
                            <td>{{item['quantity']}}</td>
                            <td>{{item['price']}}</td>
                            <td>{{item['permision']}}</td>
                            <td><a :href="'/profile?id='+item['user_id']">{{item['username']}}</a></td>
                        </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
    <div class="text-right mt-2">
        <a :href="'/edit?id='+itemid" class="btn btn-lg btn-outline-primary">تعديل اخر اضافه للمخزن <i class="fa fa-edit"></i></a>
    </div>

</div>

</template>
<script>

import axios from 'axios';
export default {
    props:['itemid'],
    data(){
        return{
            items:[],
            itemname:"",
            search:"",
        }
    },
    computed:{
        filters(){
            var app = this;
            return this.items.filter(function (item) { 
                return item.source.indexOf(app.search) !== -1;
             });
        }
    },
    methods:{
        getData(){
            axios.get("/detailsItem?id="+this.itemid).then((result) => {
                this.items = result.data;
                this.itemname = result.data[0].dataname;
            }).catch((err) => {
                console.log(err);
            });
        }
    },
    created(){
        this.getData();
    }
}
</script>
