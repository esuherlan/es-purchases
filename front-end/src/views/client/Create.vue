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
							<div class="card-header"><div class="card-title">Add New Client</div></div>
                     <form @submit.prevent="submitForm">
								<div class="card-body">
									<div class="mb-3">
										<label for="inputNIK" class="form-label">NIK</label>
										<input type="text" :class="validations.nik ? 'form-control is-invalid' : 'form-control'" v-model="inputNik">
										<span v-if="validations.nik" class="error invalid-feedback">
											{{ validations.nik[0] }}
										</span>
									</div>
									<div class="mb-3">
										<label for="inputName" class="form-label">Client Name</label>
										<input type="text" :class="validations.name ? 'form-control is-invalid' : 'form-control'" v-model="inputName">
										<span v-if="validations.name" class="error invalid-feedback">
											{{ validations.name[0] }}
										</span>
									</div>
									<div class="mb-3">
										<label for="selectDepartment" class="form-label">Department</label>
										<select :class="validations.department_id ? 'form-select is-invalid' : 'form-select'" v-model="selectedOption">
											<option v-for="option in departments" :value="option.id" :key="option.id">
												{{ option.name }}
											</option>
										</select>
										<span v-if="validations.department_id" class="error invalid-feedback">
											{{ validations.department_id[0] }}
										</span>
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" class="btn btn-primary"><i class="fas fa-share-square"></i> Save</button>
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
import { onMounted, reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios';

export default {
   data() {
		return {
			validations: [],
			departments: [],
			selectedOption: null,
			inputNik: '',
			inputName: ''
      };
   },
   mounted() {
      this.fetchDepartments();
   },
   methods: {
		async fetchDepartments() {
			try {
				const response = await axios.get('http://localhost:8000/api/department')
				this.departments = response.data.data
			} catch (error) {
				console.error('Error fetching departments:', error)
			}
      },
      async submitForm() {
			try {
				await axios.post('http://localhost:8000/api/client', {
					nik: this.inputNik,
					name: this.inputName,
					department_id: this.selectedOption
				})

				this.$router.push({ name: 'client.index' })
			} catch (error) {
				this.validations = error.response.data
			}
      },
   },
};
</script>