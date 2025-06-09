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
							<form @submit.prevent="updateProduct">
								<div class="card-body">
									<input type="hidden" :value="productId">
									<div class="form-group">
										<label for="inputSerialNumber">Serial Number</label>
										<input type="text" :class="validations.serial_number ? 'form-control is-invalid' : 'form-control'" v-model="productSerialNumber" aria-describedby="inputSerialNumber">
										<span v-if="validations.serial_number" class="error invalid-feedback">
											{{ validations.serial_number[0] }}
										</span>
									</div>
									<div class="form-group">
										<label for="inputName">Product Name</label>
										<input type="text" :class="validations.name ? 'form-control is-invalid' : 'form-control'" v-model="productName" aria-describedby="inputName">
										<span v-if="validations.name" class="error invalid-feedback">
											{{ validations.name[0] }}
										</span>
									</div>
									<div class="form-group">
										<label for="inputLocation">Location</label>
										<input type="text" :class="validations.location ? 'form-control is-invalid' : 'form-control'" v-model="productLocation" aria-describedby="inputLocation">
										<span v-if="validations.location" class="error invalid-feedback">
											{{ validations.location[0] }}
										</span>
									</div>
									<div class="form-group">
										<label for="inputStock">Stock</label>
										<input type="text" :class="validations.stock ? 'form-control is-invalid' : 'form-control'" v-model="productStock" aria-describedby="inputStock">
										<span v-if="validations.stock" class="error invalid-feedback">
											{{ validations.stock[0] }}
										</span>
									</div>
									<div class="form-group">
										<label for="inputUnit">Unit</label>
										<input type="text" :class="validations.unit ? 'form-control is-invalid' : 'form-control'" v-model="productUnit" aria-describedby="inputUnit">
										<span v-if="validations.unit" class="error invalid-feedback">
											{{ validations.unit[0] }}
										</span>
									</div>
									<div class="form-group">
										<label for="inputDescription">Description</label>
										<textarea class="form-control" rows="4" v-model="productDescription"></textarea>
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
   data() {
		return {
			validations: ref([]),
			departments: [],
			validations: [],
			productId: '',
			productSerialNumber: '',
			productName: '',
			productUnit: '',
			productStock: '',
			productLocation: '',
			productDescription: '',
      };
   },
   mounted() {
      this.fetchProduct()
   },
   methods: {
		async fetchProduct() {
			try {
				const route = useRoute()
				const response = await axios.get(`http://localhost:8000/api/product/${route.params.id}`);
				
				this.productId = response.data.data.id
				this.productSerialNumber = response.data.data.serial_number
				this.productName = response.data.data.name
				this.productUnit = response.data.data.unit
				this.productStock = response.data.data.stock
				this.productLocation = response.data.data.location
				this.productDescription = response.data.data.description
			} catch (error) {
				console.error('Error fetching product:', error)
			}
		},
      async updateProduct() {
			try {
				await axios.put(`http://localhost:8000/api/product/${this.productId}`, {
					serial_number: this.productSerialNumber,
					name: this.productName,
					unit: this.productUnit,
					stock: this.productStock,
					location: this.productLocation,
					description: this.productDescription
				})

				this.$router.push({ name: 'product.index' })
			} catch (error) {
				this.validations = error.response.data
			}
      },
   },
}

/*
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
*/
</script>