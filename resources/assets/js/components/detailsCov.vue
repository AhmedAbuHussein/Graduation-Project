<template>
  
<div>
<div class="card mt-4 cardtable">
        <div class="card-heading bg-danger p-2 text-right text-white">
            <div class="row pr-4 pl-4">
                <div class="col-sm-6">
                    <input style="direction:rtl;" type="search" v-model="search" placeholder="بحث بالمصدر" class="form-control form-control-sm">
                </div>
                
                <div class="col-sm-6">
                     <bdi>المصرف من [ <span class="font-weight-bold">{{itemname}}</span> ]</bdi>
                </div>
            </div>
        </div>
            
        <div class="card-body py-0">
            <table class="table table-striped" style="direction:rtl">
                <thead>
                    <tr>
                        <th>التسلسل</th>
                        <th>صاحب العهده</th>
                        <th>الكميه</th>
                        <th>اذن التوريد</th>
                        <th>الموظف</th>
                    </tr>
                </thead>
                <tbody>
                        <tr v-for="item in filters" :key="item['id']">
                            <td>{{item['id']}}</td>
                            <td>{{item['employee']}}</td>
                            <td>{{item['quantity']}}</td>
                            <td>{{item['permision']}}</td>
                            <td><a :href="'/profile?id='+item['userid']">{{item['username']}}</a></td>
                        </tr>
                    
                </tbody>
            </table>
        </div>
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
                return item.employee.indexOf(app.search) !== -1;
             });
        }
    },
    methods:{
        getData(){
            axios.get("/detailscov?id="+this.itemid).then((result) => {
                this.items = result.data[0];
                this.itemname = result.data[1].name;
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
<style>
    .card-heading{
        z-index: 3;
    }
    .card-body{
        max-height: 200px;
        overflow: auto;
        z-index: 2;
    }
    table tr th , table tr td{
        text-align: center
    }
</style>
