<template>
	<div class="content-wrapper">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-12">
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
								<h3 class="card-title">Edit Department</h3>
							</div>
							<form @submit.prevent="update">
								<div class="card-body">
									<div class="form-group">
										<label for="inputName">Department Name</label>
										<input type="text" class="form-control" name="name" id="name" v-model="department.name" aria-describedby="inputName"/>
										<div v-if="validation.name" class="alert alert-danger mt-2">
											<i class="icon fas fa-ban"></i> {{ validation.name[0] }}
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
		const department = reactive({
			name: ''
		})

		const validation = ref([])
		const router = useRouter()
		const route = useRoute()

		onMounted(() => {
			axios.get(`http://localhost:8000/api/department/${route.params.id}`)
			.then(response => {
				department.name = response.data.data.name
			}).catch(error => {
				console.log(error.response.data)
			})
		})

		function update() {
			let name   = department.name

			axios.put(`http://localhost:8000/api/department/${route.params.id}`, {
				name: name
			}).then(() => {
				router.push({
					name: 'department.index'
				})
			}).catch(error => {
				validation.value = error.response.data
			})
		}

		return {
			department,
			validation,
			router,
			update
		}
	}
}
</script>