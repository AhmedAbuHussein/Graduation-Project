<template>

<div class="card">
		<div class="card-heading bg-info p-2">
			<div class="row">
                <div class="col-sm-6">
                    <input class="form-control text-right" style="direction:rtl;" v-model="search" type="search" placeholder="بحث باسم الصنف" />                </div>
                <div class="col-sm-6">
                    <h5 class="pt-2 text-white"><span v-text="filteremp.length"></span> عنصر</h5>
                </div>
			</div>
		</div>
		<div class="card-body py-0" style="max-height:26rem; overflow-y:auto">

			<table class="table table-striped" style="direction:rtl;">
				<tr>
					<th class="text-center">التسلسل</th>
					<th class="text-center">الاسم</th>
					<th class="text-center">الرقم القومي</th>
					<th class="text-center">البريد الاليكتروني</th>
					<th class="text-center">الجوال</th>
					<th class="text-center">المؤسسه</th>
					<th class="text-center">التحكم</th>
				</tr>
                <tr class="text-center" v-for="emp in filteremp" :key="emp">
					<td>{{emp.id}}</td>
					<td><a :href="'/covenant-owner?id='+emp.id">{{emp.name}}</a></td>
					<td>{{emp.ssn}}</td>
					<td>{{emp.email}}</td>
					<td>{{emp.phone}}</td>
                    <td>{{emp.establishment}}</td>
                    <td>
                        <a :href="'/covenant-owner/'+emp.id" class="btn btn-sm btn-outline-success">التفاصيل <i class="fa fa-edit"></i></a>
                    </td>                    
                </tr>
                
			</table>
		</div>
	</div>
</template>
<script>
import axios from 'axios';
export default {
    props:{
        role:''
    },
    data(){
        return{
            search:'',
            employees:[]
        };
    },
    methods:{
        getdata(){
            axios.get('/get-emps').then(response=>{
                this.employees = response.data;
                
                console.log(this.employees);
            }).catch(err=>{
                console.log(err);
            });
        }
    },
    computed:{
        filteremp(){
            var app = this;
            return this.employees.filter(function(item){
                return item.name.indexOf(app.search) !== -1;
            });
        },
       
    },
    created(){
       this.getdata();

    }
}
</script>
