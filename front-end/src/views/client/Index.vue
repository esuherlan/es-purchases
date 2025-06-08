<template>
	<div class="content-wrapper">
    	<section class="content-header">
      	<div class="container-fluid">
        		<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1>Clients</h1>
          		</div>
          		<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Clients</li>
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
                			<router-link :to="{name: 'client.create'}" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Add New Client</router-link>
              			</div>
							<div class="card-body p-0">
								<table class="table table-striped">
									<thead>
										<tr>
											<th style="width: 10px">#</th>
											<th>NIK</th>
											<th>Name</th>
											<th>Department</th>
											<th style="width: 200px">Action</th>
										</tr>
									</thead>
									<tbody>
										<tr class="align-middle" v-for="(client, index) in clients" :key="index">
											<td>{{ index+1 }}</td>
											<td>{{ client.nik }}</td>
											<td>{{ client.name }}</td>
											<td>{{ client.department_name }}</td>
											<td>
												<router-link :to="{name: 'client.edit', params:{id: client.id }}" class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i> Edit</router-link>
												<button @click.prevent="clientDelete(client.id)" class="btn btn-sm btn-danger ml-1" style="margin-left: 10px"><i class="far fa-trash-alt"></i> Delete</button>
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
		let clients = ref([])

		onMounted(() => {
			axios.get('http://localhost:8000/api/client')
			.then(response => {
				clients.value = response.data.data
			}).catch(error => {
				console.log(error.response.data)
			})
		})

		function clientDelete(id) {
			axios.delete(`http://localhost:8000/api/client/${id}`)
			.then(() => {
				clients.value.splice(clients.value.indexOf(id), 1);
			}).catch(error => {
				console.log(error.response.data)
			})
		}

		return {
			clients,
			clientDelete
		}
	}
}
</script>