<template>
<div class="card">
    <div class="card-heading bg-info p-2">
			<div class="row">
                <div class="col-sm-6">
                    <input class="form-control text-right" v-model="search" style="direction:rtl;"  type="search" placeholder="بحث باسم الصنف" />                </div>
                <div class="col-sm-6">
                    <h5 class="pt-2 text-white"><span v-text="filterfun.length"></span> عنصر</h5>
                </div>
			</div>
		</div>
		<div class="card-body py-0" style="max-height:20rem; overflow-y:auto">

		<table class="table table-striped" style="direction:rtl;">

            <tr class="text-center">
                <th>المسلسل</th>
                <th>العنصر</th>
                <th>الكميه</th>
                <th>المخزن</th>
                <th>الموظف</th>
            </tr>
            <tr class="text-center" v-for="data in filterfun" :key="data.id">
                <td>{{data.id}}</td>
                <td>{{data.datastorename}}</td>
                <td>{{data.quantity}}</td>
                <td>{{data.store}}</td>
                <td>{{data.username}}</td>
            </tr>
      </table>
  </div>
  </div>
</template>
<script>
import axios from 'axios';
export default {
    props:['userid'],
    data(){
        return{
            covenants :[],
            search:''
        }
    },
    methods:{

         getdata(){
            
            var x = this.userid;
            axios.get('/owner-covenants?userid='+x).then((result) => {
                console.log(result);
                this.covenants = result.data;
            }).catch((err) => {
                console.log(err);
            });
        }

    },
    computed:{
       
        filterfun(){
            var app = this;
            return this.covenants.filter(function(item){
                return item.datastorename.indexOf(app.search) !== -1;
            });
        }
    },
    mounted(){
        this.getdata();
    }
}
</script>
