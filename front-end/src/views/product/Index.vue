<template>
	<div class="content-wrapper">
    	<section class="content-header">
      	<div class="container-fluid">
        		<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1>Products</h1>
          		</div>
          		<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Products</li>
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
                			<router-link :to="{name: 'product.create'}" class="btn btn-sm btn-success"><i class="far fa-plus-square"></i> Add New Product</router-link>
              			</div>
							<div class="card-body p-0">
								<table class="table table-striped">
									<thead>
										<tr>
											<th style="width: 50px">#</th>
											<th>Serial Number</th>
											<th>Product Name</th>
											<th>Unit</th>
											<th>Stock</th>
											<th>Location</th>
											<th style="width: 200px">Action</th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(product, index) in products" :key="index">
											<td>{{ index+1 }}</td>
											<td>{{ product.serial_number }}</td>
											<td>{{ product.name }}</td>
											<td>{{ product.unit }}</td>
											<td>{{ product.stock }}</td>
											<td>{{ product.location }}</td>
											<td>
												<router-link :to="{name: 'product.edit', params:{id: product.id }}" class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i> Edit</router-link>
												<button @click.prevent="productDelete(product.id)" class="btn btn-sm btn-danger ml-1"><i class="far fa-trash-alt"></i> Delete</button>
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
		let products = ref([])

		onMounted(() => {
			axios.get('http://localhost:8000/api/product')
			.then(response => {
				products.value = response.data.data
			}).catch(error => {
				console.log(error.response.data)
			})
		})

		function productDelete(id) {
			axios.delete(`http://localhost:8000/api/product/${id}`)
			.then(() => {
				products.value.splice(products.value.indexOf(id), 1);
			}).catch(error => {
				console.log(error.response.data)
			})
		}

		return {
			products,
			productDelete
		}
	}
}
</script>