<template>
	<div class="content-wrapper">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-12">
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
							<div class="card-header"><div class="card-title">Edit Client</div></div>
							<form @submit.prevent="submitClient">
								<div class="card-body">
									<input type="hidden" :value="clientId">
									<div class="mb-3">
										<label for="inputNIK" class="form-label">NIK</label>
										<input type="text" :class="validations.nik ? 'form-control is-invalid' : 'form-control'" v-model="clientNIK">
										<span v-if="validations.nik" class="error invalid-feedback">
											{{ validations.nik[0] }}
										</span>
									</div>
									<div class="mb-3">
										<label for="inputName" class="form-label">Client Name</label>
										<input type="text" :class="validations.name ? 'form-control is-invalid' : 'form-control'" v-model="clientName">
										<span v-if="validations.name" class="error invalid-feedback">
											{{ validations.name[0] }}
										</span>
									</div>
									<div class="mb-3">
										<label for="selectDepartment" class="form-label">Department</label>
										<select class="form-select" v-model="selectedDepartment">
											<option v-for="department in departments" :value="department.id" :key="department.id">
												{{ department.name }}
											</option>
										</select>
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" class="btn btn-primary"><i class="fas fa-share-square"></i> Update</button>
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
			selectedDepartmentId: null,
			selectedDepartment: null,
			clientId: '',
			clientNIK: '',
			clientName: ''
      };
   },
   mounted() {
      this.fetchClient()
   },
   methods: {
		async fetchClient() {
			try {
				const route = useRoute()
				const response = await axios.get(`http://localhost:8000/api/client/${route.params.id}`);
				
				this.clientId = response.data.data[0].id
				this.clientNIK = response.data.data[0].nik
				this.clientName = response.data.data[0].name
				this.selectedDepartmentId = response.data.data[0].department_id
				this.fetchDepartment()
			} catch (error) {
				console.error('Error fetching client:', error)
			}
		},
		async fetchDepartment() {
			try {
				const response = await axios.get('http://localhost:8000/api/department');
				this.departments = response.data.data
				this.selectedDepartment = this.selectedDepartmentId
			} catch (error) {
				console.error('Error fetching departments:', error)
			}
      },
      async submitClient() {
			try {
				await axios.put(`http://localhost:8000/api/client/${this.clientId}`, {
					nik: this.clientNIK,
					name: this.clientName,
					department_id: this.selectedDepartment
				})

				this.$router.push({ name: 'client.index' })
			} catch (error) {
				this.validations = error.response.data
			}
      },
   },
}
</script>