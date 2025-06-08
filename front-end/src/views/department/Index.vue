<template>
	<div class="content-wrapper">
    	<section class="content-header">
      	<div class="container-fluid">
        		<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1>Departments</h1>
          		</div>
          		<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Departments</li>
						</ol>
          		</div>
        		</div>
      	</div>
    	</section>
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="card card-primary card-outline">
							<div class="card-header">
                			<router-link :to="{name: 'department.create'}" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Add New Department</router-link>
              			</div>
							<div class="card-body p-0">
								<table class="table table-striped">
									<thead>
										<tr>
											<th style="width: 50px">#</th>
											<th>Department Name</th>
											<th style="width: 200px">Action</th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(department, index) in departments" :key="index">
											<td>{{ index+1 }}</td>
											<td>{{ department.name }}</td>
											<td>
												<router-link :to="{name: 'department.edit', params:{id: department.id }}" class="btn btn-sm btn-primary mr-2"><i class="fas fa-pencil-alt"></i> Edit</router-link>
												<button @click.prevent="departmentDelete(department.id)" class="btn btn-sm btn-danger ml-1"><i class="fas fa-trash"></i> Delete</button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
  	</div>
</template>

<script>
import axios from 'axios'
import { onMounted, ref } from 'vue'

export default {
	setup() {
		let departments = ref([])

		onMounted(() => {
			axios.get('http://localhost:8000/api/department')
			.then(response => {
				departments.value = response.data.data
			}).catch(error => {
				console.log(error.response.data)
			})
		})

		function departmentDelete(id) {
			axios.delete(`http://localhost:8000/api/department/${id}`)
			.then(() => {
				departments.value.splice(departments.value.indexOf(id), 1);
			}).catch(error => {
				console.log(error.response.data)
			})
		}

		return {
			departments,
			departmentDelete
		}
	}
}
</script>