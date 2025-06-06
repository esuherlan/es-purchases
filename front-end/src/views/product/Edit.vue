<template>
	<div class="content-wrapper">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-12">
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
								<h3 class="card-title">Edit Product</h3>
							</div>
							<form @submit.prevent="update">
								<div class="card-body">
									<div class="form-group">
										<label for="inputSerialNumber">Serial Number</label>
										<input type="text" class="form-control" v-model="product.serial_number" aria-describedby="inputSerialNumber">
										<div v-if="validation.serial_number" class="alert alert-danger mt-2">
											<i class="icon fas fa-ban"></i> {{ validation.serial_number[0] }}
										</div>
									</div>
									<div class="form-group">
										<label for="inputName">Product Name</label>
										<input type="text" class="form-control" v-model="product.name" aria-describedby="inputName"/>
										<div v-if="validation.name" class="alert alert-danger mt-2">
											<i class="icon fas fa-ban"></i> {{ validation.name[0] }}
										</div>
									</div>
									<div class="form-group">
										<label for="inputLocation">Location</label>
										<input type="text" class="form-control" v-model="product.location" aria-describedby="inputLocation">
										<div v-if="validation.location" class="alert alert-danger mt-2">
											<i class="icon fas fa-ban"></i> {{ validation.location[0] }}
										</div>
									</div>
									<div class="form-group">
										<label for="inputStock">Stock</label>
										<input type="text" class="form-control" v-model="product.stock" aria-describedby="inputStock">
										<div v-if="validation.stock" class="alert alert-danger mt-2">
											<i class="icon fas fa-ban"></i> {{ validation.stock[0] }}
										</div>
									</div>
									<div class="form-group">
										<label for="inputUnit">Unit</label>
										<input type="text" class="form-control" v-model="product.unit" aria-describedby="inputUnit">
										<div v-if="validation.unit" class="alert alert-danger mt-2">
											<i class="icon fas fa-ban"></i> {{ validation.unit[0] }}
										</div>
									</div>
									<div class="form-group">
										<label for="inputDescription">Description</label>
										<textarea class="form-control" rows="4" v-model="product.description"></textarea>
										<div v-if="validation.stock" class="alert alert-danger mt-2">
											<i class="icon fas fa-ban"></i> {{ validation.stock[0] }}
										</div>
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" class="btn btn-primary"><i class="fas fa-cloud-upload-alt"></i> Update</button>
								</div>
							</form>
						</div>
					</div>
			 	</div>
			</div>
		</section>
	</div>
</template>

<script>
import { reactive, ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import axios from 'axios'

export default {
	setup() {
		const product = reactive({
			serial_number: '',
			name: '',
			unit: '',
			stock: '',
			location: '',
			description: '',
		})

		const validation = ref([])
		const router = useRouter()
		const route = useRoute()

		onMounted(() => {
			axios.get(`http://localhost:8000/api/product/${route.params.id}`)
			.then(response => {
				product.serial_number = response.data.data.serial_number
				product.name = response.data.data.name
				product.unit = response.data.data.unit
				product.stock = response.data.data.stock
				product.location = response.data.data.location
				product.description = response.data.data.description
			}).catch(error => {
				console.log(error.response.data)
			})
		})

		function update() {
			let serial_number = product.serial_number
			let name = product.name
			let unit = product.unit
			let stock = product.stock
			let location = product.location
			let description = product.description

			axios.put(`http://localhost:8000/api/product/${route.params.id}`, {
				serial_number: serial_number,
				name: name,
				unit: unit,
				stock: stock,
				location: location,
				description: description
			}).then(() => {
				router.push({
					name: 'product.index'
				})
			}).catch(error => {
				validation.value = error.response.data
			})
		}

		return {
			product,
			validation,
			router,
			update
		}
	}
}
</script>