<template>
	<main class="app-main">
		<div class="app-content-header">
			<div class="container-fluid">
				<div class="row">
					<!-- <div class="col-sm-6"><h3 class="mb-0">Add New Department</h3></div> -->
					<div class="col-sm-12">
						<ol class="breadcrumb float-sm-end">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Department</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<div class="app-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
                	<div class="card card-primary card-outline mb-4">
							<div class="card-header"><div class="card-title">Add New Department</div></div>
							<form @submit.prevent="store">
								<div class="card-body">
									<div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Department Name</label>
										<input type="text" class="form-control" name="name" id="name" v-model="department.name" aria-describedby="nameHelp"/>
										<!-- <div id="nameHelp" class="form-text">
											We'll never share your email with anyone else.
										</div> -->
										<div v-if="validation.title" class="mt-2 alert alert-danger">
                                    {{ validation.title[0] }}
                                </div>
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</form>
                	</div>
              	</div>
				</div>
			</div>
		</div>
   </main>
</template>

<script>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

export default {
	setup() {
		const department = reactive({
			name: ''
		})

		const validation = ref([])
		const router = useRouter()

		function store() {
			let name   = department.name

			axios.post('http://localhost:8000/api/department', {
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
			store
		}
	}
}
</script>